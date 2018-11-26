<?php
if(!defined('IN_CRONLITE'))exit();
if(!$conf['invite_tid'])exit("<script language='javascript'>alert('当前站点未开启推广链接功能');window.location.href='./';</script>");
$invite_row = $DB->get_row("select * from shua_tools where tid='{$conf['invite_tid']}' limit 1");
if(!$invite_row)exit("<script language='javascript'>alert('赠送商品ID不存在，请重新配置');window.location.href='./';</script>");
$backdrop_img='//index-css.skyhost.cn/cdn/zip-img/'.rand(1, 19).'.jpg!gzipimgw';
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no"/>
    <title><?php echo $conf['sitename']?> - 推广链接生成</title>
    <link href="//lib.baomitu.com/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="//lib.baomitu.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="assets/simple/css/plugins.css">
    <link rel="stylesheet" href="assets/simple/css/main.css">
    <script src="//lib.baomitu.com/modernizr/2.8.3/modernizr.min.js"></script>
    <!--[if lt IE 9]>
      <script src="//lib.baomitu.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="//lib.baomitu.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<br/>
<img src="<?php echo $backdrop_img;?>" alt="Full Background" class="full-bg full-bg-bottom animated pulse " ondragstart="return false;" oncontextmenu="return false;">
<div class="col-xs-12 col-sm-10 col-md-8 col-lg-5 center-block" style="float: none;">
    <div class="block">
        <div class="block-title">
            <h2><i class="fa fa-share-alt"></i>&nbsp;&nbsp;<b>推广链接生成</b></h2>
        </div>
			<div class="form-group">
				<div class="alert alert-info alert-dismissable">
					<span id="loginmsg">注：复制链接与宣传语到QQ群，微信，空间等地方宣传，用户访问并购买商品后，即可获得<?php echo $invite_row['name']?>哦！</span>
				</div>
			<div class="form-group">
				<div class="input-group"><div class="input-group-addon">您的ＱＱ</div>
				<input type="text" name="userqq" id="userqq" class="form-control" placeholder="请输入您正确的QQ" required="required" onkeydown="if(event.keyCode==13){submit_sub.click()}"/>
			</div></div>
              <input type="submit" name="submit" id="submit_sub" value="立即生成推广链接" class="btn btn-primary btn-block"/>
			<div id="resulturl" style="display:none;">
			</div>
			</div>
			<hr>
			<div class="form-group">
			<a href="./" class="btn btn-primary btn-rounded"><i class="fa fa-home"></i>&nbsp;返回主页</a>
			<a href="user/reg.php" class="btn btn-danger btn-rounded" style="float:right;"><i class="fa fa-user-plus"></i>&nbsp;开通分站</a>
			</div>
        </div>
      </div>
    </div>
  </div>
<script src="//lib.baomitu.com/jquery/1.12.4/jquery.min.js"></script>
<script src="//lib.baomitu.com/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="//lib.baomitu.com/layer/2.3/layer.js"></script>
<script src="//lib.baomitu.com/clipboard.js/1.7.1/clipboard.min.js"></script>
<script type="text/javascript">
var hashsalt=<?php echo $addsalt_js?>;
</script>
<script>
	var clipboard = new Clipboard('#copyurl');
	clipboard.on('success', function (e) {
		layer.msg('复制成功！');
	});
	clipboard.on('error', function (e) {
		layer.msg('复制失败，请长按链接后手动复制');
	});
	var clipboard = new Clipboard('#copycontent');
	clipboard.on('success', function (e) {
		layer.msg('复制成功！');
	});
	clipboard.on('error', function (e) {
		layer.msg('复制失败，请长按选中后手动复制');
	});
	$('#submit_sub').click(function(){
		var userqq = $('#userqq').val();
		if (userqq == '')
		{
			layer.alert('请确保每项不能为空！');
			return false;
		}
		var ii = layer.load(1, {shade: [0.1, '#fff']});
		$.ajax({
			type : 'POST',
			url : 'ajax.php?act=inviteurl',
			data : {userqq : userqq, hashsalt:hashsalt},
			timeout : 5000,
			dataType : 'json',
			async : true,
			success : function (json)
			{
				layer.close(ii);
				if (json.code === 1) {
					 var value = '特价名片赞0.1元起刷，免费领名片赞，免费拉圈圈99+，空间人气、刷钻、名片赞、空间访问、快手双击、全民K歌、抖音视频，链接：' + json.url + ' (请复制链接到浏览器打开)';
                    $('#resulturl').html('<br><div class="list-group-item list-group-item-warning"><i class="fa fa-check-circle-o"></i>&nbsp;生成链接成功，请复制以下内容进行推广！</div><div class="col-xs-12 well well-sm">特价名片赞0.1元起刷<br>免费领名片赞，免费拉圈圈99+<br>空间人气、刷钻、名片赞、空间访问、快手双击、全民K歌、抖音视频<br><br>链接：' + json.url + '<br>(请复制链接到浏览器打开)</div><center><button class="btn btn-warning btn-sm" data-clipboard-text="'+json.url+'" id="copyurl">一键复制链接</button>&nbsp;<button class="btn btn-success btn-sm" data-clipboard-text="'+value+'" id="copycontent">一键复制广告语</button></center>');
				} else if (json.code === 2) {
					var value = '特价名片赞0.1元起刷，免费领名片赞，免费拉圈圈99+，空间人气、刷钻、名片赞、空间访问、快手双击、全民K歌、抖音视频，链接：' + json.url + '(请复制链接到浏览器打开)';
                    $('#resulturl').html('<br><div class="list-group-item list-group-item-warning"><i class="fa fa-info-circle"></i>&nbsp;您已生成过链接，请复制以下内容进行推广！</div><div class="col-xs-12 well well-sm">特价名片赞0.1元起刷<br>免费领名片赞，免费拉圈圈99+<br>空间人气、刷钻、名片赞、空间访问、快手双击、全民K歌、抖音视频、等等..<br>' + json.url + '<br>(请复制链接到浏览器打开)</div><center><button class="btn btn-warning btn-sm" data-clipboard-text="'+json.url+'" id="copyurl">一键复制链接</button>&nbsp;<button class="btn btn-success btn-sm" data-clipboard-text="'+value+'" id="copycontent">一键复制广告语</button></center>');
				} else {
					$('#resulturl').html('<br><div class="list-group-item list-group-item-warning"><i class="fa fa-close"></i>&nbsp;生成链接失败</div><div class="col-xs-12 well well-sm">'+json.msg+'</div>');
				} 
				$('#resulturl').slideDown();
			},
			error : function(){
				layer.close(ii);
				layer.alert('服务器错误，请稍后再试！');
			}
			
		})
	})
</script>
</body>
</html>