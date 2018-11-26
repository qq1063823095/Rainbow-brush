<?php
require './inc.php';

$trade_no=isset($_GET['trade_no'])?daddslashes($_GET['trade_no']):exit('No trade_no!');

@header('Content-Type: text/html; charset=UTF-8');

$row=$DB->get_row("SELECT * FROM shua_pay WHERE trade_no='{$trade_no}' limit 1");
if($row['domain'] && $row['domain']!=$_SERVER['HTTP_HOST']){
	$baseurl = 'http://'.$row['domain'].'/';
}else{
	$baseurl = '../';
}
if($row['tid']==-1)$link = $baseurl.'user/';
elseif($row['tid']==-2)$link = $baseurl.'user/regok.php?orderid='.$trade_no;
else $link = $baseurl.'?buyok=1';

if($row['status']>=1){
	exit('{"code":1,"msg":"付款成功","backurl":"'.$link.'"}');
}else{
	exit('{"code":-1,"msg":"未付款"}');
}
?>