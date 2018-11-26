<?php
/**
 * 登录
**/
$is_defend=true;
include("../includes/common.php");
if(isset($_POST['user']) && isset($_POST['pass'])){
	$user=daddslashes($_POST['user']);
	$pass=daddslashes($_POST['pass']);
	$row=$DB->get_row("SELECT * FROM shua_site WHERE user='$user' limit 1");
	if($row && $user==$row['user'] && $pass==$row['pwd']) {
		if($row['status']==0){
			@header('Content-Type: text/html; charset=UTF-8');
			exit("<script language='javascript'>alert('当前分站已关闭！');history.go(-1);</script>");
		}
		elseif($conf['fenzhan_expiry']>0 && $row['endtime']<$date){
			@header('Content-Type: text/html; charset=UTF-8');
			exit("<script language='javascript'>alert('你的账号已到期，请联系管理员续费！');history.go(-1);</script>");
		}
		$session=md5($user.$pass.$password_hash);
		$token=authcode("{$row['zid']}\t{$session}", 'ENCODE', SYS_KEY);
		setcookie("user_token", $token, time() + 604800, '/');
		log_result('分站登录', 'User:'.$user.' IP:'.$clientip, null, 1);
		$DB->query("update shua_site set lasttime='$date' where zid='{$row['zid']}'");
		@header('Content-Type: text/html; charset=UTF-8');
		exit("<script language='javascript'>alert('登陆用户中心成功！');window.location.href='./';</script>");
	}else {
		@header('Content-Type: text/html; charset=UTF-8');
		exit("<script language='javascript'>alert('用户名或密码不正确！');history.go(-1);</script>");
	}
}elseif(isset($_GET['logout'])){
	setcookie("user_token", "", time() - 604800, '/');
	@header('Content-Type: text/html; charset=UTF-8');
	exit("<script language='javascript'>alert('您已成功注销本次登陆！');window.location.href='./login.php';</script>");
}elseif($islogin2==1){
	@header('Content-Type: text/html; charset=UTF-8');
	exit("<script language='javascript'>alert('您已登陆！');window.location.href='./';</script>");
}
$title='用户登录';
include './head2.php';
?>
<img src="<?php echo $backdrop_img;?>" alt="Full Background" class="full-bg full-bg-bottom animated pulse" ondragstart="return false;" oncontextmenu="return false;">
<div class="col-xs-12 col-sm-10 col-md-8 col-lg-4 center-block " style="float: none;">
  <br /><br /><br />
    <div class="widget">
    <div class="widget-content themed-background-flat text-center"  style="background-image: url(<?php echo $cdnserver?>assets/simple/img/userbg.jpg);background-size: 100% 100%;" >
<img  class="img-circle"src="//q4.qlogo.cn/headimg_dl?dst_uin=<?php echo $conf['kfqq'];?>&spec=100" alt="Avatar" alt="avatar" height="60" width="60" />
<p></p>
    </div>

    <div class="block">
        <div class="block-title">
            <div class="block-options pull-right">
            <a href="../" class="btn btn-effect-ripple btn-default toggle-bordered enable-tooltip">返回首页</a>
            </div>
            <h2><i class="fa fa-user"></i>&nbsp;&nbsp;<b>分站后台登录</b></h2>
        </div>
          <form action="./login.php" method="post" role="form">
            <div class="input-group"><div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
              <input type="text" name="user" value="" class="form-control" required="required" placeholder="用户名"/>
            </div><br/>
            <div class="input-group"><div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
              <input type="password" name="pass" class="form-control" required="required" placeholder="密码"/>
            </div><br/>
            <div class="form-group">
              <input type="submit" value="立即登陆" class="btn btn-primary btn-block"/>
            </div>
			<hr>
			<div class="form-group">
			<a href="findpwd.php" class="btn btn-info btn-rounded"><i class="fa fa-unlock"></i>&nbsp;找回密码</a>
			<a href="reg.php" class="btn btn-danger btn-rounded" style="float:right;"><i class="fa fa-user-plus"></i>&nbsp;开通分站</a>
			</div>
          </form>
    </div>
  </div>
<script src="//lib.baomitu.com/jquery/1.12.4/jquery.min.js"></script>
<script src="//lib.baomitu.com/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="<?php echo $cdnserver?>assets/appui/js/plugins.js"></script>
</body>
</html>