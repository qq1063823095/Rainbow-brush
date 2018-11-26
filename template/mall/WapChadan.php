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
			<a class="mui-action-back mui-icon mui-pull-left"><</a>
			<h1 class="mui-title">购买商品</h1>
			<a class="mui-pull-right" href="./"><span class="mui-icon mui-icon-home"></span></a>
		</header>
		<div class="mui-content">
	
	<div class="jinxiu_about" style="padding:20px; background:#fff; margin-top: 30px;">

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






