<?php
/*支付接口订单监控文件
说明：用于请求支付接口订单列表，同步未通知到本站的订单，防止漏单。
监控频率建议5分钟一次
监控地址：/cron.php?key=监控密钥
注意：千万不要监控太快或使用多节点监控！！！否则会被支付接口自动屏蔽IP地址
*/

if(preg_match('/Baiduspider/', $_SERVER['HTTP_USER_AGENT']))exit;
include("./includes/common.php");

if (function_exists("set_time_limit"))
{
	@set_time_limit(0);
}
if (function_exists("ignore_user_abort"))
{
	@ignore_user_abort(true);
}

@header('Content-Type: text/html; charset=UTF-8');

if(empty($conf['cronkey']))exit("请先设置好监控密钥");
if($conf['cronkey']!=$_GET['key'])exit("监控密钥不正确");

if($_GET['do']=='pricejk'){
	$cron_lasttime = $DB->get_column("SELECT v FROM shua_config WHERE k='pricejk_lasttime' limit 1");
	if(time()-strtotime($cron_lasttime)<50)exit('ok');
	saveSetting('pricejk_lasttime',$date);
	$success = 0;
	$is_need = 0;
	$rs=$DB->query("SELECT * FROM shua_shequ WHERE type=0 or type=2 or type=1 order by id asc");
	while($res = $DB->fetch($rs))
	{
		$tcount = $DB->count("SELECT count(*) FROM shua_tools WHERE shequ='{$res['id']}' and active=1 and cid IN ({$conf['pricejk_cid']})");
		if($tcount>0 && $res['username'] && $res['password']){
			$is_need++;
			if($res['type']==0 || $res['type']==2){
				$list = jiuwu_goodslist_details($res['url'], $res['username'], $res['password']);
				if(is_array($list)){
					$price_arr =array();
					foreach($list as $row){
						$price_arr[$row['id']] = $row['price'];
					}
					$rs2=$DB->query("SELECT * FROM shua_tools WHERE shequ='{$res['id']}' and active=1 and cid IN ({$conf['pricejk_cid']})");
					while($res2 = $DB->fetch($rs2))
					{
						if($res2['price']==='0.00')continue;
						if(isset($price_arr[$res2['goods_id']]) && $price_arr[$res2['goods_id']]>0){
							$cost1 = ceil($price_arr[$res2['goods_id']] * $res2['value'] * $conf['pricejk_price'] * 100)/100;
							$cost2 = ceil($price_arr[$res2['goods_id']] * $res2['value'] * $conf['pricejk_cost'] * 100)/100;
							$cost3 = ceil($price_arr[$res2['goods_id']] * $res2['value'] * $conf['pricejk_cost2'] * 100)/100;
							if($conf['pricejk_edit']==1 && ($cost1>$res2['price'] || $cost2>$res2['cost'] || $cost3>$res2['cost2'])){
								$DB->query("update `shua_tools` set `price` ='{$cost1}',`cost` ='{$cost2}',`cost2` ='{$cost3}' where `tid`='{$res2['tid']}'");
								$success++;
							}elseif($cost1!=$res2['price'] || $cost2!=$res2['cost'] || $cost3!=$res2['cost2']){
								$DB->query("update `shua_tools` set `price` ='{$cost1}',`cost` ='{$cost2}',`cost2` ='{$cost3}' where `tid`='{$res2['tid']}'");
								$success++;
							}
						}
					}
					saveSetting('pricejk_status','ok');
				}else{
					saveSetting('pricejk_status',$list);
					$is_error = true;
				}
			}elseif($res['type']==1){
				$price_arr =array();
				$rs2=$DB->query("SELECT * FROM shua_tools WHERE shequ='{$res['id']}' and active=1 and cid IN ({$conf['pricejk_cid']})");
				while($res2 = $DB->fetch($rs2))
				{
					if($res2['price']==='0.00')continue;
					if(isset($price_arr[$res2['goods_id']])){
						$price = $price_arr[$res2['goods_id']];
					}else{
						$details = yile_goods_details($res['url'], $res2['goods_id'], $res['username'], $res['password']);
						if(!is_array($details))continue;
						$price_arr[$res2['goods_id']] = $details['price'];
						$price = $details['price'];
					}
					$cost1 = ceil($price * $res2['value'] * $conf['pricejk_price'] * 100)/100;
					$cost2 = ceil($price * $res2['value'] * $conf['pricejk_cost'] * 100)/100;
					$cost3 = ceil($price * $res2['value'] * $conf['pricejk_cost2'] * 100)/100;
					if($conf['pricejk_edit']==1 && ($cost1>$res2['price'] || $cost2>$res2['cost'] || $cost3>$res2['cost2'])){
						$DB->query("update `shua_tools` set `price` ='{$cost1}',`cost` ='{$cost2}',`cost2` ='{$cost3}' where `tid`='{$res2['tid']}'");
						$success++;
					}elseif($cost1!=$res2['price'] || $cost2!=$res2['cost'] || $cost3!=$res2['cost2']){
						$DB->query("update `shua_tools` set `price` ='{$cost1}',`cost` ='{$cost2}',`cost2` ='{$cost3}' where `tid`='{$res2['tid']}'");
						$success++;
					}
				}
				saveSetting('pricejk_status','ok');
			}
		}
	}
	if($is_error==true){
		exit($list);
	}elseif($is_need==0){
		exit('没有需要监控价格的商品');
	}else{
		exit('成功更新'.$success.'个商品的价格');
	}
}
elseif($_GET['do']=='daily'){
	$cron_lasttime = $DB->get_column("SELECT v FROM shua_config WHERE k='daily_lasttime' limit 1");
	if(time()-strtotime($cron_lasttime)<3600*12)exit('日常维护任务今天已执行过');
	saveSetting('daily_lasttime',$date);
	$DB->query("DELETE FROM `shua_pay` WHERE addtime<'".date("Y-m-d H:i:s",strtotime("-7 days"))."'");
	$sq1 = $DB->affected();
	$DB->query("DELETE FROM `shua_pay` WHERE addtime<'".date("Y-m-d H:i:s",strtotime("-3 hours"))."' and status=0");
	$sq2 = $DB->affected();
	$DB->query("OPTIMIZE TABLE `shua_pay`");
	$DB->query("DELETE FROM `shua_giftlog` WHERE addtime<'".date("Y-m-d H:i:s",strtotime("-1 days"))."'");
	$sq3 = $DB->affected();
	$DB->query("OPTIMIZE TABLE `shua_giftlog`");
	$DB->query("DELETE FROM `shua_invitelog` WHERE date<'".date("Y-m-d H:i:s",strtotime("-1 days"))."'");
	$sq4 = $DB->affected();
	$DB->query("OPTIMIZE TABLE `shua_invitelog`");
	$count = $sq1+$sq2+$sq3+$sq4;
	exit('日常维护任务已成功执行，本次共清理'.$count.'条数据');
}
elseif($conf['epay_pid'] && $conf['epay_key']){
	$cron_lasttime = $DB->get_column("SELECT v FROM shua_config WHERE k='cron_lasttime' limit 1");
	if(time()-strtotime($cron_lasttime)<30)exit('ok');
	$trade_no = date("YmdHis",strtotime($cron_lasttime)).'000';
	$limit = $DB->count("SELECT count(*) FROM shua_pay WHERE trade_no>'$trade_no'");
	if($limit<1)exit('ok');
	if($limit>50)$limit=50;
	saveSetting('cron_lasttime',$date);
	$payapi=pay_api(true);
	$data = get_curl($payapi.'api.php?act=orders&limit='.$limit.'&pid='.$conf['epay_pid'].'&key='.$conf['epay_key']);
	$arr = json_decode($data, true);
	if($arr['code']==1){
		foreach($arr['data'] as $row){
			if($row['status']==1){
				$out_trade_no = $row['out_trade_no'];
				$srow=$DB->get_row("SELECT * FROM shua_pay WHERE trade_no='{$out_trade_no}' limit 1 for update");
				if($srow && $srow['status']==0){
					$DB->query("update `shua_pay` set `status` ='1',`endtime` ='$date' where `trade_no`='{$out_trade_no}'");
					processOrder($srow);
					echo '已成功补单:'.$out_trade_no.'<br/>';
				}
			}
		}
		exit('ok');
	}else{
		exit($arr['msg']);
	}
}else{
	exit('未配置易支付信息');
}