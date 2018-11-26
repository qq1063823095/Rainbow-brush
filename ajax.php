<?php
include("./includes/common.php");
$act=isset($_GET['act'])?daddslashes($_GET['act']):null;

@header('Content-Type: application/json; charset=UTF-8');

if($is_fenzhan == true){
	$price_obj = new Price($siterow['zid'],$siterow);
}
if ($conf['cjmsg'] != '') {
	$cjmsg = $conf['cjmsg'];
} else {
	$cjmsg = '您今天的抽奖次数已经达到上限！';
}
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
case 'getcount':
	$strtotime=strtotime($conf['build']);//获取开始统计的日期的时间戳
	$now=time();//当前的时间戳
	$yxts=ceil(($now-$strtotime)/86400);//取相差值然后除于24小时(86400秒)
	if($conf['hide_tongji']==1){
		$result=array("code"=>0,"yxts"=>$yxts,"orders"=>0,"orders1"=>0,"orders2"=>0,"money"=>0,"money1"=>0,"gift"=>$gift);
		exit(json_encode($result));
	}
	if($conf['tongji_time']>0){
		$tongji_cachetime = $DB->get_column("SELECT v FROM shua_config WHERE k='tongji_cachetime' limit 1");
		$tongji_cache = $DB->get_column("SELECT v FROM shua_config WHERE k='tongji_cache' limit 1");
		if($tongji_cachetime+intval($conf['tongji_time'])>=time() && $tongji_cache){
			$array = unserialize($tongji_cache);
			$result=array("code"=>0,"yxts"=>$yxts,"orders"=>$array['orders'],"orders1"=>$array['orders1'],"orders2"=>$array['orders2'],"money"=>$array['money'],"money1"=>$array['money1'],"gift"=>$array['gift']);
			exit(json_encode($result));
		}
	}
	if($conf['gift_log']==1 && $conf['gift_open']==1){
		$gift = array();
		$list=$DB->query("SELECT a.*,(select b.name from shua_gift as b where a.gid=b.id) as name FROM shua_giftlog as a WHERE status=1 ORDER BY id DESC");
		while($cjlist=$DB->fetch($list)){
			if(!$cjlist['input'])continue;
			$gift[$cjlist['input']] = $cjlist['name'];
		}
	}
	$time =date("Y-m-d").' 00:00:01';
	$count1=$DB->count("SELECT count(*) from shua_orders");
	$count2=$DB->count("SELECT count(*) from shua_orders where status>=1");
	$count3=$DB->count("SELECT sum(money) from shua_pay where status=1");
	$count4=round($count3, 2);
	$count5=$DB->count("SELECT count(*) from `shua_orders` WHERE  `addtime` > '$time'");
	$count6=$DB->count("SELECT sum(money) FROM `shua_pay` WHERE `addtime` > '$time' AND `status` = 1");
	$count7=round($count6, 2);
	if($conf['tongji_time']>0){
		saveSetting('tongji_cachetime',time());
		saveSetting('tongji_cache',serialize(array("orders"=>$count1,"orders1"=>$count2,"orders2"=>$count5,"money"=>$count4,"money1"=>$count7,"gift"=>$gift)));
	}

	$result=array("code"=>0,"yxts"=>$yxts,"orders"=>$count1,"orders1"=>$count2,"orders2"=>$count5,"money"=>$count4,"money1"=>$count7,"gift"=>$gift);
	exit(json_encode($result));
	break;
