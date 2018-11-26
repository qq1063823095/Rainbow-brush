<?php
if(!defined('IN_CRONLITE'))exit();
if($_GET['buyok']==1 && checkmobile()){include_once TEMPLATE_ROOT.'mall/WapChadan.php';exit;}
elseif($_GET['buyok']==1){include_once TEMPLATE_ROOT.'mall/chadan.php';exit;}
if(checkmobile() && !$_GET['pc'] || $_GET['mobile']){include_once TEMPLATE_ROOT.'mall/wapindex.php';exit;}
$config = require_once TEMPLATE_ROOT.'mall/config.php';
if(isset($_GET['cid']) && isset($_GET['tid'])){
	exit("<script language='javascript'>window.location.href='./?mod=PostProduct&cid={$_GET['cid']}&tid={$_GET['tid']}';</script>");
}elseif(isset($_GET['cid'])){
	exit("<script language='javascript'>window.location.href='./?mod=PostProduct&cid={$_GET['cid']}';</script>");
}
?> 
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no"/>
	<meta http-equiv="Cache-Control" content="no-transform"/>
	<title><?php echo $conf['sitename']?> - <?php echo $conf['title']?></title>
	<meta name="keywords" content="<?php echo $conf['keywords']?>">
	<meta name="description" content="<?php echo $conf['description']?>">
	<link rel="stylesheet" href="<?php echo $cdnserver?>assets/mall/css/base.css"/>
	<link rel="stylesheet" href="<?php echo $cdnserver?>assets/mall/css/indexnew.css" />
	<script type="text/javascript" src="//lib.baomitu.com/jquery/1.12.4/jquery.min.js"></script>
	<script src="//lib.baomitu.com/layer/2.3/layer.js"></script>
	<script type="text/javascript" src="<?php echo $cdnserver?>assets/mall/js/main2.js?t=1"></script>
</head>
<body>

<div class="header">
	<div class="top widthset">
		<div class="topcon fl">
			<img src="<?php echo $cdnserver?>assets/mall/images/house.png" /><font>您好，欢迎来到<?php echo $conf['sitename']?>！<a style="color: #fff;
    background: #78c443;
    width: 80px;
    height: 22px;
    line-height: 22px;
    text-align: center;
    border-radius: 20px;
    margin-left: 5px;" href="//wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['kfqq']?>&site=qq&menu=yes" target="_blank">联系客服</a></font>
				
		</div>
		<div class="topcon fr">
			<span class="login_top_wrap fl">
	
				<a href="./user/login.php" target="_blank" class="red">站长登陆</a>
				<a href="./user/reg.php" target="_blank" class="green">自助开通分站</a>

	
			</span>
			<ul class="fl">
				
				<li>工具箱
					<div class="tkbox">
						<div class="aSty01">
							<a href="./index.php?mod=tools" target="_blank">获取快手或K歌ID</a>
			
						</div>
					</div>
				</li>
			
				<li class="nobox"><a href="./?mobile=1">手机版</a></li>
			</ul>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="logobg" style="height: 115px;">
		<div id="search" class="widthset">
							<a hideFocus href="./" class="logo"  title="<?php echo $conf['sitename']?>" ><img src="<?php echo $logo?>" width="190"  alt="<?php echo $conf['sitename']?>" /></a><div class="gg">|&nbsp;24小时最便宜自助代刷平台</div>
							<div class="ser1" style="float:right; width:500px;">
							
				<form name="searchForm" action="" method="get">
					<input type="hidden" name="mod" value="product">
					<input type="hidden" name="search" value="yes">
					<div class="lib_Contentbox1 serch_border" style="width:500px;">
						<ul id="serch1">
							<li id="one1"  class="hover"><span><a href="./?mod=product" style="font-size:16px; font-weight:bold; color:#f96557;">我要买</a></span></li>
						</ul>
				
						<input class="serch_content" name="keyWords" type="text" style="border-left:none;" placeholder="请输入您要购买商品的关键词">
						<input class="serch_button" type="submit" value="搜索">
					</div>
				</FORM>
				<div class="clear"></div>
			</div>
		</div>
	</div>
	<!-- 搜索框 End -->
	
	<div class="nav widthset">
		<a href="./" class="current">首页</a>
		<a onclick='location.href="./?mod=product";' target="_blank" rel="nofollow">商品列表</a>
		<a onclick='location.href="./?mod=chadan";' target="_blank" rel="nofollow">订单查询</a>
		<a onclick='location.href="./user/reg.php";' target="_blank" rel="nofollow">分站搭建</a>
		<a onclick='location.href="./?mod=fenzhandajian";' target="_blank" rel="nofollow">分站介绍</a>
		<a onclick='location.href="./?mod=about";' target="_blank" rel="nofollow">关于我们</a>
		<a href="<?php echo $conf['appurl']; ?>" target="_blank" class="download"><img class="down" src="<?php echo $cdnserver?>assets/mall/images/download.png"/>APP下载<img src="<?php echo $cdnserver?>assets/mall/images/hot1icon.png" class="hot" /></a>
	</div>
