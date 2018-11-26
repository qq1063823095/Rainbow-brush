<?php
if(!defined('IN_CRONLITE'))exit();
$config = require_once TEMPLATE_ROOT.'mall/config.php';
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<title><?php echo $conf['sitename']?> - <?php echo $conf['title']?></title>
  <meta name="keywords" content="<?php echo $conf['keywords']?>">
  <meta name="description" content="<?php echo $conf['description']?>">
<!-- jQuery元素 开始 -->
<script src="//lib.baomitu.com/jquery/1.12.4/jquery.min.js" type="text/javascript"></script>
<!-- jQuery元素 结束 -->

<!-- 公共元素 开始 -->
<link href="//lib.baomitu.com/mui/3.7.1/css/mui.min.css" rel="stylesheet" />
<link href="<?php echo $cdnserver?>assets/mall/css/hui.css" rel="stylesheet" />
<link href="<?php echo $cdnserver?>assets/mall/css/icons-extra.css" rel="stylesheet" type="text/css" />
<script src="//lib.baomitu.com/mui/3.7.1/js/mui.min.js"></script>
<script src="<?php echo $cdnserver?>assets/mall/js/hui.js" type="text/javascript"></script>
<link href="<?php echo $cdnserver?>assets/mall/css/index.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $cdnserver?>assets/mall/css/style.css" rel="stylesheet" type="text/css" />
<!-- 公共元素 结束 -->

<!-- 当前页元素 开始 -->
<link href="<?php echo $cdnserver?>assets/mall/css/search-form.css" rel="stylesheet" type="text/css">
<!-- 当前页元素 结束 -->
</head>
<body>
<input type="hidden" value="./" id="imageBase"/>
<div id="kyx-body" class="wrapper">
	<div class="htmleaf-container">
		<!--侧滑菜单容器-->
		<div id="offCanvasWrapper" class="mui-off-canvas-wrap">
			<!--菜单部分-->
			




<aside id="offCanvasSide" class="mui-off-canvas-right">
	<div id="offCanvasSideScroll" class="mui-scroll-wrapper">
		<div class="mui-scroll">
			<div class="title">导航栏目</div>
			<div class="content">
				您目前正在使用的是最新版的移动端H5网站！点击下述导航菜单，到达不同的功能区！
				<p style="margin: 10px 15px;">
					<button id="offCanvasHide" type="button" class="mui-btn mui-btn-danger mui-btn-block" style="padding: 5px 20px;">关闭导航菜单</button>
				</p>

			</div>
			<div class="title" style="margin-bottom: 25px;">功能菜单列表</div>
			<ul class="mui-table-view mui-table-view-chevron mui-table-view-inverted">
				<li class="mui-table-view-cell">
					<a class="mui-navigate-right" href="./?mod=wapindex">网站首页</a>
				</li>
				<li class="mui-table-view-cell">
					<a class="mui-navigate-right" href="./?mod=WapProduct">商品分类</a>
				</li>
				

				<li class="mui-table-view-cell">
					<a class="mui-navigate-right" href="//wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['kfqq']?>&site=qq&menu=yes">联系客服</a>
				</li>


			</ul>
		</div>
	</div>
</aside>
			
			<div class="mui-inner-wrap">
				<!--头部部分-->

	<header class="mui-bar mui-bar-nav kyx-header-menu">
		<div class="navbar">
			<div class="logo" >
				<img src="<?php echo $logo?>" style="width:80px;height:30px;"/><?php echo $conf['sitename']?>
			</div>
			<!--
			<div class="sousuo"><a id="kyx-btn-search" href="javascript:void(0);"><img src="assets/mall/images/sousuo.png"></a></div>
			-->
			<div class="user">
				<a href="./user/login.php"><img src="<?php echo $cdnserver?>assets/mall/images/user2.png" /></a>
			</div>
			<div class="menut">
				<a id="offCanvasBtn" href="#offCanvasSide" class="mui-icon mui-action-menu mui-icon-bars kyx-btn-menu"></a>
			</div>
		</div>
	</header>

				<div id="offCanvasContentScroll" class="mui-content mui-scroll-wrapper screen">
					<div class="mui-scroll">
						<div id="slider" class="mui-slider kyx-slider">
