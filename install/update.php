<?php
$install = true;
require_once('../includes/common.php');
@header('Content-Type: text/html; charset=UTF-8');
if($conf['version']<1039){
	exit('网站程序版本太旧，不支持直接升级');
}elseif($conf['version']<1043){
	$trade_no = date("YmdHis",strtotime("-7 days")).'000';
	$DB->query("DELETE FROM `shua_pay` WHERE `trade_no`<'$trade_no'");
	$DB->query("OPTIMIZE TABLE `shua_pay`");
	echo '已完成清理支付记录表<br/>';
	flush();
	ob_flush();
	$DB->query("DELETE FROM `shua_logs` WHERE `addtime`<'".date("Y-m-d H:i:s",strtotime("-7 days"))."'");
	$DB->query("OPTIMIZE TABLE `shua_logs`");
	echo '已完成清理日志表<br/>';
	flush();
	ob_flush();
	$DB->query("DELETE FROM `shua_orders` WHERE `addtime`<'".date("Y-m-d H:i:s",strtotime("-45 days"))."'");
	$DB->query("OPTIMIZE TABLE `shua_orders`");
	$DB->query("OPTIMIZE TABLE `shua_tixian`");
	$DB->query("OPTIMIZE TABLE `shua_points`");
	echo '已完成清理订单表<br/>';
	flush();
	ob_flush();
	$sqls = file_get_contents('update6.sql');
	$version = 1043;
	$rs=$DB->query("SELECT * FROM shua_tools order by sort asc");
	$shua_func=array();
	$i=1;
	while($res = $DB->fetch($rs)){
		$shua_func[$i++]=$res['tid'];
	}
	foreach($shua_func as $k=>$v){
		$DB->query("update shua_tools set sort={$k} where tid='{$v}'");
	}
	echo '已完成商品数据表转换<br/>';
	flush();
	ob_flush();
	saveSetting('syskey',random(32));
	saveSetting('template','default');
}elseif($conf['version']<1051){
	$sqls = file_get_contents('update7.sql');
	$version = 1051;
}elseif($conf['version']<1051){
	$sqls = file_get_contents('update7.sql');
	$version = 1051;
}elseif($conf['version']<1053){
	$sqls = file_get_contents('update8.sql');
	$version = 1053;
}elseif($conf['version']<1056){
	$sqls = file_get_contents('update9.sql');
	$version = 1056;
}else{
	exit('你的网站已经升级到最新版本了');
}
$explode = explode(';', $sqls);
$num = count($explode);
foreach ($explode as $sql) {
    if ($sql = trim($sql)) {
        $DB->query($sql);
    }
}
saveSetting('version',$version);
$CACHE->clear();
exit("<script language='javascript'>alert('网站数据库升级完成！');window.location.href='../';</script>");
?>
