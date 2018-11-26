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
  <link href="<?php echo $cdnserver?>assets/css/nifty.min.css" rel="stylesheet">
  <link href="<?php echo $cdnserver?>assets/css/magic-check.min.css" rel="stylesheet">
  <link href="<?php echo $cdnserver?>assets/css/pace.min.css" rel="stylesheet">
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

	<div id="container" class="effect aside-float aside-bright mainnav-lg">
        <header id="navbar">
            <div id="navbar-container" class="boxed">
                <div class="navbar-header">
                    <a href="./" class="navbar-brand">
                        <img src="<?php echo $logo?>" alt="<?php echo $conf['sitename']?>" class="brand-icon">
                        <div class="brand-title">
                            <span class="brand-text"><?php echo $conf['sitename']?></span>
                        </div>
                    </a>
                </div>

                <div class="navbar-content clearfix">
                    <ul class="nav navbar-top-links pull-left">
                        <li class="tgl-menu-btn">
                            <a class="mainnav-toggle" href="#">
                                <i class="fa fa-th-list"></i>
                            </a>
                        </li>
						<li class="dropdown" >
                            <a data-toggle="modal" href="#kaurl" class="dropdown-toggle">
                                <i class="fa fa-credit-card"></i>
                            </a>
                        </li>
						<li class="dropdown">
                            <a data-toggle="modal" href="#cxdd" class="dropdown-toggle">
                                <i class="fa fa-search"></i>
                            </a>
                        </li>
                    </ul>
					
                    <ul class="nav navbar-top-links pull-right">
                        <li class="dropdown" >
                            <a data-toggle="modal" href="#lqq" class="dropdown-toggle">
                                <i class="fa fa-circle-o-notch"></i>
                            </a>
                        </li>
                        <li class="dropdown" class="active-link" style="display:none;">
                            <a data-toggle="modal" href="#ltjl" class="dropdown-toggle">
                                <i class="fa fa-coffee"></i>
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['kfqq']?>&site=qq&menu=yes">
                                <i class="fa fa-qq"></i>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </header>

        <div class="boxed">
            <div id="content-container">
                <div id="page-content">
					<div class="row">
		
                      <div class="row" <?php if($conf['hide_tongji']==1){?>style="display:none;"<?php }?>>
                      <div class="col-xs-6">
						  <div class="panel media middle">
					                    <div class="media-left bg-primary pad-all">
					                        <span class="fa fa-shopping-cart fa-3x"></span>
					                    </div>
					                    <div class="media-body pad-lft">
					                        <p class="text-2x mar-no"><span id="count_orders_all"></span></p>
					                        <p class="text-muted mar-no">订单总数</p>
					                    </div>
					      </div>
                          </div>
                          <div class="col-xs-6">
						  <div class="panel media middle">
					                    <div class="media-left bg-primary pad-all">
					                        <i class="fa fa-check-square-o fa-3x"></i>
					                    </div>
					                    <div class="media-body pad-lft">
					                        <p class="text-2x mar-no"><span id="count_orders_today"></span></p>
					                        <p class="text-muted mar-no">今天订单</p>
					                    </div>
					      </div>
                          </div>
                      </div> 



<div class="panel panel-success">
	<div class="panel-heading"><h3 class="panel-title"><font color="#fff"><i class="fa fa-volume-up"></i>&nbsp;&nbsp;<b>站点公告</b></font></h3></div>
	<div>
<?php echo $conf['anounce']?>
	</div>
</div>

<div class="tab-content">
	<div id="demo-tabs-box-1" class="tab-pane fade active in">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title"><font color="#fff"><i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;<b>自助下单</b></font><span class="pull-right"><a data-toggle="tab" href="#demo-tabs-box-2" aria-expanded="true" class="btn btn-warning btn-rounded"><i class="fa fa-warning"></i> 注意</a></span></h3>
			</div>
	<div class="panel-body">
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
			<div id="alert_frame" class="alert alert-warning" style="display:none;font-weight: bold;"></div>
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
			<input type="submit" id="submit_buy" class="btn btn-primary btn-block" value="立即购买">
		</div>
	</div>
