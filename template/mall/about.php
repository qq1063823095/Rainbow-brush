<?php
if(!defined('IN_CRONLITE'))exit();
$title = '关于我们';
include TEMPLATE_ROOT.'mall/head.php';
?>


<div class="Main" style="min-height:360px;">
	<div class="jinxiu_about" style="padding:20px; background:#fff; margin-top: 30px;">
		
		<style>
			.wxdy span { font-size:14px; line-height: 40px;}
			.wxdy em { font-size:14px; color: #1775F4;}
			</style>
	
        <div class="wxdy">
			
            <span style="color:#2287EB; font-size:20px;">关于我们</span>
        	
        </div>
		<div class="wxdy"><span>官方主页</span> <em><?php echo $_SERVER['HTTP_HOST']?></em></div>
		<div class="wxdy"><span>客服QQ</span> <em><?php echo $conf['kfqq']?><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['kfqq']?>&site=qq&menu=yes"> <img border="0" src="http://wpa.qq.com/pa?p=2:<?php echo $conf['kfqq']?>:51" alt="点击这里给我发消息" title="点击这里给我发消息"/></a></em></div>
		<div class="wxdy"><span>技术支持</span> <em><?php echo $conf['sitename']?></em></div>
		<div class="intro"><?php echo $conf['chatframe']?> </div>
    
		</div>

</div><div class="clear"></div>
<div class="anli_wrap"></div>

<?php include TEMPLATE_ROOT.'mall/foot.php';?>

<link rel="stylesheet" type="text/css" href="<?php echo $cdnserver?>assets/mall/css/suspend.css?t=0709">

<?php
include TEMPLATE_ROOT.'mall/footer.php';
?>