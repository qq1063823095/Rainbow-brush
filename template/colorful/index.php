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
  <link rel="stylesheet" href="<?php echo $cdnserver?>assets/simple/css/plugins.css">
  <link rel="stylesheet" href="<?php echo $cdnserver?>assets/simple/css/main.css">
  <link rel="stylesheet" href="<?php echo $cdnserver?>assets/simple/css/oneui.css">
  <script src="//lib.baomitu.com/modernizr/2.8.3/modernizr.min.js"></script>
  <!--[if lt IE 9]>
    <script src="//lib.baomitu.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="//lib.baomitu.com/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
<style>
#cover{position: fixed;
    width: 100%;
    background-repeat: no-repeat;
    background-size: cover;
    z-index: -1;
    top: 0;
    left: 0;    background-position: center 0%;
    height: 100%;    background-image: url(<?php echo $background_image?>);background-attachment: fixed;
}
img.logo{width:14px;height:14px;margin:0 5px 0 3px;}
.onclick{cursor: pointer;touch-action: manipulation;}
.giftlist{overflow:hidden;width:90%;margin:0 auto}
.giftlist ul{height:270px;overflow:hidden;padding:0}
.giftlist li{width:100%;line-height:35px;padding:0 10px;overflow:hidden;box-sizing:border-box;-webkit-box-sizing:border-box;-moz-box-sizing:border-box}
.giftlist li strong{margin:0 5px 0 0;font-weight:400;color:#1977d8}
</style>
</head>
<body>
<br />
<div class="col-xs-12 col-sm-10 col-md-8 col-lg-5 center-block" style="float: none;">
<!--弹出公告-->
<div class="modal fade" align="left" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header-tabs">
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
<!--弹出公告-->
<div class="widget">
<!--logo-->
    <div class="widget-content themed-background-flat text-center" style="background-image: url(https://ww2.sinaimg.cn/large/a15b4afegy1fpv512r11pj20oo08ctcq.jpg);background-size: 100% 100%;">
        <a href="javascript:void(0)">
			<img class="img-circle m-b-xs" style="border: 2px solid #1281FF; margin-left:3px; margin-right:3px;" src="//q4.qlogo.cn/headimg_dl?dst_uin=<?php echo $conf['kfqq'];?>&spec=100" width="70px" height="70px" alt="Avatar">
        </a>
   </div>
  <aside id="php_text-8" class="widget php_text wow fadeInUp" data-wow-delay="3.0s"><div class="textwidget widget-text"><style type="text/css">#container-box-1{color:#526372;text-transform:uppercase;width:100%;font-size:16px;line-height:50px;text-align:center}#flip-box-1{overflow:hidden;height:50px}#flip-box-1 div{height:50px}#flip-box-1>div>div{color:#fff;display:inline-block;text-align:center;height:50px;width:100%}#flip-box-1 div:first-child{animation:show 8s linear infinite}.flip-box-1-1{background-color:#FF7E40}.flip-box-1-2{background-color:#C166FF}.flip-box-1-3{background-color:#737373}.flip-box-1-4{background-color:#4ec7f3}.flip-box-1-5{background-color:#42c58a}.flip-box-1-6{background-color:#F1617D}@keyframes show{0%{margin-top:-300px}5%{margin-top:-250px}16.666%{margin-top:-250px}21.666%{margin-top:-200px}33.332%{margin-top:-200px}38.332%{margin-top:-150px}49.998%{margin-top:-150px}54.998%{margin-top:-100px}66.664%{margin-top:-100px}71.664%{margin-top:-50px}83.33%{margin-top:-50px}88.33%{margin-top:0px}99.996%{margin-top:0px}100%{margin-top:300px}}</style><div id="container-box-1"><div class="container-box-1-1"></div><div id="flip-box-1"><div><div class="flip-box-1-1">本网站所有业务正常接单中</div></div><div><div class="flip-box-1-2">如有订单问题请联系本站客服</div></div><div><div class="flip-box-1-3">站长QQ：<?php echo $conf['kfqq'];?></div></div><div><div class="flip-box-1-4">诚信代刷全网各种网络业务</div></div><div><div class="flip-box-1-5">一起合作共赢，我们期待您的加入</div></div><div><div class="flip-box-1-6">记得收藏本网站，方便下次使用喔</div></div><div><div class="flip-box-1-1">本站客服QQ:<?php echo $conf['kfqq'];?></div></div></div><div class="container-box-1-2"></div><div class="clear"></div></div></div>
<?php echo $conf['anounce']?>
<!--免费拉圈-->
<div class="modal fade" align="left" id="circles" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">免费拉圈圈99+</h4>
      </div>
      <div class="modal-body">
		<div class="form-group">
			<div class="input-group"><div class="input-group-addon">请输入QQ</div>
				<input type="text" name="qq" id="qq4" value="" class="form-control" required/>
			</div>
		</div>
		<input type="submit" id="submit_lqq" class="btn btn-primary btn-block" value="立即提交">
		<div id="result3" class="form-group text-center" style="display:none;"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
      </div>
    </div>
  </div>
</div>
<!--免费拉圈-->
</div>
<div class="block full2">
<!--TAB标签-->
	<div class="block-title">

       <ul class="nav nav-tabs" id="panel-heading" style="background: linear-gradient(to right,pink ,#5ccdde,#8ae68a,#e0e0e0);">
            <li style="width: 25%;" align="center"><a href="#shop" data-toggle="tab"><span style="font-weight:bold"><i class="fa fa-shopping-bag fa-fw"></i> 下单</span></a></li>
            <li style="width: 25%;" align="center"><a href="#search" data-toggle="tab" id="tab-query"><span style="font-weight:bold"><i class="fa fa-search"></i> 查询</span></a></li>
			<li style="width: 25%;" align="center" <?php if($conf['fenzhan_buy']==0){?>class="hide"<?php }?>><a href="#Substation" data-toggle="tab"><span style="font-weight:bold"><font color="#ff0000"><i class="fa fa-coffee fa-fw"></i> 赚钱</span></font></a></li>
			<li style="width: 25%;" align="center" <?php if($conf['gift_open']==0){?>class="hide"<?php }?>><a href="#gift" data-toggle="tab"><span style="font-weight:bold"><i class="fa fa-gift fa-fw"></i> 抽奖</span></a></li>
			<li style="width: 25%;" align="center" <?php if($conf['iskami']==0||$conf['fenzhan_buy']==1&&$conf['gift_open']==1){?>class="hide"<?php }?>><a href="#cardbuy" data-toggle="tab"><span style="font-weight:bold"><i class="glyphicon glyphicon-th"></i> 卡密</span></a></li>
			<li style="width: 25%;" align="center" <?php if(empty($conf['chatframe'])||$conf['iskami']==1&&$conf['fenzhan_buy']==1||$conf['gift_open']==1){?>class="hide"<?php }?>><a href="#chat" data-toggle="tab"><span style="font-weight:bold"><i class="fa fa-comments"></i> 聊天</span></a></li>
        </ul>
    </div>
<!--TAB标签-->
    <div class="tab-content">
<!--在线下单-->
    <div class="tab-pane active" id="shop">	
			<?php echo $conf['alert']?>
			<div class="form-group" id="display_selectclass"<?php if($classhide){?> style="display:none;"<?php }?>>
				<div class="input-group"><div class="input-group-addon">选择分类</div>
				<select name="tid" id="cid" class="form-control"><?php echo $select?></select>
				<div class="input-group-addon"><span class="glyphicon glyphicon-search onclick" title="搜索商品" id="showSearchBar"></span></div>
			</div></div>
			<div class="form-group" id="display_searchBar" style="display:none;">
				<div class="input-group"><div class="input-group-addon">搜索商品</div>
				<input type="text" id="searchkw" class="form-control" placeholder="搜索商品" onkeydown="if(event.keyCode==13){$('#doSearch').click()}"/>
				<div class="input-group-addon"><span class="glyphicon glyphicon-search onclick" title="搜索" id="doSearch"></span></div>
                <div class="input-group-addon"><span class="glyphicon glyphicon-remove onclick" title="关闭" id="closeSearchBar"></span></div>
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
			<div id="alert_frame" class="alert alert-success animation-pullUp" style="display:none;font-weight: bold;"></div>
			<div id="pay_frame" class="form-group text-center" style="display:none;">
			<div class="form-group">
				<div class="input-group">
				<div class="input-group-addon">订单编号</div>
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
            <div class="well well-sm">
<?php
if($conf['alipay_api'])echo '<button type="submit" class="btn btn-default" id="buy_alipay"><img width="20" src="assets/icon/alipay.ico" class="logo">支付宝</button>&nbsp;';
if($conf['qqpay_api'])echo '<button type="submit" class="btn btn-default" id="buy_qqpay"><img width="20" src="assets/icon/qqpay.ico" class="logo">QQ钱包</button>&nbsp;';
if($conf['wxpay_api'])echo '<button type="submit" class="btn btn-default" id="buy_wxpay"><img width="20" src="assets/icon/wechat.ico" class="logo">微信支付</button>&nbsp;';
if($conf['tenpay_api'])echo '<button type="submit" class="btn btn-default" id="buy_tenpay"><img src="assets/icon/tenpay.ico" class="logo">财付通</button>&nbsp;';
?>
            </div>
			</div>
			<input type="submit" id="submit_buy" class="btn btn-primary btn-block" value="立即购买"><br />
  	</div>
<!--在线下单-->
<!--查询订单-->
    <div class="tab-pane" id="search">
		<div class="col-xs-12 well well-sm animation-pullUp" <?php if(empty($conf['gg_search'])){?>style="display:none;"<?php }?>><?php echo $conf['gg_search']?></div>
			<div class="form-group">
				<div class="input-group">
					<div class="input-group-addon">查询内容</div>
					<input type="text" name="qq" id="qq3" value="<?php echo $qq?>" class="form-control" placeholder="请输入下单的QQ（留空则根据浏览器缓存查询）" onkeydown="if(event.keyCode==13){submit_query.click()}" required/>
				</div>
			</div>
			<input type="submit" id="submit_query" class="btn btn-primary btn-block" value="立即查询">
			<div id="result2" class="form-group" style="display:none;">
              <center><small><font color="#ff0000">手机用户可以左右滑动</font></small></center>
				<div class="table-responsive">
					<table class="table table-vcenter table-condensed table-striped">
					<thead><tr><th class="hidden-xs">下单账号</th><th>商品名称</th><th>数量</th><th class="hidden-xs">购买时间</th><th>状态</th><th>操作</th></tr></thead>
					<tbody id="list">
					</tbody>
					</table>
				</div>
			</div>
			<br/>
   </div>
<!--查询订单-->
<!--开通分站-->
    <div class="tab-pane" id="Substation">
		<table class="table table-borderless table-pricing">
            <tbody>
                <tr class="active">
                    <td>
                        <h4><i class="fa fa-cny fa-fw"></i><strong><?php echo $conf['fenzhan_price']?>元</strong> / <i class="fa fa-cny fa-fw"></i><strong><?php echo $conf['fenzhan_price2']?>元</strong><br><small>普及版 / 专业版两种分站供你选择</small></h4>
                    </td>
                </tr>
                <tr>
                    <td>无聊时可以赚点零花钱</td>
                </tr>
                <tr>
                    <td>还可以锻炼自己销售口才</td>
                </tr>
				<tr>
                    <td>宝妈、学生等网络兼职首选</td>
                </tr>
                <tr>
                    <td>分站满<?php echo $conf['tixian_min']; ?>元即可申请提现</td>
                </tr>
                <tr>
                    <td><strong>轻轻松松推广日赚100+不是梦</td>
                </tr>
                <tr class="active">
                    <td>
						<a href="#userjs" data-toggle="modal" class="btn btn-effect-ripple btn-info"><i class="fa fa-th-list"></i><span class="btn-ripple animate" style="height: 100px; width: 100px; top: -34.4px; left: 2.58749px;"></span> 功能介绍</a>
                        <a href="user/reg.php" target="_blank" class="btn btn-effect-ripple btn-danger"><i class="fa fa-arrow-right"></i> 马上开通</a>
                        <a href="user/" target="_blank" class="btn btn-effect-ripple btn-primary"><i class="fa fa-arrow-right"></i> 分站后台</a>
                    </td>
                </tr>
                <tr>
                    <td class="text-muted">
                        <small><em>* 欢迎加入网赚大家庭！</em></small>
                    </td>
                </tr>
            </tbody>
        </table>
    </table>
	</div>
<!--开通分站-->
<!--抽奖-->
    <div class="tab-pane" id="gift">
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
<!--抽奖-->
<!--版本介绍-->
<div class="modal fade" align="left" id="userjs" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
		<div class="modal-header">
			<h4 class="modal-title" id="myModalLabel">版本介绍</h4>
		</div>
		<div class="block">
            <div class="table-responsive">
                <table class="table table-borderless table-vcenter">
                    <thead>
                        <tr>
                            <th style="width: 100px;">功能</th>
                            <th class="text-center" style="width: 20px;">普及版/专业版</th>
                        </tr>
                    </thead>
					<tbody>
						<tr class="active">
                            <td>专属代刷平台</td>
                            <td class="text-center">
								<span class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-check"></i></span>
								<span class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-check"></i></span>
							</td>
                        </tr>
                        <tr class="">
                            <td>三种在线支付接口</td>
                            <td class="text-center">
								<span class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-check"></i></span>
								<span class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-check"></i></span>
							</td>
                        </tr>
						<tr class="success">
                            <td>专属网站域名</td>
                            <td class="text-center">
								<span class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-check"></i></span>
								<span class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-check"></i></span>
							</td>
                        </tr>
						<tr class="">
                            <td>赚取用户提成</td>
                            <td class="text-center">
								<span class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-check"></i></span>
								<span class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-check"></i></span>
							</td>
                        </tr>
						<tr class="info">
                            <td>赚取下级分站提成</td>
                            <td class="text-center">
								<span class="btn btn-effect-ripple btn-xs btn-danger"><i class="fa fa-close"></i></span>
								<span class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-check"></i></span>
							</td>
                        </tr>
						<tr class="">
                            <td>设置商品价格</td>
                            <td class="text-center">
								<span class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-check"></i></span>
								<span class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-check"></i></span>
							</td>
                        </tr>
						<tr class="warning">
                            <td>设置下级分站商品价格</td>
                            <td class="text-center">
								<span class="btn btn-effect-ripple btn-xs btn-danger"><i class="fa fa-close"></i></span>
								<span class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-check"></i></span>
							</td>
                        </tr>
						<tr class="">
                            <td>搭建下级分站</td>
                            <td class="text-center">
								<span class="btn btn-effect-ripple btn-xs btn-danger"><i class="fa fa-close"></i></span>
								<span class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-check"></i></span>
							</td>
                        </tr>
						<tr class="danger">
                            <td>赠送专属精致APP</td>
                            <td class="text-center">
								<span class="btn btn-effect-ripple btn-xs btn-danger"><i class="fa fa-close"></i></span>
								<span class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-check"></i></span>
							</td>
                        </tr>
                    </tbody>
                </table>
            </div>
				<center style="color: #b2b2b2;"><small><em>* 自己的能力决定着你的收入！</em></small></center>
        </div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
		</div>
    </div>
  </div>
</div>
<!--版本介绍-->
<!--卡密下单-->
    <div class="tab-pane" id="cardbuy">
		<div class="form-group">
			<div class="input-group"><div class="input-group-addon">输入卡密</div>
			<input type="text" name="km" id="km" value="" class="form-control" onkeydown="if(event.keyCode==13){submit_checkkm.click()}" required/>
		</div></div>
		<input type="submit" id="submit_checkkm" class="btn btn-primary btn-block" value="检查卡密">
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
		<div id="km_alert_frame" class="alert alert-success animation-pullUp" style="display:none;font-weight: bold;"></div>
		<input type="submit" id="submit_card" class="btn btn-primary btn-block" value="立即购买">
		<div id="result1" class="form-group text-center" style="display:none;">
		</div>
		</div>
		<br />
	</div>
<!--卡密下单-->
<!--卡密下单-->
    <div class="tab-pane" id="chat">
		<?php echo $conf['chatframe']?>
	</div>
<!--卡密下单-->
    </div>
</div>
<!--关于我们弹窗-->
<div class="modal fade" align="left" id="about" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			<h4 class="modal-title" id="myModalLabel">客服与帮助</h4>
		</div>
		<div class="modal-body">
			<a href="javascript:void(0)" class="widget">
				<center>
						<strong><font size="3">站长ＱＱ：<?php echo $conf['kfqq'];?></font> </strong>
                      	 <br /> 
						<strong><font size="2">本站域名：<?php echo $_SERVER['HTTP_HOST'];?></font> </strong>
					</center>
					<center>
<div id="demo-acc-faq" class="panel-group accordion"><div class="panel panel-trans pad-top"><a href="#demo-acc-faq1" class="text-semibold text-lg text-main collapsed" data-toggle="collapse" data-parent="#demo-acc-faq" aria-expanded="false">下单很久了都没有开始刷呢？</a><div id="demo-acc-faq1" class="mar-ver collapse" aria-expanded="false" style="height: 0px;">由于本站采用全自动订单处理，难免会出现漏单，部分单子处理时间可能会稍长一点，不过都会完成，最终解释权归本站所有。超过24小时没处理请联系客服！</div></div><div class="panel panel-trans pad-top"><a href="#demo-acc-faq2" class="text-semibold text-lg text-main collapsed" data-toggle="collapse" data-parent="#demo-acc-faq" aria-expanded="false">ＱＱ空间业务类下单方法讲解</a><div id="demo-acc-faq2" class="mar-ver collapse" aria-expanded="false">1.下单前：空间必须是所有人可访问,必须自带1~4条原创说说!<br>2.代刷期间，禁止关闭访问权限，或者删除说说，删除说说的一律由自行负责，不给予补偿。</div></div><div class="panel panel-trans pad-top"><a href="#demo-acc-faq3" class="text-semibold text-lg text-main collapsed" data-toggle="collapse" data-parent="#demo-acc-faq" aria-expanded="false">空间说说赞相关下单方法讲解</a><div id="demo-acc-faq3" class="mar-ver collapse" aria-expanded="false">1.下单前：空间必须是所有人可访问,必须自带1条原创说说!转发的说说不能刷！<br>2.在“QQ号码”栏目输入QQ号码，点击下面的获取说说ID并选择你需要刷的说说的ID，下单即可。<br>3.代刷期间，禁止关闭访问权限，或者删除说说，删除说说的一律由自行负责，不给予补偿。</div></div><div class="panel panel-trans pad-top"><a href="#demo-acc-faq4" class="text-semibold text-lg text-main collapsed" data-toggle="collapse" data-parent="#demo-acc-faq" aria-expanded="false">全民Ｋ歌业务类下单方法讲解</a><div id="demo-acc-faq4" class="mar-ver collapse" aria-expanded="false">1.打开你的全名k歌<br>2.复制你全名k歌里面的需要刷的歌曲链接<br>3.例如：你歌曲链接是：<font color="#ff0000">https://kg.qq.com/node/play?s= <font color="green">881Zbk8aCfIwA8U3</font> &amp;g_f=personal</font><br>4.然后把s=后面的 <font color="green">881Zbk8aCfIwA8U3</font> 链接填入到歌曲ID里面，然后提交购买。</div></div><div class="panel panel-trans pad-top"><a href="#demo-acc-faq5" class="text-semibold text-lg text-main collapsed" data-toggle="collapse" data-parent="#demo-acc-faq" aria-expanded="false">快手业务类代刷下单方法讲解</a><div id="demo-acc-faq5" class="mar-ver collapse" aria-expanded="false">1.需要填写用户ID和作品ID，比如<font color="#ff0000">http://www.kuaishou.com/i/photo/lwx?userId= <font color="green">294200023</font> &amp;photoId= <font color="green">1071823418</font></font> (分享作品就可以看到“复制链接”了)<br>2.用户ID就是 <font color="green">294200023</font> 作品ID就是 <font color="green">1071823418</font> ，然后在分别把用户ID和作品ID填上，请勿把两个选项填反了，不给予补单！</div></div><div class="panel panel-trans pad-top"><a href="#demo-acc-faq6" class="text-semibold text-lg text-main collapsed" data-toggle="collapse" data-parent="#demo-acc-faq" aria-expanded="false">永久ＱＱ会员/钻下单方法讲解</a><div id="demo-acc-faq6" class="mar-ver collapse" aria-expanded="false">1.下单之前，先确认输的信息是不是正确的!<br>2.Q会员/钻因为需要人工处理，所以每天不定时开刷，24小时-48小时内到账！</div></div></div>
             </center>                                                           
			</a>
		</div>
    </div>
  </div>
</div>
<div class="panel panel-info" <?php if($conf['hide_tongji']==1){?>style="display:none;"<?php }?>>
<div class="panel-heading" style="background: linear-gradient(to right,#14b7ff,#5ccdde,#b221ff);"><font color="#000000"><i class="fa fa-bar-chart"></i>&nbsp;&nbsp;<b>运行日志</b></font></h3></div>
<table class="table table-bordered">
<tbody>
<tr>
	<td align="center"><font color="#808080"><b>业务订单总数</b></br><i class="fa fa-hourglass-2 fa-2x"></i></br><span id="count_orders"></span>条</font></td>
	<td align="center"><font color="#808080"><b>累计交易金额</b></br><span class="fa fa-shopping-cart fa-2x"></span></br><span id="count_money"></span>元</font></td>
</tr>
<tr height=50>
         <td align="center"><font color="#808080"><b>已处理的订单</b></br><i class="fa fa-check-square-o fa-2x"></i></span></br><span id="count_orders1"></span>条</font></td>
	<td align="center"><font color="#808080"><b>您共访问本站</b></br><i class="fa fa-internet-explorer fa-2x"></i></span></br><span id="counter">1</span>次</font></td>
<tbody>
</table>
</div>
<!--关于我们弹窗-->
<!--底部导航-->
<div class="panel panel-info" <?php if($conf['bottom']==''){?>style="display:none;"<?php }?>>
<div class="panel-heading" style="background: linear-gradient(to right,#b221ff,#14b7ff,#8ae68a);"><font color="#000000"><i class="fa fa-skyatlas"></i>&nbsp;&nbsp;<b>站点工具</b></font></h3></div>
<?php echo $conf['bottom']?>
  <center>  <div class="panel-body"><span style="font-weight:bold">CopyRight <i class="fa fa-heart text-danger"></i> 2018 <a href="/"><?php echo $conf['sitename']?></a> | </span><a class="" href="#about" data-toggle="modal"><span style="font-weight:bold">客服与帮助</span></a></center>
</div>
<!--底部导航-->
</div>
<script src="//lib.baomitu.com/jquery/1.12.4/jquery.min.js"></script>
<script src="//lib.baomitu.com/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="//lib.baomitu.com/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script src="//lib.baomitu.com/layer/2.3/layer.js"></script>
<script src="<?php echo $cdnserver?>assets/appui/js/plugins.js"></script>
<script src="<?php echo $cdnserver?>assets/appui/js/app.js"></script>
<script type="text/javascript">
var isModal=<?php echo empty($conf['modal'])?'false':'true';?>;
var homepage=true;
var hashsalt=<?php echo $addsalt_js?>;
</script>
<script src="assets/js/main.js?ver=<?php echo VERSION ?>"></script>
<div id="cover">
</body>
</html>