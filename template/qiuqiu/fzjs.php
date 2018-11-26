<?php
if(!defined('IN_CRONLITE'))exit();
?>
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, width=device-width">
<title><?php echo $conf['sitename']?> - <?php echo $conf['title']?></title>
  <meta name="keywords" content="<?php echo $conf['keywords']?>">
  <meta name="description" content="<?php echo $conf['description']?>">
  <link href="//lib.baomitu.com/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="//lib.baomitu.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
  <link rel="stylesheet" type="text/css" href="<?php echo $cdnserver?>assets/qiuqiu/css/con_index.css">
  <script src="//lib.baomitu.com/jquery/1.12.4/jquery.min.js"></script>

    <style media="screen">
    .art-header{z-index: 99999;width: 100%;height: 42px;background: #1787e6;position: fixed;top: 0;color: #fff;border-bottom: 1px solid #ccc;}
    .art-back{display: inline-block;float: left;height: 43px;padding-left: 10px;line-height: 43px;color: #fff;position: relative;font-size: 22px;}
    .art-title-top{width: 80%;overflow: hidden;height: 43px;position: absolute;left: 50%;font-size: 14px;font-weight: 800;transform: translateX(-50%);-webkit-transform: translateX(-50%);-moz-transform: translateX(-50%);text-align: center;line-height: 43px;}
    .art-tools{display: inline-block;float: right;height: 43px;line-height: 43px;padding: 0 20px;text-align: center;font-size: 22px;}
    .art-article{padding-top: 42px}
    .art-article-title{margin-top: 22px;padding: 0 16px;}
    .art-article-title>h1{font-weight: bold;font-size: 22px;padding: 0;margin: 0;}
    .art-information{padding: 10px 16px;line-height: 13px;font-size: 14px;}
    .art-information>span{color: #999;font-size: 13px;margin-right:4px;}
    .art-data{color: #000;line-height: 18px;}

    @media screen and (min-width: 901px) {
      html{width: 640px;margin: 0 auto;}
      .art-header{width: 641px !important;}
    }

    </style>
	 </head>
  <body>
 <div class="art-header">

 <span class="art-back"><i class="iconfont"></i></span>
      <span class="art-title-top">关于<?php echo $conf['sitename']?>分站搭建</span>
      <span class="art-tools"><i class="iconfont"></i></span>
    </div>
    <div class="art-article">
      <div class="art-article-title">
        <h3>关于<?php echo $conf['sitename']?>分站搭建</h3>
      </div>
      <div class="art-information">
        <span>发布人：admin</span>
        <span> | </span>
        <span>客服QQ:<a style="font-weight: 800;color: #09f;" target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['kfqq']?>&site=qq&menu=yes"><?php echo $conf['kfqq']?></a></span>
 
 
 <hr color=red>
<div style="min-height: 300px; font-size: 14px; line-height:2;max-width: 99%;margin: 0 auto;">

 代刷网分站8.88元/长期，需要搭建可以在线购买，自助开通！<br>购买网址：<a target="_blank" href="./user/reg.php" class="btn btn-success btn-xs"> 点击搭建</a>
 <br>后台账号密码就是自己登录分站后台的时候用的账号密码，分站账号可以为自己的QQ，密码不能太过于简单，能够记住且不能被别人猜中就行，二级域名那里，比如你填123abc，则你的分站网址就是 123abc.<?php echo $_SERVER['HTTP_HOST']?>，如果不会的话可以参考下图： <img src="<?php echo $cdnserver?>assets/qiuqiu/images/fz.png" width="100%"> </div>
 <br>你可以把你的网站分享给朋友，球球群，互赞群，有人来下单，你就有提成，分站不能上架自己的<br><br>商品，商品全部对接主站，所有订单由主站处理，分站拿提成，分站可以修改商品价格（价格不能<br><br>低于代理价），售价减去代理价等于利润，售价越高，赚的越多，当然，也要有分寸。<br><br><img src="<?php echo $cdnserver?>assets/qiuqiu/images/tc.png" width="100%"> <br><br>提成会被存在网站里的账户中，大于10元就可以申请提现，支付QQ红包，微信红包，支付宝。
 <br><br>

          <center><td align="center"><a href="./" class="btn btn-sm btn-info"><i class="glyphicon glyphicon-home"></i>返回首页</a></td></center>
</div>
　    <script type="text/javascript">
      $(".art-back").click(function(){
        window.location="./";
        //返回
      });
      $(".art-tools").click(function(){
        //更多

      });
    </script>

</div>
</div>
 </div>
   </body>