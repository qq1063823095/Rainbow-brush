<?php
include 'head.php';
?>
	
	<div class="s3"><?php echo $conf['sitename']?></div>
		<div class="s2"><img src="<?php echo $cdnserver?>assets/qiuqiu/images/y1.png" /></div>
		<div class="s1"><img src="<?php echo $cdnserver?>assets/qiuqiu/images/hj.png" /></div>
	</div>
	<div class="nav">
		<ul>

			<li><span class="nav-txt" onclick='location.href="./"'>首页</span></li>
			<li class="ks-active"><s class="wao">送龙蛋</s><span class="nav-txt" onclick='location.href="./?mod=tool"' style="color:#ff585d;">秒点</span></li>
			<li><span class="nav-txt" onclick='location.href="./?mod=pattern";'>字体</span></li>
			<li><span class="nav-txt" onclick='location.href="./?mod=about";'>关于</span></li>
	</div>
</div><div id="bd">
	<div class="ct">
		<div class="" style="text-align:center;">
		<span style="color: #fd0000;text-align: center;">通知：在此提交龙蛋链接,有几率获得200以上龙蛋！</span><br/><br/>
			<input class="url" type="url" id="url" placeholder="输入球球邀请链接或龙蛋链接"><br>
			<div class="an1 bt" onclick="longdan()">领取30龙蛋</div>
			<div class="an2 bt" onclick="submit()">领取棒棒糖</div>
		</div>
				</div>
	<center><a href="./?mod=fzjs"><img style="width:90%;" src="assets/qiuqiu/images/dlpic.jpg" /></a></center>
	</div>

				
<div id="loading"></div> 
<script src="<?php echo $cdnserver?>assets/qiuqiu/js/mainl.js"></script>
</article>
<?php include 'foot.php';?>