case 'getclass':
	$rs=$DB->query("SELECT * FROM shua_class WHERE active=1 order by sort asc");
	$data = array();
	while($res = $DB->fetch($rs)){
		$data[]=$res;
	}
	$result=array("code"=>0,"msg"=>"succ","data"=>$data);
	exit(json_encode($result));
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
		if(isset($_SESSION['gift_id']) && isset($_SESSION['gift_tid']) && $_SESSION['gift_tid']==$res['tid']){
			$price=$conf["cjmoney"]?$conf["cjmoney"]:0;
		}elseif($is_fenzhan == true){
			$price_obj->setToolInfo($res['tid'],$res);
			if($price_obj->getToolDel($res['tid'])==1)continue;
			$price=$price_obj->getToolPrice($res['tid']);
		}else $price=$res['price'];
		$data[]=array('tid'=>$res['tid'],'sort'=>$res['sort'],'name'=>$res['name'],'value'=>$res['value'],'price'=>$price,'input'=>$res['input'],'inputs'=>$res['inputs'],'alert'=>$res['alert'],'shopimg'=>$res['shopimg'],'repeat'=>$res['repeat'],'multi'=>$res['multi'],'isfaka'=>$res['is_curl']==4?1:0);
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
		if(isset($_SESSION['gift_id']) && isset($_SESSION['gift_tid']) && $_SESSION['gift_tid']==$tid){
			$gift_id = intval($_SESSION['gift_id']);
			$giftlog=$DB->get_column("select status from shua_giftlog where id='$gift_id' limit 1");
			if($giftlog==1){
				unset($_SESSION['gift_id']);
				unset($_SESSION['gift_tid']);
				exit('{"code":-1,"msg":"当前奖品已经领取过了！"}');
			}
			$price=$conf["cjmoney"]?$conf["cjmoney"]:0;
			$num=1;
		}elseif($is_fenzhan == true){
			$price_obj->setToolInfo($tid,$tool);
			$price=$price_obj->getToolPrice($tid);
		}else $price=$tool['price'];
		$need=$price*$num;
		if($need==0 && $tid!=$_SESSION['gift_tid']){
			$thtime=date("Y-m-d").' 00:00:00';
			if($_SESSION['blockfree']==true || $DB->count("SELECT count(*) FROM `shua_pay` WHERE `tid`='{$row['tid']}' and `money`=0 and `ip`='$clientip' and `status`=1 and `endtime`>'$thtime'")>=1){
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
		}

		$trade_no=date("YmdHis").rand(111,999);
		$input=$inputvalue.($inputvalue2?'|'.$inputvalue2:null).($inputvalue3?'|'.$inputvalue3:null).($inputvalue4?'|'.$inputvalue4:null).($inputvalue5?'|'.$inputvalue5:null);
		if($need==0){
			$trade_no='free'.$trade_no;
			$num = 1;
			$sql="insert into `shua_pay` (`trade_no`,`tid`,`zid`,`type`,`input`,`num`,`name`,`money`,`ip`,`userid`,`addtime`,`status`) values ('".$trade_no."','".$tid."','".($siterow['zid']?$siterow['zid']:1)."','free','".$input."','".$num."','".$tool['name']."','".$need."','".$clientip."','".$cookiesid."','".$date."','1')";
			if($DB->query($sql)){
				unset($_SESSION['addsalt']);
				if(isset($_SESSION['gift_id'])){
					$DB->query("update `shua_giftlog` set `status` =1,`tradeno` ='$trade_no',`input` ='$inputvalue' where `id`='$gift_id'");
					unset($_SESSION['gift_id']);
					unset($_SESSION['gift_tid']);
				}
				$_SESSION['blockfree']=true;
				$srow['tid']=$tid;
				$srow['input']=$input;
				$srow['num']=$num;
				$srow['zid']=$siterow['zid'];
				$srow['userid']=$cookiesid;
				$srow['trade_no']=$trade_no;
				if($orderid=processOrder($srow)){
					exit('{"code":1,"msg":"下单成功！你可以在进度查询中查看代刷进度","orderid":"'.$orderid.'"}');
				}else{
					exit('{"code":-1,"msg":"下单失败！'.$DB->error().'"}');
				}
			}
		}else{
			$sql="insert into `shua_pay` (`trade_no`,`tid`,`zid`,`input`,`num`,`name`,`money`,`ip`,`userid`,`inviteid`,`addtime`,`status`) values ('".$trade_no."','".$tid."','".($siterow['zid']?$siterow['zid']:1)."','".$input."','".$num."','".$tool['name']."','".$need."','".$clientip."','".$cookiesid."','".$invite_id."','".$date."','0')";
			if($DB->query($sql)){
				unset($_SESSION['addsalt']);
				if(isset($_SESSION['gift_id'])){
					$DB->query("update `shua_giftlog` set `status` =1,`tradeno` ='$trade_no' where `id`='$gift_id'");
					unset($_SESSION['gift_id']);
					unset($_SESSION['gift_tid']);
				}
				exit('{"code":0,"msg":"提交订单成功！","trade_no":"'.$trade_no.'","need":"'.$need.'"}');
			}else{
				exit('{"code":-1,"msg":"提交订单失败！'.$DB->error().'"}');
			}
		}
	}else{
		exit('{"code":-2,"msg":"该商品不存在"}');
	}
	break;
