<?php
if(!defined('IN_CRONLITE'))exit();
$title = '分站介绍';
include TEMPLATE_ROOT.'mall/head.php';
?>
<div class="Main" style="min-height:360px;">
	<div class="jinxiu_about" style="padding:20px; background:#fff; margin-top: 30px;">
		
		<style>
			.wxdy span { font-size:14px; line-height: 40px;}
			.wxdy em { font-size:14px; color: #1775F4;}
			</style>
	
        <div class="wxdy">
			
            <span style="color:#2287EB; font-size:20px;"><?php echo $conf['sitename']?>分站介绍</span>
        	
        </div>
<div class="art-article">

      <div class="art-information">
        <span>发布人：admin</span>
        <span> | </span>
        <span>客服QQ：<a style="font-weight: 800;color: #09f;" target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['kfqq']?>&site=qq&menu=yes"><?php echo $conf['kfqq']?></a></span>
 
 
 <hr color=red>
<div style="min-height: 300px; font-size: 14px; line-height:2;max-width: 99%;margin: 0 auto;">

 需要搭建可以在线购买，自助开通！<br>购买网址：<a target="_blank" href="./user/reg.php" class="btn btn-success btn-xs"> 点击搭建</a>
 <br>后台账号密码就是自己登录分站后台的时候用的账号密码，分站账号可以为自己的QQ，密码不能太过于简单，能够记住且不能被别人猜中就行，二级域名那里，比如你填123abc，则你的分站网址就是 123abc.<?php echo $_SERVER['HTTP_HOST']?>，如果不会的话可以参考下图： <img src="<?php echo $cdnserver?>assets/qiuqiu/images/fz.png" width="100%"> </div>
 <br>你可以把你的网站分享给朋友，球球群，互赞群，有人来下单，你就有提成，分站不能上架自己的<br><br>商品，商品全部对接主站，所有订单由主站处理，分站拿提成，分站可以修改商品价格（价格不能<br><br>低于代理价），售价减去代理价等于利润，售价越高，赚的越多，当然，也要有分寸。<br><br><img src="<?php echo $cdnserver?>assets/qiuqiu/images/tc.png" width="100%"> <br><br>提成会被存在网站里的账户中，大于10元就可以申请提现，支付QQ红包，微信红包，支付宝。
 <br><br>
		  <style>
			  .FooterBtn { text-align:center; margin-top: 10px;}
			  .FooterBtn a {  color:#fff; padding:5px 10px;}
			  .FooterBtnRed { background:#E95658;transition:all .3s;-webkit-transition:all .3s;}
			  .FooterBtnRed:hover { background:#CA1D20;transition:all .3s;-webkit-transition:all .3s;}
			  .FooterBtnBlue{ background:#45A1DF;transition:all .3s;-webkit-transition:all .3s;}
			  .FooterBtnBlue:hover{ background:#0081D8;transition:all .3s;-webkit-transition:all .3s;}
			  .FooterYeloow { background:#E9C056;transition:all .3s;-webkit-transition:all .3s;}
			  .FooterYeloow:hover { background:#FFB800;transition:all .3s;-webkit-transition:all .3s;}
			  

			  
			 </style>
		  <div class="FooterBtn">
			  <a href="./" class="FooterBtnRed">返回首页</a>
			  <a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['kfqq']?>&site=qq&menu=yes" target="_blank" class="FooterYeloow">联系客服</a>
		  </div>

</div>

</div>

		</div>

</div><div class="clear"></div>
<div class="anli_wrap"></div>

<?php include TEMPLATE_ROOT.'mall/foot.php';?>

<link rel="stylesheet" type="text/css" href="<?php echo $cdnserver?>assets/mall/css/suspend.css?t=0709">

<?php
include TEMPLATE_ROOT.'mall/footer.php';
?>