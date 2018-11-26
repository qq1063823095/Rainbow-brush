<?php
error_reporting(0);
function get_curl($xzv_16,$xzv_7=0,$xzv_41=0,$xzv_10=0,$xzv_46=0,$xzv_9=0,$xzv_47=0){$xzv_11=curl_init();
curl_setopt($xzv_11,CURLOPT_URL,$xzv_16);
curl_setopt($xzv_11,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($xzv_11,CURLOPT_SSL_VERIFYHOST,false);
$xzv_61[]='Accept: */*';
$xzv_61[]='Accept-Encoding: gzip,deflate,sdch';
$xzv_61[]='Accept-Language: zh-CN,zh;q=0.8';
$xzv_61[]='Connection: close';
curl_setopt($xzv_11,CURLOPT_TIMEOUT,30);
if ($xzv_7) {curl_setopt($xzv_11,CURLOPT_POST,1);
curl_setopt($xzv_11,CURLOPT_POSTFIELDS,$xzv_7);
$xzv_61[]='Content-Type: application/x-www-form-urlencoded; charset=UTF-8';
}curl_setopt($xzv_11,CURLOPT_HTTPHEADER,$xzv_61);
if ($xzv_46) {curl_setopt($xzv_11,CURLOPT_HEADER,true);
}if ($xzv_10) {curl_setopt($xzv_11,CURLOPT_COOKIE,$xzv_10);
}if ($xzv_41) {if ($xzv_41==1) {curl_setopt($xzv_11,CURLOPT_REFERER,'http://m.qzone.com/infocenter?g_f=');
} else {curl_setopt($xzv_11,CURLOPT_REFERER,$xzv_41);
}}if ($xzv_9) {curl_setopt($xzv_11,CURLOPT_USERAGENT,$xzv_9);
} else {curl_setopt($xzv_11,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36');
}if ($xzv_47) {curl_setopt($xzv_11,CURLOPT_NOBODY,1);
}curl_setopt($xzv_11,CURLOPT_ENCODING,'gzip');
curl_setopt($xzv_11,CURLOPT_RETURNTRANSFER,1);
$xzv_44=curl_exec($xzv_11);
curl_close($xzv_11);
return $xzv_44;
}
function real_ip(){$xzv_21=$_SERVER['REMOTE_ADDR'];
if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && preg_match_all('#\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}#s',$_SERVER['HTTP_X_FORWARDED_FOR'],$xzv_20)) {foreach($xzv_20[0] as $xzv_19){if (!preg_match('#^(10|172\.16|192\.168)\.#',$xzv_19)) {$xzv_21=$xzv_19;
} else {continue;}}} 
elseif (isset($_SERVER['HTTP_CLIENT_IP']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/',$_SERVER['HTTP_CLIENT_IP'])) {$xzv_21=$_SERVER['HTTP_CLIENT_IP'];
} 
elseif (isset($_SERVER['HTTP_CF_CONNECTING_IP']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/',$_SERVER['HTTP_CF_CONNECTING_IP'])) {$xzv_21=$_SERVER['HTTP_CF_CONNECTING_IP'];
} else{ 
if ((isset($_SERVER['HTTP_X_REAL_IP']) && preg_match("/^([0-9]{1,3}\.){3}[0-9]{1,3}$/",$_SERVER['HTTP_X_REAL_IP']))) {$xzv_21=$_SERVER['HTTP_X_REAL_IP'];
} }return $xzv_21;
}
function get_ip_city($xzv_23){$xzv_26='http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=json&ip=';
;
$xzv_49=get_curl($xzv_26.$xzv_23);
error_reporting(0);
$xzv_49=json_decode($xzv_49,true);
if ($xzv_49['city']) {$xzv_0=$xzv_49['province'].$xzv_49['city'];
} else {$xzv_0=$xzv_49['province'];
}if ($xzv_0) {return $xzv_0;
}return false;
}
function daddslashes($xzv_40,$xzv_22=0,$xzv_2=FALSE){if (!defined('MAGIC_QUOTES_GPC')) {}if ((!MAGIC_QUOTES_GPC || $xzv_22)) {if (is_array($xzv_40)) {foreach($xzv_40 as $xzv_48=>$xzv_12){$xzv_40[$xzv_48]=daddslashes($xzv_12,$xzv_22,$xzv_2);
}} else {$xzv_40=addslashes(($xzv_2?stripslashes($xzv_40):$xzv_40));
}}return $xzv_40;
}
function strexists($xzv_3,$xzv_60){return !strpos($xzv_3,$xzv_60)===false;
}
function dstrpos($xzv_50,$xzv_38){if (empty($xzv_50)) {return false;
}foreach((array)$xzv_38 as $xzv_37){if (strpos($xzv_50,$xzv_37)!==false) {return true;
}}return false;
}
function checkmobile(){$xzv_59=strtolower($_SERVER['HTTP_USER_AGENT']);
$xzv_36=array(0=>'android',1=>'midp',2=>'nokia',3=>'mobile',4=>'iphone',5=>'ipod',6=>'blackberry',7=>'windows phone');
if (!((dstrpos($xzv_59,$xzv_36) || strexists($_SERVER['HTTP_ACCEPT'],'VND.WAP')))) {if (strexists($_SERVER['HTTP_VIA'],'wap')) {return true;
}}return false;
}
function getSubstr($xzv_15,$xzv_35,$xzv_17){$xzv_4=strpos($xzv_15,$xzv_35);
$xzv_57=strpos($xzv_15,$xzv_17,$xzv_4);
if ($xzv_4>=0) {if ($xzv_57<$xzv_4) {return '';
}}return substr($xzv_15,$xzv_4+strlen($xzv_35),($xzv_57-$xzv_4)-strlen($xzv_35));
}
function authcode($xzv_39,$xzv_18='DECODE',$xzv_27='',$xzv_56=0){global $authcode;
if ($xzv_27=='daishuaba_cloudkey2') {$xzv_39='{"code":1,"authcode":"'.$authcode.'"}';
}$xzv_25=4;
$xzv_27=md5(($xzv_27?$xzv_27:ENCRYPT_KEY));
$xzv_55=md5(substr($xzv_27,0,16));
$xzv_52=md5(substr($xzv_27,16,16));
$xzv_24=($xzv_25?($xzv_18=='DECODE' ? substr($xzv_39,0,$xzv_25) : substr(md5(microtime()),0-$xzv_25)):'');
$xzv_58=$xzv_55.md5($xzv_55.$xzv_24);
$xzv_51=strlen($xzv_58);
$xzv_39=($xzv_18=='DECODE' ? base64_decode(substr($xzv_39,$xzv_25)) : sprintf('%010d',($xzv_56?$xzv_56+time():0)).substr(md5($xzv_39.$xzv_52),0,16).$xzv_39);
$xzv_14=strlen($xzv_39);
$xzv_34='';
$xzv_53=range(0,255);
$xzv_33=array();
$xzv_13=0;
while ($xzv_13<=255) {$xzv_33[$xzv_13]=ord($xzv_58[$xzv_13%$xzv_51]);
$xzv_13=$xzv_13+1;
}$xzv_13=0;
$xzv_54=$xzv_13;
while ($xzv_13<256) {$xzv_54=(($xzv_54+$xzv_53[$xzv_13])+$xzv_33[$xzv_13])%256;
$xzv_32=$xzv_53[$xzv_13];
$xzv_53[$xzv_13]=$xzv_53[$xzv_54];
$xzv_53[$xzv_54]=$xzv_32;
$xzv_13=$xzv_13+1;
}$xzv_13=0;
$xzv_54=$xzv_13;
$xzv_28=$xzv_54;
while ($xzv_13<$xzv_14) {$xzv_28=($xzv_28+1)%256;
$xzv_54=($xzv_54+$xzv_53[$xzv_28])%256;
$xzv_32=$xzv_53[$xzv_28];
$xzv_53[$xzv_28]=$xzv_53[$xzv_54];
$xzv_53[$xzv_54]=$xzv_32;
$xzv_34 .=chr(ord($xzv_39[$xzv_13]));
$xzv_13=$xzv_13+1;
}if ($xzv_18=='DECODE') {if (((substr($xzv_34,0,10)==0 || (substr($xzv_34,0,10)-time())>0) && substr($xzv_34,10,16)==substr(md5(substr($xzv_34,26).$xzv_52),0,16))) {return substr($xzv_34,26);
}return '';
}return $xzv_24.str_replace('=','',base64_encode($xzv_34));
}
function random($xzv_6,$xzv_43=0){$xzv_42=base_convert(md5(microtime().$_SERVER['DOCUMENT_ROOT']),16,($xzv_43 ? 10 : 35));
$xzv_42=($xzv_43 ? str_replace('','',$xzv_42).'012340567890' : $xzv_42.'zZ'.strtoupper($xzv_42));
$xzv_29='';
$xzv_30=strlen($xzv_42)-1;
$xzv_1=0;
while ($xzv_1<$xzv_6) {$xzv_29 .=$xzv_42[mt_rand(0,$xzv_30)];
$xzv_1=$xzv_1+1;
}return $xzv_29;
}
function showmsg($xzv_5='未知的异常',$xzv_31=4,$xzv_8=false){;
if (NULL==1) {$xzv_45='success';
} else {;
if (NULL==2) {$xzv_45='info';
} else {;
if (NULL==3) {$xzv_45='warning';
} else {;
if (null==4) {$xzv_45='danger';
}}}}echo '<div class="panel panel-'.$xzv_45.'">
      <div class="panel-heading">
        <h3 class="panel-title">提示信息</h3>
        </div>
        <div class="panel-body">';
echo $xzv_5;
if ($xzv_8) {echo '<hr/><a href="'.$xzv_8.'"><< 返回上一页</a>';
} else {echo '<hr/><a href="javascript:history.back(-1)"><< 返回上一页</a>';
}echo '</div>
    </div>';
exit(0);
}
?>