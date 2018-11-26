<?php
/**
 * 订单管理
**/
include("../includes/common.php");
$title='订单管理';
include './head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>
  <div class="container-fluid" style="padding-top:70px;">
    <div class="col-md-12 center-block" style="float: none;">
<?php
function display_zt($zt,$id=0){
	if($zt==1)
		return '<a onclick="setResult('.$id.',\'订单结果\')" title="点此填写结果"><font color=green>已完成</font></a>';
	elseif($zt==2)
		return '<font color=orange>正在处理</font>';
	elseif($zt==3)
		return '<a onclick="setResult('.$id.')" title="点此填写异常原因"><font color=red>异常</font></a>';
	elseif($zt==4)
		return '<font color=grey>已退单</font>';
	else
		return '<font color=blue>待处理</font>';
}
function display_djzt($zt,$id=0){
	if($zt==1)
		return '<span onclick="showStatus('.$id.')" title="查看订单进度" class="btn btn-success btn-xs">成功</span>';
	elseif($zt==2)
		return '<span onclick="djOrder('.$id.')" title="点击重试" class="btn btn-danger btn-xs">失败</span>';
	elseif($zt==3)
		return '<a onclick="window.open(\'fakakms.php?orderid='.$id.'\')" title="查看卡密信息"><font color=green>已发卡</font></a>';
	elseif($zt==4)
		return '<span onclick="djOrder('.$id.')" title="点击重试" class="btn btn-danger btn-xs">未发卡</span>';
	else
		return '<font color=grey>未对接</font>';
}

$rs=$DB->query("SELECT * FROM shua_tools WHERE 1 order by sort asc");
$select='';
while($res = $DB->fetch($rs)){
	$shua_func[$res['tid']]=$res['name'];
	$select.='<option value="'.$res['tid'].'">'.$res['name'].'</option>';
}

