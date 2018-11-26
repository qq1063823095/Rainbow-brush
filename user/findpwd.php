<?php
/**
 * 找回密码
**/
$is_defend=true;
include("../includes/common.php");
if(isset($_GET['act']) && $_GET['act']=='qrlogin'){
	if(isset($_SESSION['findpwd_qq']) && $qq=$_SESSION['findpwd_qq']){
		$row=$DB->get_row("SELECT * FROM shua_site WHERE qq='$qq' limit 1");
		unset($_SESSION['findpwd_qq']);
		if($row['user']){
			if($conf['fenzhan_expiry']>0 && $row['endtime']<$date){
				@header('Content-Type: application/json; charset=UTF-8');
				exit('{"code":-1,"msg":"你的账号已到期，请联系管理员续费！"}');
			}
			$session=md5($row['user'].$row['pwd'].$password_hash);
			$token=authcode("{$row['zid']}\t{$session}", 'ENCODE', SYS_KEY);
			setcookie("user_token", $token, time() + 604800, '/');
			log_result('分站找回密码', 'User:'.$row['user'].' IP:'.$clientip, null, 1);
			$DB->query("update shua_site set lasttime='$date' where zid='{$row['zid']}'");
			exit('{"code":1,"msg":"登录成功，请在用户资料设置里重置密码","url":"./"}');
		}else{
			@header('Content-Type: application/json; charset=UTF-8');
			exit('{"code":-1,"msg":"当前QQ不存在，请确认你已开通过分站"}');
		}
	}else{
		@header('Content-Type: application/json; charset=UTF-8');
		exit('{"code":-2,"msg":"验证失败，请重新扫码"}');
	}
}elseif(isset($_GET['act']) && $_GET['act']=='qrcode'){
	$image=trim($_POST['image']);
	$result = qrcodelogin($image);
	exit(json_encode($result));
}elseif($islogin2==1){
	@header('Content-Type: text/html; charset=UTF-8');
	exit("<script language='javascript'>alert('您已登陆！');window.location.href='./';</script>");
}
$title='找回密码';
include './head2.php';
?>
<br/><br/><br/>
<img src="<?php echo $backdrop_img;?>" alt="Full Background" class="full-bg full-bg-bottom animated pulse " ondragstart="return false;" oncontextmenu="return false;">
<div class="col-xs-12 col-sm-10 col-md-8 col-lg-4 center-block" style="float: none;">
    <div class="block">
        <div class="block-title">
            <div class="block-options pull-right">
            <a href="../" class="btn btn-effect-ripple btn-default toggle-bordered enable-tooltip">返回首页</a>
            </div>
            <h2><i class="fa fa-unlock"></i>&nbsp;&nbsp;<b>找回密码</b></h2>
        </div>
			<div class="form-group" style="text-align: center;">
				<div class="list-group-item list-group-item-info" style="font-weight: bold;" id="login">
					<span id="loginmsg">请使用QQ手机版扫描二维码</span><span id="loginload" style="padding-left: 10px;color: #790909;">.</span>
				</div>
				<div id="qrimg">
				</div>
				<div class="list-group-item" id="mobile" style="display:none;"><button type="button" id="mlogin" onclick="mloginurl()" class="btn btn-warning btn-block">跳转QQ快捷登录</button><br/><button type="button" onclick="loadScript()" class="btn btn-success btn-block">我已完成登录</button></div>
			</div>
			<hr>
			<div class="form-group">
			<a href="login.php" class="btn btn-primary btn-rounded"><i class="fa fa-user"></i>&nbsp;返回登录</a>
			<a href="reg.php" class="btn btn-danger btn-rounded" style="float:right;"><i class="fa fa-user-plus"></i>&nbsp;开通分站</a>
			</div>
        </div>
      </div>
    </div>
  </div>
<script src="//lib.baomitu.com/jquery/1.12.4/jquery.min.js"></script>
<script src="//lib.baomitu.com/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="../assets/js/qrlogin.js?ver=<?php echo VERSION ?>"></script>
</body>
</html>