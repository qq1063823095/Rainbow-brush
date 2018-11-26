<?php
/**
 * 自助开通分站
**/
$is_defend=true;
include("../includes/common.php");
if($islogin2==1){
	@header('Content-Type: text/html; charset=UTF-8');
	exit("<script language='javascript'>alert('您已登陆！');window.location.href='./';</script>");
}elseif($conf['fenzhan_buy']==0){
	@header('Content-Type: text/html; charset=UTF-8');
	exit("<script language='javascript'>alert('当前站点未开启自助开通分站功能！');window.location.href='./';</script>");
}

if($is_fenzhan == true && $siterow['power']==1 && $siterow['ktfz_price']>0){
	$conf['fenzhan_price']=$siterow['ktfz_price'];
	if($conf['fenzhan_cost2']<=0)$conf['fenzhan_cost2']=$conf['fenzhan_price2'];
	if($siterow['ktfz_price2']>0 && $siterow['ktfz_price2']>=$conf['fenzhan_cost2'])$conf['fenzhan_price2']=$siterow['ktfz_price2'];
}
if($_GET['act']=='check'){
	$qz = daddslashes($_GET['qz']);
	$domain = $qz . '.' . daddslashes($_GET['domain']);
	$srow=$DB->get_row("SELECT * FROM shua_site WHERE domain='{$domain}' or domain2='{$domain}' limit 1");
	if($srow)exit('1');
	else exit('0');
}elseif($_GET['act']=='check2'){
	$user = daddslashes($_GET['user']);
	$srow=$DB->get_row("SELECT * FROM shua_site WHERE user='{$user}' limit 1");
	if($srow)exit('1');
	else exit('0');
}elseif($_GET['act']=='pay'){
	$kind = intval($_POST['kind']);
	$qz = trim(strtolower(daddslashes($_POST['qz'])));
	$domain = trim(strtolower(strip_tags(daddslashes($_POST['domain']))));
	$user = trim(strip_tags(daddslashes($_POST['user'])));
	$pwd = trim(strip_tags(daddslashes($_POST['pwd'])));
	$name = trim(strip_tags(daddslashes($_POST['name'])));
	$qq = trim(daddslashes($_POST['qq']));
	$hashsalt = isset($_POST['hashsalt'])?$_POST['hashsalt']:null;
	$domain = $qz . '.' . $domain;
	if($conf['verify_open']==1 && (empty($_SESSION['addsalt']) || $hashsalt!=$_SESSION['addsalt'])){
		exit('{"code":-1,"msg":"验证失败，请刷新页面重试"}');
	}
	if ($kind!=0 && $kind!=1) {
		exit('{"code":-1,"msg":"分站类型错误！"}');
	} elseif (strlen($qz) < 2 || strlen($qz) > 10 || !preg_match('/^[a-z0-9\-]+$/',$qz)) {
		exit('{"code":-1,"msg":"域名前缀不合格！"}');
	} elseif (!preg_match('/^[a-zA-Z0-9\_\-\.]+$/',$domain)) {
		exit('{"code":-1,"msg":"域名格式不正确！"}');
	} elseif (!preg_match('/^[a-zA-Z0-9]+$/',$user)) {
		exit('{"code":-1,"msg":"用户名只能为英文或数字！"}');
	} elseif ($DB->get_row("SELECT * FROM shua_site WHERE user='{$user}' limit 1")) {
		exit('{"code":-1,"msg":"用户名已存在！"}');
	} elseif (strlen($pwd) < 6) {
		exit('{"code":-1,"msg":"密码不能低于6位"}');
	} elseif (strlen($name) < 2) {
		exit('{"code":-1,"msg":"网站名称太短！"}');
	} elseif (strlen($qq) < 5 || !preg_match('/^[0-9]+$/',$qq)) {
		exit('{"code":-1,"msg":"QQ格式不正确！"}');
	} elseif ($DB->get_row("SELECT * FROM shua_site WHERE domain='{$domain}' or domain2='{$domain}' limit 1") || $qz=='www' || $domain==$_SERVER['HTTP_HOST'] || in_array($domain,explode('|',$conf['fenzhan_remain']))) {
		exit('{"code":-1,"msg":"此前缀已被使用！"}');
	}
	$fenzhan_expiry = $conf['fenzhan_expiry']>0?$conf['fenzhan_expiry']:12;
	$endtime = date("Y-m-d H:i:s", strtotime("+ {$fenzhan_expiry} months", time()));
	$trade_no=date("YmdHis").rand(111,999);
	$input=$kind.'|'.$domain.'|'.$user.'|'.$pwd.'|'.$name.'|'.$qq.'|'.$endtime;
	if($kind==1){
		$need=$conf['fenzhan_price2'];
	}else{
		$need=$conf['fenzhan_price'];
	}
	if($need==0){
		$keywords=$conf['keywords'];
		$description=$conf['description'];
		if($conf['fenzhan_html']==1){
			$anounce=addslashes($conf['anounce']);
			$bottom=addslashes($conf['bottom']);
			$modal=addslashes($conf['modal']);
		}
		$sql="insert into `shua_site` (`upzid`,`power`,`domain`,`domain2`,`user`,`pwd`,`rmb`,`qq`,`sitename`,`keywords`,`description`,`anounce`,`bottom`,`modal`,`addtime`,`endtime`,`status`) values ('".$siterow['zid']."','".$kind."','".$domain."',NULL,'".$user."','".$pwd."','0','".$qq."','".$name."','".$keywords."','".$description."','".$anounce."','".$bottom."','".$modal."','".$date."','".$endtime."','1')";
		$zid = $DB->insert($sql);
		if($zid){
			$_SESSION['newzid']=$zid;
			unset($_SESSION['addsalt']);
			exit('{"code":1,"msg":"开通分站成功","zid":"'.$zid.'"}');
		}else{
			exit('{"code":-1,"msg":"开通分站失败！'.$DB->error().'"}');
		}
	}else{
		$sql="insert into `shua_pay` (`trade_no`,`tid`,`zid`,`input`,`num`,`name`,`money`,`ip`,`userid`,`addtime`,`status`) values ('".$trade_no."','-2','".($siterow['zid']?$siterow['zid']:1)."','".$input."','1','自助开通分站','".$need."','".$clientip."','".$cookiesid."','".$date."','0')";
		if($DB->query($sql)){
			unset($_SESSION['addsalt']);
			exit('{"code":0,"msg":"提交订单成功！","trade_no":"'.$trade_no.'","need":"'.$need.'"}');
		}else{
			exit('{"code":-1,"msg":"提交订单失败！'.$DB->error().'"}');
		}
	}
}
$title='自助开通分站';
include './head2.php';