if(isset($_GET['my']) && $_GET['my']=='op')
{
$status=$_POST['status'];
$checkbox=$_POST['checkbox'];
$i=0;
$statuss=$conf['shequ_status']?$conf['shequ_status']:1;
foreach($checkbox as $id){
	if($status==4)$DB->query("DELETE FROM shua_orders WHERE id='$id'");
	elseif($status==5){
		$result = do_goods($id);
		if(strpos($result,'成功')!==false){
			$DB->query("update shua_orders set status='$statuss',djzt='1',result=NULL where id='{$id}'");
		}
	}elseif($status==6){
		$row=$DB->get_row("select * from shua_orders where id='$id' limit 1");
		if($row && $row['zid']>1 && $row['status']==3){
			$tc_point=$DB->get_column("select point from shua_points where zid='{$row['zid']}' and action='提成' and orderid='$id' limit 1");
			$money=$row['money'];
			if($tc_point>0)$money-=$tc_point;
			$DB->query("update `shua_site` set `rmb`=`rmb`+{$money} where `zid`='{$row['zid']}'");
			addPointRecord($row['zid'], $money, '退款', '订单(ID'.$id.')已退款到分站余额');
			$DB->query("update shua_orders set status='4',result=NULL where id='{$id}'");
		}
	}
	else $DB->query("update shua_orders set status='$status' where id='$id' limit 1");
	$i++;
}
exit("<script language='javascript'>alert('成功改变{$i}条订单状态');history.go(-1);</script>");
}
else
{

if(isset($_GET['kw']) && !empty($_GET['kw'])) {
	$sql=" `input`='{$_GET['kw']}' or `id`='{$_GET['kw']}' or `tradeno`='{$_GET['kw']}'";
	$numrows=$DB->count("SELECT count(*) from shua_orders WHERE{$sql}");
	$con='包含 '.$_GET['kw'].' 的共有 <b>'.$numrows.'</b> 个订单';
	$link='&kw='.$_GET['kw'];
}elseif(isset($_GET['tid'])) {
	$sql=" `tid`='{$_GET['tid']}'";
	$numrows=$DB->count("SELECT count(*) from shua_orders WHERE{$sql}");
	$con=$shua_func[$_GET['tid']].' 共有 <b>'.$numrows.'</b> 个订单';
	$link='&tid='.$_GET['tid'];
}elseif(isset($_GET['zid'])) {
	$sql=" `zid`='{$_GET['zid']}'";
	$numrows=$DB->count("SELECT count(*) from shua_orders WHERE{$sql}");
	$con='站点ID '.$_GET['zid'].' 的共有 <b>'.$numrows.'</b> 个订单';
	$link='&zid='.$_GET['zid'];
}elseif(isset($_GET['type'])) {
	$sql=" `status`='{$_GET['type']}'";
	$numrows=$DB->count("SELECT count(*) from shua_orders WHERE{$sql}");
	$con=''.display_zt($_GET['type']).' 状态的共有 <b>'.$numrows.'</b> 个订单';
	if($_GET['type']==3)$con.='&nbsp;[<a href="list.php?my=fillall" onclick="return confirm(\'你确定要将所有异常订单改为待处理状态吗？\');">将所有异常订单改为待处理状态</a>]';
	$link='&type='.$_GET['type'];
}else{
	$numrows=$DB->count("SELECT count(*) from shua_orders");
	$ondate=$DB->count("select count(*) from shua_orders where status=1");
	$ondate2=$DB->count("select count(*) from shua_orders where status=2");
	$sql=" 1";
	$con='系统共有 <b>'.$numrows.'</b> 个订单，其中已完成的有 <b>'.$ondate.'</b> 个，正在处理的有 <b>'.$ondate2.'</b> 个。';
}
?>
<form action="list.php" method="GET" class="form-inline">
  <div class="form-group">
    <label>搜索订单</label>
    <input type="text" class="form-control" name="kw" placeholder="请输入下单账号或订单号">
	<select name="type" class="form-control"><option value="0">待处理</option><option value="2">正在处理</option><option value="1">已完成</option><option value="3">异常</option><option value="4">删除订单</option></select>
  </div>
  <button type="submit" class="btn btn-primary">搜索</button>&nbsp;
  <a href="./export.php" class="btn btn-success">导出订单</a>
  <a href="./log.php" class="btn btn-warning" target="_blank">对接日志</a>
</form>

	  <form name="form1" method="post" action="list.php?my=op">
	  <div class="table-responsive">
        <table class="table table-striped">
          <thead><tr><th>订单ID</th><th>商品名称</th><th>下单数据</th><th>份数</th><th>站点ID</th><th>添加时间</th><th>对接状态</th><th>订单状态</th><th>操作</th></tr></thead>
          <tbody>
<?php
$pagesize=30;
$pages=intval($numrows/$pagesize);
if ($numrows%$pagesize)
{
 $pages++;
 }
if (isset($_GET['page'])){
$page=intval($_GET['page']);
}
else{
$page=1;
}
$offset=$pagesize*($page - 1);

$rs=$DB->query("SELECT * FROM shua_orders WHERE{$sql} order by id desc limit $offset,$pagesize");
while($res = $DB->fetch($rs))
{
echo '<tr><td><input type="checkbox" name="checkbox[]" id="list1" value="'.$res['id'].'" onClick="unselectall1()"><b>'.$res['id'].'</b></td><td><span onclick="showOrder('.$res['id'].')" title="点击查看详情">'.$shua_func[$res['tid']].'</span></td><td><span onclick="inputOrder('.$res['id'].')" title="点击修改数据">'.$res['input'].($res['input2']?'<br/>'.$res['input2']:null).($res['input3']?'<br/>'.$res['input3']:null).($res['input4']?'<br/>'.$res['input4']:null).($res['input5']?'<br/>'.$res['input5']:null).'</span></td><td><span onclick="inputNum('.$res['id'].')" title="点击修改份数">'.$res['value'].'</span></td><td><a href ="sitelist.php?zid='.$res['zid'].'" target="_blank">'.$res['zid'].'</a></span></td><td>'.$res['addtime'].'</td><td>'.display_djzt($res['djzt'],$res['id']).'</td><td>'.display_zt($res['status'],$res['id']).'</td><td><select onChange="javascript:setStatus(\''.$res['id'].'\',this.value)" class="form-control"><option selected>操作订单</option><option value="0">待处理</option><option value="2">正在处理</option><option value="1">已完成</option><option value="4">已退单</option><option value="3">异常</option>'.($res['zid']>1?'<option value="6">退款</option>':null).'<option value="5">删除订单</option></select></td></tr>';
}
?>
          </tbody>
        </table>
<input name="chkAll1" type="checkbox" id="chkAll1" onClick="this.value=check1(this.form.list1)" value="checkbox">&nbsp;全选&nbsp;
<select name="status"><option selected>操作订单</option><option value="0">待处理</option><option value="2">正在处理</option><option value="1">已完成</option><option value="3">异常</option><option value="5">重新下单</option><option value="6">订单退款</option><option value="4">删除订单</option></select>
<input type="submit" name="Submit" value="确定">
      </div>
	 </form>
<script>
var checkflag1 = "false";
function check1(field) {
if (checkflag1 == "false") {
for (i = 0; i < field.length; i++) {
field[i].checked = true;}
checkflag1 = "true";
return "false"; }
else {
for (i = 0; i < field.length; i++) {
field[i].checked = false; }
checkflag1 = "false";
return "true"; }
}

function unselectall1()
{
    if(document.form1.chkAll1.checked){
	document.form1.chkAll1.checked = document.form1.chkAll1.checked&0;
	checkflag1 = "false";
    }
}
</script>
<?php
echo'<ul class="pagination">';
$first=1;
$prev=$page-1;
$next=$page+1;
$last=$pages;
if ($page>1)
{
echo '<li><a href="list.php?page='.$first.$link.'">首页</a></li>';
echo '<li><a href="list.php?page='.$prev.$link.'">&laquo;</a></li>';
} else {
echo '<li class="disabled"><a>首页</a></li>';
echo '<li class="disabled"><a>&laquo;</a></li>';
}
for ($i=1;$i<$page;$i++)
echo '<li><a href="list.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '<li class="disabled"><a>'.$page.'</a></li>';
if($pages>=10)$s=10;
else $s=$pages;
for ($i=$page+1;$i<=$s;$i++)
echo '<li><a href="list.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '';
if ($page<$pages)
{
echo '<li><a href="list.php?page='.$next.$link.'">&raquo;</a></li>';
echo '<li><a href="list.php?page='.$last.$link.'">尾页</a></li>';
} else {
echo '<li class="disabled"><a>&raquo;</a></li>';
echo '<li class="disabled"><a>尾页</a></li>';
}
echo'</ul>';
#分页
}
?>
    </div>
  </div>
