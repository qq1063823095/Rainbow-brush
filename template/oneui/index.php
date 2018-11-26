<?php
if(!defined('IN_CRONLITE'))exit();
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title><?php echo $conf['sitename'] ?> - <?php echo $conf['title'] ?></title>
    <meta name="keywords" content="<?php echo $conf['keywords'] ?>">
    <meta name="description" content="<?php echo $conf['description'] ?>">
	<link href="//lib.baomitu.com/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="//lib.baomitu.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="<?php echo $cdnserver?>assets/simple/css/oneui.css">
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
<?php
$backdrop_img='//index-css.skyhost.cn/cdn/zip-img/'.rand(1, 19).'.jpg!gzipimgw';
?>
<img src="<?php echo $backdrop_img;?>" alt="Full Background" class="full-bg full-bg-bottom animated pulse " ondragstart="return false;" oncontextmenu="return false;">
<!--弹出公告-->
<div class="modal fade" align="left" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
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
<!--公告-->
<div class="modal fade" align="left" id="mustsee" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">公告</h4>
      </div>
	  <div class="modal-body">
	  <?php echo $conf['anounce']?>
	  </div>
	  <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
      </div>
    </div>
  </div>
 </div>
<!--公告-->
<div class="col-xs-12 col-sm-10 col-md-8 col-lg-5 center-block" style="float: none;">
    <br/>
    <!--顶部导航-->
    <div class="block block-link-hover3" href="javascript:void(0)">
        <div class="block-content block-content-full text-center bg-image"
             style="background-image: url('assets/simple/img/head2.png');background-size: 100% 100%;">
            <div>
                <div>
                    <img class="img-avatar img-avatar80 img-avatar-thumb animated zoomInDown"
                         src="//q4.qlogo.cn/headimg_dl?dst_uin=<?php echo $conf['kfqq'] ?>&spec=100">
                </div>
            </div>
        </div>
        <div class="block-content block-content-mini block-content-full bg-gray-lighter">
            <div class="text-center text-muted">
                <div class="btn-group btn-group-justified">
                    <div class="btn-group">
                        <a class="btn btn-default" data-toggle="modal" href="#mustsee"><i class="fa fa-file"></i>
                            必看说明</a>
                    </div>
					<div class="btn-group">
					<?php if($conf['appurl'] && !$is_fenzhan){?>
					<a href="<?php echo $conf['appurl']; ?>" target="_blank" class="btn btn-effect-ripple btn-default"><i class="glyphicon glyphicon-phone"></i> <span style="font-weight:bold">客户端</span></a>
					<?php }else{?>
					<a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['kfqq']?>&site=qq&menu=yes" target="_blank" class="btn btn-effect-ripple btn-default"><i class="fa fa-qq"></i> <span style="font-weight:bold">联系客服</span></a>
					<?php }?>
					</div>
                    <div class="btn-group">
                        <a href="./user/" target="_blank" class="btn btn-effect-ripple btn-default"><i class="glyphicon glyphicon-user"></i> <span style="font-weight:bold">分站后台</span></a>
					</div>
                </div>
            </div>
        </div>
    </div>
   
    <!--顶部导航-->

<!--查单说明开始-->
<div class="modal fade" align="left" id="cxsm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">查询内容是什么？该输入什么？</h4>
      </div>
      	<li class="list-group-item"><font color="red">请在右侧的输入框内输入您下单时，在第一个输入框内填写的信息</font></li>
      	<li class="list-group-item">例如您购买的是QQ名片赞，输入下单的QQ账号即可查询订单</li>
      	<li class="list-group-item">例如您购买的是邮箱类商品，需要输入您的邮箱号，输入QQ号是查询不到的</li>
      	<li class="list-group-item">例如您购买的是快手商品，需要输入作品链接里“userid=”后面的数字，输入快手号是一般是查询不到的</li>
      	<li class="list-group-item">例如您购买的是全民K歌商品，需要输入歌曲链接里“shareuid=”后面的，&amp;前面的一串英文数字，输入歌曲链接是查询不到的</li>
      	<li class="list-group-item"><font color="red">如果您不知道下单账号是什么，可以不填写，直接点击查询，则会根据浏览器缓存查询</font></li>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
      </div>
    </div>
  </div>
