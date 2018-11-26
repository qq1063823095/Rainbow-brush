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
<div class="container">
<div class="col-xs-12 col-sm-10 col-md-8 col-lg-6 center-block" style="float: none;">
<div class="panel panel-danger">
<div class="panel-heading" style="text-align: center;"><h3 class="panel-title">
	全民K歌获取歌曲ID</h3></div>
<div class="panel-body" style="text-align: center;">
	<div class="list-group">
		<div class="list-group-item">
			<div id="myTabContent" class="tab-content">
			<div class="tab-pane fade in active">
				<div class="form-group">
					<input type="text" name="url" id="url" value="" class="form-control" placeholder="请输入歌曲的分享链接" required="">
				</div>
				<div class="form-group" style="display:none;" id="song_v">
					<div class="input-group"><div class="input-group-addon">歌曲ID</div>
					<input type="text" id="songid" value="" class="form-control" required="">
				</div></div>
				<input type="submit" onclick="getsongid()" id="getsongid" class="btn btn-info btn-block" value="立即获取">
			</div>
			</div>
		</div>
		</div>
	</div>
<div class="panel-footer">
<span class="glyphicon glyphicon-info-sign"></span>
进入全民K歌-选择歌曲-分享-复制链接
</div>
</div>
</div>
<div class="col-xs-12 col-sm-10 col-md-8 col-lg-6 center-block" style="float: none;">
<div class="panel panel-info">
<div class="panel-heading" style="text-align: center;"><h3 class="panel-title">
	获取快手ID</h3></div>
<div class="panel-body" style="text-align: center;">
	<div class="list-group">
		<div class="list-group-item">
			<div id="myTabContent" class="tab-content">
			<div class="tab-pane fade in active">
				<div class="form-group">
					<input type="text"id="kuaishou_url" value="" class="form-control" placeholder="请输入快手作品链接" required="">
				</div>
				<div  style="display:none;" id="kuaishou_v">
				<div class="form-group">
					<div class="input-group"><div class="input-group-addon">作者ID</div>
					<input type="text" id="anotherid" value="" class="form-control" required="">
				</div></div>
				<div class="form-group">
					<div class="input-group"><div class="input-group-addon">作品ID</div>
					<input type="text" id="videoid" value="" class="form-control" required="">
				</div></div>
				</div>
				<input type="submit" onclick="getkuaishouid()" id="getkuaishouid" class="btn btn-danger btn-block" value="立即获取">
			</div>
			</div>
		</div>
		</div>
	</div>
<div class="panel-footer">
<span class="glyphicon glyphicon-info-sign"></span>
进入快手，选择一个作品，分享，复制链接
</div>
</div>
</div>
<script src="//lib.baomitu.com/jquery/1.12.4/jquery.min.js"></script>
<script src="//lib.baomitu.com/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript">
function getsongid(){
	var songurl=$("#url").val();
	if(songurl==''){alert('请确保每项不能为空！');return false;}
	if(songurl.indexOf('.qq.com')<0){alert('请输入正确的歌曲的分享链接！');return false;}
	$('#song_v').hide();
	try{
		var songid = songurl.split('s=')[1].split('&')[0];
	}catch(e){
		alert('请输入正确的歌曲的分享链接！');return false;
	}
	$('#songid').val(songid);
	$('#song_v').slideDown();
}
function getkuaishouid(){
	var kuauishouurl=$("#kuaishou_url").val();
	if(kuauishouurl==''){alert('请确保每项不能为空！');return false;}
	if(kuauishouurl.indexOf('gifshow.com')<0 && kuauishouurl.indexOf('kuaishou.com')<0){alert('请输入正确的快手作品链接！');return false;}
	$('#kuaishou_v').hide();
	try{
		if(kuauishouurl.indexOf('userId=')>0){
			var anotherid = kuauishouurl.split('userId=')[1].split('&')[0];
		}else{
			var anotherid = kuauishouurl.split('photo/')[1].split('/')[0];
		}
		if(kuauishouurl.indexOf('photoId=')>0){
			var videoid = kuauishouurl.split('photoId=')[1].split('&')[0];
		}else{
			var videoid = kuauishouurl.split('photo/')[1].split('/')[1].split('?')[0];
		}
	}catch(e){
		alert('请输入正确的快手作品链接！');return false;
	}
	$('#anotherid').val(anotherid);
	$('#videoid').val(videoid);
	$('#kuaishou_v').slideDown();
}
</script>
</body>
</html>