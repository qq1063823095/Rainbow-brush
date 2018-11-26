<?php
if(!defined('IN_CRONLITE'))exit();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
    <title>商品列表 - <?php echo $conf['title']?></title>
    <meta name="keywords" content="<?php echo $conf['keywords']?>">
    <meta name="description" content="<?php echo $conf['description']?>"> 
		<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
		<!--标准mui.css-->
		<link rel="stylesheet" href="//lib.baomitu.com/mui/3.7.1/css/mui.min.css">
		<!--App自定义的css-->
		<link rel="stylesheet" type="text/css" href="<?php echo $cdnserver?>assets/mall/css/app.css"/>

<!-- 公共的CSS和JS文件 -->
<!-- css -->

  <link href="//lib.baomitu.com/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="//lib.baomitu.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
<link type="text/css" rel="stylesheet" href="<?php echo $cdnserver?>assets/mall/css/base1.css"/>
<link type="text/css" rel="stylesheet" href="<?php echo $cdnserver?>assets/mall/css/vc_base.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo $cdnserver?>assets/mall/css/head.css?v0604">
		<style>
			h5{
		        padding-top: 8px;
		        padding-bottom: 8px;
		        text-indent: 12px;
		    }
		    
			.mui-table-view.mui-grid-view .mui-table-view-cell .mui-media-body{
				font-size: 15px;
				margin-top:8px;
				color: #333;
			}
			img.paylogo{width:14px;height:14px;margin:0 5px 0 3px;}
		</style>
	</head>

	<body>
<header class="mui-bar mui-bar-nav">
			<a class="mui-action-back mui-icon mui-pull-left">&lt;</a>
			<h1 class="mui-title">购买商品</h1>
			<a class="mui-pull-right" href="./"><span class="mui-icon mui-icon-home"></span></a>
		</header>
		<div class="mui-content">
	
	<div class="jinxiu_about" style="padding:20px; background:#fff; margin-top: 30px;">

		
			<div class="form-group" id="display_selectclass" style="display: none;">
				<div class="input-group"><div class="input-group-addon">选择分类</div>
				<select name="tid" id="cid" class="form-control"><?php echo $select?></select>
			</div></div>
				<div class="form-group">
				<div class="input-group"><div class="input-group-addon">选择商品</div>
				<select name="tid" id="tid" class="form-control" onChange="getPoint();"><?php echo $select2?></select>
			</div></div>
			<div class="form-group">
				<div class="input-group"><div class="input-group-addon">商品价格</div>
				<input type="text" name="need" id="need" class="form-control" disabled/>
			</div></div>
			<div class="form-group" id="display_left" style="display:none;">
				<div class="input-group"><div class="input-group-addon">库存数量</div>
				<input type="text" name="leftcount" id="leftcount" class="form-control" disabled/>
			</div></div>
			<div class="form-group" id="display_num" style="display:none;">
				<div class="input-group"><div class="input-group-addon">数量</div>
				<div class="input-group-addon"><input id="num_min" type="button" value="-"/></div>
				<div class="input-group-addon"><input id="num" name="num" class="form-control" type="number" min="1" value="1"/></div>
				<div class="input-group-addon"><input id="num_add" type="button" value="+"/></div>
			</div></div>
			<div class="form-group">
				<div class="input-group"><div class="input-group-addon" id="inputname">下单ＱＱ</div>
				<input type="text" name="inputvalue" id="inputvalue" value="<?php echo $qq?>" class="form-control" required/>
			</div></div>
			<div id="inputsname"></div>
			<div id="alert_frame" class="alert alert-warning" style="display:none;"></div>
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
			<div style="margin:0 auto;">
<?php
if($conf['alipay_api'])echo '<button type="submit" class="btn btn-default" id="buy_alipay"><img src="assets/icon/alipay.ico" class="paylogo">支付宝</button>&nbsp;';
if($conf['qqpay_api'])echo '<button type="submit" class="btn btn-default" id="buy_qqpay"><img src="assets/icon/qqpay.ico" class="paylogo">QQ钱包</button>&nbsp;';
if($conf['wxpay_api'])echo '<button type="submit" class="btn btn-default" id="buy_wxpay"><img src="assets/icon/wechat.ico" class="paylogo">微信支付</button>&nbsp;';
if($conf['tenpay_api'])echo '<button type="submit" class="btn btn-default" id="buy_tenpay"><img src="assets/icon/tenpay.ico" class="paylogo">财付通</button>&nbsp;';
?>
			</div>
			</div>
			<input type="submit" id="submit_buy" class="btn btn-primary btn-block" value="立即购买">
		</div>
</div>

	<script src="//lib.baomitu.com/mui/3.7.1/js/mui.min.js"></script>
	<script>
		mui.init({
			swipeBack:true //启用右滑关闭功能
		});
	</script>	
	
<script src="//lib.baomitu.com/jquery/1.12.4/jquery.min.js"></script>
<script src="//lib.baomitu.com/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="//lib.baomitu.com/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script src="//lib.baomitu.com/layer/2.3/layer.js"></script>

<script type="text/javascript">
var isModal=<?php echo empty($conf['modal'])?'false':'true';?>;
var homepage=true;
var hashsalt='<?php echo $addsalt?>';
</script>
<script src="assets/js/main.js?ver=<?php echo VERSION ?>"></script>


		</div>

	</div>
</div><div class="clear"></div>
<div class="anli_wrap"></div>
</div>
</body>
</html>