<script src="//lib.baomitu.com/layer/2.3/layer.js"></script>
<script>
function showStatus(id) {
	var ii = layer.load(2, {shade:[0.1,'#fff']});
	$.ajax({
		type : 'GET',
		url : 'ajax.php?act=showStatus&id='+id,
		dataType : 'json',
		success : function(data) {
			layer.close(ii);
			if(data.code == 0){
				var item = data.data; 
				layer.open({
				  type: 1,
				  title: '订单进度查询',
				  skin: 'layui-layer-rim',
				  content: '以下数据来自'+data.domain+'<br/><table class="table"><tr><td class="warning">下单数量</td><td>'+item.num+'</td><td class="warning">下单时间</td><td colspan="3">'+item.add_time+'</td></tr><tr><td class="warning">初始数量</td><td>'+item.start_num+'</td><td class="warning">当前数量</td><td>'+item.now_num+'</td><td class="warning">订单状态</td><td><font color=blue>'+item.order_state+'</font></td></tr></table>'
				});
			}else{
				layer.alert(data.msg);
			}
		},
		error:function(data){
			layer.msg('服务器错误');
			return false;
		}
	});
}
function djOrder(id) {
	var ii = layer.load(2, {shade:[0.1,'#fff']});
	$.ajax({
		type : 'GET',
		url : 'ajax.php?act=djOrder&id='+id,
		dataType : 'json',
		success : function(data) {
			layer.close(ii);
			if(data.code == 0){
				layer.msg(data.msg);
				window.location.reload();
			}else{
				layer.alert(data.msg);
			}
		},
		error:function(data){
			layer.msg('服务器错误');
			return false;
		}
	});
}
function showOrder(id) {
	var ii = layer.load(2, {shade:[0.1,'#fff']});
	$.ajax({
		type : 'GET',
		url : 'ajax.php?act=order&id='+id,
		dataType : 'json',
		success : function(data) {
			layer.close(ii);
			if(data.code == 0){
				layer.open({
				  type: 1,
				  title: '订单详情',
				  skin: 'layui-layer-rim',
				  content: data.data
				});
			}else{
				layer.alert(data.msg);
			}
		},
		error:function(data){
			layer.msg('服务器错误');
			return false;
		}
	});
}
function inputOrder(id) {
	var ii = layer.load(2, {shade:[0.1,'#fff']});
	$.ajax({
		type : 'GET',
		url : 'ajax.php?act=order2&id='+id,
		dataType : 'json',
		success : function(data) {
			layer.close(ii);
			if(data.code == 0){
				layer.open({
				  type: 1,
				  title: '修改数据',
				  skin: 'layui-layer-rim',
				  content: data.data
				});
			}else{
				layer.alert(data.msg);
			}
		},
		error:function(data){
			layer.msg('服务器错误');
			return false;
		}
	});
}
function inputNum(id) {
	var ii = layer.load(2, {shade:[0.1,'#fff']});
	$.ajax({
		type : 'GET',
		url : 'ajax.php?act=order3&id='+id,
		dataType : 'json',
		success : function(data) {
			layer.close(ii);
			if(data.code == 0){
				layer.open({
				  type: 1,
				  title: '修改份数',
				  skin: 'layui-layer-rim',
				  content: data.data
				});
			}else{
				layer.alert(data.msg);
			}
		},
		error:function(data){
			layer.msg('服务器错误');
			return false;
		}
	});
}
function refund(id) {
	var ii = layer.load(2, {shade:[0.1,'#fff']});
	$.ajax({
		type : 'POST',
		url : 'ajax.php?act=getmoney',
		data : {id:id},
		dataType : 'json',
		success : function(data) {
			layer.close(ii);
			if(data.code == 0){
				layer.prompt({title: '填写退款金额', value: data.money, formType: 0}, function(text, index){
					var ii = layer.load(2, {shade:[0.1,'#fff']});
				$.ajax({
					type : 'POST',
					url : 'ajax.php?act=refund',
					data : {id:id,money:text},
					dataType : 'json',
					success : function(data) {
						layer.close(ii);
						if(data.code == 0){
							layer.msg(data.msg);
							window.location.reload();
						}else{
							layer.alert(data.msg);
						}
					},
					error:function(data){
						layer.msg('服务器错误');
						return false;
					}
				});
			});
			}else{
				layer.alert(data.msg);
			}
		},
		error:function(data){
			layer.msg('服务器错误');
			return false;
		}
	});
}
function setStatus(name, status) {
	if(status==6){
		refund(name);
		return false;
	}
	var ii = layer.load(2, {shade:[0.1,'#fff']});
	$.ajax({
		type : 'get',
		url : 'ajax.php',
		data : 'act=setStatus&name=' + name + '&status=' + status,
		dataType : 'json',
		success : function(ret) {
			layer.close(ii);
			if (ret['code'] != 200) {
				alert(ret['msg'] ? ret['msg'] : '操作失败');
			}
			window.location.reload();
		},
		error:function(data){
			layer.msg('服务器错误');
			return false;
		}
	});
}
function setResult(id,title) {
	var title = title || '异常原因';
	var ii = layer.load(2, {shade:[0.1,'#fff']});
	$.ajax({
		type : 'POST',
		url : 'ajax.php?act=result',
		data : {id:id},
		dataType : 'json',
		success : function(data) {
			layer.close(ii);
			if(data.code == 0){
				layer.prompt({title: '填写'+title, value: data.result, formType: 2}, function(text, index){
					var ii = layer.load(2, {shade:[0.1,'#fff']});
				$.ajax({
					type : 'POST',
					url : 'ajax.php?act=setresult',
					data : {id:id,result:text},
					dataType : 'json',
					success : function(data) {
						layer.close(ii);
						if(data.code == 0){
							layer.msg('填写'+title+'成功');
						}else{
							layer.alert(data.msg);
						}
					},
					error:function(data){
						layer.msg('服务器错误');
						return false;
					}
				});
			});
			}else{
				layer.alert(data.msg);
			}
		},
		error:function(data){
			layer.msg('服务器错误');
			return false;
		}
	});
}
function saveOrder(id) {
	var inputvalue=$("#inputvalue").val();
	if(inputvalue=='' || $("#inputvalue2").val()=='' || $("#inputvalue3").val()=='' || $("#inputvalue4").val()=='' || $("#inputvalue5").val()==''){layer.alert('请确保每项不能为空！');return false;}
	if($('#inputname').html()=='下单ＱＱ' && (inputvalue.length<5 || inputvalue.length>11)){layer.alert('请输入正确的QQ号！');return false;}
	$('#save').val('Loading');
	var ii = layer.load(2, {shade:[0.1,'#fff']});
	$.ajax({
		type : "POST",
		url : "ajax.php?act=editOrder",
		data : {id:id,inputvalue:inputvalue,inputvalue2:$("#inputvalue2").val(),inputvalue3:$("#inputvalue3").val(),inputvalue4:$("#inputvalue4").val(),inputvalue5:$("#inputvalue5").val()},
		dataType : 'json',
		success : function(data) {
			layer.close(ii);
			if(data.code == 0){
				layer.msg('保存成功！');
				window.location.reload();
			}else{
				layer.alert(data.msg);
			}
			$('#save').val('保存');
		} 
	});
}
function saveOrderNum(id) {
	var num=$("#num").val();
	if(num==''){layer.alert('请确保每项不能为空！');return false;}
	$('#save').val('Loading');
	var ii = layer.load(2, {shade:[0.1,'#fff']});
	$.ajax({
		type : "POST",
		url : "ajax.php?act=editOrderNum",
		data : {id:id,num:num},
		dataType : 'json',
		success : function(data) {
			layer.close(ii);
			if(data.code == 0){
				layer.msg('保存成功！');
				window.location.reload();
			}else{
				layer.alert(data.msg);
			}
			$('#save').val('保存');
		} 
	});
}
</script>