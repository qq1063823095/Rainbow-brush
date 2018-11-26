<?php
if(!defined('IN_CRONLITE'))exit();
if($_GET['buyok']==1){include_once TEMPLATE_ROOT.'table/query.php';exit;}
$tcount = $DB->count("SELECT count(*) FROM shua_tools WHERE active=1");
$num = 0;
$flag = 0;
if($is_fenzhan == true){
	$price_obj = new Price($siterow['zid'],$siterow);
}
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
        <button type="button" class="btn btn-default" data-dismiss="modal">知道了</button>
      </div>
    </div>
  </div>
</div>

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
	  <li class="active"><a href="./"><span class="glyphicon glyphicon-home"></span>&nbsp;下单首页</a></li>
	  <li class=""><a href="./?mod=query"><span class="glyphicon glyphicon-search"></span>&nbsp;查询订单</a></li>
	  <?php if($conf['fenzhan_buy']==1){?><li class=""><a href="./user/"><span class="glyphicon glyphicon-cog"></span>&nbsp;分站后台</a></li>
	  </ul><?php }?>
  </div>
  </div>
</div>
  
<div class="container" style="margin-top: 60px">
 
<div class="row">
       <div class="col-md-12">
<div class="panel panel-primary">
    <div class="panel-heading" align="center">
        <h3 class="panel-title"><a data-toggle="collapse" href="#collapseA">公告</a></h3>
    </div>
<div id="collapseA" class="panel-collapse collapse in">
<?php echo $conf['anounce']?> </div>
</div>
       </div>
</div>

<div class="row">
	<div class="col-md-4">

<?php foreach($shua_class as $cid=>$classname){?>
<div class="panel panel-primary">
    <div class="panel-heading" align="center">
        <h3 class="panel-title"><a data-toggle="collapse" href="#collapse<?php echo $cid?>"><?php echo $classname?></a></h3>
    </div>
	<div id="collapse<?php echo $cid?>" class="panel-collapse collapse in">
        <table class="table table-bordered table-striped">     
          <tbody>
<?php
$rs=$DB->query("SELECT * FROM shua_tools WHERE cid='$cid' and active=1 order by sort asc");
while($res = $DB->fetch($rs)){
	$num++;
	if($is_fenzhan == true){
		$price_obj->setToolInfo($res['tid'],$res);
		if($price_obj->getToolDel($res['tid'])==1)continue;
		$price=$price_obj->getToolPrice($res['tid']);
	}else $price=$res['price'];
	echo '<tr>
<td>'.$res['name'].'</td>
<td align="center"><font color="#ff3333"><b>'.$price.'</b></font>元<font color="#ff3333">'.($res['value']?$res['value']:1).'</font>个</td>
<td align="center">'.($res['is_curl']==4?'<a href="./?mod=buy&cid='.$cid.'&tid='.$res['tid'].'" class="btn btn-success btn-xs" style="background:#4faf1b">自动发卡</a>':'<a href="./?mod=buy&cid='.$cid.'&tid='.$res['tid'].'" class="btn btn-danger btn-xs" style="background:#ff803a">自动充值</a>').'</td>
</tr>';
	if($num == intval($tcount/3) || $num == intval($tcount/3*2))$flag = 1;
}
?>         
			</tbody>
        </table>
	</div>
</div>
<?php
if($flag==1){echo '</div><div class="col-md-4">
';$flag = 0;}
}?>
	</div>
</div>

<p style="text-align:center"><span style="font-weight:bold">CopyRight <i class="fa fa-heart text-danger"></i> 2018 <a href="/"><?php echo $conf['sitename']?></a></span></p>

<script src="//lib.baomitu.com/jquery/1.12.4/jquery.min.js"></script>
<script src="//lib.baomitu.com/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="//lib.baomitu.com/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script src="//lib.baomitu.com/layer/2.3/layer.js"></script>

<script type="text/javascript">
var isModal=<?php echo empty($conf['modal'])?'false':'true';?>;
var homepage=true;
var hashsalt=<?php echo $addsalt_js?>;
</script>
<script src="assets/js/main.js?ver=<?php echo VERSION ?>"></script>
</body>
</html>