$addsalt=md5(mt_rand(0,999).time());
$_SESSION['addsalt']=$addsalt;
include_once(SYSTEM_ROOT."hieroglyphy.class.php");
$x = new hieroglyphy();
$addsalt_js = $x->hieroglyphyString($addsalt);

$kind = isset($_GET['kind'])?$_GET['kind']:0;
?>
<style>
img.logo{width:14px;height:14px;margin:0 5px 0 3px;}
</style>
<?php
if($is_fenzhan == true && $siterow['power']==1 && !empty($siterow['ktfz_domain'])){
	$domains=explode(',',$siterow['ktfz_domain']);
}else{
	$domains=explode(',',$conf['fenzhan_domain']);
}
$select='';
foreach($domains as $domain){
	$select.='<option value="'.$domain.'">'.$domain.'</option>';
}
if(empty($select))showmsg('请先到后台分站设置，填写可选分站域名',3);
?>
<img src="<?php echo $backdrop_img;?>" alt="Full Background" class="full-bg full-bg-bottom animated pulse" ondragstart="return false;" oncontextmenu="return false;">
<div class="col-xs-12 col-sm-10 col-md-8 col-lg-4 center-block " style="float: none;">
  <br />
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
            <h2><i class="fa fa-user-plus"></i>&nbsp;&nbsp;<b>自助开通分站</b></h2>
        </div>
				<div class="row text-center">
                    <div class="col-xs-6">
                    <a class="btn btn-block btn-info" href="#about" data-toggle="modal">分站详细介绍</a>
                    </div>
                    <div class="col-xs-6">
                    <a class="btn btn-block btn-info" href="#userjs" data-toggle="modal">分站版本介绍</a>
                    </div>
                </div>
				<br>
                <form>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                                分站版本
                            </div>
                            <select name="kind" class="form-control"><option value="0" <?php if($kind==0){?>selected<?php }?>>普及版(<?php echo $conf['fenzhan_price']?>元)</option><option value="1" <?php if($kind==1){?>selected<?php }?>>专业版(<?php echo $conf['fenzhan_price2']?>元)</option></select>
                        </div>
                    </div>
					<div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                                二级域名
                            </div>
                            <input type="text" onkeyup="value=value.replace(/[^\w\.\/]/ig,'')" name="qz"
                                   class="form-control" required data-parsley-length="[2,8]"
                                   placeholder="输入你想要的二级前缀">
                            <select name="domain" class="form-control"><?php echo $select?></select>
                        </div>
                    </div>
					<div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                                管理账号
                            </div>
                            <input type="text" name="user" class="form-control" required placeholder="输入要注册的用户名">
                        </div>
                    </div>
					<div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                                管理密码
                            </div>
                            <input type="text" name="pwd" class="form-control" required placeholder="输入管理员密码">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                                网站名称
                            </div>
                            <input type="text" name="name" class="form-control" required
                                   data-parsley-length="[2,10]"
                                   placeholder="输入网站名称">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                                绑定ＱＱ
                            </div>
                            <input type="number" name="qq" class="form-control" required
                                   data-parsley-length="[5,10]"
                                   placeholder="输入你的QQ号" value="">
                        </div>
                    </div>
					<div id="pay_frame" class="form-group text-center" style="display:none;">
					<div class="form-group">
						<div class="input-group">
						<div class="input-group-addon">订单号</div>
						<input class="form-control" name="orderid" id="orderid" value="" disabled>
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
						<div class="input-group-addon">共需支付</div>
						<input class="form-control" name="needs" id="needs" value="" disabled>
						</div>
					</div>
					<div class="alert alert-success">订单保存成功，请点击以下链接支付！</div>