</div>

<div class="wrapper">
	<div class="main">
		<div class="banner_bg">
		<div class="wrap">
			<div class="ban_bg">
	
	<style>
		.zq_show .zq_title a { margin-bottom:10px;}
		
		.ban_left ul li:hover{ background:#FFA4A4;}
		.ban_bg .ban_left ul li span.otherstyle{ border-bottom:none; margin-top:0px;}
		.ban_bg .ban_left ul li span.otherstyle:hover{ border-top:none; margin-top:0px;}
		
		</style>
				
				
				
				<div class="ban_left">
					<ul>
						<li><span class="otherstyle1"><img src="<?php echo $cdnserver?>assets/mall/images/ban_left.png" alt="热门商品" />热门商品</span>
						         
				
						</li>
						
<?php

$rs=$DB->query("select * from shua_class where active=1 order by sort asc limit 9");
while($res = $DB->fetch($rs)){
echo "<li>";
echo " <span class=\"otherstyle bigclassy\">";
echo "   <img src=\"assets/mall/images/ban_left$i$i.png\" alt=\"{$res['name']}\" />{$res['name']}</span>";
echo " <div class=\"zq_show\">";
echo "   <div class=\"searchStar\" style=\"min-height:350px;\">";
echo "     <div class=\"zq_title\">";
echo "       <p>";
	
$rs1=$DB->query("select * from shua_tools where cid={$res['cid']}");
while($row1 = $DB->fetch($rs1)){	

 echo "<a target=\"_parent\" href=\"./?mod=PostProduct&cid={$row1['cid']}&tid={$row1['tid']}\" title=\"{$row1['name']}\">{$row1['name']}</a><b></b>";

}

echo "</p>";
echo "</div>";
echo "</div>";
echo "</div>";
echo "</li>";
}

?>	
				
					
						<li class="allWeb"><a href="./?mod=product"  target="_blank"> 查看网站全部商品</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
		<div class="main_left fl">
			<div class="banner_left">
				<font><</font>
				<div class="banner_leftbg"></div>
			</div>
			<div class="banner_right">
				<font>></font>
				<div class="banner_rightbg"></div>
			</div>
			<ul class="banner">
				<li class="current">
					<a target="_blank" href="./" ><img src="<?php echo $config['banner1']?>" /></a>
				</li>
				<li >
					<a target="_blank" href="./" ><img src="<?php echo $config['banner2']?>" /></a>
				</li>	
				<li >
					<a target="_blank" href="./" ><img src="<?php echo $config['banner3']?>" /></a>
				</li>
				<li >
					<a target="_blank" href="./" ><img src="<?php echo $config['banner4']?>" /></a>
				</li>
			</ul>
			<ul class="banner_circle">
				<li class="current">
					<span></span>
					<div></div>
				</li>
				<li ><span></span><div></div></li>	
				<li ><span></span><div></div></li>		
				<li ><span></span><div></div></li>		
		</ul>
		</div>
		<div class="main_right fr">
			<div class="login_neck_wrap">
				<div class="login nologin">
					<a href="./user/reg.php" class="btn" target="_blank">&nbsp;搭建分站</a>
					<a href="./user/login.php" class="btn" target="_blank">&nbsp;后台登陆</a>
				</div>
			</div>
			<div class="news">
				<ul class="news_title">
					<li class="current"><a>最新公告</a></li>
					<li class=""><a>交易统计</a></li>
					
				</ul>
				<ul class="news_list">
								
<style>
	.SiteData { height:175px; width:248px; text-align: center;}
	.SiteData span { float:left; height:40px; line-height: 40px; text-align: center; width:248px;margin-bottom: 10px;}
	.BackgroundRed { background:#E95658; color:#fff;transition:all .3s;-webkit-transition:all .3s;}
	.BackgroundRed:hover { background:#CA1D20;transition:all .3s;-webkit-transition:all .3s;}
	.BackgroundBlue { background:#45A1DF; color:#fff;transition:all .3s;-webkit-transition:all .3s;}
	.BackgroundBlue:hover { background:#0081D8; transition:all .3s;-webkit-transition:all .3s;}
	.BackgroundYellow { background:#E9C056; color:#fff;transition:all .3s;-webkit-transition:all .3s;}
	.BackgroundYellow:hover { background:#FFB800; transition:all .3s;-webkit-transition:all .3s;}
	.BackgroundGreen { background:#72C580; color:#fff;transition:all .3s;-webkit-transition:all .3s;}
	.BackgroundGreen:hover { background:#109125; transition:all .3s;-webkit-transition:all .3s;}
</style>
					
					<li style="display:list-item;">
<?php echo $conf['anounce']?>
					</li>
					<li style="display: none;">
						
<div class="SiteData">			
<span class="BackgroundRed">累计订单总数：<text id="count_orders"></text> 条</span>	
<span class="BackgroundBlue">累计交易金额：<text id="count_money"></text> 元</span>
<span class="BackgroundYellow">今日累计订单总数：<text id="count_orders2"></text> 条</span>	
<span class="BackgroundGreen">今日累计交易金额：<text id="count_money1"></text> 元</span>
</div>
					</li>
				</ul>
			</div>
			

		</div>
		<div class="clear"></div>
	</div>
	<div class="warp tiyan">
		<div class="title title1">
			热门商品
			<a href="?mod=product">查看更多+</a>
		</div>
		<div class="tiyan_con">
			<a class="tyleft">
				<img src="<?php echo $cdnserver?>assets/mall/images/tyleft.png" />
			</a>
			<div class="tybox">
<?php

$rs=$DB->query("select * from shua_class where active=1 order by sort asc");

while($res = $DB->fetch($rs)){
	if(!empty($res["shopimg"])){
		$productimg = $res["shopimg"];
	}else{
		$productimg = 'assets/img/Product/default.png';
	}
	echo "<a href=\"./?mod=PostProduct&cid={$res['cid']}\">";
	echo "<img src=\"{$productimg}\" onerror=\"this.src='assets/img/Product/noimg.png'\"/>";
	echo "<span>".$res['name']."</span>";
	echo "<span class=\"imgbg\"></span>";
	echo "</a>";
}

?>

				<div class="clear"></div>
			</div>
			<a class="tyright">
				<img src="<?php echo $cdnserver?>assets/mall/images/tyright.png" />
			</a>
		</div>
	</div>
	<div class="warp">
		<div class="title title2">
			热门推荐
			<a href="./">查看更多+</a>
		</div>
		<div class="hotgame">
			
<?php
			
$rs=$DB->query("select * from shua_class where active=1 order by sort desc limit 1");
while($res = $DB->fetch($rs)){
	if(!empty($res["shopimg"])){
		$productimg = $res["shopimg"];
	}else{
		$productimg = 'assets/img/Product/default.png';
	}
echo "			<div class=\"hotgame_left fl\">";
echo "				<img src=\"{$productimg}\" onerror=\"this.src='assets/img/Product/noimg.png'\">";
echo "				<div class=\"con\">";
echo "					<div class=\"pn\">";
echo "						<span>{$res['name']}</span>";
echo "						<font>每日优惠，福利更多！</font>";
echo "					</div>";
echo "					<div class=\"btn\">";
echo "						<a href=\"./?mod=PostProduct&cid={$res['cid']}\">进入专区</a>";
echo "						<a href=\"./?mod=PostProduct&cid={$res['cid']}\">每日优惠</a>";
echo "					</div>";
echo "				</div>";
echo "				<div class=\"hotgamebg\"></div>";
echo "				<div class=\"topbtn\"></div>";
echo "			</div>	";
}

?>	

			<ul class="hotgame_right fr">
				
<?php

$rs=$DB->query("select * from shua_class where active=1 order by sort desc limit 1,6");

while($res = $DB->fetch($rs)){
	if(!empty($res["shopimg"])){
		$productimg = $res["shopimg"];
	}else{
		$productimg = 'assets/img/Product/default.png';
	}
echo "				<li>";
echo "					<img src=\"{$productimg}\" style=\" widht:296px; height:145px;\" onerror=\"this.src='assets/img/Product/noimg.png'\">";
echo "					<div class=\"con\">";
echo "						<div class=\"pn\">";
echo "							<span>{$res['name']}</span>";
echo "							<font></font>";
echo "						</div>";
echo "						<div class=\"btn\">";
echo "							<a href=\"./?mod=PostProduct&cid={$res['cid']}\">进入专区</a>";
echo "							<a href=\"./?mod=PostProduct&cid={$res['cid']}\">立即查看</a>";
echo "						</div>";
echo "					</div>";
echo "					<div class=\"hotgamebg\"></div>";
echo "					<div class=\"topbtn\"></div>";
echo "				</li>";
}

?>	
				
				
			</ul>
			<div class="clear"></div>
		</div>
	</div>
	
					<div class="warp">
		<div class="title title2">
			关于我们
			
		</div>
		</div>
	<div class="wrap newslist" style="margin-top:20px;">
		
		
		<div class="news_left fl">
			<ul class="news1_title">
				<li class="current"><a href="./?mod=Faq#changjian" target="_blank">常见问题</a></li>
				<li><a href="./?mod=Faq#qqzuan" target="_blank">QQ钻问题</a></li>
				<li><a href="./?mod=Faq#qqkongjian" target="_blank">空间问题</a></li>
				<li><a href="./?mod=Faq#kuaishou" target="_blank">快手问题</a></li>
			</ul>
			<ul class="news1_list">
				<li>
					<p>
							<span title="代刷网为什么下单很久了都没有开始刷呢？">代刷网为什么下单很久了都没有开始刷呢？</span>
							<font>浏览次数：220618次</font>
							<a href="./?mod=Faq&id=changjian1#changjian1">查看</a>
						</p><p>
							<span title="代刷网为什么显示订单已完成但是没有到账呢？">代刷网为什么显示订单已完成但是没有到账呢？</span>
							<font>浏览次数：203411次</font>
							<a href="./?mod=Faq&id=changjian2#changjian2">查看</a>
						</p><p>
							<span title="代刷网出现订单异常应该怎么办呢？">代刷网出现订单异常应该怎么办呢？</span>
							<font>浏览次数：112997次</font>
							<a href="./?mod=Faq&id=changjian3#changjian3">查看</a>
						</p><p>
							<span title="代刷网的优势都有哪些呢？">代刷网的优势都有哪些呢？</span>
							<font>浏览次数：97279次</font>
							<a href="./?mod=Faq&id=changjian4#changjian4">查看</a>
						</p><p>
							<span title="代刷网支持代刷哪些商品呢？">代刷网支持代刷哪些商品呢？</span>
							<font>浏览次数：87099次</font>
							<a href="./?mod=Faq&id=changjian5#changjian5">查看</a>
						</p><p>
							<span title="代刷网的专业版本分站有哪些用呢？">代刷网的专业版本分站有哪些用呢？</span>
							<font>浏览次数：86986次</font>

							<a href="./?mod=Faq&id=changjian6#changjian6">查看</a>
						</p>					<div class="clear"></div>
				</li>
				<li style="display:none;">
					<p>
							<span title="代刷网QQ会员/钻下单方法讲解">代刷网QQ会员/钻下单方法讲解</span>
							<font>浏览次数：22018次</font>
							<a href="./?mod=Faq&id=qqzuan1#qqzuan1">查看</a>
						</p><p>
							<span title="代刷网QQ钻掉单了怎么办呢？">代刷网QQ钻掉单了怎么办呢？</span>
							<font>浏览次数：20411次</font>
							<a href="./?mod=Faq&id=qqzuan2#qqzuan2">查看</a>
						</p><p>
							<span title="代刷网刷的QQ钻稳定吗？">代刷网刷的QQ钻稳定吗？</span>
							<font>浏览次数：11997次</font>
							<a href="./?mod=Faq&id=qqzuan3#qqzuan3">查看</a>
						</p><p>
							<span title="代刷网刷QQ钻一般多久可以刷好？">代刷网刷QQ钻一般多久可以刷好？</span>
							<font>浏览次数：9779次</font>
							<a href="./?mod=Faq&id=qqzuan4#qqzuan4">查看</a>
						</p><p>
							<span title="代刷网刷QQ钻需要花钱吗？">代刷网刷QQ钻需要花钱吗？</span>
							<font>浏览次数：8799次</font>
							<a href="./?mod=Faq&id=qqzuan5#qqzuan5">查看</a>
						</p><p>
							<span title="代刷网刷QQ钻自带业务可以下单吗？">代刷网刷QQ钻自带业务可以下单吗？</span>
							<font>浏览次数：8686次</font>

							<a href="./?mod=Faq&id=qqzuan6#qqzuan6">查看</a>
						</p>					<div class="clear"></div>
				</li>
				<li style="display:none;">
					<p>
							<span title="代刷网QQ空间人气下单代刷方法讲解">代刷网QQ空间人气下单代刷方法讲解</span>
							<font>浏览次数：22018次</font>
							<a href="./?mod=Faq&id=qqkongjian1#qqkongjian1">查看</a>
						</p><p>
							<span title="代刷网QQ空间说说赞代刷下单讲解">代刷网QQ空间说说赞代刷下单讲解</span>
							<font>浏览次数：20411次</font>
							<a href="./?mod=Faq&id=qqkongjian2#qqkongjian2">查看</a>
						</p><p>
							<span title="代刷网QQ空间访问量代刷下单讲解">代刷网QQ空间访问量代刷下单讲解</span>
							<font>浏览次数：11997次</font>
							<a href="./?mod=Faq&id=qqkongjian3#qqkongjian3">查看</a>
						</p><p>
							<span title="代刷网QQ空间说说访问量代刷下单讲解">代刷网QQ空间说说访问量代刷下单讲解</span>
							<font>浏览次数：9779次</font>
							<a href="./?mod=Faq&id=qqkongjian4#qqkongjian4">查看</a>
						</p><p>
							<span title="代刷QQ空间留言代刷下单讲解">代刷QQ空间留言代刷下单讲解</span>
							<font>浏览次数：8799次</font>
							<a href="./?mod=Faq&id=qqkongjian5#qqkongjian5">查看</a>
						</p><p>
							<span title="代刷网QQ空间说说评论代刷下单讲解">代刷网QQ空间说说评论代刷下单讲解</span>
							<font>浏览次数：8686次</font>

							<a href="./?mod=Faq&id=qqkongjian6#qqkongjian6">查看</a>
						</p>					<div class="clear"></div>
				</li>
				<li style="display:none;">
					<p>
							<span title="代刷网快手代刷下单方法讲解">代刷网快手代刷下单方法讲解</span>
							<font>浏览次数：22018次</font>
							<a href="./?mod=Faq&id=kuaishou1#kuaishou1">查看</a>
						</p><p>
							<span title="代刷网一天可以代刷多少快手粉丝？">代刷网一天可以代刷多少快手粉丝？</span>
							<font>浏览次数：20411次</font>
							<a href="./?mod=Faq&id=kuaishou2#kuaishou2">查看</a>
						</p><p>
							<span title="代刷网刷的快手粉丝会掉吗？">代刷网刷的快手粉丝会掉吗？</span>
							<font>浏览次数：11997次</font>
							<a href="./?mod=Faq&id=kuaishou3#kuaishou3">查看</a>
						</p><p>
							<span title="代刷网代刷快手业务为什么要准确填写商品信息呢？">代刷网代刷快手业务为什么要准确填写商品信息呢？</span>
							<font>浏览次数：9779次</font>
							<a href="./?mod=Faq&id=kuaishou4#kuaishou4">查看</a>
						</p><p>
							<span title="代刷网代刷快手业务支持倍拍吗？">代刷网代刷快手业务支持倍拍吗？</span>
							<font>浏览次数：8799次</font>
							<a href="./?mod=Faq&id=kuaishou5#kuaishou5">查看</a>
						</p><p>
							<span title="代刷网代刷快手业务完成后支持退款吗？">代刷网代刷快手业务完成后支持退款吗？</span>
							<font>浏览次数：8686次</font>

							<a href="./?mod=Faq&id=kuaishou6#kuaishou6">查看</a>
						</p>					<div class="clear"></div>
				</li>
			</ul>
		</div>
		<div class="news_center fl">
			<a href="./user/reg.php">
				<img src="<?php echo $cdnserver?>assets/mall/images/news1.jpg" class="sjimg" />
				<div class="imgbg"></div>
			</a>
			<a href="javascript:">
				<img src="<?php echo $cdnserver?>assets/mall/images/news2.jpg" />
				<div class="imgbg"></div>
			</a>
			<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['kfqq']?>&site=qq&menu=yes">
				<img src="<?php echo $cdnserver?>assets/mall/images/news3.jpg"/>
				<div class="imgbg"></div>
			</a>
			<a href="?mod=fenzhandajian">
				<img src="<?php echo $cdnserver?>assets/mall/images/news4.jpg" class="sjimg"/>
				<div class="imgbg"></div>
			</a>
			<div class="clear"></div>
		</div>
		
		
		
		<div class="news_right fr">
			<img width="235" height="235" src="http://qr.liantu.com/api.php?text=<?php echo urlencode($conf['appurl']); ?>" />
			<p>APP下载&nbsp;[扫一扫]</p>
		</div>
		<div class="clear"></div>
	</div>
</div>
<style>
.foot_top ul li{ float:left;}
</style>
<div id="Foot" style="min-width:1240px;">
	<div class="foot" style="height:330px;">
		<div class="foot_top">
			<ul class="helpclassy">
				<li class="foot_top_first">
					<a>站点导航</a>
					<a >网站简介</a>
					<a >关于我们</a>
				</li>
				<li>
					<a href="./" target="_blank">网站首页</a>
					<a href="?mod=fenzhandajian" target="_blank">分站介绍</a>
					<a href="./?mod=about" target="_blank">关于我们</a>
				</li>
				<li>
					<a href="./?mod=product" target="_blank">商品列表</a>
					<a href="./" target="_blank"></a>
					<a href="./" target="_blank"></a>
	
				
				</li>
		
			</ul>
			<script>
				$(function(){
					$(".foot_top_right .indexewm .imgtarch li").mouseenter(function(){
						var bottomnum=$(".foot_top_right .indexewm .imgtarch li").index(this);
						$(".foot_top_right .indexewm .ewmcon li").eq(bottomnum).show().siblings().hide();
					});
				});
			</script>
			
			
			<div class="foot_top_right">
				<div class="indexewm">
					<ul class="imgtarch">
						<li><img src="<?php echo $cdnserver?>assets/mall/images/Android.jpg" /></li>
						<!--
						<li><img src="assets/mall/images/weixinicon.jpg" /></li>
						<li><img src="assets/mall/images/weiboicon.jpg" /></li>
						-->
					</ul>
					<div class="clear"></div>
					<ul class="ewmcon">
						<li><div class="small"><img src="<?php echo $cdnserver?>assets/mall/images/bottomcircle.png" /></div><img width="133" height="133" src="http://qr.liantu.com/api.php?text=<?php echo urlencode($conf['appurl']); ?>" /></li>
						<!--
						<li style="display:none;"><div class="smal11"><img src="assets/mall/images/bottomcircle.png" /></div><img src="assets/mall/images/weixinewm.jpg" /></li>
						
						<li style="display:none;"><div class="small1"><img src="assets/mall/images/bottomcircle.png" /></div><img src="assets/mall/images/weiboewm.jpg" /></li>
--></ul>
				</div>
				<!--<div class="tel">客服中心QQ：</div>-->
				<!--<div class="telNum" style="color:#fff;"><?php echo $conf['kfqq']?></div>-->
				<div class="p_server">客服QQ：</div>
				<!-- <div class="p_time"><?php echo $conf['kfqq']?></div> -->
				<div class="p_time"><?php echo $conf['kfqq']?></div>
				<!--<div class="p_server1">客服QQ：</div>-->
				<!-- <div class="p_time"><?php echo $conf['kfqq']?></div> -->
				<!-- <div class="p_time1"><?php echo $conf['kfqq']?></div>-->
			</div>
			<div class="clear"></div>
		</div>
		<img src="<?php echo $cdnserver?>assets/mall/images/bottomlinebg.png" />
		<div class="paper">
			<a href="http://<?php echo $_SERVER['HTTP_HOST']?>" target="_blank">网站简介：<?php echo $conf['description']?></a>

		</div>
		<div class="link">
			<p>&copy; Powered by <a href="./"><?php echo $conf['sitename']?></a></p>
		</div>
	</div>
</div>
<div class="anli_wrap"></div>

<link rel="stylesheet" type="text/css" href="<?php echo $cdnserver?>assets/mall/css/suspend.css?t=0709">
<?php
include TEMPLATE_ROOT.'mall/footer.php';
?>

<script type="text/javascript" src="<?php echo $cdnserver?>assets/mall/js/noticeRoll-0608.js"></script>
<script type="text/javascript" src="<?php echo $cdnserver?>assets/mall/js/common.js"></script>
<script type="text/javascript" src="<?php echo $cdnserver?>assets/mall/js/index.js?t=10"></script>
<script type="text/javascript" src="<?php echo $cdnserver?>assets/mall/js/address.js"></script>
<?php
if (!empty($conf['modal'])){
?>
<div id="box1" style="display:none;"><div style="text-align:center;padding:20px;"><?php echo $conf['modal']?></div></div>
<script>
layer.open({
  type: 1,
  title:false,
shadeClose: true, //开启遮罩关闭
  skin: 'layui-layer-rim', //加上边框
  area: ['702px', '410px'], //宽高
  content:$("#box1").html(),

});
</script>
<?php
}		
?>
<script>
function getcount() {
	$.ajax({
		type : "GET",
		url : "ajax.php?act=getcount",
		dataType : 'json',
		async: true,
		success : function(data) {
			$('#count_yxts').html(data.yxts);
			$('#count_orders').html(data.orders);
			$('#count_orders1').html(data.orders1);
			$('#count_orders2').html(data.orders2);
			$('#count_orders_all').html(data.orders);
			$('#count_orders_today').html(data.orders2);
			$('#count_money').html(data.money);
			$('#count_money1').html(data.money1);
		}
	});
}
window.onload = getcount();
</script>
</body>
</html>