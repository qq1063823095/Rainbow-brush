<?php
include("../includes/common.php");

if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");

$tid=intval($_GET['tid']);
$status=intval($_GET['status']);
$sign=intval($_GET['sign']);
$orderby=($_GET['orderby']==1)?"desc":"asc";

$tool=$DB->get_row("SELECT * FROM shua_tools WHERE tid='$tid' limit 1");
$value=$tool['value']>0?$tool['value']:1;

$date=date("Y-m-d");
$data='';

$rs=$DB->query("SELECT * FROM shua_orders WHERE tid='{$tid}' and status={$status} order by addtime {$orderby} limit 1000");

while($row = $DB->fetch($rs))
{
	$data.=$row['input'] . ($row['input2']?'----'.$row['input2']:null) . ($row['input3']?'----'.$row['input3']:null) . ($row['input4']?'----'.$row['input4']:null) . ($row['input5']?'----'.$row['input5']:null) . '----' . $row['value']*$value."\r\n";
	if($sign>0)$DB->query("update `shua_orders` set status={$sign} where `id`='{$row['id']}'");
}

$file_name='output_'.$tid.'_'.$date.'__'.time().'.txt';
$file_size=strlen($data);
header("Content-Description: File Transfer");
header("Content-Type:application/force-download");
header("Content-Length: {$file_size}");
header("Content-Disposition:attachment; filename={$file_name}");
echo $data;
?>