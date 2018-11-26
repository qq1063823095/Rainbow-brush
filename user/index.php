<?php
require '../includes/common.php';
if($islogin2==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");

if($_GET['do']=='recharge'){
	$value=daddslashes($_GET['value']);
	$trade_no=date("YmdHis").rand(111,999);
	if(!is_numeric($value))exit('{"code":-1,"msg":"提交参数错误！"}');
	$sql="insert into `shua_pay` (`trade_no`,`tid`,`input`,`name`,`money`,`ip`,`addtime`,`status`) values ('".$trade_no."','-1','".$userrow['zid']."','在线充值余额','".$value."','".$clientip."','".$date."','0')";
	if($DB->query($sql)){
		exit('{"code":0,"msg":"提交订单成功！","trade_no":"'.$trade_no.'","money":"'.$value.'","name":"在线充值余额"}');
	}else{
		exit('{"code":-1,"msg":"提交订单失败！'.$DB->error().'"}');
	}
}
$title = '平台首页';
include 'head.php';

if($conf['ui_bing']==1){
	$background_image='//index-css.skyhost.cn/cdn/zip-img/'.rand(1,19).'.jpg!gzipimgw';
	$conf['ui_background']=3;
}elseif($conf['ui_bing']==2){
	if(date("Ymd")==$conf['ui_bing_date']){
		$background_image=$conf['ui_backgroundurl'];
		if(checkmobile()==true)$background_image=str_replace('1920x1080','768x1366',$background_image);
	}else{
		$url = 'http://cn.bing.com/HPImageArchive.aspx?format=js&idx=0&n=1';
		$bing_data = get_curl($url);
		$bing_arr=json_decode($bing_data,true);
		if (!empty($bing_arr['images'][0]['url'])) {
			$background_image='//cn.bing.com'.$bing_arr['images'][0]['url'];
			saveSetting('ui_backgroundurl', $background_image);
			saveSetting('ui_bing_date', date("Ymd"));
			$CACHE->clear();
			if(checkmobile()==true)$background_image=str_replace('1920x1080','768x1366',$background_image);
		}
	}
	$conf['ui_background']=3;
}else{
	$background_image='../assets/img/bj.png';
}
if($conf['ui_background']==0)
$repeat='background-repeat:repeat;';
elseif($conf['ui_background']==1)
$repeat='background-repeat:repeat-x;
background-size:auto 100%;';
elseif($conf['ui_background']==2)
$repeat='background-repeat:repeat-y;
background-size:100% auto;';
elseif($conf['ui_background']==3)
$repeat='background-repeat:no-repeat;
background-size:100% 100%;';

$count1=$DB->count("SELECT count(*) from shua_orders where zid={$userrow['zid']}");
?>
<style>
body{
background:#ecedf0 url("<?php echo $background_image?>") fixed;
<?php echo $repeat?>}
img.logo{width:14px;height:14px;margin:0 5px 0 3px;}
</style>
<div class="container" style="padding-top:70px;">
	<div class="row">
		<div class="col-sm-12 col-md-6 center-block" style="float: none;">
		  <div class="panel panel-primary" id="recharge">
			<div class="panel-heading" style="background: linear-gradient(to right,#14b7ff,#b221ff);padding: 15px;">				
			  <div class="widget-content text-right clearfix">
				<img src="//q4.qlogo.cn/headimg_dl?dst_uin=<?php echo $userrow['qq']?$userrow['qq']:'10000';?>&spec=100" alt="Avatar" width="66" alt="avatar" class="img-circle img-thumbnail img-thumbnail-avatar pull-left">
				<h3 class="widget-heading h4"><strong>余额：<?php echo $userrow['rmb']?>元</strong></h3>
				<span class="text-muted"><a href="#userjs" data-toggle="modal" class="btn btn-primary btn-xs" style="overflow: hidden; position: relative;"><span class="btn-ripple animate" style="height: 100px; width: 100px; top: -29px; left: -3px;"></span>充值</a>&nbsp;<a href="tixian.php" class="btn btn-warning btn-xs">提现</a>&nbsp;<a href="record.php" class="btn btn-success btn-xs">账单</a></span>
			  </div>
			</div>
			<li style="font-weight:bold" class="list-group-item">用户名：<font color="orange"><?php echo $userrow['user']?> (UID:<?php echo $userrow['zid']?>)</font></li>
			<li style="font-weight:bold" class="list-group-item">我的域名：<a href="http://<?php echo $userrow['domain']?>/" target="_blank" rel="noreferrer"><?php echo $userrow['domain']?></a>（<a href="uset.php?mod=site"target="_blank"><font color="#000000"><span class="glyphicon glyphicon-cog"></span><u>编辑信息</u> </font> </a>）</li>
			<li style="font-weight:bold" class="list-group-item">网站名称：<font color="blue"><?php echo $userrow['sitename']?></font></li>
			<li style="font-weight:bold" class="list-group-item">站点类型：<?php echo ($userrow['power']==1?'<font color=red>专业版</font>':'<font color=red>普及版</font>')?>&nbsp;<?php if($conf['fenzhan_upgrade']>0 && $userrow['power']==0){echo '[<a href="upsite.php">升级站点</a>]';}?></li>
			<li style="font-weight:bold" class="list-group-item">注册时间：<font color="orange"><?php echo $userrow['addtime']?></font> </li>
			<?php if($conf['fenzhan_expiry']>0){?>
			<li style="font-weight:bold" class="list-group-item">到期时间：<font color="orange"><?php echo $userrow['endtime']?></font> [<a href="renew.php">续期</a>]</li>
			<?php }?>
	<table class="table table-bordered">
	<tbody>
		<tr>
			<td><a href="shop.php" class="btn btn-success btn-sm btn-block">自助下单</a></td>
			<td><a href="list.php" class="btn btn-info btn-sm btn-block">订单记录</a></td>
			<td><a href="shoplist.php" class="btn btn-primary btn-sm btn-block">商品管理</a></td>
		</tr>
		<tr>
			<?php if($userrow['power']==1){?>
			<td><a href="sitelist.php" class="btn btn-info btn-sm btn-block">分站管理</a></td>
			<?php }else{?>
			<td><a href="record.php" class="btn btn-info btn-sm btn-block">收支明细</a></td>
			<?php }?>
			<td><a href="#userjs" data-toggle="modal" class="btn btn-warning btn-sm btn-block">充值余额</a></td>
			<?php if($conf['fanghong_url']){?>
			<td><button type="button" class="btn btn-success btn-sm btn-block" id="create_url" >防红链接</button></td>
			<?php }else{?>
			<td><a href="login.php?logout" class="btn btn-danger btn-sm btn-block">退出登录</a></td>
			<?php }?>
		</tr>
	</tbody>
	</table>
		</div>
	<?php if(!empty($conf['gg_panel'])){?>
	<div class="panel panel-default text-center">
		<div class="list-group-item reed" style="background: linear-gradient(to right,#14b7ff,#b221ff);"><h3 class="panel-title"><font color="#fff"><i class="fa fa-volume-up"></i>&nbsp;&nbsp;<b>站点公告</b></font></h3></div>
		<div class="panel-body">
			<?php echo $conf['gg_panel']?>
		</div>
	</div>
	<?php }?>
	</div>
</div>
</div>
<div class="modal fade" id="userjs" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">关闭</span>
			</button>
			<h4 class="modal-title">在线充值余额</h4>
		</div>
		<div class="modal-body text-center">
			<b>我当前的账户余额：<span style="font-size:16px; color:#FF6133;"><?php echo $userrow['rmb']?></span> 元</b>
			<hr>
			<input type="text" class="form-control" name="value" autocomplete="off" placeholder="输入要充值的余额"><br/>
<?php 
if($conf['alipay_api'])echo '<button type="submit" class="btn btn-default" id="buy_alipay"><img src="../assets/icon/alipay.ico" class="logo">支付宝</button>&nbsp;';
if($conf['qqpay_api'])echo '<button type="submit" class="btn btn-default" id="buy_qqpay"><img src="../assets/icon/qqpay.ico" class="logo">QQ钱包</button>&nbsp;';
if($conf['wxpay_api'])echo '<button type="submit" class="btn btn-default" id="buy_wxpay"><img src="../assets/icon/wechat.ico" class="logo">微信支付</button>&nbsp;';
if($conf['tenpay_api'])echo '<button type="submit" class="btn btn-default" id="buy_tenpay"><img src="../assets/icon/tenpay.ico" class="logo">财付通</button>&nbsp;';
?>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModa4" id="alink" style="visibility: hidden;"></button>
<hr><small style="color:#999;">付款后自动充值，刷新此页面即可查看余额。</small>
		</div>
	</div>
</div>
</div>
<div class="modal fade" id="myModa4" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" onclick="clearInterval(interval1)"><span aria-hidden="true">&times;</span><span class="sr-only">关闭</span>
				</button>
				<h4 class="modal-title">订单信息</h4>
			</div>
			<div class="modal-body" id="showInfo2">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-white" data-dismiss="modal" onclick="clearInterval(interval1)">关闭</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="fanghongurl" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">关闭</span>
				</button>
				<h4 class="modal-title">防红链接生成</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<div class="input-group"><div class="input-group-addon">防红链接</div>
					<input type="text" id="target_url" value="" class="form-control" disabled/>
				</div><br/>
				<center><button class="btn btn-info btn-sm" id="recreate_url">重新生成</button>&nbsp;<button class="btn btn-warning btn-sm" id="copyurl">一键复制链接</button></center>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
			</div>
		</div>
	</div>
</div>
<script src="//lib.baomitu.com/layer/2.3/layer.js"></script>
<script src="//lib.baomitu.com/clipboard.js/1.7.1/clipboard.min.js"></script>
<script>
var clipboard = new Clipboard('#copyurl');
clipboard.on('success', function (e) {
	layer.msg('复制成功！');
});
clipboard.on('error', function (e) {
	layer.msg('复制失败，请长按链接后手动复制');
});
$(document).ready(function(){
$("#buy_alipay").click(function(){
	var value=$("input[name='value']").val();
	if(value=='' || value==0){alert('充值金额不能为空');return false;}
	$.get("index.php?do=recharge&type=alipay&value="+value, function(data) {
		tishi_2('alipay',data);
	}, 'json');
});
$("#buy_qqpay").click(function(){
	var value=$("input[name='value']").val();
	if(value=='' || value==0){alert('充值金额不能为空');return false;}
	$.get("index.php?do=recharge&type=qqpay&value="+value, function(data) {
		tishi_2('qqpay',data);
	}, 'json');
});
$("#buy_wxpay").click(function(){
	var value=$("input[name='value']").val();
	if(value=='' || value==0){alert('充值金额不能为空');return false;}
	$.get("index.php?do=recharge&type=wxpay&value="+value, function(data) {
		tishi_2('wxpay',data);
	}, 'json');
});
$("#buy_tenpay").click(function(){
	var value=$("input[name='value']").val();
	if(value=='' || value==0){alert('充值金额不能为空');return false;}
	$.get("index.php?do=recharge&type=tenpay&value="+value, function(data) {
		tishi_2('tenpay',data);
	}, 'json');
});
$("#create_url").click(function(){
	var self = $(this);
	if (self.attr("data-lock") === "true") return;
	else self.attr("data-lock", "true");
	var ii = layer.load(1, {shade: [0.1, '#fff']});
	$.get("ajax.php?act=create_url", function(data) {
		layer.close(ii);
		if(data.code == 0){
			$("#target_url").val(data.url);
			$("#copyurl").attr('data-clipboard-text',data.url);
			$('#fanghongurl').modal('show');
		}else{
			layer.alert(data.msg);
		}
		self.attr("data-lock", "false");
	}, 'json');
});
$("#recreate_url").click(function(){
	var self = $(this);
	if (self.attr("data-lock") === "true") return;
	else self.attr("data-lock", "true");
	var ii = layer.load(1, {shade: [0.1, '#fff']});
	$.get("ajax.php?act=create_url&force=1", function(data) {
		layer.close(ii);
		if(data.code == 0){
			layer.msg('生成链接成功');
			$("#target_url").val(data.url);
			$("#copyurl").attr('data-clipboard-text',data.url);
		}else{
			layer.alert(data.msg);
		}
		self.attr("data-lock", "false");
	}, 'json');
});
});
function tishi_2(paytype,d){
	if(d.code == 0){
		var data = '<p>订单号：'+d.trade_no+'</p><p>订单金额：<b>'+d.money+'</b>元</p><p>订单名称：'+d.name+'</p>'+
					'<p><b>付款后系统会自动为您充值到账，即时生效，无需卡密。</b></p>'+
					'<a href="../other/submit.php?type='+paytype+'&orderid='+d.trade_no+'" class="btn btn-success btn-block" target="_blank">立即支付</a>'+
					'</form>';
		var divshow = $("#showInfo2");
		divshow.text("");
		divshow.append(data);
		$("#alink").click();
	} else {
		alert(d.msg);
	}
}
</script>