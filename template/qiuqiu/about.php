<?php
if(!defined('IN_CRONLITE'))exit();
include TEMPLATE_ROOT.'qiuqiu/head.php';
?>

	<div class="s3"><?php echo $conf['sitename']?></div>
		<div class="s2"><img src="<?php echo $cdnserver?>assets/qiuqiu/images/y1.png" /></div>
		<div class="s1"><img src="<?php echo $cdnserver?>assets/qiuqiu/images/hj.png" /></div>
	</div>
	<div class="nav">
		<ul>

			<li><span class="nav-txt" onclick='location.href="./"'>首页</span></li>
			<li><s class="wao">送龙蛋</s><span class="nav-txt" onclick='location.href="./?mod=tool"' style="color:#ff585d;">秒点</span></li>
			<li><span class="nav-txt" onclick='location.href="./?mod=pattern";'>字体</span></li>
			<li class="ks-active"><span class="nav-txt" onclick='location.href="./?mod=about";'>关于</span></li>
	</div>
</div><div id="bd">
<div class="ct">
    <div class="about">
	
        <div class="wxdy">
			
            <span style="color:#2287EB;">关于我们</span>
        	
        </div>
		<div class="wxdy"><span>官方主页</span> <em><?php echo $_SERVER['HTTP_HOST']?></em></div>
		<div class="wxdy"><span>客服QQ</span> <em><?php echo $conf['kfqq']?><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['kfqq']?>&site=qq&menu=yes"> <img border="0" src="http://wpa.qq.com/pa?p=2:<?php echo $conf['kfqq']?>:51" alt="点击这里给我发消息" title="点击这里给我发消息"/></a></em></div>
		<div class="wxdy"><span>技术支持</span> <em><?php echo $conf['sitename']?></em></div>
		<div class="intro"><?php echo $conf['chatframe']?> </div>
    
	</div>

 </article>
<?php include TEMPLATE_ROOT.'qiuqiu/foot.php';?>