</div>
<!--查单说明结束-->
    <div class="block">
        <ul class="nav nav-tabs" data-toggle="tabs">
            <li class="active" style="width: 20%;" align="center">
                <a href="#shop" data-toggle="tab"><i class="fa fa-shopping-bag fa-fw"></i> 下单</a>
            </li>
            <li style="width: 20%;" align="center">
                <a href="#search" data-toggle="tab" id="tab-query"><i class="fa fa-search"></i> 查单</a>
            </li>
            <li style="width: 20%;" align="center" <?php if($conf['fenzhan_buy']==0){?>class="hide"<?php }?>>
                <a href="#ktfz" data-toggle="tab"><i class="fa fa-coffee fa-fw"></i> 赚钱</a>
            </li>
            <li style="width: 20%;" align="center" <?php if($conf['gift_open']==0){?>class="hide"<?php }?>>
                <a href="#gift" data-toggle="tab"><i class="fa fa-gift fa-fw"></i> 抽奖</a>
            </li>
			<li style="width: 20%;" align="center" <?php if($conf['iskami']==0||$conf['fenzhan_buy']==1&&$conf['gift_open']==1){?>class="hide"<?php }?>>
                <a href="#cardbuy" data-toggle="tab"><i class="glyphicon glyphicon-th"></i> 卡密</a>
            </li>
            <li style="width: 20%;" align="center">
                <a href="#more" data-toggle="tab"><i class="fa fa-folder-open"></i> 更多</a>
            </li>
        </ul>
        <!--TAB-->
        <div class="block-content tab-content">
            <!--在线下单-->
            <div class="tab-pane fade fade-up in active" id="shop">
				<?php echo $conf['alert']?>
                <div class="form-group" id="display_selectclass"<?php if($classhide){?> style="display:none;"<?php }?>>
                    <div class="input-group">
                        <div class="input-group-addon">选择分类</div>
                        <select name="tid" id="cid" class="form-control">
                            <?php echo $select ?>
                        </select>
                        <div class="input-group-addon"><span class="glyphicon glyphicon-search onclick" title="搜索商品" id="showSearchBar"></span></div>
                    </div>
                </div>
                <div class="form-group" id="display_searchBar" style="display:none;">
                    <div class="input-group">
                        <div class="input-group-addon">搜索商品</div>
                        <input type="text" id="searchkw" class="form-control" placeholder="搜索商品"
                               onkeydown="if(event.keyCode==13){$('#doSearch').click()}"/>
                        <div class="input-group-addon"><span class="glyphicon glyphicon-search onclick" title="搜索" id="doSearch"></span></div>
                        <div class="input-group-addon"><span class="glyphicon glyphicon-remove onclick" title="关闭" id="closeSearchBar"></span></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">选择商品</div>
                        <select name="tid" id="tid" class="form-control" onchange="getPoint();">
                            <?php echo $select2 ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">商品价格</div>
                        <input type="text" name="need" id="need" class="form-control" disabled/>
                    </div>
                </div>
                <div class="form-group" id="display_left" style="display:none;">
                    <div class="input-group">
                        <div class="input-group-addon">库存数量</div>
                        <input type="text" name="leftcount" id="leftcount" class="form-control" disabled/>
                    </div>
                </div>
                <div class="form-group" id="display_num" style="display:none;">
                    <div class="input-group">
                        <div class="input-group-addon">下单份数</div>
                       <span class="input-group-btn"><input id="num_min" type="button" class="btn btn-info" style="border-radius: 0px;" value="━"></span>
						<input id="num" name="num" class="form-control" type="number" min="1" value="1"/>
						<span class="input-group-btn"><input id="num_add" type="button" class="btn btn-info" style="border-radius: 0px;" value="✚"></span>
				</div></div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon" id="inputname">下单ＱＱ</div>
                        <input type="text" name="inputvalue" id="inputvalue" value="<?php echo $qq ?>" class="tooltip-show form-control" data-toggle="tooltip" title="请认真输入并仔细阅读商品说明！" required/>
                    </div>
                </div>
                <div id="inputsname"></div>
                <div id="alert_frame" class="alert alert-danger animated rubberBand" style="display:none;"></div>
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
                        if ($conf['alipay_api']) echo '<button type="submit" class="btn btn-default" id="buy_alipay"><img src="assets/icon/alipay.ico" class="logo">支付宝</button>&nbsp;';
                        if ($conf['qqpay_api']) echo '<button type="submit" class="btn btn-default" id="buy_qqpay"><img src="assets/icon/qqpay.ico" class="logo">QQ钱包</button>&nbsp;';
                        if ($conf['wxpay_api']) echo '<button type="submit" class="btn btn-default" id="buy_wxpay"><img src="assets/icon/wechat.ico" class="logo">微信支付</button>&nbsp;';
                        if ($conf['tenpay_api']) echo '<button type="submit" class="btn btn-default" id="buy_tenpay"><img src="assets/icon/tenpay.ico" class="logo">财付通</button>&nbsp;';
                        ?>
                    </div>
                </div>
                <input type="submit" id="submit_buy" class="btn btn-primary btn-block" value="立即购买"><br/>
            </div>
            <!--在线下单-->
            <!--查询订单-->
            <div class="tab-pane fade fade-up" id="search">
                <table class="table table-striped table-borderless table-vcenter remove-margin-bottom">
                    <tbody>
                    <tr class="animation-fadeInQuick2">
                        <td class="text-center" style="width: 100px;">
                            <img src="//q4.qlogo.cn/headimg_dl?dst_uin=<?php echo $conf['kfqq']?>&spec=100"
                                 alt="avatar" class="img-circle img-thumbnail img-thumbnail-avatar">
                        </td>
                        <td>
                             <h5><strong>订单售后客服</strong></h5>
                            <i class="fa fa-check-circle-o text-danger"></i> 客服当前<br>
                            <i class="fa fa-comment-o text-success"></i>在线中,有事直奔主题!
                        </td>
                        <td class="text-right" style="width: 20%;">
                            <a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['kfqq']?>&site=qq&menu=yes" target="_blank" class="btn btn-sm btn-info">联系</a>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <br>
                <div class="col-xs-12 well well-sm animation-pullUp"
                     <?php if (empty($conf['gg_search'])){ ?>style="display:none;"<?php } ?>><?php echo $conf['gg_search'] ?></div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">查询内容</div>
                        <input type="text" name="qq" id="qq3" value="<?php echo $qq ?>" class="form-control"
                               placeholder="请输入下单账号（留空则根据浏览器缓存查询）" required/>
						<span class="input-group-btn"><a href="#cxsm" target="_blank" data-toggle="modal" class="btn btn-warning"><i class="glyphicon glyphicon-exclamation-sign"></i></a></span>
                    </div>
                </div>
                <input type="submit" id="submit_query" class="btn btn-primary btn-block" value="立即查询"><br/>
                <div id="result2" class="form-group" style="display:none;">
                    <center>
                        <small><font color="#ff0000">手机用户可以左右滑动</font></small>
                    </center>
                    <div class="table-responsive">
                        <table class="table table-vcenter table-condensed table-striped">
                            <thead>
                            <tr>
                                <th class="hidden-xs">下单账号</th>
                                <th>商品名称</th>
                                <th>数量</th>
                                <th class="hidden-xs">购买时间</th>
                                <th>状态</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody id="list">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--查询订单-->


            <!--开通分站-->
            <div class="tab-pane fade fade-up" id="ktfz">
                <div class="block block-link-hover2 text-center">
                    <div class="block-content block-content-full bg-success">
                        <div class="h4 font-w700 text-white push-10"><i
                                    class="fa fa-cny fa-fw"></i><strong><?php echo $conf['fenzhan_price'] ?>元</strong> /
                            <i
                                    class="fa fa-cny fa-fw"></i><strong><?php echo $conf['fenzhan_price2'] ?>元</strong>
                        </div>
                        <div class="h5 font-w300 text-white-op">普及版 / 专业版两种分站供你选择</div>
                    </div>
                    <div class="block-content">
                        <table class="table table-borderless table-condensed">
                            <tbody>
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
                            </tbody>
                        </table>
                    </div>
                    <div class="block-content block-content-mini block-content-full bg-gray-lighter">
                     <a href="#userjs" data-toggle="modal" class="btn btn-success">版本介绍</a>
                    <button onclick="window.open('./user/reg.php')" class="btn btn-danger">开通分站</button>
                    </div>
                </div>
            </div>
            <!--开通分站-->
			<!--抽奖-->
				<div class="tab-pane fade fade-up" id="gift">
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
			<!--卡密下单-->
				<div class="tab-pane fade fade-up" id="cardbuy">
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
           <!--更多-->
            <div class="tab-pane fade fade-right" id="more">
                <div class="col-xs-6 col-sm-4 col-lg-4<?php if(empty($conf['appurl'])){?> hide<?php }?>">
                    <a class="block block-link-hover2 text-center" href="<?php echo $conf['appurl']; ?>" target="_blank">
                        <div class="block-content block-content-full bg-success">
                            <i class="fa fa-cloud-download fa-3x text-white"></i>
                            <div class="font-w600 text-white-op push-15-t">APP下载</div>
                        </div>
                    </a>
                </div>
         
                <div class="col-xs-6 col-sm-4 col-lg-4<?php if(empty($conf['lqqapi'])){?> hide<?php }?>">
                    <a class="block block-link-hover2 text-center" data-toggle="modal" href="#lqq">
                        <div class="block-content block-content-full bg-primary">
                            <i class="fa fa-circle-o fa-3x text-white"></i>
                            <div class="font-w600 text-white-op push-15-t">免费拉圈</div>
                        </div>
                    </a>
                </div>
				<div class="col-xs-6 col-sm-4 col-lg-4<?php if(empty($conf['invite_tid'])){?> hide<?php }?>">
					<a class="block block-link-hover2 text-center" href="./?mod=invite" target="_blank">
						<div class="block-content block-content-full bg-warning">
						  <i class="fa fa-paper-plane-o fa-3x text-white"></i>
							<div class="font-w600 text-white-op push-15-t">免费领赞</div>
						  </div>
					</a>
				</div>

                <div class="col-xs-6 col-sm-4 col-lg-4<?php if($conf['iskami']==0||$conf['fenzhan_buy']==0||$conf['gift_open']==0){?> hide<?php }?>">
                    <a class="block block-link-hover2 text-center" href="#cardbuy" data-toggle="tab">
                        <div class="block-content block-content-full bg-amethyst">
                            <i class="fa fa-credit-card fa-3x text-white"></i>
                            <div class="font-w600 text-white-op push-15-t">卡密下单</div>
                        </div>
                    </a>
                </div>
				<div class="col-xs-6 col-sm-4 col-lg-4<?php if(empty($conf['chatframe'])){?> hide<?php }?>">
					<a class="block block-link-hover2 text-center" href="#chat" data-toggle="tab">
						<div class="block-content block-content-full bg-success">
						   <i class="fa fa-comments fa-3x text-white"></i>
							<div class="font-w600 text-white-op push-15-t">在线聊天</div>
						</div>
					</a>
				</div>
                <div class="col-xs-6 col-sm-4 col-lg-4">
                    <a class="block block-link-hover2 text-center" href="./user/" target="_blank">
                        <div class="block-content block-content-full bg-city">
                            <i class="fa fa-certificate fa-3x text-white"></i>
                            <div class="font-w600 text-white-op push-15-t">分站后台</div>
                        </div>
                    </a>
                </div>
            </div>
            <!--更多-->
            <!--拉圈圈-->
            <div class="modal fade" id="lqq" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-popin">
                    <div class="modal-content">
                        <div class="block block-themed block-transparent remove-margin-b">
                            <div class="block-header bg-primary-dark">
                                <ul class="block-options">
                                    <li>
                                        <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                                    </li>
                                </ul>
                                <h4 class="block-title">免费拉圈圈99+</h4>
                            </div>
                            <div class="modal-body">
                                <div id="alert_frame" class="alert alert-info">
                                    免费拉取圈圈标签赞 99+ ，不是100%成功哦！
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">请输入QQ</div>
                                        <input type="text" name="qq" id="qq4" value="" class="form-control" required/>
                                    </div>
                                </div>
                                <input type="submit" id="submit_lqq" class="btn btn-primary btn-block" value="立即提交">
                                <div id="result3" class="form-group text-center" style="display:none;"></div>
                                <br/>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">关闭</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--拉圈圈-->
            <div class="tab-pane fade fade-right" id="chat">
			<?php echo $conf['chatframe']?>
            </div>
            <!--聊天-->
        </div>
    </div>
    <!--版本介绍-->
    <div class="modal fade" id="userjs" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-popin">
            <div class="modal-content">
                <div class="block block-themed block-transparent remove-margin-b">
                    <div class="block-header bg-primary-dark">
                        <ul class="block-options">
                            <li>
                                <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                            </li>
                        </ul>
                        <h4 class="block-title">版本介绍</h4>
                    </div>
                    <div class="modal-body">
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
                                        <span class="btn btn-effect-ripple btn-xs btn-success"><i
                                                    class="fa fa-check"></i></span>
                                        <span class="btn btn-effect-ripple btn-xs btn-success"><i
                                                    class="fa fa-check"></i></span>
                                    </td>
                                </tr>
                                <tr class="">
                                    <td>三种在线支付接口</td>
                                    <td class="text-center">
                                        <span class="btn btn-effect-ripple btn-xs btn-success"><i
                                                    class="fa fa-check"></i></span>
                                        <span class="btn btn-effect-ripple btn-xs btn-success"><i
                                                    class="fa fa-check"></i></span>
                                    </td>
                                </tr>
                                <tr class="success">
                                    <td>专属网站域名</td>
                                    <td class="text-center">
                                        <span class="btn btn-effect-ripple btn-xs btn-success"><i
                                                    class="fa fa-check"></i></span>
                                        <span class="btn btn-effect-ripple btn-xs btn-success"><i
                                                    class="fa fa-check"></i></span>
                                    </td>
                                </tr>
                                <tr class="">
                                    <td>赚取用户提成</td>
                                    <td class="text-center">
                                        <span class="btn btn-effect-ripple btn-xs btn-success"><i
                                                    class="fa fa-check"></i></span>
                                        <span class="btn btn-effect-ripple btn-xs btn-success"><i
                                                    class="fa fa-check"></i></span>
                                    </td>
                                </tr>
                                <tr class="info">
                                    <td>赚取下级分站提成</td>
                                    <td class="text-center">
                                        <span class="btn btn-effect-ripple btn-xs btn-danger"><i
                                                    class="fa fa-close"></i></span>
                                        <span class="btn btn-effect-ripple btn-xs btn-success"><i
                                                    class="fa fa-check"></i></span>
                                    </td>
                                </tr>
                                <tr class="">
                                    <td>设置商品价格</td>
                                    <td class="text-center">
                                        <span class="btn btn-effect-ripple btn-xs btn-success"><i
                                                    class="fa fa-check"></i></span>
                                        <span class="btn btn-effect-ripple btn-xs btn-success"><i
                                                    class="fa fa-check"></i></span>
                                    </td>
                                </tr>
                                <tr class="warning">
                                    <td>设置下级分站商品价格</td>
                                    <td class="text-center">
                                        <span class="btn btn-effect-ripple btn-xs btn-danger"><i
                                                    class="fa fa-close"></i></span>
                                        <span class="btn btn-effect-ripple btn-xs btn-success"><i
                                                    class="fa fa-check"></i></span>
                                    </td>
                                </tr>
                                <tr class="">
                                    <td>搭建下级分站</td>
                                    <td class="text-center">
                                        <span class="btn btn-effect-ripple btn-xs btn-danger"><i
                                                    class="fa fa-close"></i></span>
                                        <span class="btn btn-effect-ripple btn-xs btn-success"><i
                                                    class="fa fa-check"></i></span>
                                    </td>
                                </tr>
                                <tr class="danger">
                                    <td>赠送专属精致APP</td>
                                    <td class="text-center">
                                        <span class="btn btn-effect-ripple btn-xs btn-danger"><i
                                                    class="fa fa-close"></i></span>
                                        <span class="btn btn-effect-ripple btn-xs btn-success"><i
                                                    class="fa fa-check"></i></span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <center style="color: #b2b2b2;">
                            <small><em>* 自己的能力决定着你的收入！</em></small>
                        </center>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                </div>
            </div>
        </div>
    </div>
    <!--版本介绍-->
