<?php
if(!defined('IN_CRONLITE'))exit();
?>
<!DOCTYPE html>
<html>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo $title?> - <?php echo $conf['sitename']?></title>
    <meta name="keywords" content="<?php echo $conf['keywords']?>">
    <meta name="description" content="<?php echo $conf['description']?>">
	<?php echo $cssadd?>
	<link type="text/css" rel="stylesheet" href="<?php echo $cdnserver?>assets/mall/css/base1.css"/>
	<link type="text/css" rel="stylesheet" href="<?php echo $cdnserver?>assets/mall/css/vc_base.css"/>
    <link href=<?php echo $cdnserver?>"assets/mall/css/search0429.css?t=1219" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $cdnserver?>assets/mall/css/head.css?v0604">
</head>

<body style="background:#f1f2f3;">
<div class="nybg">
    <!-- navigation -->
    <!-- 文字滚动 -->
    <div id="noticeContent" class="noticeBox noticeRollTop" style="display: none;">
        <div class="noticeTopTxt"><span></span><div class="close__">×</div></div>
    </div>
    <div id="top_top">
        <!-- NAVI_TOP -->
        <!-- NAVI_TOP -->
<div class="logBox">
    <div class="login" style="width:1100px;"><span>您好，欢迎来到<?php echo $conf['sitename']?>！&nbsp;&nbsp;<a class="head_kefu" style="display:inline-block;color: #fff;
    background: #78c443;
    width: 80px;
    height: 22px;
    line-height: 22px;
    text-align: center;
    border-radius: 20px;
    margin-left: 5px;cursor: pointer"  href="//wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['kfqq']?>&site=qq&menu=yes" target="_blank">联系客服</a></span>
		
        <div class="top" style="left:450px; display:none;">
	
		
         </div>

    <div class="siderNav1">
		<a href="./user/login.php" target="_parent" title="站长登陆">站长登陆</a><div class="line">|</div>
		<a href="./user/reg.php" target="_parent" title="自助开通分站" style="width:80px;">自助开通分站</a><div class="line"></div>

	</div>
    </div>
</div>
    </div>


    <!-- search -->
    <div id="search1_width">
        <div id="search1" style="width:1200px;padding:0 20px;background:#fff;">
             <a hideFocus href="./" class="logo1" title="<?php echo $conf['sitename']?>" target="_parent"><img src="<?php echo $logo?>" width="170" alt="<?php echo $conf['sitename']?>" /></a><div class="gg">| 24小时最便宜自助代刷平台</div> 
							
							
			<form name="searchForm" action="" method="get">
					<input type="hidden" name="mod" value="product">
					<input type="hidden" name="search" value="yes">
                <div class="ser" style="width:500px;">
                    <input name="keyWords" class="input1" type="text" style="background:#eee;">
					<input class="input2" name="searchBtn" id="searchBtn" value="搜索" type="submit">
                </div>
            </form>

        </div>

    </div><div class="clear"></div>
        <!-- menu -->
    <div class="nav" >
        <div class="content" style="width:1200px;background:#e6292c;height:40px;line-height:40px;position:relative">
       
            <ul>
                <li><a hidefocus class="con_li1" href="./" title="首页">首页</a></li>
				<li><a hidefocus class="con_li1 <?php if($_GET['mod']=="product"){ echo "curr";} ?>" onclick='location.href="./?mod=product";' target="_blank" rel="nofollow">商品列表</a></li>
				<li><a hidefocus class="con_li1 <?php if($_GET['mod']=="chadan"){ echo "curr";} ?>" onclick='location.href="./?mod=chadan";' target="_blank" rel="nofollow">订单查询</a></li>
				<li><a hidefocus class="con_li1 <?php if($_GET['mod']=="fenzhandajian"){ echo "curr";} ?>" onclick='location.href="./?mod=fenzhandajian";' target="_blank" rel="nofollow">分站介绍</a></li>
				<li><a hidefocus class="con_li1 <?php if($_GET['mod']=="Faq"){ echo "curr";} ?>" onclick='location.href="./?mod=Faq";' target="_blank" rel="nofollow">帮助中心</a></li>
                <li><a hidefocus class="con_li2 <?php if($_GET['mod']=="about"){ echo "curr";} ?>" onclick='location.href="./?mod=about";' target="_blank"  target="_blank" rel="nofollow" title="关于我们">关于我们</a></li>
                <li class="ul_li"><a hidefocus href="<?php echo $conf['appurl']; ?>"  target="_blank" title="下载APP"><img class="fl" alt="下载APP" style="padding-top:13px;padding-right:5px;" src="assets/mall/images/Myinfor2_03.jpg" /><span style="position:relative;top:1px;">下载APP</span></a></li>
            </ul>
        </div>
    </div>
    <div class="clear"></div>

</div>