<script>
var advert4list = [{title:"",img:"<?php echo $config['banner1']?>",link:"/?mod=product"},{title:"",img:"<?php echo $config['banner2']?>",link:"/?mod=product"},{title:"",img:"<?php echo $config['banner3']?>",link:"/?mod=product"},{title:"",img:"<?php echo $config['banner4']?>",link:"/?mod=product"}];
</script>
       						<script type="text/javascript" src="<?php echo $cdnserver?>assets/mall/js/wapreadbanner.js"></script>
						</div>
						<div class="line"></div>
						<div class="index_menu">
							<a href="./?mod=WapChadan"><img src="<?php echo $cdnserver?>assets/mall/images/menu1.png" /><span></span>订单查询</a>
							<a href="./user/reg.php" target="_blank"><img src="<?php echo $cdnserver?>assets/mall/images/menu2.png" /><span></span>搭建分站</a>
							<a href="./user/login.php" target="_blank"><img src="<?php echo $cdnserver?>assets/mall/images/menu3.png" /><span></span>后台登录</a>
							<a href="//wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['kfqq']?>&site=qq&menu=yes" target="_blank"><img src="<?php echo $cdnserver?>assets/mall/images/menu4.png" /><span></span>联系客服</a>
						</div>
						<div class="line"></div>
						<div id="getCommonDrem" class="kyx-hot-shop">
						  	<div class="mui-loading">
								<div class="mui-spinner"></div>
							</div>
							
							
							
					  	</div>
						<div class="line"></div>
						
						<div class="kyx-shop-list">
							<div id="sliderGood" class="mui-slider">
								<div id="sliderSegmentedControl" class="mui-slider-indicator mui-segmented-control mui-segmented-control-inverted">
									<a class="mui-control-item mui-active" href="#item1mobile">推荐商品</a>
									
									
									<a class="mui-control-item" href="#item2mobile">商品目录</a>
									
								</div>
								<div id="sliderProgressBar" class="mui-slider-progress-bar mui-col-xs-6"></div>
								<div class="mui-slider-group kyx-index-good">
									<div id="item1mobile" class="mui-slider-item mui-control-content">
										<div id="scroll1" class="mui-scroll-wrapper">
											<div id="item1content" class="mui-scroll">
												<div class="mui-loading">
													<div class="mui-spinner"></div>
												</div>
											</div>
										</div>
									</div>
									<div id="item2mobile" class="mui-slider-item mui-control-content">
										<div id="scroll2" class="mui-scroll-wrapper">
											<div id="item2content" class="mui-scroll">
												<div class="mui-loading">
													<div class="mui-spinner"></div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div id="kyx-switch" class="news_version">
							<a name="w" id="1" href="javascript:void(0);"><img src="<?php echo $cdnserver?>assets/mall/images/sjb.png" />手机版</a>
							<a name="p" id="0" href="./?pc=1"><img src="<?php echo $cdnserver?>assets/mall/images/dnb.png" />电脑版</a>
							<a name="m" id="2" href="<?php echo $conf['appurl']; ?>"><img src="<?php echo $cdnserver?>assets/mall/images/app.png"/>APP</a>
						</div>
						<div class="news_footer">
							&copy; Powered by <a href="./"><?php echo $conf['sitename']?></a>
						</div>
					</div>
					<div class="mui-off-canvas-backdrop"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--底部部分-->

<style>
.mui-table { width:83%;}
.kyx-shop-list .mui-ellipsis-2 { font-size:16px; font-weight:bold;}
</style>



<div id="kyx-search" class="wrapper kyx-search" style="display: none;">
	<div class="htmleaf-container">
		<div class="mui-inner-wrap">
			<header class="mui-bar mui-bar-nav kyx-header-menu">
				<a id="kyx-close-search" class="mui-icon mui-icon-back mui-pull-left kyx-link"></a>
				<div class="navbar">
					<div class="tit">搜索商品</div>
				</div>
			</header>
			<div class="nav_line"></div>
			<div class="kyx-search-box mui-input-row">
				<input id="kyx-keyword" type="search" class="mui-input-clear" placeholder="输入商品名称相关信息"/>
			</div>
			<div class="kyx-search-list">
				<div id="getCommonKeywordsSearch">
					<div class="mui-loading">
						<div class="mui-spinner"></div>
					</div>
				</div>
				<div id="getCommonDremSearch">
					<div class="mui-loading">
						<div class="mui-spinner"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



<script>
(function($, doc) {
	//侧滑容器父节点
	var offCanvasWrapper = mui('#offCanvasWrapper');
	 //主界面容器
	var offCanvasInner = offCanvasWrapper[0].querySelector('.mui-inner-wrap');
	 //菜单容器
	var offCanvasSide = document.getElementById("offCanvasSide");
	 //移动效果是否为整体移动
	var moveTogether = true;
	//整体滑动时，侧滑菜单在inner-wrap内
	offCanvasInner.insertBefore(offCanvasSide, offCanvasInner.firstElementChild);
	document.getElementById('offCanvasHide').addEventListener('tap', function() {
		offCanvasWrapper.offCanvas('close');
	});
	//主界面和侧滑菜单界面均支持区域滚动；
	mui('#offCanvasSideScroll').scroll();
	mui('#offCanvasContentScroll').scroll();

})(mui, document);
</script>


