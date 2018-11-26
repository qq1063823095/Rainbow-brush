<?php
/**
 * 导出订单列表
**/
include("../includes/common.php");
$title='导出订单列表';
include './head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");

$rs=$DB->query("SELECT * FROM shua_class WHERE active=1 order by sort asc");
$select='<option value="0">请选择分类</option>';
$shua_class[0]='默认分类';
while($res = $DB->fetch($rs)){
	$shua_class[$res['cid']]=$res['name'];
	$select.='<option value="'.$res['cid'].'">'.$res['name'].'</option>';
}

$select2='<option value="0">请选择商品</option>';
?>
  <div class="container" style="padding-top:70px;">
    <div class="col-sm-12 col-md-10 col-lg-8 center-block" style="float: none;">
	  <div class="panel panel-primary">
        <div class="panel-heading"><h3 class="panel-title">导出订单列表</h3></div>
        <div class="panel-body">
          <form action="download.php" method="get" role="form">
		    <div class="form-group">
				<div class="input-group"><div class="input-group-addon">选择分类</div>
				<select name="cid" id="cid" class="form-control"><?php echo $select?></select>
			</div></div>
			<div class="form-group">
				<div class="input-group"><div class="input-group-addon">选择商品</div>
				<select name="tid" id="tid" class="form-control"><?php echo $select2?></select>
			</div></div>
			<div class="form-group">
				<div class="input-group"><div class="input-group-addon">要导出的订单状态</div>
				<select name="status" id="status" class="form-control">
					<option value="0">待处理</option>
					<option value="1">已完成</option>
					<option value="2">正在处理</option>
					<option value="3">异常</option>
				</select>
			</div></div>
			<div class="form-group">
				<div class="input-group"><div class="input-group-addon">导出同时改变状态</div>
				<select name="sign" id="sign" class="form-control">
					<option value="0">不改变状态</option>
					<option value="1">标记为已完成</option>
					<option value="2">标记为正在处理</option>
				</select>
			</div></div>
            <p><input type="submit" value="生成TXT" class="btn btn-primary form-control"/></p>
          </form>
        </div>
		<div class="panel-footer">
          <span class="glyphicon glyphicon-info-sign"></span> 生成txt的格式：输入内容1----输入内容2----输入内容3----输入内容4----输入内容5----下单数量<br/>
		  已标记为已完成的下次导出时就不会导出了。
        </div>
      </div>
    </div>
  </div>
<script src="//lib.baomitu.com/layer/2.3/layer.js"></script>
<script>
$("#cid").change(function () {
	var cid = $(this).val();
	var ii = layer.load(2, {shade:[0.1,'#fff']});
	$("#tid").empty();
	$("#tid").append('<option value="0">请选择商品</option>');
	$.ajax({
		type : "GET",
		url : "../ajax.php?act=gettool&cid="+cid,
		dataType : 'json',
		success : function(data) {
			layer.close(ii);
			if(data.code == 0){
				var num = 0;
				$.each(data.data, function (i, res) {
					$("#tid").append('<option value="'+res.tid+'">'+res.name+'</option>');
					num++;
				});
				$("#tid").val(0);
				if(num==0 && cid!=0)layer.alert('该分类下没有商品');
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
window.onload=$("#cid").change();
</script>