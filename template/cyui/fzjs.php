<?php 
if(!defined('IN_CRONLITE'))exit();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title><?php echo $conf['sitename']?> - 分站介绍</title>
  <meta name="keywords" content="<?php echo $conf['keywords']?>">
  <meta name="description" content="<?php echo $conf['description']?>">
  <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no"/>
  <link href="//lib.baomitu.com/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="//lib.baomitu.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="//lib.baomitu.com/animate.css/3.5.2/animate.min.css" type="text/css" />
  <link rel="stylesheet" href="//lib.baomitu.com/simple-line-icons/2.4.1/css/simple-line-icons.min.css" type="text/css" />
  <link rel="stylesheet" href="https://template.down.swap.wang/ui/angulr_2.0.1/html/css/font.css" type="text/css" />
  <link rel="stylesheet" href="https://template.down.swap.wang/ui/angulr_2.0.1/html/css/app.css" type="text/css" />
  <link rel="stylesheet" href="https://admin.down.swap.wang/assets/plugins/toastr/toastr.min.css" type="text/css" />

</head>
<body>
<div class="app app-header-fixed  ">
  <!-- header -->
  <header id="header" class="app-header navbar" role="menu">
          <!-- navbar header -->
      <div class="navbar-header bg-dark">
        <button class="pull-right visible-xs dk" ui-toggle="show" target=".navbar-collapse">
          <i class="glyphicon glyphicon-cog"></i>
        </button>
        <button class="pull-right visible-xs" ui-toggle="off-screen" target=".app-aside" ui-scroll="app">
          <i class="glyphicon glyphicon-align-justify"></i>
        </button>
        <!-- brand -->
        <a href="/" class="navbar-brand text-lt">
         
       <i class="fa fa-qq"></i>
          <span class="hidden-folded m-l-xs"><?php echo $conf['sitename']?></span>
        </a>
        <!-- / brand -->
      </div>
      <!-- / navbar header -->
      <!-- navbar collapse -->
      <div class="collapse pos-rlt navbar-collapse box-shadow bg-white-only">
        <!-- buttons -->
        <div class="nav navbar-nav hidden-xs">
          <a href="#" class="btn no-shadow navbar-btn" ui-toggle="app-aside-folded" target=".app">
            <i class="fa fa-dedent fa-fw text"></i>
            <i class="fa fa-indent fa-fw text-active"></i>
          </a>
        </div>
		
        <!-- / buttons -->

        <!-- nabar right -->
        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="dropdown-toggle clear" data-toggle="dropdown">
              <span class="thumb-sm avatar pull-right m-t-n-sm m-b-n-sm m-l-sm">
                <img src="//q4.qlogo.cn/headimg_dl?dst_uin=<?php echo $conf['qq']?$conf['qq']:$conf['kfqq']?>&spec=100">
                <i class="on md b-white bottom"></i>
              </span>
              <span class="hidden-sm hidden-md" style="text-transform:uppercase;"><?php echo $conf['sitename']?></span> <b class="caret"></b>
            </a>
            <!-- dropdown -->
            <ul class="dropdown-menu animated fadeInRight w">
              <li>
                <a ui-sref="access.signin" href="admin/login.php">后台登入</a>
              </li>
            </ul>
            <!-- / dropdown -->
          </li>
        </ul>
        <!-- / navbar right -->
      </div>
      <!-- / navbar collapse -->
  </header>
  <!-- / header -->
  <!-- aside -->
  <aside id="aside" class="app-aside hidden-xs bg-dark">
      <div class="aside-wrap">
        <div class="navi-wrap">

          <!-- nav -->
          <nav ui-nav class="navi clearfix">
            <ul class="nav">
              <li class="hidden-folded padder m-t m-b-sm text-muted text-xs">
                <span>导航</span>
              </li>
              <li>
                <a href="./">
                  <i class="glyphicon glyphicon-home icon text-primary-dker"></i>
				  <b class="label bg-info pull-right">❤</b>
                  <span class="font-bold">代刷首页</span>
                </a>
              </li>
              
              <li>
                <a href class="auto">      
                  <span class="pull-right text-muted">
                    <i class="fa fa-fw fa-angle-right text"></i>
                    <i class="fa fa-fw fa-angle-down text-active"></i>
                  </span>
                  <i class="glyphicon glyphicon-leaf icon text-success-lter"></i>
                  <span>管理中心</span>
                </a>
                <ul class="nav nav-sub dk">
                  <li class="nav-sub-header">
                    <a href>
                      <span>管理中心</span>
                    </a>
                  </li>
				 	<li><a href="./user"><span
								class="sidebar-nav-mini-hide">分站后台</span></a></li> 
						<li><a href="./admin"><span
								class="sidebar-nav-mini-hide">站长后台</span></a></li>
						
                </ul>
              </li>

           
              <li class="line dk"></li>
              <li class="hidden-folded padder m-t m-b-sm text-muted text-xs">
                <span>功能</span>
              </li>
                <li>
                <a href="index.php?mod=fzjs">
                  <i class="glyphicon glyphicon-send"></i>
                  <span>分站介绍</span>
                </a>
              </li>
			  <li>
                <a href="user/reg.php">
                  <i class="glyphicon glyphicon-shopping-cart"></i>
                  <span>分站搭建</span>
                </a>
              </li>
              <li class="line dk hidden-folded"></li>

              <li class="hidden-folded padder m-t m-b-sm text-muted text-xs">          
                <span>帮助</span>
              </li>
              <li>
                <a href="//wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['qq']?$conf['qq']:$conf['kfqq']?>&site=qq&menu=yes">
                  <i class="glyphicon glyphicon-info-sign"></i>
                  <span>联系客服</span>
                </a>
              </li>
            </ul>
          </nav>
          <!-- nav -->
              <li class="line dk hidden-folded"></li>

        </div>
  
  </aside>
  <!-- / aside -->
 <!-- content --> <div id="content" class="app-content" role="main">
    <div class="app-content-body ">