<script>
(function($, doc) {
	//图片轮播
	var slider = mui("#slider");
	slider.slider({
		interval: 5000
	});
	
	var height1 = 0;
	var height2 = 0;
	var y_height=document.getElementById('item1mobile');
	var x_height=document.getElementById('item1content');
	var n_height=x_height.offsetHeight;
	y_height.style.height=n_height+"px";
	height1 = n_height;
	
	var itemCommonDrem = document.getElementById('getCommonDrem');
	mui(itemCommonDrem).load("./?mod=WapGongGao");
	
	var itemCommonGood = document.getElementById('item1content');
	mui(itemCommonGood).load("./?mod=WapClassList", function(){
		var y_height=document.getElementById('item1mobile');
		var x_height=document.getElementById('item1content');
		var n_height=x_height.offsetHeight;
		y_height.style.height=n_height+"px"; 
		height1 = n_height;
		
		mui(itemCommonGood).on('tap','a',function(){
			var del = this.getAttribute("del");
			var stop = this.getAttribute("stop");
			var reason = this.getAttribute("reason");
			var url = this.getAttribute("url");
			
			if (del == "true") {
				hui.toast("该游戏官方正在维护，请稍后再购买！");
                return false;
            }
            if (stop == "2") {
            	hui.toast(reason);
                return false;
            }
            if (this.href == "2") {
            	hui.toast(reason);
                return false;
            }
			document.location.href=url;
		});
 	});

	
	var item1 = document.getElementById('item1content');
	var item2 = document.getElementById('item2content');
	document.getElementById('sliderGood').addEventListener('slide', function(e) {
		if (e.detail.slideNumber === 0) {
			if (item1.querySelector('.mui-loading')) {
				mui(item1).load("front/getCommonGood.htm", function(){
					var y_height=document.getElementById('item1mobile');
					var x_height=document.getElementById('item1content');
					var n_height=x_height.offsetHeight;
					y_height.style.height=n_height+"px"; 
					height1 = n_height;
					
					mui(item1).on('tap','a',function(){
						var del = this.getAttribute("del");
						var stop = this.getAttribute("stop");
						var reason = this.getAttribute("reason");
						var url = this.getAttribute("url");
						
						if (del == "true") {
							hui.toast("该游戏官方正在维护，请稍后再购买！");
			                return false;
			            }
			            if (stop == "2") {
			            	hui.toast(reason);
			                return false;
			            }
			            if (this.href == "2") {
			            	hui.toast(reason);
			                return false;
			            }
						document.location.href=url;
					});
			 	});
			}
		}else if (e.detail.slideNumber === 1) {
			if (item2.querySelector('.mui-loading')) {
				mui(item2).load("./?mod=WapClassList", function(){
					document.location.href="./?mod=WapProduct";
					var y_height=document.getElementById('item2mobile');
					var x_height=document.getElementById('item2content');
					var n_height=x_height.offsetHeight;
					y_height.style.height=n_height+"px"; 
					height2 = n_height;
						
					mui(item2).on('tap','a',function(){
						var del = this.getAttribute("del");
						var stop = this.getAttribute("stop");
						var reason = this.getAttribute("reason");
						var url = this.getAttribute("url");
						
						if (del == "true") {
							hui.toast("该游戏官方正在维护，请稍后再购买！");
			                return false;
			            }
			            if (stop == "2") {
			            	hui.toast(reason);
			                return false;
			            }
			            if (this.href == "2") {
			            	hui.toast(reason);
			                return false;
			            }
						
						document.location.href=url;
					});
			 	});
			}
		}
		
		if (e.detail.slideNumber === 0 && height1 > 0) {
			if (height1<height2) {
				var yy_height=document.getElementById('item2mobile');
				yy_height.style.height=height1+"px";
			}else{
				var yy_height=document.getElementById('item1mobile');
				yy_height.style.height=height1+"px";
			}
		}else if (e.detail.slideNumber === 1 && height2 > 0) {
			if (height1<height2) {
				var yy_height=document.getElementById('item2mobile');
				yy_height.style.height=height2+"px";
			}else{
				var yy_height=document.getElementById('item1mobile');
				yy_height.style.height=height2+"px";
			}
		}
		
		mui('#offCanvasContentScroll').scroll().reLayout();
		var s_height1 = mui('#offCanvasContentScroll').scroll().maxScrollY;
		var s_height2 = mui('#offCanvasContentScroll').scroll().y;
		
		if (s_height2<=s_height1) {
			mui('#offCanvasContentScroll').scroll().scrollTo(0, s_height1);
		}
	});
})(mui, document);
</script>
</body>
</html>