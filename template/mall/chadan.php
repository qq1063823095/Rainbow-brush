<?php
if(!defined('IN_CRONLITE'))exit();
$title = '订单查询';
$cssadd = '<link href="//lib.baomitu.com/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="'.$cdnserver.'assets/ss/nifty.min.css" rel="stylesheet">';
include TEMPLATE_ROOT.'mall/head.php';
?>

<div class="Main" style="min-height:360px;">
	<div class="jinxiu_about" style="padding:20px; background:#fff; margin-top: 30px;">
		<style>
			.wxdy span { font-size:14px; line-height: 40px;}
			.wxdy em { font-size:14px; color: #1775F4;}
			</style>
        <div class="wxdy">
            <span style="color:#2287EB; font-size:20px;">订单查询</span>
        </div>
		
		<div class="panel panel-primary">
		<div class="panel-body">
			<div class="alert alert-info" <?php if(empty($conf['gg_search'])){?>style="display:none;"<?php }?>><?php echo $conf['gg_search']?></div>
			<div class="form-group">
				<div class="input-group"><div class="input-group-addon">查询内容</div>
				<input type="text" name="qq" id="qq3" value="<?php echo $qq?>" class="form-control" placeholder="请输入下单账号（留空则根据浏览器缓存查询）" required/>
			</div></div>
			<input type="submit" id="submit_query" class="btn btn-primary btn-block" value="立即查询">
			<div id="result2" class="form-group" style="display:none;">
				<table class="table table-striped">
				<thead><tr><th>下单账号</th><th>商品名称</th><th>数量</th><th class="hidden-xs">购买时间</th><th>状态</th><th>操作</th></tr></thead>
				<tbody id="list">
				</tbody>
				</table>
			</div>
		</div>
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