<?php
if(!defined('IN_CRONLITE'))exit();
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no"/>
  <title>查询订单 - <?php echo $conf['sitename']?></title>
  <meta name="keywords" content="<?php echo $conf['keywords']?>">
  <meta name="description" content="<?php echo $conf['description']?>">
  <link href="//lib.baomitu.com/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="//lib.baomitu.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
  <!--[if lt IE 9]>
    <script src="//lib.baomitu.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="//lib.baomitu.com/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
<style>
body{
background:#ecedf0 url("<?php echo $background_image?>") fixed;
<?php echo $repeat?>}
</style>
</head>
<body>

<div class="navbar navbar-default navbar-fixed-top affix" role="navigation">
  <div class="container">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
      <span class="sr-only"><?php echo $conf['sitename']?></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="./"><?php echo $conf['sitename']?></a>
	<p class="navbar-text pull-left text-muted hidden-xs hidden-sm"><small class="text-muted text-sm"><em><?php echo $_SERVER['HTTP_HOST']?></em></small></p>
  </div>
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
	  <li class=""><a href="./"><span class="glyphicon glyphicon-home"></span>&nbsp;下单首页</a></li>
	  <li class="active"><a href="./?mod=query"><span class="glyphicon glyphicon-search"></span>&nbsp;查询订单</a></li>
	  <?php if($conf['fenzhan_buy']==1){?><li class=""><a href="./user/"><span class="glyphicon glyphicon-cog"></span>&nbsp;分站后台</a></li>
	  </ul><?php }?>
	  </ul>
  </div>
  </div>
</div>
  
<div class="container" style="margin-top: 60px">
 
<div class="row">
	<div class="col-md-6">
 


<div class="panel panel-primary">
    <div class="panel-heading" align="center">
        <h3 class="panel-title">订单售后</h3>
    </div>	
<div class="panel-body">
<div class="alert alert-success">
平台所有业务只受理购买时间起3个月内的订单，如有问题，请尽快投诉处理，超3个月订单，平台无法处理仲裁，代理自行承担！！！
</div>

<a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['kfqq']?>&site=qq&menu=yes" target="_blank" class="media" style="text-decoration:none">
    <div class="media-left">
        <img class="media-object img-circle img-thumbnail img-thumbnail-avatar" src="//q4.qlogo.cn/headimg_dl?dst_uin=<?php echo $conf['kfqq']?>&amp;spec=100" alt="QQ" style="width:60px;margin:1px">
    </div>
    <div class="media-body" style="padding-top:13px">
        <h5 class="media-heading">本站站长QQ：<span class="text-danger"><?php echo $conf['kfqq']?></span></h5>
        <font color="#808080">有问题点击头像.可直接联系站长</font>
    </div>
</a>


</div>
</div>

       </div> 
 
       <div class="col-md-6">
 
<div class="panel panel-primary">
    <div class="panel-heading" align="center">
        <h3 class="panel-title">订单查询</h3>
    </div>	
		<div class="panel-body">

			<div class="alert alert-info" <?php if(empty($conf['gg_search'])){?>style="display:none;"<?php }?>><?php echo $conf['gg_search']?></div>
			<div class="form-group">
				<div class="input-group"><div class="input-group-addon">查询内容</div>
				<input type="text" name="qq" id="qq3" value="" class="form-control" placeholder="请输入下单账号（留空则根据浏览器缓存查询）" onkeydown="if(event.keyCode==13){submit_query.click()}" required/>
			</div></div>
			<input type="submit" id="submit_query" class="btn btn-primary btn-block" value="立即查询">
			<div id="result2" class="form-group" style="display:none;"></br>
			<table class="table table-striped">
				<thead><tr><th>下单账号</th><th>商品名称</th><th>数量</th><th class="hidden-xs">购买时间</th><th>状态</th><th>操作</th></tr></thead>
				<tbody id="list">
				</tbody>
			</table>
			</div>



		</div>
	</div>
</div>


<p style="text-align:center"><span style="font-weight:bold">CopyRight <i class="fa fa-heart text-danger"></i> 2018 <a href="/"><?php echo $conf['sitename']?></a></span></p>

<script src="//lib.baomitu.com/jquery/1.12.4/jquery.min.js"></script>
<script src="//lib.baomitu.com/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="//lib.baomitu.com/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script src="//lib.baomitu.com/layer/2.3/layer.js"></script>

<script type="text/javascript">
var isModal=false;
var homepage=false;
var hashsalt=<?php echo $addsalt_js?>;
</script>
<script src="assets/js/main.js?ver=<?php echo VERSION ?>"></script>
</body>
</html>