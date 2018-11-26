<?php
if(!defined('IN_CRONLITE'))exit();
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no"/>
  <title><?php echo $conf['sitename']?> - <?php echo $conf['title']?></title>
  <meta name="keywords" content="<?php echo $conf['keywords']?>">
  <meta name="description" content="<?php echo $conf['description']?>">
  <link href="//lib.baomitu.com/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="//lib.baomitu.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="<?php echo $cdnserver?>assets/appui/css/main.css">
  <link rel="stylesheet" href="<?php echo $cdnserver?>assets/appui/css/themes.css">
  <link rel="stylesheet" href="//lib.baomitu.com/modernizr/2.8.3/modernizr.min.js">
  <!--[if lt IE 9]>
    <script src="//lib.baomitu.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="//lib.baomitu.com/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
<style>
img.logo{width:14px;height:14px;margin:0 5px 0 3px;}
.onclick{cursor: pointer;touch-action: manipulation;}
.giftlist{overflow:hidden;width:90%;margin:0 auto}
.giftlist ul{height:270px;overflow:hidden;padding:0}
.giftlist li{width:100%;line-height:35px;padding:0 10px;overflow:hidden;box-sizing:border-box;-webkit-box-sizing:border-box;-moz-box-sizing:border-box}
.giftlist li strong{margin:0 5px 0 0;font-weight:400;color:#1977d8}
</style>
</head>
<body>
	<!--隐藏<div id="page-wrapper" class="page-loading">
            <div class="preloader">
                <div class="inner">
                    <div class="preloader-spinner themed-background hidden-lt-ie10"></div>
                    <h3 class="text-primary visible-lt-ie10"><strong>Loading..</strong></h3>
                </div>
            </div>加载-->
<div class="modal fade" align="left" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $conf['sitename']?></h4>
      </div>
      <div class="modal-body">
	  <?php echo $conf['modal']?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">知道啦</button>
      </div>
    </div>
  </div>
</div>


	<div id="page-container" class="header-fixed-top sidebar-visible-lg-full">
		<div id="sidebar">
			<div id="sidebar-brand" class="themed-background">
				<a href="index.php" class="sidebar-title"> <i class="fa fa-qq"></i>
					<span class="sidebar-nav-mini-hide"><?php echo $conf['sitename']?></span>
				</a>
			</div>
			<div id="sidebar-scroll">
				<div class="sidebar-content">
					<ul class="sidebar-nav">
						<li><a href="/" class=" active"><i class="fa fa-home sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">网站首页</span></a></li>
						<li><a href="./user/reg.php"><i class="fa fa-star sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">开通分站</span></a></li>
						<li><a href="./user/"><i class="fa fa-lock sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">后台登入</span></a></li>
						<li><a target="_blank" href="./index.php?mod=tools"><i class="fa fa-cogs sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">实用工具</span></a></li>
						<li><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&amp;uin=<?php echo $conf['kfqq']?>&amp;site=qq&amp;menu=yes"><i class="fa fa-qq sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">客服QQ</span></a></li>		
					</ul>
				</div>
			</div>
			<div id="sidebar-extra-info"
				class="sidebar-content sidebar-nav-mini-hide">
				<div class="text-center">
					<small>2017 <i class="fa fa-heart text-danger"></i> <a href="./"> <?php echo $conf['sitename']?></a></small><br>
					
				</div>
			</div>
		</div>
		<div id="main-container">
			<header class="navbar navbar-inverse navbar-fixed-top">
				<ul class="nav navbar-nav-custom">
					<li><a href="javascript:void(0)"
						onclick="App.sidebar('toggle-sidebar');this.blur();"> <i
							class="fa fa-ellipsis-v fa-fw animation-fadeInRight"
							id="sidebar-toggle-mini"></i> <i
							class="fa fa-bars fa-fw animation-fadeInRight"
							id="sidebar-toggle-full"></i> 菜单
					</a></li>
				</ul>
				<ul class="nav navbar-nav-custom pull-right">
					<li class="dropdown"><a href="./" class="dropdown-toggle">
							<img
							src="//q4.qlogo.cn/headimg_dl?dst_uin=<?php echo $conf['kfqq']?>&spec=100"
							alt="avatar">
					</a></li>
				</ul>
			</header>

			<div id="page-content">
				<div class="row">
					<div class="col-sm-6">
						<div class="block">
							<div class="block-title">
								<h4>
									<i class="fa fa-bullhorn"></i>&nbsp;站点公告
								</h4>
							</div>
							<?php echo $conf['anounce']?>
						</div>
					</div>

					<div class="col-sm-6">
						<div class="block">
							<div class="block-title">
								<ul class="nav nav-tabs">
									<li class="active"><a href="#onlinebuy" data-toggle="tab"><i class="fa fa-check-square-o"></i>&nbsp;在线下单</a></li>
									<li <?php if($conf['iskami']==0){?>class="hide"<?php }?>><a href="#cardbuy" data-toggle="tab"><i class="fa fa-money"></i>&nbsp;卡密下单</a></li>
									<li><a href="#query" data-toggle="tab" id="tab-query"><i class="fa fa-search"></i>&nbsp;查询订单</a></li>
									<li <?php if(empty($conf['lqqapi'])){?>class="hide"<?php }?>><a href="#lqq" data-toggle="tab"><i class="fa fa-dot-circle-o"></i>&nbsp;圈圈赞</a></li>
									<li <?php if($conf['gift_open']==0){?>class="hide"<?php }?>><a href="#gift" data-toggle="tab"><i class="fa fa-gift"></i> 抽奖</a></li>
									<li <?php if(empty($conf['chatframe'])){?>class="hide"<?php }?>><a href="#chat" data-toggle="tab"><i class="fa fa-comments"></i>&nbsp;聊天</a></li>
								</ul>
							</div>
		<div id="myTabContent" class="tab-content">
		<div class="tab-pane fade in active" id="onlinebuy">
			<?php echo $conf['alert']?>
			<div class="form-group" id="display_selectclass"<?php if($classhide){?> style="display:none;"<?php }?>>
				<div class="input-group"><div class="input-group-addon">选择分类</div>
				<select name="tid" id="cid" class="form-control"><?php echo $select?></select>
				<div class="input-group-addon"><span class="glyphicon glyphicon-search onclick" title="搜索商品" id="showSearchBar"></span></div>
			</div></div>
			<div class="form-group" id="display_searchBar" style="display:none;">
				<div class="input-group"><div class="input-group-addon"><span class="glyphicon glyphicon-remove onclick" title="关闭" id="closeSearchBar"></span></div>
				<input type="text" id="searchkw" class="form-control" placeholder="搜索商品" onkeydown="if(event.keyCode==13){$('#doSearch').click()}"/>
				<div class="input-group-addon"><span class="glyphicon glyphicon-search onclick" title="搜索" id="doSearch"></span></div>
			</div></div>
			<div class="form-group">
				<div class="input-group"><div class="input-group-addon">选择商品</div>
				<select name="tid" id="tid" class="form-control" onchange="getPoint();"><?php echo $select2?></select>
			</div></div>
			<div class="form-group">
				<div class="input-group"><div class="input-group-addon">商品价格</div>
				<input type="text" name="need" id="need" class="form-control" disabled/>
			</div></div>
			<div class="form-group" id="display_left" style="display:none;">
				<div class="input-group"><div class="input-group-addon">库存数量</div>
				<input type="text" name="leftcount" id="leftcount" class="form-control" disabled/>
			</div></div>
			<div class="form-group" id="display_num" style="display:none;">
                <div class="input-group">
                <div class="input-group-addon">下单份数</div>
                <span class="input-group-btn"><input id="num_min" type="button" class="btn btn-info" style="border-radius: 0px;" value="━"></span>
				<input id="num" name="num" class="form-control" type="number" min="1" value="1"/>
				<span class="input-group-btn"><input id="num_add" type="button" class="btn btn-info" style="border-radius: 0px;" value="✚"></span>
			</div></div>
			<div class="form-group">
				<div class="input-group"><div class="input-group-addon" id="inputname">下单ＱＱ</div>
				<input type="text" name="inputvalue" id="inputvalue" value="<?php echo $qq?>" class="form-control" required/>
			</div></div>
			<div id="inputsname"></div>
			<div id="alert_frame" class="alert alert-warning" style="display:none;"></div>
			<div id="pay_frame" class="form-group text-center" style="display:none;">
			<div class="form-group">
				<div class="input-group">
				<div class="input-group-addon">订单号</div>
				<input class="form-control" name="orderid" id="orderid" value="" disabled>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
				<div class="input-group-addon">共需支付</div>
				<input class="form-control" name="needs" id="needs" value="" disabled>
				</div>
			</div>
			<div class="alert alert-success">订单保存成功，请点击以下链接支付！</div>
<?php
if($conf['alipay_api'])echo '<button type="submit" class="btn btn-default" id="buy_alipay"><img src="assets/icon/alipay.ico" class="logo">支付宝</button>&nbsp;';
if($conf['qqpay_api'])echo '<button type="submit" class="btn btn-default" id="buy_qqpay"><img src="assets/icon/qqpay.ico" class="logo">QQ钱包</button>&nbsp;';
if($conf['wxpay_api'])echo '<button type="submit" class="btn btn-default" id="buy_wxpay"><img src="assets/icon/wechat.ico" class="logo">微信支付</button>&nbsp;';
if($conf['tenpay_api'])echo '<button type="submit" class="btn btn-default" id="buy_tenpay"><img src="assets/icon/tenpay.ico" class="logo">财付通</button>&nbsp;';
?>
			</div>
			<input type="submit" id="submit_buy" class="btn btn-primary btn-block" value="立即购买"><br />
		</div>
		<div class="tab-pane fade in" id="cardbuy">
			<?php if(!empty($conf['kaurl'])){?>
			<div class="form-group">
				<a href="<?php echo $conf['kaurl']?>" class="btn btn-default btn-block" target="_blank"/>点击进入购买卡密</a>
			</div>
			<?php }?>
			<div class="form-group">
				<div class="input-group"><div class="input-group-addon">输入卡密</div>
				<input type="text" name="km" id="km" value="" class="form-control" onkeydown="if(event.keyCode==13){submit_checkkm.click()}" required/>
			</div></div>
			<input type="submit" id="submit_checkkm" class="btn btn-primary btn-block" value="检查卡密"><br />
			<div id="km_show_frame" style="display:none;">
			<div class="form-group">
				<div class="input-group"><div class="input-group-addon">商品名称</div>
				<input type="text" name="name" id="km_name" value="" class="form-control" disabled/>
			</div></div>
			<div class="form-group">
				<div class="input-group"><div class="input-group-addon" id="km_inputname">下单ＱＱ</div>
				<input type="text" name="inputvalue" id="km_inputvalue" value="<?php echo $qq?>" class="form-control" required/>
			</div></div>
			<div id="km_inputsname"></div>
			<div id="km_alert_frame" class="alert alert-warning" style="display:none;"></div>
			<input type="submit" id="submit_card" class="btn btn-primary btn-block" value="立即购买"><br />
			<div id="result1" class="form-group text-center" style="display:none;">
			</div>
			</div>
		</div>
		<div class="tab-pane fade in" id="query">
			<div class="alert alert-info" <?php if(empty($conf['gg_search'])){?>style="display:none;"<?php }?>><?php echo $conf['gg_search']?></div>
			<div class="form-group">
				<div class="input-group"><div class="input-group-addon">查询内容</div>
				<input type="text" name="qq" id="qq3" value="<?php echo $qq?>" class="form-control" placeholder="请输入下单账号（留空则根据浏览器缓存查询）" onkeydown="if(event.keyCode==13){submit_query.click()}" required/>
			</div></div>
			<input type="submit" id="submit_query" class="btn btn-primary btn-block" value="立即查询"><br />
			<div id="result2" class="form-group" style="display:none;">
				<table class="table table-striped">
				<thead><tr><th>下单账号</th><th>商品名称</th><th>数量</th><th class="hidden-xs">购买时间</th><th>状态</th><th>操作</th></tr></thead>
				<tbody id="list">
				</tbody>
				</table>
			</div>
		</div>
		<div class="tab-pane fade in" id="lqq">
			<div class="form-group">
				<div class="input-group"><div class="input-group-addon">请输入QQ</div>
				<input type="text" name="qq" id="qq4" value="" class="form-control" required/>
			</div></div>
			<input type="submit" id="submit_lqq" class="btn btn-primary btn-block" value="立即提交"><br />
			<div id="result3" class="form-group text-center" style="display:none;"></div>
		</div>
		<div class="tab-pane fade in" id="gift">
			<div class="panel-body text-center">
			<div id="roll">点击下方按钮开始抽奖</div>
			<hr>
			<p>
			<a class="btn btn-info" id="start" style="display:block;">开始抽奖</a>
			<a class="btn btn-danger" id="stop" style="display:none;">停止</a>
			</p> 
			<div id="result"></div><br/>
			<div class="giftlist" style="display:none;"><strong>最近中奖记录</strong><ul id="pst_1"></ul></div>
			</div>
		</div>
		<div class="tab-pane fade in" id="chat">
			<?php echo $conf['chatframe']?>
		</div>
		</div>
	</div>
</div>
</div>

				<div class="row" <?php if($conf['hide_tongji']==1){?>style="display:none;"<?php }?>>
					<div class="col-sm-6 col-lg-3">
						<a href="javascript:void(0)" class="widget">
							<div
								class="widget-content widget-content-mini text-right clearfix">
								<div class="widget-icon pull-left themed-background">
									<i class="fa fa-calendar text-light-op"></i>
								</div>
								<h2 class="widget-heading h3">
									<strong><span data-toggle="counter" data-to="" id="count_yxts"></span>天</strong>
								</h2>
								<span class="text-muted">平台运营</span>
							</div>
						</a>
					</div>

					<div class="col-sm-6 col-lg-2">
						<a href="javascript:void(0)" class="widget">
							<div
								class="widget-content widget-content-mini text-right clearfix">
								<div class="widget-icon pull-left themed-background-success">
									<i class="fa fa-cart-plus text-light-op"></i>
								</div>
								<h2 class="widget-heading h3 text-success">
									<strong><span data-toggle="counter" id="count_orders"></span>条</strong>
								</h2>
								<span class="text-muted">订单总数</span>
							</div>
						</a>
					</div>
					
					<div class="col-sm-6 col-lg-2">
						<a href="javascript:void(0)" class="widget">
							<div
								class="widget-content widget-content-mini text-right clearfix">
								<div class="widget-icon pull-left themed-background-success">
									<i class="fa fa-cart-plus text-light-op"></i>
								</div>
								<h2 class="widget-heading h3 text-success">
									<strong><span data-toggle="counter" id="count_orders1">3</span>条</strong>
								</h2>
								<span class="text-muted">处理订单</span>
							</div>
						</a>
					</div>

					<div class="col-sm-6 col-lg-2">
						<a href="javascript:void(0)" class="widget">
							<div
								class="widget-content widget-content-mini text-right clearfix">
								<div class="widget-icon pull-left themed-background-warning">
									<i class="fa fa-money text-light-op"></i>
								</div>
								<h2 class="widget-heading h3 text-warning">
									<strong><span data-toggle="counter" id="count_money1"></span>元</strong>
								</h2>
								<span class="text-muted">今日交易</span>
							</div>
						</a>
					</div>

					<div class="col-sm-6 col-lg-3">
						<a href="javascript:void(0)" class="widget">
							<div
								class="widget-content widget-content-mini text-right clearfix">
								<div class="widget-icon pull-left themed-background-danger">
									<i class="fa fa-clock-o text-light-op"></i>
								</div>
								<h2 class="widget-heading h3 text-danger">
									<strong><span><label id="timeShow"></lable></span></strong>
								</h2>
								<span class="text-muted">当前时间</span>
							</div>
						</a>
					</div>
				</div>

				<div class="block full">
					<div class="block-title">
						<h2>
							<i class="fa fa-chain"></i>&nbsp;友情链接
						</h2>
					</div>
					<div class="row headings-container">
					<?php echo $conf['bottom']?>
					</div>
				</div>
			</div>
		</div>
	</div>

<script src="//lib.baomitu.com/jquery/1.12.4/jquery.min.js"></script>
<script src="//lib.baomitu.com/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="//lib.baomitu.com/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script src="//lib.baomitu.com/layer/2.3/layer.js"></script>
<script src="<?php echo $cdnserver?>assets/appui/js/plugins.js"></script>
<script src="<?php echo $cdnserver?>assets/appui/js/app.js"></script>
<!-- DT Time -->
<script language="javascript">
	var t = null;
	t = setTimeout(time,1000);
	function time()
	{
	   clearTimeout(t);
	   dt = new Date();
	   var h=dt.getHours();
	   var m=dt.getMinutes();
	   var s=dt.getSeconds();
	   document.getElementById("timeShow").innerHTML = h+":"+m+":"+s;
	   t = setTimeout(time,1000);             
	} 
</script>

<script type="text/javascript">
var isModal=<?php echo empty($conf['modal'])?'false':'true';?>;
var homepage=true;
var hashsalt=<?php echo $addsalt_js?>;
</script>
<script src="assets/js/main.js?ver=<?php echo VERSION ?>"></script>
</body>
</html>