<?php
if($conf['alipay_api'])echo '<button type="button" class="btn btn-default" id="buy_alipay"><img src="../assets/icon/alipay.ico" class="logo">支付宝</button>&nbsp;';
if($conf['qqpay_api'])echo '<button type="button" class="btn btn-default" id="buy_qqpay"><img src="../assets/icon/qqpay.ico" class="logo">QQ钱包</button>&nbsp;';
if($conf['wxpay_api'])echo '<button type="button" class="btn btn-default" id="buy_wxpay"><img src="../assets/icon/wechat.ico" class="logo">微信支付</button>&nbsp;';
if($conf['tenpay_api'])echo '<button type="button" class="btn btn-default" id="buy_tenpay"><img src="../assets/icon/tenpay.ico" class="logo">财付通</button>&nbsp;';
?>
					</div>
                    <input type="button" id="submit_buy" value="点此立即拥有分站" class="btn btn-danger btn-block">
					<hr>
					<div class="form-group">
						<a href="findpwd.php" class="btn btn-info btn-rounded"><i class="fa fa-unlock"></i>&nbsp;找回密码</a>
						<a href="login.php" class="btn btn-primary btn-rounded" style="float:right;"><i class="fa fa-user"></i>&nbsp;返回登录</a>
					</div>
                </form>
        </div>
	</div>