<!--关于我们弹窗-->
<div class="modal fade" align="left" id="about" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			<h4 class="modal-title" id="myModalLabel">新手下单帮助</h4>
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
<!--关于我们弹窗-->
<div class="list-group-item reed" style="background:#66ccff;"><center><h3 class="panel-title"><font color="#fff"><b>用户反馈留言</b></font></h3></center></div>
<div class="panel panel-info">
<marquee direction="up" behavior="scroll" loop="3" scrollamount="3" scrolldelay="10" align="top" bgcolor="#ffffff" height="200px" width="93%" hspace="20" vspace="10" onmouseover="this.stop()" onmouseout="this.start()" style="background-color: rgb(255, 255, 255); height: 200px; width: 93%; margin: 10px 20px;">

<div class="gg_info" style="margin: 0;color:red"><b>官方：不忘初心，方得始终！感谢一路相伴！</b></div>

<div class="gg_info" style="margin: 0;color:blue">用户203***130说：<b>没毛病老铁，我又来下单了</b></div>
<div class="gg_info" style="margin: 0;color:blue">用户960***86说：<b>超级会员快满五个月了，感谢感谢</b></div>
<div class="gg_info" style="margin: 0;color:blue">用户298***775说：<b>我搭建了个分站，请问一天赚36算少还是多？</b></div>
<div class="gg_info" style="margin: 0;color:blue">用户89***120说：<b>放假啦，又来你这里接单赚钱咯</b></div>
<div class="gg_info" style="margin: 0;color:blue">用户160***816说：<b>QQ会员已稳三个月，起来报道。</b></div>
<div class="gg_info" style="margin: 0;color:blue">用户368***785说：<b>今天我分站提了50多块钱，学生放假就是爽</b></div>
<div class="gg_info" style="margin: 0;color:blue">用户103***108说：<b>秒刷名片赞是真的快，十万名片赞一天就到了</b></div>
<div class="gg_info" style="margin: 0;color:blue">用户60***216说：<b>超级会员已稳定6个月，不多bb，有事没事都会来你这里下两单</b></div>
<div class="gg_info" style="margin: 0;color:blue">用户132***988说：<b>从你们网站刚开我就搭建了个分站，这么多天也赚了两千多了，你们挺诚信的</b></div>
<div class="gg_info" style="margin: 0;color:blue">用户107***124说：<b>我是分站长，每天提现10+元，虽然不多但是起码是自己努力挣的钱！</b></div>
<div class="gg_info" style="margin: 0;color:blue">用户139***201说：<b>今天在你网站进货，一天挣了39块钱啊</b></div>
<div class="gg_info" style="margin: 0;color:blue">用户303***963说：<b>名片赞的真的快，会员也稳定快三个月了</b></div>
<div class="gg_info" style="margin: 0;color:blue">用户296***909说：<b>啥时候搞活动多送点福利呗</b></div>
<div class="gg_info" style="margin: 0;color:blue">用户97***634说：<b>好便宜啊8毛一万名片赞</b></div>
<div class="gg_info" style="margin: 0;color:blue">用户395***824说：<b>豪华绿钻两个月了还没掉耶</b></div>
<div class="gg_info" style="margin: 0;color:blue">用户386***163说：<b>我是分站站长，我要努力赚钱！</b></div>
<div class="gg_info" style="margin: 0;color:blue">用户231***069说：<b>下面这个分享领赞活动我一天领了1万多赞啊</b></div>
<div class="gg_info" style="margin: 0;color:blue">用户322***396说：<b>客服态度真的好好啊</b></div>
<div class="gg_info" style="margin: 0;color:blue">用户266***864说：<b>相信你们平台会越来越好，加油！</b></div>
<div class="gg_info" style="margin: 0;color:blue">用户186***768说：<b>超会已稳一个月，前来反馈。感谢平台</b></div>
<div class="gg_info" style="margin: 0;color:blue">用户209***116说：<b>在你这里下单520说说赞追到个女朋友！！！值。</b></div>
<div class="gg_info" style="margin: 0;color:blue">用户368***423说：<b>今天活动好多啊，感觉要爱上你这个平台了</b></div>
<div class="gg_info" style="margin: 0;color:blue">用户331***032说：<b>今天提了32元，美滋滋……</b></div>
<div class="gg_info" style="margin: 0;color:blue">用户216***675说：<b>在你这搭建了个专业版分站，我要努力宣传！争取一天提现50+元！！！</b></div>
<div class="gg_info" style="margin: 0;color:blue">用户206***311说：<b>这里东西质量真的不错，快刷名片赞基本上秒刷，感谢站长提供平台！</b></div>
<div class="gg_info" style="margin: 0;color:blue">用户97***097说：<b>老板，提现的56块钱秒到账，怎么做到的？</b></div>
<div class="gg_info" style="margin: 0;color:blue">用户108***111说：<b>新手看价格，老手求品质，而牛逼的我搭建分站赚钱</b></div>
<div class="gg_info" style="margin: 0;color:blue">用户768***346说：<b>感谢站长提供这么好的平台给我们接单，支持到底！！！</b></div>
<div class="gg_info" style="margin: 0;color:blue">用户199***017说：<b>用这个接单卖给同学，还挺赚钱的耶！抱拳了</b></div>
<div class="gg_info" style="margin: 0;color:blue">用户367***788说：<b>每天来领100赞，美滋滋(～￣▽￣)～</b></div>
<div class="gg_info" style="margin: 0;color:blue">用户109***148说：<b>18块的买超会都三个月了还在，帮女朋友也开了个哈哈哈！</b></div>
<div class="gg_info" style="margin: 0;color:blue">用户111***684说：<b>666，终于更新了抽奖</b></div><div class="gg_info" style="margin: 0;color:blue">用户203***337说：<b>卧槽，这个真人名片赞速度真他妈快，3分钟刷了4万多</b></div><div class="gg_info" style="margin: 0;color:blue">用户292***724说：<b>非常不错</b></div><div class="gg_info" style="margin: 0;color:blue">用户217***359说：<b>多做这中活动</b></div><div class="gg_info" style="margin: 0;color:blue">用户136***498说：<b>希望能迅速赞</b></div><div class="gg_info" style="margin: 0;color:blue">用户212***285说：<b>hao</b></div><div class="gg_info" style="margin: 0;color:blue">用户318***115说：<b>应该尽量的保证质量，并设置分享有奖，这样，也吸引了客户</b></div><div class="gg_info" style="margin: 0;color:blue">用户159***280说：<b>每天送100名片赞</b></div><div class="gg_info" style="margin: 0;color:blue">用户265***010说：<b>类似于QQ空间里说说的赞，能不能设置指定数量？希望采纳</b></div><div class="gg_info" style="margin: 0;color:blue">用户486***443说：<b>更好</b></div><div class="gg_info" style="margin: 0;color:blue">用户280***172说：<b>非常好</b></div><div class="gg_info" style="margin: 0;color:blue">用户282***989说：<b>好</b></div><div class="gg_info" style="margin: 0;color:blue">用户142***439说：<b>不错不错。太好了</b></div><div class="gg_info" style="margin: 0;color:blue">用户932***936说：<b>能按着数量刷就好了</b></div><div class="gg_info" style="margin: 0;color:blue">用户340***683说：<b>很好用很便宜!</b></div><div class="gg_info" style="margin: 0;color:blue">用户177***283说：<b>很不错的网站，加油</b></div><div class="gg_info" style="margin: 0;color:blue">用户212***285说：<b>好</b></div><div class="gg_info" style="margin: 0;color:blue">用户624***185说：<b>这个平台很不错，信誉很好</b></div><div class="gg_info" style="margin: 0;color:blue">用户316***940说：<b>应该把全民k歌刷花间单的</b></div><div class="gg_info" style="margin: 0;color:blue">用户148***683说：<b>希望可以多点福利，东西很便宜，很好。</b></div><div class="gg_info" style="margin: 0;color:blue">用户132***627说：<b>挺好的</b></div><div class="gg_info" style="margin: 0;color:blue">用户154***984说：<b>我帮你们的网站分享给了很多群，永远支持你们</b></div><div class="gg_info" style="margin: 0;color:blue">用户238***434说：<b>刷赞</b></div><div class="gg_info" style="margin: 0;color:blue">用户239***848说：<b>炫酷点  再加点音乐就好了</b></div><div class="gg_info" style="margin: 0;color:blue">用户245***114说：<b>多搞一些低价产品，价格比其他网站略低就好了</b></div><div class="gg_info" style="margin: 0;color:blue">用户157***694说：<b>下单要快</b></div><div class="gg_info" style="margin: 0;color:blue">用户321***803说：<b>多做一些宣传</b></div><div class="gg_info" style="margin: 0;color:blue">用户213***668说：<b>666</b></div><div class="gg_info" style="margin: 0;color:blue">用户321***995说：<b>QQ代刷网是全国最大的代刷网平台,主打QQ钻业务,快手刷粉丝软件,空间业务,进货价格便宜</b></div><div class="gg_info" style="margin: 0;color:blue">用户210***769说：<b>非常好，以后要来就来这里</b></div><div class="gg_info" style="margin: 0;color:blue">用户325***178说：<b>QQ代刷网，<?php echo $_SERVER['HTTP_HOST'];?>，24小时自助下单平台</b></div><div class="gg_info" style="margin: 0;color:blue">用户325***178说：<b>刷更多的赞</b></div><div class="gg_info" style="margin: 0;color:blue">用户168***382说：<b>666</b></div><div class="gg_info" style="margin: 0;color:blue">用户353***251说：<b>很有诚信，刷的很快，推荐这个平台</b></div><div class="gg_info" style="margin: 0;color:blue">用户852***349说：<b>要是能有宣传功能的话，这个平台肯定更受欢迎</b></div><div class="gg_info" style="margin: 0;color:blue">用户183***110说：<b>ui好一点，背景好一点，加油吧</b></div><div class="gg_info" style="margin: 0;color:blue">用户218***577说：<b>建议可以去发广告，宣传自己的网址哦，贴吧里还是有很多人玩的</b></div><div class="gg_info" style="margin: 0;color:blue">用户157***694说：<b>下单速度要快</b></div><div class="gg_info" style="margin: 0;color:blue">用户316***484说：<b>希望继续努力，还不错</b></div><div class="gg_info" style="margin: 0;color:blue">用户343***331说：<b>免费的再多点</b></div><div class="gg_info" style="margin: 0;color:blue">用户340***317说：<b>速度快</b></div><div class="gg_info" style="margin: 0;color:blue">用户356***078说：<b>24小时自助下单平台<?php echo $_SERVER['HTTP_HOST'];?>，QQ代刷网，<?php echo $conf['sitename'] ?></b></div><div class="gg_info" style="margin: 0;color:blue">用户155***605说：<b>很好啊</b></div><div class="gg_info" style="margin: 0;color:blue">用户954***293说：<b>代刷网真是不错，一直用的这个网站，QQ代刷网，<?php echo $_SERVER['HTTP_HOST'];?>，代刷网，搭建代刷网</b></div><div class="gg_info" style="margin: 0;color:blue">用户314***137说：<b>希望多出来刷东西的</b></div>
<div class="gg_info" style="margin: 0;color:blue">用户532***563说：<b>平台很棒啊，支持<?php echo $conf['sitename'] ?>，自助下单平台</b></div>
<div class="gg_info" style="margin: 0;color:blue">用户532***563说：<b>24小时自助下单代刷QQ名片赞,空间人气,快手粉丝,快手作品双击喜欢,快手作品播放量,全民K歌粉丝 </b></div>

