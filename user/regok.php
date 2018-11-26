<?php
/**
 * 开通成功页面
**/
include("../includes/common.php");
$title='开通分站成功';
include './head.php';
?>
<style>
img.logo{width:14px;height:14px;margin:0 5px 0 3px;}
</style>
  <nav class="navbar navbar-fixed-top navbar-default">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">导航按钮</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="./">自助下单系统管理中心</a>
      </div><!-- /.navbar-header -->
      <div id="navbar" class="collapse navbar-collapse">
        <ul class="nav navbar-nav navbar-right">
          <li>
            <a href="./login.php"><span class="glyphicon glyphicon-user"></span> 登陆</a>
          </li>
		  <li class="active"><a href="./reg.php"><span class="glyphicon glyphicon-globe"></span> 自助开通</a></li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container -->
  </nav><!-- /.navbar -->
  <div style="padding-top:70px;">
    <div class="col-xs-12 col-sm-10 col-md-6 center-block" style="float: none;">
<?php
if(isset($_GET['orderid'])){
	$orderid = daddslashes($_GET['orderid']);
	$row=$DB->get_row("SELECT * FROM shua_pay WHERE trade_no='{$orderid}' limit 1");
	if(!$row || $row['status']==0 || $row['tid']!=-2)showmsg('订单不存在或未完成支付！',3);
	if(!$cookiesid || $row['userid']!=$cookiesid)showmsg('仅限查看自己开通的分站信息',3);
	$input=explode('|',$row['input']);
	$kind = intval($input[0]);
	$domain = daddslashes($input[1]);
	$user = daddslashes($input[2]);
	$pwd = daddslashes($input[3]);
	$name = daddslashes($input[4]);
	$qq = daddslashes($input[5]);
	$endtime = daddslashes($input[6]);
	$url = 'http://'.$domain.'/';
}elseif(isset($_GET['zid'])){
	$zid = intval($_GET['zid']);
	$row=$DB->get_row("SELECT * FROM shua_site WHERE zid='{$zid}' limit 1");
	if(!$row || !$_SESSION['newzid'] || $_SESSION['newzid']!=$zid)showmsg('你所开通的分站信息不存在！',3);
	$kind = intval($row['power']);
	$domain = $row['domain'];
	$user = $row['user'];
	$pwd = $row['pwd'];
	$name = $row['sitename'];
	$qq = $row['qq'];
	$endtime = $row['endtime'];
	$url = 'http://'.$domain.'/';
}else{
	showmsg('缺少参数',4);
}
?>
		<div class="panel panel-primary table-responsive">
            <div class="panel-heading">
                开通分站成功
            </div>
            <div class="panel-body">
			<div class="alert alert-success">
				恭喜你分站开通成功，请牢记以下信息
			</div>
                <li class="list-group-item"><b>分站网址：</b><a href="<?php echo $url?>" target="_blank"><?php echo $url?></a></li>
				<li class="list-group-item"><b>分站管理后台：</b><a href="<?php echo $url?>user/" target="_blank"><?php echo $url?>user/</a></li>
				<li class="list-group-item"><b>管理员用户名：</b><?php echo $user?></a></li>
				<li class="list-group-item"><b>管理员密码：</b><?php echo $pwd?></a></li>
            </div>
        </div>
	</div>
</div>