<?php
if(!defined('IN_CRONLITE'))exit();

$id=intval($_GET['id']);
if(md5($id.SYS_KEY.$id)!==$_GET['skey'])exit("<script language='javascript'>alert('验证失败');history.go(-1);</script>");
$row=$DB->get_row("select * from shua_orders where id='$id' limit 1");
if(!$row)exit("<script language='javascript'>alert('当前订单不存在！');history.go(-1);</script>");
$tool=$DB->get_row("select * from shua_tools where tid='{$row['tid']}' limit 1");
if($tool['is_curl']!=4)exit("<script language='javascript'>alert('非发卡类商品！');history.go(-1);</script>");
$count = $row['value'];
$rs=$DB->query("SELECT * FROM shua_faka WHERE tid='{$row['tid']}' AND orderid='$id' LIMIT {$count}");
$kmdata='';
while($res = $DB->fetch($rs))
{
	if(!empty($res['pw'])){
		$kmdata.='卡号：'.$res['km'].' 密码：'.$res['pw']."\r\n";
	}else{
		$kmdata.=$res['km']."\r\n";
	}
}

$backdrop_img='//index-css.skyhost.cn/cdn/zip-img/'.rand(1, 19).'.jpg!gzipimgw';
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no"/>
    <title><?php echo $conf['sitename']?> - 卡密查看</title>
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
<div class="col-sm-12 col-md-8 center-block" style="float: none;">
    <div class="block">
        <div class="block-title">
            <h2><i class="fa fa-share-alt"></i>&nbsp;&nbsp;<b><?php echo $tool['name']?></b></h2>
        </div>
			<?php if(!empty($tool['alert'])){?>
			<div class="alert alert-info alert-dismissable">
				<?php echo $tool['alert']?>
			</div>
			<?php }?>
			<div class="form-group">
			<textarea id="txt_0" rows="10" cols="70" readonly="" class="form-control" wrap="off"><?php echo $kmdata?></textarea>
			</div>
			<div class="pull-right">
			<button class="btn btn-danger btn-rounded" type="button" id="saveas-bt">导出全部</button>&nbsp;<button class="btn btn-info btn-rounded" type="button" data-clipboard-action="copy" data-clipboard-target="#txt_0" id="clipboard_btn">复制全部</button>
			</div>
			<hr>
			<div class="form-group">
			<a href="./" class="btn btn-primary btn-rounded"><i class="fa fa-home"></i>&nbsp;返回主页</a>
			</div>
        </div>
      </div>
    </div>
  </div>
<script src="//lib.baomitu.com/jquery/1.12.4/jquery.min.js"></script>
<script src="//lib.baomitu.com/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="//lib.baomitu.com/layer/2.3/layer.js"></script>
<script src="//lib.baomitu.com/FileSaver.js/2014-11-29/FileSaver.min.js"></script>
<script src="//lib.baomitu.com/clipboard.js/1.7.1/clipboard.min.js"></script>
<script>
	$("#saveas-bt").on("click", function () {
		var txt = $("#txt_0").val();
		if (txt.indexOf('\r\n') < 0) {
			txt = txt.replace(/\n/g, "\r\n");
		}
		var fileName = (new Date()).toISOString().substr(0, 10) + ".txt";
		var file = new File([txt], fileName, { type: "text/plain;charset=utf-8" });
		saveAs(file);
	});
	var clipboard = new Clipboard('#clipboard_btn');
	clipboard.on('success', function (e) {
		layer.msg('复制成功')
	});
	clipboard.on('error', function (e) {
		layer.msg('复制失败')
	});
</script>
</body>
</html>