<div class="gg_info" style="margin: 0;color:blue">用户280***172说：<b></b></div><div class="gg_info" style="margin: 0;color:blue">用户111***684说：<b>价格再合理一点</b></div><div class="gg_info" style="margin: 0;color:blue">用户203***337说：<b>这个平台特别棒，，，，真的特别特别棒</b></div><div class="gg_info" style="margin: 0;color:blue">用户292***724说：<b>非常不错</b></div><div class="gg_info" style="margin: 0;color:blue">用户217***359说：<b>多做这中活动</b></div><div class="gg_info" style="margin: 0;color:blue">用户136***498说：<b>希望能迅速赞</b></div><div class="gg_info" style="margin: 0;color:blue">用户212***285说：<b>hao</b></div><div class="gg_info" style="margin: 0;color:blue">用户318***115说：<b>应该尽量的保证质量，并设置分享有奖，这样，也吸引了客户</b></div><div class="gg_info" style="margin: 0;color:blue">用户159***280说：<b>每天送100名片赞</b></div><div class="gg_info" style="margin: 0;color:blue">用户265***010说：<b>类似于QQ空间里说说的赞，能不能设置指定数量？希望采纳</b></div><div class="gg_info" style="margin: 0;color:blue">用户486***443说：<b>更好</b></div><div class="gg_info" style="margin: 0;color:blue">用户280***172说：<b>非常好</b></div><div class="gg_info" style="margin: 0;color:blue">用户282***989说：<b>好</b></div><div class="gg_info" style="margin: 0;color:blue">用户142***439说：<b>不错不错。太好了</b></div><div class="gg_info" style="margin: 0;color:blue">用户932***936说：<b>能按着数量刷就好了</b></div><div class="gg_info" style="margin: 0;color:blue">用户340***683说：<b>很好用很便宜!</b></div><div class="gg_info" style="margin: 0;color:blue">用户177***283说：<b>很不错的网站，加油</b></div><div class="gg_info" style="margin: 0;color:blue">用户212***285说：<b>好</b></div><div class="gg_info" style="margin: 0;color:blue">用户624***185说：<b>这个平台很不错，信誉很好</b></div><div class="gg_info" style="margin: 0;color:blue">用户316***940说：<b>应该把全民k歌刷花间单的</b></div><div class="gg_info" style="margin: 0;color:blue">用户148***683说：<b>希望可以多点福利，东西很便宜，很好。</b></div><div class="gg_info" style="margin: 0;color:blue">用户132***627说：<b>挺好的</b></div><div class="gg_info" style="margin: 0;color:blue">用户154***984说：<b>我帮你们的网站分享给了很多群，永远支持你们</b></div><div class="gg_info" style="margin: 0;color:blue">用户238***434说：<b>刷赞</b></div><div class="gg_info" style="margin: 0;color:blue">用户239***848说：<b>炫酷点  再加点音乐就好了</b></div><div class="gg_info" style="margin: 0;color:blue">用户245***114说：<b>多搞一些低价产品，价格比其他网站略低就好了</b></div><div class="gg_info" style="margin: 0;color:blue">用户157***694说：<b>下单要快</b></div><div class="gg_info" style="margin: 0;color:blue">用户321***803说：<b>多做一些宣传</b></div><div class="gg_info" style="margin: 0;color:blue">用户213***668说：<b>666</b></div><div class="gg_info" style="margin: 0;color:blue">用户321***995说：<b>好了</b></div>
<div class="gg_info" style="margin: 0;color:blue">用户532***563说：<b>24小时自助下单平台,免登陆的虚拟业务在线自动处理平台,专业为QQ空间,全民K歌,快手GIF,新浪微博,火山视频等业务提供代刷服务,最大的空间业务代刷平台 <?php echo $_SERVER['HTTP_HOST'];?></b></div>
<div class="gg_info" style="margin: 0;color:blue">用户210***769说：<b>非常好，以后要来就来这里</b></div><div class="gg_info" style="margin: 0;color:blue">用户325***178说：<b>更好宣传</b></div><div class="gg_info" style="margin: 0;color:blue">用户325***178说：<b>刷更多的赞</b></div><div class="gg_info" style="margin: 0;color:blue">用户168***382说：<b>666</b></div><div class="gg_info" style="margin: 0;color:blue">用户353***251说：<b>很有诚信，刷的很快，推荐这个平台</b></div><div class="gg_info" style="margin: 0;color:blue">用户852***349说：<b>要是能有宣传功能的话，这个平台肯定更受欢迎</b></div><div class="gg_info" style="margin: 0;color:blue">用户183***110说：<b>ui好一点，背景好一点，加油吧</b></div><div class="gg_info" style="margin: 0;color:blue">用户218***577说：<b>建议可以去发广告，宣传自己的网址哦，贴吧里还是有很多人玩的</b></div><div class="gg_info" style="margin: 0;color:blue">用户157***694说：<b>下单速度要快</b></div><div class="gg_info" style="margin: 0;color:blue">用户316***484说：<b>希望继续努力，还不错</b></div><div class="gg_info" style="margin: 0;color:blue">用户343***331说：<b>免费的再多点</b></div><div class="gg_info" style="margin: 0;color:blue">用户340***317说：<b>速度快</b></div><div class="gg_info" style="margin: 0;color:blue">用户356***078说：<b>刷豪华黄钻</b></div><div class="gg_info" style="margin: 0;color:blue">用户155***605说：<b>很好啊</b></div><div class="gg_info" style="margin: 0;color:blue">用户954***293说：<b>好好努力</b></div><div class="gg_info" style="margin: 0;color:blue">用户314***137说：<b>希望多出来刷东西的</b></div>
</marquee>
</div>	