case 'checkkm':
	$km=trim(daddslashes($_POST['km']));
	$myrow=$DB->get_row("select * from shua_kms where km='$km' limit 1");
	if(!$myrow)
	{
		exit('{"code":-1,"msg":"此卡密不存在！"}');
	}
	elseif($myrow['usetime']!=null){
		exit('{"code":-1,"msg":"此卡密已被使用！"}');
	}
	$tool=$DB->get_row("select * from shua_tools where tid='{$myrow['tid']}' limit 1");
	$result=array("code"=>0,"tid"=>$tool['tid'],"cid"=>$tool['cid'],"name"=>$tool['name'],"alert"=>$tool['alert'],"inputname"=>$tool['input'],"inputsname"=>$tool['inputs'],"value"=>$tool['value']);
	exit(json_encode($result));
	break;
case 'card':
	if($conf['iskami']==0)exit('{"code":-1,"msg":"当前站点未开启卡密下单"}');
	$km=trim(daddslashes($_POST['km']));
	$inputvalue=trim(strip_tags(daddslashes($_POST['inputvalue'])));
	$inputvalue2=trim(strip_tags(daddslashes($_POST['inputvalue2'])));
	$inputvalue3=trim(strip_tags(daddslashes($_POST['inputvalue3'])));
	$inputvalue4=trim(strip_tags(daddslashes($_POST['inputvalue4'])));
	$inputvalue5=trim(strip_tags(daddslashes($_POST['inputvalue5'])));
	$myrow=$DB->get_row("select * from shua_kms where km='$km' limit 1");
	if(!$myrow)
	{
		exit('{"code":-1,"msg":"此卡密不存在！"}');
	}
	elseif($myrow['usetime']!=null){
		exit('{"code":-1,"msg":"此卡密已被使用！"}');
	}
	else
	{
		$tid=$myrow['tid'];
		$tool=$DB->get_row("select * from shua_tools where tid='$tid' limit 1");
		if($tool && $tool['active']==1){
			if(in_array($inputvalue,explode("|",$conf['blacklist'])))exit('{"code":-1,"msg":"你的下单账号已被拉黑，无法下单！"}');
			if($tool['repeat']==0){
				$row=$DB->get_row("select * from shua_orders where tid='$tid' and input='$inputvalue' order by id desc limit 1");
				$thtime=date("Y-m-d").' 00:00:00';
				if($row['input'] && $row['status']==0)
					exit('{"code":-1,"msg":"您今天添加的'.$tool['name'].'正在排队中，请勿重复提交！"}');
				elseif($row['addtime']>$thtime)
					exit('{"code":-1,"msg":"您今天已添加过'.$tool['name'].'，请勿重复提交！"}');
			}
			if($tool['validate'] && is_numeric($inputvalue)){
				if(validate_qzone($inputvalue)==false)
					exit('{"code":-1,"msg":"你的QQ空间设置了访问权限，无法下单！"}');
			}
			$srow['tid']=$tid;
			$srow['input']=$inputvalue.($inputvalue2?'|'.$inputvalue2:null).($inputvalue3?'|'.$inputvalue3:null).($inputvalue4?'|'.$inputvalue4:null).($inputvalue5?'|'.$inputvalue5:null);
			$srow['num']=1;
			$srow['zid']=$siterow['zid'];
			$srow['userid']=$cookiesid;
			$srow['trade_no']='kid:'.$myrow['kid'];
			if($orderid=processOrder($srow)){
				$DB->query("update `shua_kms` set `user` ='$inputvalue',`usetime` ='".$date."' where `kid`='{$myrow['kid']}'");
				exit('{"code":0,"msg":"'.$tool['name'].' 下单成功！你可以在进度查询中查看代刷进度","orderid":"'.$orderid.'"}');
			}else{
				exit('{"code":-1,"msg":"'.$tool['name'].' 下单失败！'.$DB->error().'"}');
			}
		}else{
			exit('{"code":-2,"msg":"该商品不存在"}');
		}
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
		$data[]=array('id'=>$res['id'],'tid'=>$res['tid'],'input'=>$res['input'],'name'=>$shua_func[$res['tid']],'value'=>$res['value'],'addtime'=>$res['addtime'],'endtime'=>$res['endtime'],'result'=>$res['result'],'status'=>$res['status'],'skey'=>md5($res['id'].SYS_KEY.$res['id']));
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
			$kmdata='<center><a href="./?mod=faka&id='.$id.'&skey='.$_POST['skey'].'" target="_blank" class="btn btn-sm btn-primary">点此查看卡密</a></center>';
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
					$kmdata='<center><a href="./?mod=faka&id='.$id.'&skey='.$_POST['skey'].'" target="_blank" class="btn btn-sm btn-primary">点此查看卡密</a></center>';
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
case 'lqq':
	$qq=trim(daddslashes($_POST['qq']));
	if(empty($qq) || empty($_SESSION['addsalt']) || $_POST['salt']!=$_SESSION['addsalt'])exit('{"code":-5,"msg":"非法请求"}');
	get_curl($conf['lqqapi'].$qq);
	$result=array("code"=>0,"msg"=>"succ");
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
case 'gift_start':
	$action = $_GET['action'];
	if ($action == '') {
		if(!$conf['gift_open'])exit('{"code":-2,"msg":"网站未开启抽奖功能"}');
		if(!$conf['cjcishu'])exit('{"code":-2,"msg":"站长未设置每日抽奖次数！"}');
		$thtime=date("Y-m-d").' 00:00:00';
		$cjcount = $DB->count("select count(*) from shua_giftlog where (userid='$cookiesid' or ip='$clientip') and addtime>='$thtime'");
		if ($cjcount >= $conf['cjcishu']) {
			exit('{"code":-1,"msg":"' . $cjmsg . '"}');
		}
		$query = $DB->query("select * from shua_gift where ok=0");
		while ($row = $DB->fetch($query)) {
			$arr[] = array("id" => $row["id"], "tid" => $row["tid"], "name" => $row["name"]);
		}
		$rateall = $DB->count("SELECT sum(rate) from shua_gift where ok=0");
		if($rateall<100)$arr[] = array("id" => 0, "tid" => 0, "name" => '未中奖');
		if (!$arr) {
			exit('{"code":-2,"msg":"站长未设置奖品"}');
		}
		$result=array("code"=>0,"data"=>$arr);
		exit(json_encode($result));
	} else {
		$token = md5($_GET['r'].SYS_KEY.$_GET['r']);
		exit('{"code":0,"token":"'.$token.'"}');
	}
	break;
case 'gift_stop':
	if(!$conf['gift_open'])exit('{"code":-2,"msg":"网站未开启抽奖功能"}');
	if(!$conf['cjcishu'])exit('{"code":-2,"msg":"站长未设置每日抽奖次数！"}');
	$hashsalt=isset($_POST['hashsalt'])?$_POST['hashsalt']:null;
	$token=isset($_POST['token'])?$_POST['token']:null;
	if($conf['verify_open']==1 && (empty($_SESSION['addsalt']) || $hashsalt!=$_SESSION['addsalt'])){
		exit('{"code":-1,"msg":"验证失败，请刷新页面重试"}');
	}
	if(md5($_GET['r'].SYS_KEY.$_GET['r']) !== $token)exit('{"code":-1,"msg":"请勿重复提交请求"}');
	$thtime=date("Y-m-d").' 00:00:00';
	$cjcount = $DB->count("select count(*) from shua_giftlog where (userid='$cookiesid' or ip='$clientip') and addtime>='$thtime'");
	if ($cjcount >= $conf['cjcishu']) {
		exit('{"code":-1,"msg":"' . $cjmsg . '"}');
	}
	$prize_arr = array();
	$query = $DB->query("select * from shua_gift where ok=0");
	$i = 1;
	$bre = $DB->count("SELECT count(*) from shua_gift where ok=0");
	while ($i <= $bre) {
		while ($row = $DB->fetch($query)) {
			$prize_arr[] = array("id" => ($i = $i + 1) -1, "gid" => $row["id"], "tid" => $row["tid"], "name" => $row["name"], "rate" => $row["rate"], "not" => 0);
		}
	}
	if (!$prize_arr) {
		exit('{"code":-2,"msg":"站长未设置奖品"}');
	}
	$rateall = $DB->count("SELECT sum(rate) from shua_gift where ok=0");
	if($rateall<100)$prize_arr[] = array("id" => ($i = $i + 1) -1, "gid" => 0, "tid" => 0, "name" => '未中奖', "rate" => 100-$rateall, "not" => 1);
	foreach ($prize_arr as $key => $val) {
		$arr[$val["id"]] = $val["rate"];
	}
	$prize_id = get_rand($arr);
	$data['rate'] = $prize_arr[$prize_id - 1]['rate'];
	$data['id'] = $prize_arr[$prize_id - 1]['id'];
	$data['gid'] = $prize_arr[$prize_id - 1]['gid'];
	$data['name'] = $prize_arr[$prize_id - 1]['name'];
	$data['tid'] = $prize_arr[$prize_id - 1]['tid'];
	$data['not'] = $prize_arr[$prize_id - 1]['not'];

	$gift_id =  $DB->insert("INSERT INTO `shua_giftlog`(`zid`,`tid`,`gid`,`userid`,`ip`,`addtime`,`status`) VALUES ('".($siterow['zid']?$siterow['zid']:1)."','".$data['tid']."','".$data['gid']."','".$cookiesid."','".$clientip."','".$date."',0)");
	if ($gift_id) {
		if ($data['not'] == 1) {
			exit('{"code":-1,"msg":"未中奖，谢谢参与！"}');
		}
		$tool = $DB->get_row("select * from shua_tools where tid='{$data['tid']}' limit 1");
		$_SESSION['gift_tid'] = $data['tid'];
		$_SESSION['gift_id'] = $gift_id;
		unset($_SESSION['addsalt']);

		$result = array("code" => 0, "msg" => "succ", "cid" => $tool['cid'], "tid" => $data['tid'], "name" => $data['name']);
		exit(json_encode($result));
	} else {
		exit('{"code":-3,"msg":"' . $DB->error() . '"}');
	}
	break;
case 'inviteurl':
	$qq = daddslashes($_POST['userqq']);
	$hashsalt=isset($_POST['hashsalt'])?$_POST['hashsalt']:null;
	if (!preg_match('/^[1-9][0-9]{4,9}$/i',$qq)){
		exit('{"code":0,"msg":"QQ号码格式不正确"}');
	}
	$key = random(6);
	$qqrow = $DB->get_row("SELECT * FROM `shua_invite` WHERE `qq`='$qq' LIMIT 1");
	$result = array();
	if ($qqrow)
	{
		$code = 2;
		$url = $siteurl . '?i=' .$qqrow['key'];
	} else {
		$iprow = $DB->get_row("SELECT * FROM `shua_invite` WHERE `ip`='$clientip' LIMIT 1");
		if ($iprow)
		{
			$code = 2;
			$url = $siteurl . '?i=' .$iprow['key'];
		} else {
			if($conf['verify_open']==1 && (empty($_SESSION['addsalt']) || $hashsalt!=$_SESSION['addsalt'])){
				exit('{"code":-1,"msg":"验证失败，请刷新页面重试"}');
			}
			if($DB->query("INSERT INTO `shua_invite` (`qq`,`key`,`ip`,`date`) VALUES ('$qq','$key','$clientip','$date')")){
				unset($_SESSION['addsalt']);
				$code = 1;
				$url = $siteurl . '?i=' . $key ;
			}else{
				exit('{"code":-1,"msg":"' . $DB->error() . '"}');
			}
		}
	}
	if($conf['fanghong_url'])$url = fanghongdwz($url);
	$result = array('code'=>$code, 'msg'=>'succ', 'url'=>$url);
	exit(json_encode($result));
break;
default:
	exit('{"code":-4,"msg":"No Act"}');
	break;
}