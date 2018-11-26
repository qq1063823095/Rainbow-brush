<?php
include("../includes/common.php");
if($islogin2==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
$act=isset($_GET['act'])?daddslashes($_GET['act']):null;

@header('Content-Type: application/json; charset=UTF-8');

$price_obj = new Price($userrow['zid'],$userrow);

switch($act){
case 'captcha':
	require_once SYSTEM_ROOT.'class.geetestlib.php';
	$GtSdk = new GeetestLib($conf['captcha_id'], $conf['captcha_key']);
	$data = array(
		'user_id' => $cookiesid, # 网站用户id
		'client_type' => "web", # web:电脑上的浏览器；h5:手机上的浏览器，包括移动应用内完全内置的web_view；native：通过原生SDK植入APP应用的方式
		'ip_address' => $clientip # 请在此处传输用户请求验证时所携带的IP
	);
	$status = $GtSdk->pre_process($data, 1);
	$_SESSION['gtserver'] = $status;
	$_SESSION['user_id'] = $cookiesid;
	echo $GtSdk->get_response_str();
break;
case 'gettool':
	if(isset($_POST['kw'])){
		$kw=trim(daddslashes($_POST['kw']));
		$rs=$DB->query("SELECT * FROM shua_tools WHERE name LIKE '%{$kw}%' and active=1 order by sort asc");
	}else{
		$cid=intval($_GET['cid']);
		$rs=$DB->query("SELECT * FROM shua_tools WHERE cid='$cid' and active=1 order by sort asc");
	}
	$data = array();
	while($res = $DB->fetch($rs)){
		$price_obj->setToolInfo($res['tid'],$res);
		$price=$price_obj->getBuyPrice($res['tid']);
		$data[]=array('tid'=>$res['tid'],'sort'=>$res['sort'],'name'=>$res['name'],'value'=>$res['value'],'price'=>$price,'input'=>$res['input'],'inputs'=>$res['inputs'],'alert'=>$res['alert'],'repeat'=>$res['repeat'],'multi'=>$res['multi'],'isfaka'=>$res['is_curl']==4?1:0);
	}
	$result=array("code"=>0,"msg"=>"succ","data"=>$data);
	exit(json_encode($result));
break;
case 'getleftcount':
	$tid=intval($_POST['tid']);
	$count = $DB->count("SELECT count(*) FROM shua_faka WHERE tid='$tid' and orderid=0");
	$result=array("code"=>0,"count"=>$count);
	exit(json_encode($result));
break;
case 'pay':
	$tid=intval($_POST['tid']);
	$inputvalue=trim(strip_tags(daddslashes($_POST['inputvalue'])));
	$inputvalue2=trim(strip_tags(daddslashes($_POST['inputvalue2'])));
	$inputvalue3=trim(strip_tags(daddslashes($_POST['inputvalue3'])));
	$inputvalue4=trim(strip_tags(daddslashes($_POST['inputvalue4'])));
	$inputvalue5=trim(strip_tags(daddslashes($_POST['inputvalue5'])));
	$num=isset($_POST['num'])?intval($_POST['num']):1;
	$hashsalt=isset($_POST['hashsalt'])?$_POST['hashsalt']:null;
	$tool=$DB->get_row("select * from shua_tools where tid='$tid' limit 1");
	if($tool && $tool['active']==1){
		if(in_array($inputvalue,explode("|",$conf['blacklist'])))exit('{"code":-1,"msg":"你的下单账号已被拉黑，无法下单！"}');
		if($conf['verify_open']==1 && (empty($_SESSION['addsalt']) || $hashsalt!=$_SESSION['addsalt'])){
			exit('{"code":-1,"msg":"验证失败，请刷新页面重试"}');
		}
		if($tool['is_curl']==4){
			if(!preg_match('/^[A-z0-9._-]+@[A-z0-9._-]+\.[A-z0-9._-]+$/', $inputvalue)){
				exit('{"code":-1,"msg":"邮箱格式不正确"}');
			}
			$count = $DB->count("SELECT count(*) FROM shua_faka WHERE tid='$tid' and orderid=0");
			if($count==0)exit('{"code":-1,"msg":"该商品库存卡密不足，请联系站长加卡！"}');
			if($num>$count)exit('{"code":-1,"msg":"你所购买的数量超过库存数量！"}');
		}
		elseif($tool['repeat']==0){
			$thtime=date("Y-m-d").' 00:00:00';
			$row=$DB->get_row("select * from shua_orders where tid='$tid' and input='$inputvalue' order by id desc limit 1");
			if($row['input'] && $row['status']==0)
				exit('{"code":-1,"msg":"您今天添加的'.$tool['name'].'正在排队中，请勿重复提交！"}');
			elseif($row['addtime']>$thtime)
				exit('{"code":-1,"msg":"您今天已添加过'.$tool['name'].'，请勿重复提交！"}');
		}
		if($tool['validate']==1 && is_numeric($inputvalue)){
			if(validate_qzone($inputvalue)==false)
				exit('{"code":-1,"msg":"你的QQ空间设置了访问权限，无法下单！"}');
		}
		if($tool['multi']==0 || $num<1)$num = 1;
		$price_obj->setToolInfo($tid,$tool);
		$price=$price_obj->getBuyPrice($tid);
		$need=$price*$num;
		if($need>$userrow['rmb'])exit('{"code":-1,"msg":"你的余额不足，请充值！"}');
		//if($price<0.1)exit('{"code":-1,"msg":"当前商品不支持分站后台下单！"}');
		if($need==0){
			$thtime=date("Y-m-d").' 00:00:00';
			if($_SESSION['blockfree']==true || $DB->count("SELECT count(*) FROM `shua_pay` WHERE `tid`='$tid' and `money`=0 and `ip`='$clientip' and `status`=1 and `endtime`>'$thtime'")>=1){
				exit('{"code":-1,"msg":"您今天已领取过，请明天再来！"}');
			}
			if($conf['captcha_open']==1){
				if(isset($_POST['geetest_challenge']) && isset($_POST['geetest_validate']) && isset($_POST['geetest_seccode'])){
					require_once SYSTEM_ROOT.'class.geetestlib.php';
					$GtSdk = new GeetestLib($conf['captcha_id'], $conf['captcha_key']);

					$data = array(
						'user_id' => $cookiesid,
						'client_type' => "web",
						'ip_address' => $clientip
					);

					if ($_SESSION['gtserver'] == 1) {   //服务器正常
						$result = $GtSdk->success_validate($_POST['geetest_challenge'], $_POST['geetest_validate'], $_POST['geetest_seccode'], $data);
						if ($result) {
							//echo '{"status":"success"}';
						} else{
							exit('{"code":-1,"msg":"验证失败，请重新验证"}');
						}
					}else{  //服务器宕机,走failback模式
						if ($GtSdk->fail_validate($_POST['geetest_challenge'],$_POST['geetest_validate'],$_POST['geetest_seccode'])) {
							//echo '{"status":"success"}';
						}else{
							exit('{"code":-1,"msg":"验证失败，请重新验证"}');
						}
					}
				}else{
					exit('{"code":2,"msg":"请先完成验证"}');
				}
			}
			$_SESSION['blockfree']=true;
		}

		$trade_no=date("YmdHis").rand(111,999).'RMB';
		$input=$inputvalue.($inputvalue2?'|'.$inputvalue2:null).($inputvalue3?'|'.$inputvalue3:null).($inputvalue4?'|'.$inputvalue4:null).($inputvalue5?'|'.$inputvalue5:null);
		$sql="insert into `shua_pay` (`trade_no`,`type`,`tid`,`zid`,`input`,`num`,`name`,`money`,`ip`,`userid`,`addtime`,`status`) values ('".$trade_no."','rmb','".$tid."','".($userrow['zid']?$userrow['zid']:1)."','".$input."','".$num."','".$tool['name']."','".$need."','".$clientip."','".$cookiesid."','".$date."','0')";
		if($DB->query($sql)){
			unset($_SESSION['addsalt']);
			exit('{"code":0,"msg":"提交订单成功！","trade_no":"'.$trade_no.'","need":"'.$need.'"}');
		}else{
			exit('{"code":-1,"msg":"提交订单失败！'.$DB->error().'"}');
		}
	}else{
		exit('{"code":-2,"msg":"该商品不存在"}');
	}
break;
case 'query':
	$qq=trim(daddslashes($_POST['qq']));
	$limit=isset($_POST['limit'])?intval($_POST['limit']):10;
	$rs=$DB->query("SELECT * FROM shua_tools WHERE 1 order by sort asc");
	while($res = $DB->fetch($rs)){
		$shua_func[$res['tid']]=$res['name'];
	}
	if(empty($qq))$sql=" userid='{$cookiesid}'";
	else $sql=" input='{$qq}'";
	$rs=$DB->query("SELECT * FROM shua_orders WHERE{$sql} order by id desc limit $limit");
	$data=array();
	while($res = $DB->fetch($rs)){
		$data[]=array('id'=>$res['id'],'tid'=>$res['tid'],'input'=>$res['input'],'name'=>$shua_func[$res['tid']],'value'=>$res['value'],'addtime'=>$res['addtime'],'endtime'=>$res['endtime'],'status'=>$res['status'],'skey'=>md5($res['id'].SYS_KEY.$res['id']));
	}
	$result=array("code"=>0,"msg"=>"succ","data"=>$data);
	exit(json_encode($result));
break;
case 'order': //订单进度查询
	$id=intval($_POST['id']);
	if(md5($id.SYS_KEY.$id)!==$_POST['skey'])exit('{"code":-1,"msg":"验证失败"}');
	$row=$DB->get_row("select * from shua_orders where id='$id' limit 1");
	if(!$row)
		exit('{"code":-1,"msg":"当前订单不存在！"}');
	$tool=$DB->get_row("select * from shua_tools where tid='{$row['tid']}' limit 1");
	if($tool['is_curl']==2){
		$shequ=$DB->get_row("select * from shua_shequ where id='{$tool['shequ']}' limit 1");
		if($shequ['type']==1){
			$list = yile_chadan($shequ['url'], $tool['goods_id'], $row['input'], $row['djorder']);
		}elseif($shequ['type']==0 || $shequ['type']==2){
			$list = jiuwu_chadan($shequ['url'], $shequ['username'], $shequ['password'], $row['djorder']);
		}elseif($shequ['type']==3 || $shequ['type']==5){
			$list = xmsq_chadan($shequ['url'], $tool['goods_id'], $row['input'], $row['djorder']);
		}elseif($shequ['type']==10){
			$list = qqbug_chadan($shequ['password'], $row['djorder']);
		}elseif($shequ['type']==11){
			$list = jumeng_chadan($shequ['url'], $row['djorder']);
		}elseif($shequ['type']==20){
			if(class_exists("ExtendAPI") && method_exists('ExtendAPI','chadan')){
				$list = ExtendAPI::chadan($shequ['url'], $shequ['username'], $shequ['password'], $row['djorder'], $tool['goods_id'], $row['input']);
			}
		}
		if($list['order_state']=='已完成' && $row['status']==2){
			$DB->query("update shua_orders set status=1 where id='{$id}'");
		}
	}elseif($tool['is_curl']==4){
		$count = $row['value'];
		if($count>6){
			$kmdata='<center><a href="../?mod=faka&id='.$id.'&skey='.$_POST['skey'].'" target="_blank" class="btn btn-sm btn-primary">点此查看卡密</a></center>';
		}else{
			$rs=$DB->query("SELECT * FROM shua_faka WHERE tid='{$row['tid']}' AND orderid='$id' LIMIT {$count}");
			$kmdata='';
			while($res = $DB->fetch($rs))
			{
				if(!empty($res['pw'])){
					$kmdata.='卡号：'.$res['km'].' 密码：'.$res['pw'].'<br/>';
				}else{
					$kmdata.=$res['km'].'<br/>';
				}
				if(strlen($res['km'].$res['pw'])>80){
					$kmdata='<center><a href="../?mod=faka&id='.$id.'&skey='.$_POST['skey'].'" target="_blank" class="btn btn-sm btn-primary">点此查看卡密</a></center>';
					break;
				}
			}
		}
	}
	$input=$tool['input']?$tool['input']:'下单QQ';
	if($tool['is_curl']==4)$input='联系方式';
	$inputs=explode('|',$tool['inputs']);
	$result=array('code'=>0,'msg'=>'succ','name'=>$tool['name'],'money'=>$row['money'],'date'=>$row['addtime'],'inputs'=>showInputs($row,$input,$inputs),'list'=>$list,'kminfo'=>$kmdata,'alert'=>$tool['alert']);
	exit(json_encode($result));
break;
case 'fill':
	$orderid=daddslashes($_POST['orderid']);
	if(md5($orderid.SYS_KEY.$orderid)!==$_POST['skey'])exit('{"code":-1,"msg":"验证失败"}');
	$row=$DB->get_row("select * from shua_orders where id='$orderid' limit 1");
	if($row){
		if($row['status']==3){
			$DB->query("update `shua_orders` set `status` ='0',result=NULL where `id`='{$orderid}'");
			$result=array("code"=>0,"msg"=>"已成功补交订单");
		}else{
			$result=array("code"=>0,"msg"=>"该订单不符合补交条件");
		}
	}else{
		$result=array("code"=>-1,"msg"=>"订单不存在");
	}
	exit(json_encode($result));
break;
case 'getshuoshuo':
	$uin=trim(daddslashes($_GET['uin']));
	$page=intval($_GET['page']);
	if(empty($uin))exit('{"code":-5,"msg":"QQ号不能为空"}');
	$result = getshuoshuo($uin,$page);
	exit(json_encode($result));
break;
case 'getrizhi':
	$uin=trim(daddslashes($_GET['uin']));
	$page=intval($_GET['page']);
	if(empty($uin))exit('{"code":-5,"msg":"QQ号不能为空"}');
	$result = getrizhi($uin,$page);
	exit(json_encode($result));
break;
case 'getkuaishou':
	$url=trim($_POST['url']);
	if(empty($url))exit('{"code":-5,"msg":"url不能为空"}');
	$result = getkuaishou($url);
	exit(json_encode($result));
	break;
case 'getdouyin':
	$url=trim($_POST['url']);
	if(empty($url))exit('{"code":-5,"msg":"url不能为空"}');
	$result = getdouyin($url);
	exit(json_encode($result));
	break;
case 'gethuoshan':
	$url=trim($_POST['url']);
	if(empty($url))exit('{"code":-5,"msg":"url不能为空"}');
	$result = gethuoshan($url);
	exit(json_encode($result));
	break;
case 'up_price':
	$up=intval($_POST['up']);
	if($up<=0)exit('{"code":-1,"msg":"输入值不正确"}');
	$sql=$DB->query("select * from shua_tools where active=1");
	$data=array();
	while($row=$DB->fetch($sql)){
		if($row['price']==0){
			continue;
		}
		if(strpos($row['name'],'免费')!==false){
			continue;
		}
		$a=(float)$up/100;
		$data[$row['tid']]['price']=round($row['price']*($a+1),2);
	}
	$array_data=serialize($data);
	$DB->query("update `shua_site` set `price`='{$array_data}' where zid='{$userrow['zid']}'");
	exit('{"code":0}');
break;
case 'create_url':
	$force = trim(daddslashes($_GET['force']));
	if(!$userrow['domain'])exit('{"code":-1,"msg":"当前分站还未绑定域名"}');
	$url = 'http://'.$userrow['domain'].'/';
	if($force==1){
		$turl = fanghongdwz($url,true);
	}else{
		$turl = fanghongdwz($url);
	}
	if($turl == $url){
		$result = array('code'=>-1, 'msg'=>'生成失败，请联系站长更换接口');
	}else{
		$result = array('code'=>0, 'msg'=>'succ', 'url'=>$turl);
	}
	exit(json_encode($result));
break;
default:
	exit('{"code":-4,"msg":"No Act"}');
break;
}