<?php
if(!defined('IN_CRONLITE'))exit();

?>
<div class="sidebar">
<ul class="circles animated">
	<li class="circle1"></li>
	<li class="circle2"></li>
	<li class="circle3"></li>
</ul> 
<a class="sidebartop kefuqq" onclick="kefuWindow();">
	<span>您好，有什么需要咨询的吗？</span>
</a>
<a href="./user/reg.php" target="_blank" class="cir downloadshq">
	<span>搭建<br/>分站</span>
</a>
<a href="./user/login.php" target="_blank" class="cir addaccount">
	<span>后台<br/>登陆</span>
</a>
<a href="<?php echo $conf['appurl']; ?>" target="_blank" class="downloadapp">
	<span>
		<img src="http://qr.liantu.com/api.php?text=<?php echo urlencode($conf['appurl']); ?>"/>
	
	</span>
</a>
<a href="./?mod=Faq" target="_blank" class="cir slideshhelp">
	<span>常见<br/>问题</span>
</a>
<a class="sidebarbottom flycurrent"></a>
</div>
<?php
echo "<script>";
echo "var web_domain = '//wpa.qq.com/msgrd?v=3&uin=".$conf['kfqq']."&site=qq&menu=yes';";
echo "function kefuWindow() {";
echo "   window.open(web_domain);}";
echo "</script>";
?>
</body>
</html>