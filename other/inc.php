<?php
error_reporting(0);
define('IN_CRONLITE', true);
define('IN_OTHER', true);
define('CACHE_FILE', 0);
define('SYSTEM_ROOT', dirname(__FILE__).'/');
define('ROOT', dirname(SYSTEM_ROOT).'/');
date_default_timezone_set('Asia/Shanghai');
$date = date("Y-m-d H:i:s");

if (function_exists("set_time_limit"))
{
	@set_time_limit(0);
}
if (function_exists("ignore_user_abort"))
{
	@ignore_user_abort(true);
}

$scriptpath=str_replace('\\','/',$_SERVER['SCRIPT_NAME']);
$sitepath = substr($scriptpath, 0, strrpos($scriptpath, '/'));
$siteurl = ($_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://').$_SERVER['HTTP_HOST'].$sitepath.'/';

require ROOT.'config.php';
//连接数据库
include_once(ROOT."includes/db.class.php");
$DB=new DB($dbconfig['host'],$dbconfig['user'],$dbconfig['pwd'],$dbconfig['dbname'],$dbconfig['port']);

include ROOT.'includes/cache.class.php';
$CACHE=new CACHE();
$conf=unserialize($CACHE->read());
if(empty($conf['version']))$conf=$CACHE->update();

include ROOT.'includes/authcode.php';
define('authcode',$authcode);
define('DIST_ID',hexdec($distid));
include ROOT.'includes/price.class.php';
include ROOT.'includes/function.php';
if(file_exists(ROOT."includes/extend.class.php")){
	include_once(ROOT."includes/extend.class.php");
}
include ROOT.'includes/core.func.php';

$clientip=real_ip();
$payapi = pay_api();

function showalert($msg,$status,$orderid=null,$tid=0){
	if($tid==-1)$link = '../user/';
	elseif($tid==-2)$link = '../user/regok.php?orderid='.$orderid;
	else $link = '../?buyok=1';
	echo '<meta charset="utf-8"/><script>alert("'.$msg.'");window.location.href="'.$link.'";</script>';
}