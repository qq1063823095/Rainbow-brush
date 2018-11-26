<?php
/**
 * 自助升级站点
**/
include("../includes/common.php");
$title='自助升级站点';
include './head.php';
if($islogin2==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>
  <div class="container" style="padding-top:70px;">
    <div class="col-xs-12 col-sm-10 col-md-8 col-lg-6 center-block" style="float: none;">
<?php
if(!$conf['fenzhan_upgrade'])showmsg('当前站点未开启此功能');
$price = $conf['fenzhan_upgrade'];
if($userrow['upzid']>1){
	$ktfz_price2 = $DB->get_column("select ktfz_price2 from shua_site where zid='{$userrow['upzid']}' limit 1");
	if($ktfz_price2 && $ktfz_price2>0){
		$price = $ktfz_price2;
	}
}
if($_GET['act']=='submit'){
	if($price>$userrow['rmb'])exit("<script language='javascript'>alert('你的余额不足，请充值！');window.location.href='./';</script>");
	$DB->query("update `shua_site` set `power`=1,`rmb`=`rmb`-{$price} where `zid`='{$userrow['zid']}'");
	addPointRecord($userrow['zid'], $price, '消费', '升级到专业版分站');
	exit("<script language='javascript'>alert('恭喜你成功升级站点版本！');window.location.href='index.php';</script>");
}
?>
	  <div class="panel panel-default text-center" id="recharge">
		<div class="panel-heading">
			<h2 class="panel-title">自助升级站点</h2>
		</div>
		<div class="panel-body">
			<div class="form-group">
				<div class="input-group">
					<div class="input-group-addon">
						选择要升级的版本
					</div>
					<select name="kind" class="form-control"><option value="1">专业版</option></select>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
					<div class="input-group-addon">
						升级所需
					</div>
					<input name="need" class="form-control" value="<?php echo $price?>" disabled/>
					<div class="input-group-addon">
						元
					</div>
				</div>
			</div>
			<a class="btn btn-success" href="?act=submit">立即购买</a>
		</div>
	</div>
  </div>
</div>