<?php
$fenzhan=$DB->count("SELECT count(*) from shua_site");
?>
<div class="panel panel-primary" <?php if($conf['hide_tongji']==1){?>style="display:none;"<?php }?>>
<div class="panel-heading"><h3 class="panel-title"><font color="#000000"><i class="fa fa-bar-chart-o"></i>&nbsp;&nbsp;<b>数据统计</b></font></h3></div>
<table class="table table-bordered">
<tbody>
<tr>
<td align="center">
<font size="2"><span id="count_yxts"></span>天<br><font color="#65b1c9"><i class="fa fa-shield fa-2x"></i></font><br>安全运营</font></td>
<td align="center"><font size="2"><span id="count_money"></span>元<br><font color="#65b1c9"><i class="fa fa-shopping-cart fa-2x"></i></font><br>交易总数</font></td>
<td align="center"><font size="2"><span id="count_orders"></span>笔<br><font color="#65b1c9"><i class="fa fa-check-square-o fa-2x"></i></font><br>订单总数</font></td>
</tr>
<tr>
<td align="center"><font size="2"><?php echo $fenzhan?>个<br><font color="#65b1c9"><i class="fa fa-sitemap fa-2x"></i></font><br>代理分站</font></td>
<td align="center"><font size="2"><span id="count_money1"></span>元<br><font color="#65b1c9"><i class="fa fa-pie-chart fa-2x"></i></font><br>今日交易</font></td>
<td align="center"><font size="2"><span id="count_orders2"></span>笔<br><font color="#65b1c9"><i class="fa fa-check-square fa-2x"></i></font><br>今日订单</font></td>
</tr>
</tbody>
</table>
</div>

    <!--底部导航-->
    <div class="panel panel-default">
        <center>
            <div class="panel-body"><span style="font-weight:bold"><?php echo $conf['sitename'] ?> <i class="fa fa-heart text-danger"></i> 2018 | </span><a class="" href="#about" style="font-weight:bold" data-toggle="modal">客服与帮助</span></a>
            </div>
    </div>
    <!--底部导航-->
</div>
<script src="//lib.baomitu.com/jquery/1.12.4/jquery.min.js"></script>
<script src="//lib.baomitu.com/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="//lib.baomitu.com/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script src="//lib.baomitu.com/layer/2.3/layer.js"></script>
<script src="<?php echo $cdnserver ?>assets/appui/js/plugins.js"></script>
<script src="<?php echo $cdnserver ?>assets/appui/js/app.js"></script>
<script type="text/javascript">
var isModal =<?php echo empty($conf['modal']) ? 'false' : 'true';?>;
var homepage = true;
var hashsalt =<?php echo $addsalt_js?>;
</script>
<script src="assets/js/main.js?ver=<?php echo VERSION ?>"></script>
</body>
</html>