<!--分站介绍开始-->
<div class="modal fade" align="left" id="userjs" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
		<div class="modal-header">
			<h4 class="modal-title" id="myModalLabel">版本介绍</h4>
		</div>
		<div class="block">
            <div class="table-responsive">
                <table class="table table-borderless table-vcenter">
                    <thead>
                        <tr>
                            <th style="width: 100px;">功能</th>
                            <th class="text-center" style="width: 20px;">普及版/专业版</th>
                        </tr>
                    </thead>
					<tbody>
						<tr class="active">
                            <td>专属代刷平台</td>
                            <td class="text-center">
								<span class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-check"></i></span>
								<span class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-check"></i></span>
							</td>
                        </tr>
                        <tr class="">
                            <td>三种在线支付接口</td>
                            <td class="text-center">
								<span class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-check"></i></span>
								<span class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-check"></i></span>
							</td>
                        </tr>
						<tr class="success">
                            <td>专属网站域名</td>
                            <td class="text-center">
								<span class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-check"></i></span>
								<span class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-check"></i></span>
							</td>
                        </tr>
						<tr class="">
                            <td>赚取用户提成</td>
                            <td class="text-center">
								<span class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-check"></i></span>
								<span class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-check"></i></span>
							</td>
                        </tr>
						<tr class="info">
                            <td>赚取下级分站提成</td>
                            <td class="text-center">
								<span class="btn btn-effect-ripple btn-xs btn-danger"><i class="fa fa-close"></i></span>
								<span class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-check"></i></span>
							</td>
                        </tr>
						<tr class="">
                            <td>设置商品价格</td>
                            <td class="text-center">
								<span class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-check"></i></span>
								<span class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-check"></i></span>
							</td>
                        </tr>
						<tr class="warning">
                            <td>设置下级分站商品价格</td>
                            <td class="text-center">
								<span class="btn btn-effect-ripple btn-xs btn-danger"><i class="fa fa-close"></i></span>
								<span class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-check"></i></span>
							</td>
                        </tr>
						<tr class="">
                            <td>搭建下级分站</td>
                            <td class="text-center">
								<span class="btn btn-effect-ripple btn-xs btn-danger"><i class="fa fa-close"></i></span>
								<span class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-check"></i></span>
							</td>
                        </tr>
						<tr class="danger">
                            <td>赠送专属精致APP</td>
                            <td class="text-center">
								<span class="btn btn-effect-ripple btn-xs btn-danger"><i class="fa fa-close"></i></span>
								<span class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-check"></i></span>
							</td>
                        </tr>
                    </tbody>
                </table>
            </div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
		</div>
    </div>
  </div>
</div>
<!--分站介绍结束-->

<div class="modal fade" align="left" id="about" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			<h4 class="modal-title" id="myModalLabel">详细介绍</h4>
		</div>
		<div class="modal-body">
			<div class="panel-group" id="accordion">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" class="collapsed">分站是怎么获取收益的？</a>
						</h4>
					</div>
					<div id="collapseOne" class="panel-collapse collapse" style="height: 0px;" aria-expanded="false">
						<div class="panel-body">
							其实很简单，你只需要把你的分站域名发给你的用户让他下单，一旦下单付款成功，你的账户就会增加你所赚差价的金额，自己是可以设置销售价格的哦！
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="collapsed" aria-expanded="false">赚到的钱在哪里？我如何得到？</a>
						</h4>
					</div>
					<div id="collapseTwo" class="panel-collapse collapse" style="height: 0px;" aria-expanded="false">
						<div class="panel-body">
							分站后台有完整的消费明细和余额信息，后台余额可供您在平台消费，满<?php echo $conf['tixian_min']; ?>元可以在后台提现到QQ钱包微信或者支付宝中。
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="collapsed" aria-expanded="false">需要我自己供货吗？哪来的商品货源？</a>
						</h4>
					</div>
					<div id="collapseThree" class="panel-collapse collapse" style="height: 0px;" aria-expanded="false">
						<div class="panel-body">
							所有商品全部由主站提供，您无需当心货源问题，所有订单由我们来处理，如果网站没有您想要的商品可联系主站客服添加即可！
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapseFourth" class="collapsed" aria-expanded="false">这个和卡盟一样吗？有什么区别？</a>
						</h4>
					</div>
					<div id="collapseFourth" class="panel-collapse collapse" style="height: 0px;" aria-expanded="false">
						<div class="panel-body">
							完全不同，销售提成最高享受商品售价的30%，货源更精，无需注册,无需预存，在线支付，更简单快捷！
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapseFive" class="collapsed" aria-expanded="false">可以自己上架商品吗？可以修改售价吗？</a>
						</h4>
					</div>
					<div id="collapseFive" class="panel-collapse collapse" style="height: 0px;" aria-expanded="false">
						<div class="panel-body">
							所有分站暂时都不支持自己上架商品，但可以修改销售价格，我们会在这方面后期做出相对于的更新服务！
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapseSix" class="collapsed" aria-expanded="false">那么多代刷网有分站，为什么选择你们呢？</a>
						</h4>
					</div>
					<div id="collapseSix" class="panel-collapse collapse" style="height: 0px;" aria-expanded="false">
						<div class="panel-body">
							全网最专业的代刷系统，商品齐全、货源稳定、价格低廉、售后保障。实体工作室运营，拥有丰富的人脉和资源，我们的货源全部精挑细选全网性价比最高的，实时掌握代刷市场的动态，加入我们，只要你坚持，你不用担心不赚钱，不用担心货源不好，更不用担心我们跑路，我们即使不敢保证你月入上万，在网上赚个零花钱绝对没问题！
						</div>
					</div>
				</div>
			</div>
		</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
      </div>
    </div>
  </div>
