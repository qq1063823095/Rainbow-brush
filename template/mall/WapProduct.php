<?php
if(!defined('IN_CRONLITE'))exit();
?>  
<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
    <title>商品列表 - <?php echo $conf['title']?></title>
    <meta name="keywords" content="<?php echo $conf['keywords']?>">
    <meta name="description" content="<?php echo $conf['description']?>"> 
		
		<!--标准mui.css-->
		<link rel="stylesheet" href="//lib.baomitu.com/mui/3.7.1/css/mui.min.css">
		<!--App自定义的css-->
		<link rel="stylesheet" type="text/css" href="<?php echo $cdnserver?>assets/mall/css/app.css"/>
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
		</style>
	</head>

	<body>
		<header class="mui-bar mui-bar-nav">
		    <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
		    <h1 class="mui-title">商品列表</h1>
			<a class="mui-pull-right" href="./"><span class="mui-icon mui-icon-home"></span></a>
		</header>
		<div class="mui-content" style="background-color:#fff">
		    <h5 style="background-color:#efeff4"><?php echo $conf['sitename']?> - <?php echo $conf['title']?></h5>
		    <ul class="mui-table-view mui-grid-view">
				<?php
if ($_GET['search']=="yes"){
	$kw = trim(daddslashes($_GET['kw']));
	$rs=$DB->query("select * from shua_class where active=1 and name like'%{$kw}%' order by sort asc");
}else{
	$rs=$DB->query("select * from shua_class where active=1 order by sort asc");
}
while($row = $DB->fetch($rs)){
	if(!empty($row["shopimg"])){
		$productimg = $row["shopimg"];
	}else{
		$productimg = 'assets/img/Product/default.png';
	}
?>
		        <li class="mui-table-view-cell mui-media mui-col-xs-6">
		            <a href="./?mod=WapPostProduct&cid=<?php echo $row['cid']?>">
		                <img class="mui-media-object" src="<?php echo $productimg?>" style="max-height:217px;width:auto;" onerror="this.src='assets/img/Product/noimg.png'">
		                <div class="mui-media-body"><?php echo $row['name']?></div></a>
				</li>
<?php
}
?>

		    </ul>
		</div>
	</body>
	<script src="//lib.baomitu.com/mui/3.7.1/js/mui.min.js"></script>
	<script>
		mui.init({
			swipeBack:true //启用右滑关闭功能
		});
	</script>
</html>