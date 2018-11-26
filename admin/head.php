<?php
@header('Content-Type: text/html; charset=UTF-8');
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title><?php echo $title ?></title>
  <link href="//lib.baomitu.com/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
  <script src="//lib.baomitu.com/jquery/1.12.4/jquery.min.js"></script>
  <script src="//lib.baomitu.com/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <!--[if lt IE 9]>
    <script src="//lib.baomitu.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="//lib.baomitu.com/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>
<?php if($islogin==1){?>
  <nav class="navbar navbar-fixed-top navbar-default">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">导航按钮</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="./">自助下单系统管理中心</a>
      </div><!-- /.navbar-header -->
      <div id="navbar" class="collapse navbar-collapse">
        <ul class="nav navbar-nav navbar-right">
          <li class="<?php echo checkIfActive('index,')?>">
            <a href="./"><span class="glyphicon glyphicon-user"></span> 平台首页</a>
          </li>
		  <li class="<?php echo checkIfActive('list,export')?>">
            <a href="./list.php"><span class="glyphicon glyphicon-list"></span> 订单管理</a>
          </li>
		  <li class="<?php echo checkIfActive('classlist,shoplist,kmlist')?>">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon glyphicon-shopping-cart"></span> 商品管理<b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="./classlist.php">分类列表</a></li>
			  <li><a href="./shoplist.php">商品列表</a></li>
			  <li><a href="./kmlist.php">卡密列表</a></li>
            </ul>
          </li>
		  <li class="<?php echo checkIfActive('fakalist,fakakms')?>">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-th"></span> 发卡管理<b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="./fakalist.php">库存管理</a></li>
			  <li><a href="./fakakms.php?my=add">添加卡密</a></li>
			   <li><a href="./set.php?mod=mailcon">发信模板</a></li>
            </ul>
          </li>
		  <li class="<?php echo checkIfActive('sitelist,tixian,record')?>">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-globe"></span> 分站管理<b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="./sitelist.php">分站列表</a></li>
			  <li><a href="./record.php">收支明细</a></li>
			  <li><a href="./set.php?mod=fenzhan">分站设置</a></li>
			  <?php if($conf['fenzhan_tixian']==1){?><li><a href="./tixian.php">余额提现</a><li><?php }?>
            </ul>
          </li>
		  <li class="<?php echo checkIfActive('set,shequlist')?>">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-cog"></span> 系统设置<b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="./set.php?mod=site">网站信息配置</a></li>
			  <li><a href="./set.php?mod=gonggao">网站公告配置</a></li>
			  <li><a href="./shequlist.php">社区/卡盟对接配置</a><li>
			  <li><a href="./set.php?mod=mail">发信邮箱配置</a><li>
			  <li><a href="./set.php?mod=pay">支付接口配置</a><li>
			  <li><a href="./set.php?mod=template">首页模板设置</a><li>
			  <li><a href="./set.php?mod=upimg">网站Logo上传</a><li>
			  <li><a href="./clean.php">系统数据清理</a><li>
			  <li><a href="./update.php">检查版本更新</a><li>
            </ul>
          </li>
          <li><a href="./login.php?logout"><span class="glyphicon glyphicon-log-out"></span> 退出登陆</a></li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container -->
  </nav><!-- /.navbar -->
<?php }?>