</div>
</div>
	<div id="demo-tabs-box-2" class="tab-pane fade">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title"><font color="#fff"><i
						class="fa fa-warning"></i>&nbsp;&nbsp;<b>注意事项</b></font><span class="pull-right"><a
						data-toggle="tab" href="#demo-tabs-box-1" aria-expanded="false"
						class="btn btn-warning btn-rounded"><i class="fa fa-shopping-cart"></i> 下单</a>
				</span></h3>
			</div>
			<div class="panel-body">
				<!--注意事项-->
				<div id="demo-acc-faq" class="panel-group accordion"><div class="panel panel-trans pad-top"><a href="#demo-acc-faq1" class="text-semibold text-lg text-main" data-toggle="collapse" data-parent="#demo-acc-faq">为什么下单很久了都没有开始刷呢？</a><div id="demo-acc-faq1" class="mar-ver collapse in">由于本站采用全自动订单处理，难免会出现漏单，部分单子处理时间可能会稍长一点，不过都会完成，最终解释权归本站所有。超过24小时没处理请联系客服！</div></div><div class="panel panel-trans pad-top"><a href="#demo-acc-faq2" class="text-semibold text-lg text-main" data-toggle="collapse" data-parent="#demo-acc-faq">空间人气下单方法讲解</a><div id="demo-acc-faq2" class="mar-ver collapse">1.下单前：空间必须是所有人可访问,必须自带1~4条原创说说!<br>2.代刷期间，禁止关闭访问权限，或者删除说说，删除说说的一律由自行负责，不给予补偿。</div></div><div class="panel panel-trans pad-top"><a href="#demo-acc-faq3" class="text-semibold text-lg text-main" data-toggle="collapse" data-parent="#demo-acc-faq">说说赞相关下单方法讲解</a><div id="demo-acc-faq3" class="mar-ver collapse">1.下单前：空间必须是所有人可访问,必须自带1条原创说说!转发的说说不能刷！<br>2.在“QQ号码”栏目输入QQ号码，点击下面的获取说说ID并选择你需要刷的说说的ID，下单即可。<br>3.代刷期间，禁止关闭访问权限，或者删除说说，删除说说的一律由自行负责，不给予补偿。</div></div><div class="panel panel-trans pad-top"><a href="#demo-acc-faq4" class="text-semibold text-lg text-main" data-toggle="collapse" data-parent="#demo-acc-faq">全民Ｋ歌下单方法讲解</a><div id="demo-acc-faq4" class="mar-ver collapse">1.打开你的全名k歌<br>2.复制你全名k歌里面的需要刷的歌曲链接<br>3.例如：你歌曲链接是：<font color="#ff0000">https://kg.qq.com/node/play?s= <font color="green">881Zbk8aCfIwA8U3</font> &g_f=personal</font><br>4.然后把s=后面的 <font color="green">881Zbk8aCfIwA8U3</font> 链接填入到歌曲ID里面，然后提交购买。</div></div><div class="panel panel-trans pad-top"><a href="#demo-acc-faq5" class="text-semibold text-lg text-main" data-toggle="collapse" data-parent="#demo-acc-faq">快手代刷下单方法讲解</a><div id="demo-acc-faq5" class="mar-ver collapse">1.需要填写用户ID和作品ID，比如<font color="#ff0000">http://www.kuaishou.com/i/photo/lwx?userId= <font color="green">294200023</font> &photoId= <font color="green">1071823418</font></font> (分享作品就可以看到“复制链接”了)<br>2.用户ID就是 <font color="green">294200023</font> 作品ID就是 <font color="green">1071823418</font> ，然后在分别把用户ID和作品ID填上，请勿把两个选项填反了，不给予补单！</div></div><div class="panel panel-trans pad-top"><a href="#demo-acc-faq6" class="text-semibold text-lg text-main" data-toggle="collapse" data-parent="#demo-acc-faq">Q会员/钻下单方法讲解</a><div id="demo-acc-faq6" class="mar-ver collapse">1.下单之前，先确认输的信息是不是正确的，如果密码输错，那就刷不了了，没到账之前不要改密码<br>2.Q会员/钻因为需要人工处理，所以每天不定时开刷，24小时-48小时内到账！</div></div></div>                </div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-6">
	<div class="panel panel-success panel-colorful">
			<div class="pad-all media">
				<div class="media-left">
					<i class="demo-pli-coin icon-3x icon-fw"></i>
				</div>
				<div class="media-body">
					<p class="h3 text-light mar-no media-heading"><span id="count_money"></span>元</p>
					<span>累计交易金额</span>
				</div>
			</div>
			<div class="progress progress-xs progress-success mar-no">
				<div class="progress-bar progress-bar-light" style="width: 100%"></div>
			</div>
			<div class="pad-all text-sm">
				今天交易金额 <span class="text-semibold" id="count_money1"></span> 元
			</div>
		</div>
	</div>
	<div class="col-lg-6">
	<div class="panel panel-info panel-colorful">
			<div class="pad-all media">
				<div class="media-left">
					<i class="demo-pli-add-cart icon-3x icon-fw"></i>
				</div>
				<div class="media-body">
					<p class="h3 text-light mar-no media-heading"><span id="count_orders"></span>条</p>
					<span>累计订单总数</span>
				</div>
			</div>
			<div class="progress progress-xs progress-dark-base mar-no">
				<div class="progress-bar progress-bar-light" style="width: 100%"></div>
			</div>
			<div class="pad-all text-sm bg-trans-dark">
				今天订单总数 <span class="text-semibold" id="count_orders2"></span> 条
			</div>
		</div>
	</div>