<div class="bg-light lter b-b wrapper-md hidden-print">
  <h1 class="m-n font-thin h3">分站介绍</h1>
</div>
<div class="wrapper-md control">
<div class="col-lg-12 col-md-6">
                            <div class="panel panel-info" draggable="true">
                                <div class="panel-heading font-bold">加盟代理分站主站以及介绍</div>
		<div class="panel-body">
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<div class="list-group-item reed"><span class="btn btn-danger btn-xs">问</span>    什么是<?php echo $conf['sitename']?>的分站，主站？</div>
<div class="list-group-item reed"><span class="btn btn-success btn-xs">答</span>  分站就是和我们一样的网站，拥有和我们一样的大部分功能。</div>
<div class="list-group-item reed"><span class="btn btn-danger btn-xs">问</span>    如何搭建？多少钱？能使用多长时间？</div>
<div class="list-group-item reed"><span class="btn btn-success btn-xs">答</span>  付款给我们客服，一条龙搭建，目前普通分站6.66元，高级分站40元，主站100元，永久使用时间。（授权100永久使用）</div>
<div class="list-group-item reed"><span class="btn btn-danger btn-xs">问</span>    能赚钱吗？搭建后如何赚钱？</div>
<div class="list-group-item reed"><span class="btn btn-success btn-xs">答</span>  保证回本赚钱！客户访问你的分站并下单，你就有提成，你也可以直接以代理价格帮别人下单。</div>
<div class="list-group-item reed"><span class="btn btn-danger btn-xs">问</span>    赚到的钱在哪里？我如何得到？</div>
<div class="list-group-item reed"><span class="btn btn-success btn-xs">答</span>  分站后台有完整的消费信息和余额信息，您可以提现到支付宝微信或者QQ钱包。</div>
<div class="list-group-item reed"><span class="btn btn-danger btn-xs">问</span>    需要我自己供货吗？哪来货源？</div>
<div class="list-group-item reed"><span class="btn btn-success btn-xs">答</span>  所有商品全部对接主站，无需您当心货源，所有订单我们来处理。</div>
<div class="list-group-item reed"><span class="btn btn-danger btn-xs">问</span>    可以自己上架商品吗？可以修改售价吗？</div>
<div class="list-group-item reed"><span class="btn btn-success btn-xs">答</span>  亲，所有分站暂时都不支持上架商品和修改价格，接下来的更新会添加。</div>
<div class="list-group-item reed"><span class="btn btn-danger btn-xs">问</span>    这个和卡盟一样吗？有什么区别？</div>
<div class="list-group-item reed"><span class="btn btn-success btn-xs">答</span>  完全不同，利润更高，货源更精，无需注册,无需预存，在线支付，卡密下单，更直接。</div>
<div class="list-group-item reed"><span class="btn btn-danger btn-xs">问</span>   那么多代刷有分站，主站，为什么选择<?php echo $conf['sitename']?>搭建？</div>
<div class="list-group-item reed"><span class="btn btn-success btn-xs">答</span>  <?php echo $conf['sitename']?>从事网赚两年多，拥有丰富的人脉和资源，我们的货源全部精挑细选全网性价比最高的，实时掌握代刷市场的动态，加入我们，只要你坚持，你不用担心不赚钱，不用担心货源不好，更不用担心我们跑路，我们不敢保证你月入几千上万，在网上赚个零花钱绝对没问题！</div>
</div>
                            </div>
                        </div>
	</div>
  <!-- footer -->
  <footer id="footer" class="app-footer" role="footer">
        <div class="wrapper b-t bg-light">
      <span class="pull-right">Powered by <a href="/" target="_blank"><?php echo $conf['sitename']?></a></span>
    	&copy; 2018 Copyright.
    </div>
  </footer>
  <!-- / footer -->

</div>

<script src="//lib.baomitu.com/jquery/2.2.4/jquery.min.js"></script>
<script src="//lib.baomitu.com/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://template.down.swap.wang/ui/angulr_2.0.1/html/js/ui-load.js"></script>
<script src="https://template.down.swap.wang/ui/angulr_2.0.1/html/js/ui-jp.config.js"></script>
<script src="https://template.down.swap.wang/ui/angulr_2.0.1/html/js/ui-jp.js"></script>
<script src="https://template.down.swap.wang/ui/angulr_2.0.1/html/js/ui-nav.js"></script>
<script src="https://template.down.swap.wang/ui/angulr_2.0.1/html/js/ui-toggle.js"></script>
  </body>
</html>