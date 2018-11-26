<?php
/**
 * 商品管理
**/
include("../includes/common.php");
$title='商品管理';
include './head.php';
if($islogin2==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");

?>
<style>
<!-- body {  background: linear-gradient(to bottom,#333333,#333333);"background-size:100% 100%; } -->
</style>
   <div class="col-xs-12 col-sm-10 col-md-8 col-lg-6 center-block" style="padding-top:70px; float: none;">
     <div class="panel panel-primary">
    <div class="panel-heading" style="background: linear-gradient(to right,#14b7ff,#b221ff);">
        <h3 class="panel-title"><font color="#fff">商品价格管理</font></h3>
    </div>
     
<?php

$rs=$DB->query("SELECT * FROM shua_class WHERE active=1 order by sort asc");

$my=isset($_GET['my'])?$_GET['my']:null;

$rs=$DB->query("SELECT * FROM shua_class WHERE active=1 order by sort asc");
$select='<option value="0">请选择分类</option>';
$shua_class[0]='未分类';
while($res = $DB->fetch($rs)){
	$shua_class[$res['cid']]=$res['name'];
	$select.='<option value="'.$res['cid'].'">'.$res['name'].'</option>';
}
?>
<div class="modal fade col-xs-12 " align="left" id="search2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"><br><br><br><br>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h5 class="modal-title" id="myModalLabel">商品分类</h5>
      </div>
      <div class="modal-body">
      <form action="shoplist.php" method="GET">
<select name="cid" class="form-control"><?php echo $select?></select><br/>
<input type="submit" class="btn btn-primary btn-block" value="查看"></form>
</div>

    </div>
  </div>
</div>
<?php
$price_obj = new Price($userrow['zid'],$userrow);

if($my=='edit')
{
$tid=intval($_GET['tid']);
$row=$DB->get_row("select * from shua_tools where tid='$tid' limit 1");
$price_obj->setToolInfo($tid,$row);
echo '<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title">修改商品价格</h3></div>';
echo '<div class="panel-body">';
echo '<form action="./shoplist.php?my=edit_submit&tid='.$tid.'" method="POST">
<div class="form-group">
<label>商品名称:</label><br>
<input type="text" class="form-control" name="name" value="'.$row['name'].'" disabled>
</div>';
if($userrow['power']==1)echo '
<div class="form-group">
<label>成本价格:</label><br>
<input type="text" class="form-control" name="cost2" value="'.$price_obj->getToolCost2($tid).'" disabled>
</div>
<div class="form-group">
<label>下级分站代理价格:</label><br>
<input type="text" class="form-control" name="cost" value="'.$price_obj->getToolCost($tid).'">
</div>';
else echo '
<div class="form-group">
<label>成本价格:</label><br>
<input type="text" class="form-control" name="cost" value="'.$price_obj->getToolCost($tid).'" disabled>
</div>';
echo '<div class="form-group">
<label>销售价格:</label><br>
<input type="text" class="form-control" name="price" value="'.$price_obj->getToolPrice($tid).'">
</div>
<div class="form-group">
<label>是否上架:</label><br>
<select class="form-control" name="del" default="'.$price_obj->getToolDel($tid).'"><option value="0">1_是</option><option value="1">0_否</option></select>
</div>
<input type="submit" class="btn btn-primary btn-block" value="确定修改"></form>
';
echo '<br/><a href="./shoplist.php">>>返回商品列表</a>
<script>
var items = $("select[default]");
for (i = 0; i < items.length; i++) {
	$(items[i]).val($(items[i]).attr("default")||0);
}
</script>';
}
elseif($my=='edit_submit')
{
$tid=intval($_GET['tid']);
$rows=$DB->get_row("select * from shua_tools where tid='$tid' limit 1");
if(!$rows)
	showmsg('当前记录不存在！',3);
$price_obj->setToolInfo($tid,$rows);
$price=round(daddslashes($_POST['price']),2);
$del=intval($_POST['del']);
if(!is_numeric($price) || !preg_match('/^[0-9.]+$/', $price))showmsg('价格输入不规范',3);
if($userrow['power']==1){
	$cost=round(daddslashes($_POST['cost']),2);
	if(!is_numeric($cost) || !preg_match('/^[0-9.]+$/', $cost))showmsg('价格输入不规范',3);
	if($cost<$price_obj->getToolCost2($tid)){
		showmsg('下级代理价格不能低于成本价格！',3);
	}
	if($price<$cost){
		showmsg('销售价格不能低于下级代理价格！',3);
	}
}else{
	if($price<$price_obj->getToolCost($tid)){
		showmsg('销售价格不能低于成本价格！',3);
	}
	$cost=0;
}
if($price_obj->setPriceInfo($tid,$del,$price,$cost))
	showmsg('修改商品成功！<br/><br/><a href="./shoplist.php">>>返回商品列表</a>',1);
else
	showmsg('修改商品失败！'.$DB->error(),4);
}
elseif($my=='reset')
{
if($DB->query("update shua_site set price=NULL where zid='{$userrow['zid']}'"))
	showmsg('重置成功！<br/><br/><a href="./shoplist.php">>>返回商品列表</a>',1);
else
	showmsg('重置失败！'.$DB->error(),4);
}
else
{
if(isset($_GET['cid'])){
	$cid = intval($_GET['cid']);
	$numrows=$DB->count("SELECT count(*) from shua_tools where cid='$cid' and active=1");
	$sql=" cid='$cid' and active=1";
	$con='分类 '.$shua_class[$cid].' 共有 <b>'.$numrows.'</b> 个商品&nbsp;[<a href="shoplist.php">查看全部</a>]';
}else{
	$numrows=$DB->count("SELECT count(*) from shua_tools where active=1");
	$sql=" active=1";
	$con='<div class="well well-sm">系统共有 <b>'.$numrows.'</b> 个商品 - 提升价格赚的更多哦！提高价格最好不要超过10否则太贵了没人买的哦！</div>
    
    <center><div class="btn-group">
    <a href="#" data-toggle="modal" data-target="#search2" id="search2" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-th-large"></span> 分类查看</a> <a class="btn btn-primary btn-sm" onclick="return confirm(\'是否要重置所有商品价格设定，恢复到最初状态？\');" href="shoplist.php?my=reset"><span class="glyphicon glyphicon-repeat"></span> 恢复价格</a><a class="btn btn-success btn-sm" href="javascript:void(0)" onclick="up_price(\''.$userrow['zid'].'\')"><span class="glyphicon glyphicon-arrow-up"></span> 提升销售价格</a></div></center>
    ';
}

echo $con;

?>
        <table class="table table-striped" style="font-size:12px" >
          <thead ><tr ><th style="font-size:14px">名称</th><th style="font-size:14px">成本</th><?php if($userrow['power']==1){?><th style="font-size:14px">下级</th><?php }?><th style="font-size:14px">销售</th><th style="font-size:10px"><span class="glyphicon glyphicon-eye-open"></span></th><th style="font-size:14px">操作</th></tr></thead>
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

$rs=$DB->query("SELECT * FROM shua_tools WHERE{$sql} order by sort asc limit $offset,$pagesize");
while($res = $DB->fetch($rs))
{
	$price_obj->setToolInfo($res['tid'],$res);
echo '<tr><td><b>'.$res['name'].'</td><td><font color="#7D9EC0">'.($userrow['power']==1?$price_obj->getToolCost2($res['tid']).'元</font></td><td><font color="#9400D3">'.$price_obj->getToolCost($res['tid']):$price_obj->getToolCost($res['tid'])).'元</font></td><td><font color="#FF0000">'.$price_obj->getToolPrice($res['tid']).'元</font> </td><td>'.($price_obj->getToolDel($res['tid'])==1?'<font color=red><span class="glyphicon glyphicon-remove"></span></font>':'<font color=green><span class="glyphicon glyphicon-ok"></span></font>').'</td><td><a href="./shoplist.php?my=edit&tid='.$res['tid'].'" class="label label-primary">编辑</a></td></tr>';
}
?>
          </tbody>
        </table>

<?php
echo'<ul class="pagination">';
$first=1;
$prev=$page-1;
$next=$page+1;
$last=$pages;
if ($page>1)
{
echo '<li><a href="shoplist.php?page='.$first.$link.'">首页</a></li>';
echo '<li><a href="shoplist.php?page='.$prev.$link.'">&laquo;</a></li>';
} else {
echo '<li class="disabled"><a>首页</a></li>';
echo '<li class="disabled"><a>&laquo;</a></li>';
}
for ($i=1;$i<$page;$i++)
echo '<li><a href="shoplist.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '<li class="disabled"><a>'.$page.'</a></li>';
for ($i=$page+1;$i<=$pages;$i++)
echo '<li><a href="shoplist.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '';
if ($page<$pages)
{
echo '<li><a href="shoplist.php?page='.$next.$link.'">&raquo;</a></li>';
echo '<li><a href="shoplist.php?page='.$last.$link.'">尾页</a></li>';
} else {
echo '<li class="disabled"><a>&raquo;</a></li>';
echo '<li class="disabled"><a>尾页</a></li>';
}
echo'</ul>';
#分页
}?>
    </div>
<script src="//lib.baomitu.com/layer/2.3/layer.js"></script>
<script>
function up_price(zid){
    	layer.prompt({title: '价格提升百分比 例如5 最好不要超过10', formType: 0}, function(text, index){
		layer.close(index);
		if(text.indexOf("%")==-1){
			text=text+'%';
		}
		$.ajax({
			type:"post",
			url:"ajax.php?act=up_price",
			data:{
				zid:<?=$userrow['zid']?>,up:text
			},
			dataType:"json",
			success:function(data){
				if(data.code==0){
					layer.alert('价格提升成功，刷新即可看到效果',function(){
                      window.location.reload();
                    });
				}else{
					layer.alert(data.msg);
				}
			}
		});
	});
}
</script></div>
</div>