</div>
<script src="//lib.baomitu.com/jquery/1.12.4/jquery.min.js"></script>
<script src="//lib.baomitu.com/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="//lib.baomitu.com/layer/2.3/layer.js"></script>
<script src="<?php echo $cdnserver?>assets/appui/js/plugins.js"></script>
<script>
var hashsalt=<?php echo $addsalt_js?>;
$(document).ready(function(){
    $("input[name='qz']").blur(function(){
        var qz = $(this).val();
        var domain = $("select[name='domain']").val();
        if(qz){
            $.get("?act=check", { 'qz' : qz , 'domain' : domain},function(data){
                    if( data == 1 ){
                        layer.alert('你所填写的域名已被使用，请更换一个！');
						//$("input[name='qz']").focus();
                    }
            });
        }
    });
	$("input[name='user']").blur(function(){
        var user = $(this).val();
        if(user){
            $.get("?act=check2", { 'user' : user},function(data){
                    if( data == 1 ){
                        layer.alert('你所填写的用户名已存在！');
						//$("input[name='user']").focus();
                    }
            });
        }
    });
	$("#submit_buy").click(function(){
		var kind = $("select[name='kind']").val();
		var qz = $("input[name='qz']").val();
		var domain = $("select[name='domain']").val();
		var name = $("input[name='name']").val();
		var qq = $("input[name='qq']").val();
		var user = $("input[name='user']").val();
		var pwd = $("input[name='pwd']").val();
		if(qz=='' || name=='' || qq=='' || user=='' || pwd==''){layer.alert('请确保每项不能为空！');return false;}
		if(qz.length<2){
			layer.alert('域名前缀太短！'); return false;
		}else if(qz.length>10){
			layer.alert('域名前缀太长！'); return false;
		}else if(name.length<2){
			layer.alert('网站名称太短！'); return false;
		}else if(qq.length<5){
			layer.alert('QQ格式不正确！'); return false;
		}else if(user.length<3){
			layer.alert('用户名太短'); return false;
		}else if(user.length>20){
			layer.alert('用户名太长'); return false;
		}else if(pwd.length<6){
			layer.alert('密码不能低于6位'); return false;
		}else if(pwd.length>30){
			layer.alert('密码太长'); return false;
		}
		$('#pay_frame').hide();
		$('#submit_buy').val('Loading');
		$.ajax({
			type : "POST",
			url : "reg.php?act=pay",
			data : {kind:kind,qz:qz,domain:domain,name:name,qq:qq,user:user,pwd:pwd,hashsalt:hashsalt},
			dataType : 'json',
			success : function(data) {
				if(data.code == 0){
					$('#alert_frame').hide();
					$('#submit_buy').hide();
					$('#orderid').val(data.trade_no);
					$('#needs').val("￥"+data.need);
					$("#pay_frame").slideDown();
				}else if(data.code == 1){
					alert('开通分站成功！');
					window.location.href='regok.php?zid='+data.zid;
				}else{
					layer.alert(data.msg);
				}
				$('#submit_buy').val('立即购买');
			} 
		});
	});
$("#buy_alipay").click(function(){
	var orderid=$("#orderid").val();
	window.location.href='../other/submit.php?type=alipay&orderid='+orderid;
});
$("#buy_qqpay").click(function(){
	var orderid=$("#orderid").val();
	window.location.href='../other/submit.php?type=qqpay&orderid='+orderid;
});
$("#buy_wxpay").click(function(){
	var orderid=$("#orderid").val();
	window.location.href='../other/submit.php?type=wxpay&orderid='+orderid;
});
$("#buy_tenpay").click(function(){
	var orderid=$("#orderid").val();
	window.location.href='../other/submit.php?type=tenpay&orderid='+orderid;
});
});
</script>
</body>
</html>