</div>

<div class="panel panel-primary" <?php if($conf['bottom']==''){?>style="display:none;"<?php }?>>
<div class="panel-heading"><h3 class="panel-title"><font color="#fff"><i class="fa fa-skyatlas"></i>&nbsp;&nbsp;<b>站点助手</b></font></h3></div>
<?php echo $conf['bottom']?>
</div>
</div>
</div>
</div>

			<nav id="mainnav-container">
                <div id="mainnav">
                    <div id="mainnav-menu-wrap">
                        <div class="nano">
                            <div class="nano-content">
                                <div id="mainnav-profile" class="mainnav-profile">
                                    <div class="profile-wrap">
                                        <div class="pad-btm">
                                            <a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['kfqq']?>&site=qq&menu=yes" class="label label-success pull-right">点击联系</a>
                                            <img class="img-circle img-sm img-border" src="http://q2.qlogo.cn/headimg_dl?bs=qq&dst_uin=<?php echo $conf['kfqq']?>&src_uin=<?php echo $conf['kfqq']?>&fid=<?php echo $conf['kfqq']?>&spec=100&url_enc=0&referer=bu_interface&term_type=PC" alt="Profile Picture">
                                        </div>
                                            <p class="mnp-name">客服QQ：<?php echo $conf['kfqq']?></p>
                                    </div>
                                </div>

                                <ul id="mainnav-menu" class="list-group">
						            <li class="list-header"><?php echo $_SERVER['HTTP_HOST']?></li>
						            <li class="active-link">
						                <a href="./">
						                    <i class="fa fa-th-large"></i>
						                    <span class="menu-title">
												<strong>网站首页</strong>
											</span>
						                </a>
						            </li>
						            <li >
						                <a data-toggle="modal" href="#kaurl">
						                    <i class="fa fa-credit-card"></i>
						                    <span class="menu-title">
												<strong>卡密下单</strong>
											</span>
						                </a>
						            </li>
									     <li>
						                <a data-toggle="modal" href="#cxdd">
						                    <i class="fa fa-search"></i>&nbsp;
						                    <span class="menu-title"> 
												<strong>查询订单</strong>
											</span>
						                </a>
						            </li>
									<li >
						                <a data-toggle="modal" href="#gift">
						                    <i class="fa fa-gift"></i>&nbsp;
						                    <span class="menu-title">
												<strong>幸运抽奖</strong>
											</span>
						                </a>
						            </li>
						            <li >
						                <a data-toggle="modal" href="#lqq">
						                    <i class="fa fa-circle-o-notch"></i>&nbsp;
						                    <span class="menu-title">
												<strong>拉圈圈赞</strong>
											</span>
						                </a>
						            </li>
									<li <?php if(empty($conf['chatframe'])){?>style="display:none;"<?php }?>>
						                <a  data-toggle="modal" href="#ltjl">
						                    <i class="fa fa-coffee"></i>&nbsp;
						                    <span class="menu-title">
												<strong>聊天交流</strong>
											</span>
						                </a>
						            </li>
								       <li >
						                <a data-toggle="modal" href="./user/reg.php">
						                    <i class="fa fa-diamond"></i>&nbsp;
						                    <span class="diamond">
												<strong>搭建分站</strong>
											</span>
						                </a>
						            </li>
									     <li>
						                <a data-toggle="modal" href="./user">
						                    <i class="fa fa-expeditedssl"></i>&nbsp;
						                    <span class="menu-title">
												<strong>后台登陆</strong>
											</span>
						                </a>
						            </li>
									     <li>																		
	  				                <a href="index.php?mod=gywm">
						                    <i class="fa fa fa-heart-o"></i>&nbsp;
						                    <span class="menu-title">
												<strong>关于我们</strong>
											</span>
						                </a>
						            </li>
									      <li>								
						                <a data-toggle="modal" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['kfqq']?>&site=qq&menu=yes">
						                    <i class="fa fa-user-o"></i>&nbsp;
						                    <span class="menu-title">
												<strong>联系客服</strong>
											</span>
						                </a>
						            </li>


                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>

	<div class="modal fade" id="kaurl" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                     <h4 class="modal-title"><i class="fa fa-credit-card"></i> 卡密下单</h4>
                </div>
                <div class="modal-body">
			<div class="form-group">
				<div class="btn-group btn-group-justified">
				<a class="btn btn-primary" href="<?php echo $conf['kaurl']?>" target="_blank"/><span class="fa fa-cart-plus fa-3x"></span></br><b>在线购买卡密</b></a>				<a class="btn btn-info" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['kfqq']?>&site=qq&menu=yes"><span class="fa fa-qq fa-3x"></span></br><b>联系客服购买</b></a>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group"><div class="input-group-addon">输入卡密</div>
				<input type="text" name="km" id="km" value="" class="form-control" onkeydown="if(event.keyCode==13){submit_checkkm.click()}" required/>
			</div></div>
			<input type="submit" id="submit_checkkm" class="btn btn-primary btn-block" value="检查卡密">
			<div id="km_show_frame" style="display:none;">
			<div class="form-group">
				<div class="input-group"><div class="input-group-addon" id="inputname">商品名称</div>
				<input type="text" name="name" id="km_name" value="" class="form-control" disabled/>
			</div></div>
			<div class="form-group">
				<div class="input-group"><div class="input-group-addon" id="inputname">下单帐号</div>
				<input type="text" name="inputvalue" id="km_inputvalue" value="" class="form-control" required/>
			</div></div>
			<div id="km_inputsname"></div>
			<div id="km_alert_frame" class="alert alert-warning" style="display:none;font-weight: bold;"></div>
			<input type="submit" id="submit_card" class="btn btn-primary btn-block" value="立即购买">
			<div id="result1" class="form-group text-center" style="display:none;">
			</div>
		</div>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">关闭</button>
                </div>
            </div>
        </div>
      </div>
	
	<div class="modal fade" id="cxdd" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                     <h4 class="modal-title"><i class="fa fa-search"></i> 查询订单</h4>
                </div>
                <div class="modal-body">
			<div class="alert alert-info" <?php if(empty($conf['gg_search'])){?>style="display:none;"<?php }?>><?php echo $conf['gg_search']?></div>
			<div class="form-group">
				<label for="password"><font color="#808080"><b>查询内容</b></font></label>
				<input type="text" name="qq" id="qq3" value="" class="form-control" placeholder="输入下单的帐号（留空根据浏览器缓存显示）" onkeydown="if(event.keyCode==13){submit_query.click()}" required/>
			</div>
			<input type="submit" id="submit_query" class="btn btn-primary btn-block" value="立即查询">
			<div id="result2" class="form-group text-center" style="display:none;">
				<table class="table table-striped">
				<thead><tr><th>账号</th><th>商品名称</th><th>数量</th><th class="hidden-xs">购买时间</th><th>状态</th><th>操作</th></tr></thead>
				<tbody id="list">
				</tbody>
				</table>
			</div>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">关闭</button>
                </div>
            </div>
        </div>
    </div>
	
	<div class="modal fade" id="lqq" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                     <h4 class="modal-title"><i class="fa fa-circle-o"></i> 免费拉圈圈99+</h4>
                </div>
                <div class="modal-body">
			<div class="alert alert-success">免费拉取QQ名片圈圈赞99+，输入QQ号并提交即可！</div>
		<div class="tab-pane fade in" id="lqq">
			<div class="form-group">
				<div class="input-group"><div class="input-group-addon">请输入QQ</div>
				<input type="text" name="qq" id="qq4" value="" class="form-control" required/>
			</div></div>
			<input type="submit" id="submit_lqq" class="btn btn-primary btn-block" value="立即提交">
			<div id="result3" class="form-group text-center" style="display:none;"></div>
		</div>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">关闭</button>
                </div>
            </div>
        </div>
    </div>

	<div class="modal fade" id="gift" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                     <h4 class="modal-title"><i class="fa fa-comments-o"></i> 抽奖</h4>
                </div>
                <div class="modal-body">
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
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">关闭</button>
                </div>
            </div>
        </div>
    </div>

	<div class="modal fade" id="ltjl" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                     <h4 class="modal-title"><i class="fa fa-comments-o"></i> 聊天交流</h4>
                </div>
                <div class="modal-body">
						<div class="alert alert-warning">若有更好的建议或发现系统Bug可以在这里留言互动，禁止留言任何广告、链接以及语言不当的话语。商务合作请点击底部联系方式进行咨询。</div>
						<?php echo $conf['chatframe']?>
			    </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">关闭</button>
                </div>
            </div>
        </div>
    </div>
		
        <footer id="footer">
            <div class="hide-fixed pull-right pad-rgt">
                  <strong></strong>
            </div>
            <p class="pad-lft">&#0169; 2018 <?php echo $conf['sitename']?></p>

        </footer>

        <button class="scroll-top btn">
            <i class="pci-chevron chevron-up"></i>
        </button>

    </div>


<script src="//lib.baomitu.com/jquery/1.12.4/jquery.min.js"></script>
<script src="//lib.baomitu.com/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="//lib.baomitu.com/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script src="//lib.baomitu.com/layer/2.3/layer.js"></script>
<script src="<?php echo $cdnserver?>assets/js/pace.min.js"></script>
<script src="<?php echo $cdnserver?>assets/js/nifty.min.js"></script>

<script type="text/javascript">
var isModal=<?php echo empty($conf['modal'])?'false':'true';?>;
var homepage=true;
var hashsalt=<?php echo $addsalt_js?>;
</script>
<script src="assets/js/main.js?ver=<?php echo VERSION ?>"></script>
</body>
</html>