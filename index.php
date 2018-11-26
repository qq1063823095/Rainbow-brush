<?php
$is_defend=true;
include("./includes/common.php");

if(isset($_GET['i']) && !isset($_COOKIE['invite']) && $conf['invite_tid']){
	processInvite(daddslashes($_GET['i']));
}
@header('Content-Type: text/html; charset=UTF-8');
if($conf['fenzhan_page']==1 && !empty($conf['fenzhan_remain']) && !in_array($domain,explode(',',$conf['fenzhan_remain'])) && $is_fenzhan==false){
	include ROOT.'template/default/404.html';
	exit;
}

$qq=isset($_GET['qq'])?strip_tags($_GET['qq']):null;

$addsalt=md5(mt_rand(0,999).time());
$_SESSION['addsalt']=$addsalt;
include_once(SYSTEM_ROOT."hieroglyphy.class.php");
$x = new hieroglyphy();
$addsalt_js = $x->hieroglyphyString($addsalt);

$rs=$DB->query("SELECT * FROM shua_class WHERE active=1 order by sort asc");
$select='<option value="0">请选择分类</option>';
$shua_class=array();
while($res = $DB->fetch($rs)){
	$shua_class[$res['cid']]=$res['name'];
	$select.='<option value="'.$res['cid'].'">'.$res['name'].'</option>';
}
if(count($shua_class)==0)$classhide = true;

$select2='<option value="0">请选择商品</option>';

if($is_fenzhan==true && file_exists(ROOT.'assets/img/logo_'.$conf['zid'].'.png')){
	$logo = 'assets/img/logo_'.$conf['zid'].'.png';
}else{
	$logo = 'assets/img/logo.png';
}
if($conf['cdnserver']==1){
	$cdnserver = '//cdn.qqzzz.net/';
}else{
	$cdnserver = null;
}

if(!empty($conf['gg_announce']))$conf['anounce']=$conf['gg_announce'].$conf['anounce'];

if($is_fenzhan == true && $siterow['power']==1 && $siterow['ktfz_price']>0){
	$conf['fenzhan_price']=$siterow['ktfz_price'];
	if($conf['fenzhan_cost2']<=0)$conf['fenzhan_cost2']=$conf['fenzhan_price2'];
	if($siterow['ktfz_price2']>0 && $siterow['ktfz_price2']>=$conf['fenzhan_cost2'])$conf['fenzhan_price2']=$siterow['ktfz_price2'];
}

if($conf['ui_bing']==1){
	$background_image='//index-css.skyhost.cn/cdn/zip-img/'.rand(1,19).'.jpg!gzipimgw';
	$conf['ui_background']=3;
}elseif($conf['ui_bing']==2){
	if(date("Ymd")==$conf['ui_bing_date']){
		$background_image=$conf['ui_backgroundurl'];
		if(checkmobile()==true)$background_image=str_replace('1920x1080','768x1366',$background_image);
	}else{
		$url = 'http://cn.bing.com/HPImageArchive.aspx?format=js&idx=0&n=1';
		$bing_data = get_curl($url);
		$bing_arr=json_decode($bing_data,true);
		if (!empty($bing_arr['images'][0]['url'])) {
			$background_image='//cn.bing.com'.$bing_arr['images'][0]['url'];
			saveSetting('ui_backgroundurl', $background_image);
			saveSetting('ui_bing_date', date("Ymd"));
			$CACHE->clear();
			if(checkmobile()==true)$background_image=str_replace('1920x1080','768x1366',$background_image);
		}
	}
	$conf['ui_background']=3;
}else{
	$background_image='assets/img/bj.png';
}
if($conf['ui_background']==0)
$repeat='background-repeat:repeat;';
elseif($conf['ui_background']==1)
$repeat='background-repeat:repeat-x;
background-size:auto 100%;';
elseif($conf['ui_background']==2)
$repeat='background-repeat:repeat-y;
background-size:100% auto;';
elseif($conf['ui_background']==3)
$repeat='background-repeat:no-repeat;
background-size:100% 100%;';

$mod = isset($_GET['mod'])?$_GET['mod']:'index';
$loadfile = Template::load($mod);
include $loadfile;