<?php
if(!defined('IN_CRONLITE'))exit();
if(checkmobile() && !$_GET['pc'] || $_GET['mobile']){include_once TEMPLATE_ROOT.'mall/WapPostProduct.php';exit;}
$title = '商品列表';
$cssadd = '<link href="//lib.baomitu.com/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="//lib.baomitu.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
  <link href="'.$cdnserver.'assets/mall/css/nifty.min.css" rel="stylesheet">';
include TEMPLATE_ROOT.'mall/head.php';
?>
<div class="Main" style="min-height:360px;">
	<div class="jinxiu_about" style="padding:20px; background:#fff; margin-top: 30px;">
		
		<style>
			.wxdy span { font-size:14px; line-height: 40px;}
			.wxdy em { font-size:14px; color: #1775F4;}
			
			img.paylogo { width:16px; height:16px;}
			</style>
	
        <div class="wxdy">
			
            <span style="color:#2287EB; font-size:20px;">提交订单</span>
        	
        </div>
		

		
		<div class="panel panel-primary">
			<div class="panel-body">

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
                <div class="input-group">
                <div class="input-group-addon">下单份数</div>
                <span class="input-group-btn"><input id="num_min" type="button" class="btn btn-info" style="border-radius: 0px;" value="━"></span>
				<input id="num" name="num" class="form-control" type="number" min="1" value="1"/>
				<span class="input-group-btn"><input id="num_add" type="button" class="btn btn-info" style="border-radius: 0px;" value="✚"></span>
			</div></div>
			<div class="form-group">
				<div class="input-group"><div class="input-group-addon" id="inputname">下单ＱＱ</div>
				<input type="text" name="inputvalue" id="inputvalue" value="<?php echo $qq?>" class="form-control" required/>
			</div></div>
			<div id="inputsname"></div>
			<div id="alert_frame" class="alert alert-warning" style="display:none;font-weight: bold;"></div>
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
			<div style=" margin:0 auto;">
<?php
if($conf['alipay_api'])echo '<button type="submit" class="btn btn-default" id="buy_alipay" style="float:inherit;"><img src="assets/icon/alipay.ico" class="paylogo">支付宝</button>&nbsp;';
if($conf['qqpay_api'])echo '<button type="submit" class="btn btn-default" id="buy_qqpay" style="float:inherit;"><img src="assets/icon/qqpay.ico" class="paylogo">QQ钱包</button>&nbsp;';
if($conf['wxpay_api'])echo '<button type="submit" class="btn btn-default" id="buy_wxpay" style="float:inherit;"><img src="assets/icon/wechat.ico" class="paylogo">微信支付</button>&nbsp;';
if($conf['tenpay_api'])echo '<button type="submit" class="btn btn-default" id="buy_tenpay" style="float:inherit;"><img src="assets/icon/tenpay.ico" class="paylogo">财付通</button>&nbsp;';
?>
			</div>
			</div>
			<input type="submit" id="submit_buy" class="btn btn-primary btn-block" value="立即购买">
	</div>
</div>
	
<script src="//lib.baomitu.com/jquery/1.12.4/jquery.min.js"></script>
<script src="//lib.baomitu.com/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="//lib.baomitu.com/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script src="//lib.baomitu.com/layer/2.3/layer.js"></script>

<script type="text/javascript">
var isModal=false;
var homepage=true;
var hashsalt='<?php echo $addsalt?>';
</script>
<script src="assets/js/main.js?ver=<?php echo VERSION ?>"></script>

		</div>

	</div></div>
</div><div class="clear"></div>
<div class="anli_wrap"></div>


   <!--  bottom-->

<?php include TEMPLATE_ROOT.'mall/foot.php';?>

<link rel="stylesheet" type="text/css" href="<?php echo $cdnserver?>assets/mall/css/suspend.css?t=0709">

<?php
include TEMPLATE_ROOT.'mall/footer.php';
?>