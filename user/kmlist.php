<?php
/**
 * 卡密列表
**/
include("../includes/common.php");
$title = '卡密管理';
include 'head.php';
if($islogin2==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>

  <div class="container" style="padding-top:70px;">
    <div class="col-sm-12 col-md-10 center-block" style="float: none;">
<div class="modal fade" align="left" id="search" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">搜索卡密</h4>
      </div>
      <div class="modal-body">
      <form action="kmlist.php" method="GET">
<input type="text" class="form-control" name="kw" placeholder="请输入卡密或QQ"><br/>
<input type="submit" class="btn btn-primary btn-block" value="搜索"></form>
</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php
if($conf['fenzhan_kami']==0){
	showmsg('当前站点未开启此功能！',3);
}
function getkm($len = 18)
{
	$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
	$strlen = strlen($str);
	$randstr = "";
	for ($i = 0; $i < $len; $i++) {
		$randstr .= $str[mt_rand(0, $strlen - 1)];
	}
	return $randstr;
}

$price_obj = new Price($userrow['zid'],$userrow);
$rs=$DB->query("SELECT * FROM shua_tools WHERE active=1 and cost!=0 and is_curl!=4 order by sort asc");
$select='';
while($res = $DB->fetch($rs)){
	$price_obj->setToolInfo($res['tid'],$res);
	$price=$price_obj->getBuyPrice($res['tid']);
	if($price>0){
		$shua_func[$res['tid']]=$res['name'];
		$kmneed[$res['tid']]=$res['cost'];
		$select.='<option value="'.$res['tid'].'">'.$res['name'].'('.$res['cost'].'元)</option>';
	}
}

$my=isset($_GET['my'])?$_GET['my']:null;

if($my=='add'){
$tid=intval($_POST['tid']);
$num=intval($_POST['num']);
if($num<=0)showmsg('生成数量不能为负值',3);
if(!isset($kmneed[$tid]))showmsg('商品不存在',3);
$need=$kmneed[$tid]*$num;
if($userrow['rmb']<$need)showmsg('您的余额不足，请充值！',3);
$DB->query("update shua_site set rmb=rmb-{$need} where zid='{$userrow['zid']}'");
echo "<ul class='list-group'><li class='list-group-item active'>成功生成以下卡密</li>";
for ($i = 0; $i < $num; $i++) {
	$km=getkm(18);
	$sql=$DB->query("insert into `shua_kms` (`tid`,`km`,`value`,`addtime`,`zid`,`money`) values ('".$tid."','".$km."','".$value."','".$date."','".$userrow['zid']."','".$kmneed[$tid]."')");
	if($sql) {
		echo "<li class='list-group-item'>$km</li>";
	}
}

echo '<a href="./kmlist.php" class="btn btn-default btn-block">>>返回卡密列表</a>';
}

elseif($my=='del'){
echo '<div class="panel panel-primary">
<div class="panel-heading w h"><h3 class="panel-title">删除卡密</h3></div>
<div class="panel-body box">';
$id=intval($_GET['id']);
$kmrow=$DB->get_row("SELECT * FROM shua_kms WHERE kid='$id' and zid='".$userrow['zid']."' limit 1");
if(!$kmrow){
	echo '卡密不存在！';
}else{
$sql=$DB->query("DELETE FROM shua_kms WHERE kid='$id'");
if($sql){
	if($kmrow['user']==0 && $kmrow['usetime']==null){
		$need=$kmrow['money']?$kmrow['money']:$kmneed[$kmrow['tid']];
		$DB->query("update shua_site set rmb=rmb+{$need} where zid='{$userrow['zid']}'");
		echo '删除成功！已退回'.$need.'元到你的账号';
	}else{
		echo '删除成功！';
	}
}else{echo '删除失败！';}
}
echo '<hr/><a href="./kmlist.php">>>返回卡密列表</a></div></div>';
}

elseif($my=='qk'){//清空卡密
echo '<div class="panel panel-primary">
<div class="panel-heading w h"><h3 class="panel-title">清空卡密</h3></div>
<div class="panel-body box">
您确认要清空所有卡密吗？清空后无法恢复！<br><a href="./kmlist.php?my=qk2">确认</a> | <a href="javascript:history.back();">返回</a></div></div>';
}
elseif($my=='qk2'){//清空卡密结果
echo '<div class="panel panel-primary">
<div class="panel-heading w h"><h3 class="panel-title">清空卡密</h3></div>
<div class="panel-body box">';
if($DB->query("DELETE FROM shua_kms where `zid`='{$userrow['zid']}'")==true){
echo '<div class="box">清空成功.</div>';
}else{
echo'<div class="box">清空失败.</div>';
}
echo '<hr/><a href="./kmlist.php">>>返回卡密列表</a></div></div>';
}
elseif($my=='qkuse'){//清空已使用卡密
echo '<div class="panel panel-primary">
<div class="panel-heading w h"><h3 class="panel-title">清空已使用卡密</h3></div>
<div class="panel-body box">
您确认要清空所有已使用过的卡密吗？清空后无法恢复！<br><a href="./kmlist.php?my=qkuse2">确认</a> | <a href="javascript:history.back();">返回</a></div></div>';
}
elseif($my=='qkuse2'){//清空已使用卡密结果
echo '<div class="panel panel-primary">
<div class="panel-heading w h"><h3 class="panel-title">清空已使用卡密</h3></div>
<div class="panel-body box">';
if($DB->query("DELETE FROM qiuqiu_kms WHERE user!=0 and `zid`='{$userrow['zid']}'")==true){
echo '<div class="box">清空成功.</div>';
}else{
echo'<div class="box">清空失败.</div>';
}
echo '<hr/><a href="./kmlist.php">>>返回卡密列表</a></div></div>';
}
else
{

echo '<form action="kmlist.php?my=add" method="POST" class="form-inline">
  <div class="form-group">
    <label>卡密生成</label>
	<select name="tid" class="form-control">'.$select.'</select>
  </div>
  <div class="form-group">
    <input type="text" class="form-control" name="num" placeholder="生成的卡密数量" required>
  </div>
  <button type="submit" class="btn btn-primary">生成</button>
  <a href="kmlist.php?my=qk" class="btn btn-danger">清空</a>
  <a href="kmlist.php?my=qkuse" class="btn btn-danger">清空已使用</a>
  <a href="#" data-toggle="modal" data-target="#search" id="search" class="btn btn-success">搜索</a>
</form>';

if(isset($_GET['kw'])) {
	$kw=daddslashes($_GET['kw']);
	$sql=" (`km`='{$kw}' or `user`='{$kw}') and `zid`='{$userrow['zid']}'";
	$numrows=$DB->count("SELECT count(*) from shua_kms WHERE{$sql}");
	$con='包含 '.$_GET['kw'].' 的共有 <b>'.$numrows.'</b> 个卡密';
	$link='&kw='.$kw;
}else{
	$sql=" `zid`='{$userrow['zid']}'";
	$numrows=$DB->count("SELECT count(*) from shua_kms WHERE{$sql}");
	$con='你共有 <b>'.$numrows.'</b> 个卡密，你的当前余额:<b>'.$userrow['rmb'].'</b>元';
}
echo $con;
?>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead><tr><th>卡密</th><th>状态</th><th>添加时间</th><th>使用时间</th><th>操作</th></tr></thead>
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

$rs=$DB->query("SELECT * FROM shua_kms WHERE{$sql} order by kid desc limit $offset,$pagesize");
while($res = $DB->fetch($rs))
{
if($res['usetime']==null) {
	$isuse='<font color="green">未使用</font>';
} else {
	$isuse='<font color="red">已使用</font><br/>使用者:'.$res['user'];
}
echo '<tr><td><b>'.$res['km'].'</b><br/>'.$shua_func[$res['tid']].'</td><td>'.$isuse.'</td><td>'.$res['addtime'].'</td><td>'.$res['usetime'].'</td><td><a href="./kmlist.php?my=del&id='.$res['kid'].'" class="btn btn-xs btn-danger" onclick="return confirm(\'你确实要删除此卡密吗？\');">删除</a></td></tr>';
}
?>
          </tbody>
        </table>
      </div>
<?php
echo'<ul class="pagination">';
$first=1;
$prev=$page-1;
$next=$page+1;
$last=$pages;
if ($page>1)
{
echo '<li><a href="kmlist.php?page='.$first.$link.'">首页</a></li>';
echo '<li><a href="kmlist.php?page='.$prev.$link.'">&laquo;</a></li>';
} else {
echo '<li class="disabled"><a>首页</a></li>';
echo '<li class="disabled"><a>&laquo;</a></li>';
}
for ($i=1;$i<$page;$i++)
echo '<li><a href="kmlist.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '<li class="disabled"><a>'.$page.'</a></li>';
for ($i=$page+1;$i<=$pages;$i++)
echo '<li><a href="kmlist.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '';
if ($page<$pages)
{
echo '<li><a href="kmlist.php?page='.$next.$link.'">&raquo;</a></li>';
echo '<li><a href="kmlist.php?page='.$last.$link.'">尾页</a></li>';
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
<?php include 'foot.php';?>