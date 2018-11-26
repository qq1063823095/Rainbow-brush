<?php

include("./includes/common.php");
$act=isset($_GET['act'])?daddslashes($_GET['act']):null;
$url=daddslashes($_GET['url']);
$authcode=daddslashes($_GET['authcode']);

@header('Content-Type: application/json; charset=UTF-8');

if($act=='clone')
{
	$key=daddslashes($_GET['key']);
	if(!$key)exit('{"code":-5,"msg":"确保各项不能为空"}');
	if($key!=md5($password_hash.md5(SYS_KEY).$conf['apikey']))exit('{"code":-4,"msg":"克隆密钥错误"}');
	$rs=$DB->query("SELECT * FROM shua_class order by cid asc");
	$class=array();
	while($res = $DB->fetch($rs)){
		$class[]=$res;
	}
	$rs=$DB->query("SELECT * FROM shua_tools order by tid asc");
	$tools=array();
	while($res = $DB->fetch($rs)){
		$tools[]=$res;
	}
	$rs=$DB->query("SELECT id,url,type FROM shua_shequ order by id asc");
	$shequ=array();
	while($res = $DB->fetch($rs)){
		$shequ[]=$res;
	}
	$result=array("code"=>1,"class"=>$class,"tools"=>$tools,"shequ"=>$shequ);
}
elseif($act=='tools')
{
	$key=daddslashes($_GET['key']);
	$limit=isset($_GET['limit'])?intval($_GET['limit']):50;
	if(!$key)exit('{"code":-5,"msg":"确保各项不能为空"}');
	if($key!=$conf['apikey'])exit('{"code":-4,"msg":"API对接密钥错误，请在后台设置密钥"}');
	$rs=$DB->query("SELECT * FROM shua_tools WHERE active=1 order by tid asc limit $limit");
	while($res = $DB->fetch($rs)){
		$data[]=array('tid'=>$res['tid'],'cid'=>$res['cid'],'sort'=>$res['sort'],'name'=>$res['name'],'price'=>$res['price']);
	}
	exit(json_encode($data));
}
elseif($act=='orders')
{
	$tid=intval($_GET['tid']);
	$key=daddslashes($_GET['key']);
	$limit=isset($_GET['limit'])?intval($_GET['limit']):50;
	$format=isset($_GET['format'])?daddslashes($_GET['format']):'json';
	if(!$key)exit('{"code":-5,"msg":"确保各项不能为空"}');
	if($key!=$conf['apikey'])exit('{"code":-4,"msg":"API对接密钥错误，请在后台设置密钥"}');
	if($tid){
		$tool=$DB->get_row("SELECT * FROM shua_tools WHERE tid='$tid' and active=1 limit 1");
		if(!$tool)exit('{"code":-5,"msg":"商品ID不存在"}');
		$sqls=" and tid='$tid'";
		$value=$tool['value']>0?$tool['value']:1;
	}
	$rs=$DB->query("SELECT * FROM shua_orders WHERE status=0{$sqls} order by id asc limit $limit");
	while($res = $DB->fetch($rs)){
		$data[]=array('id'=>$res['id'],'tid'=>$res['tid'],'input'=>$res['input'],'input2'=>$res['input2'],'input3'=>$res['input3'],'input4'=>$res['input4'],'input5'=>$res['input5'],'value'=>$res['value'],'status'=>$res['status']);
		if($_GET['sign']==1)$DB->query("update `shua_orders` set status=1 where `id`='{$res['id']}'");
	}
	if($format=='text'){
		$txt = '';
		foreach($data as $row){
			$txt .= $row['input'] . ($row['input2']?'----'.$row['input2']:null) . ($row['input3']?'----'.$row['input3']:null) . ($row['input4']?'----'.$row['input4']:null) . ($row['input5']?'----'.$row['input5']:null) . '----' . $row['value'] . "\r\n";
		}
		exit($txt);
	}else{
		exit(json_encode($data));
	}
}
elseif($act=='change')
{
	$id=intval($_GET['id']);
	$key=daddslashes($_GET['key']);
	$status=intval($_GET['zt']); //1:已完成,2:正在处理,3:异常,4:待处理
	if(!$id || !$key)exit('{"code":-5,"msg":"确保各项不能为空"}');
	if($key!=$conf['apikey'])exit('{"code":-4,"msg":"API对接密钥错误，请在后台设置密钥"}');
	$row=$DB->get_row("SELECT * FROM shua_orders WHERE id='$id' limit 1");
	if($id=$row['id']) {
		$sql="update `shua_orders` set `status`='$status' where `id`='{$id}' limit 1";
		if($DB->query($sql)){
			$result=array("code"=>1,"msg"=>"修改成功","id"=>$id);
		}else{
			$result=array("code"=>-2,"msg"=>"修改失败","id"=>$id);
		}
	}
	else
	{
		$result=array("code"=>-5,"msg"=>"订单ID不存在");
	}
}
elseif($act=='siteinfo')
{
	$count1=$DB->count("SELECT count(*) from shua_orders");
	$count2=$DB->count("SELECT count(*) from shua_orders where status>=1");
	$count3=$DB->count("SELECT count(*) from shua_site");
	$result=array('sitename'=>$conf['sitename'],'kfqq'=>$conf['qq']?$conf['qq']:$conf['kfqq'],'anounce'=>$conf['anounce'],'modal'=>$conf['modal'],'bottom'=>$conf['bottom'],'gg_search'=>$conf['gg_search'],'version'=>VERSION,'build'=>$conf['build'],'orders'=>$count1,'orders1'=>$count2,'sites'=>$count3,'appalert'=>$conf['appalert']);
}
elseif($act=='token')
{
	$key = isset($_GET['key'])?$_GET['key']:exit('No key');
	$result=array('token'=>get_app_token($key),'time'=>time());
}
else
{
	$result=array("code"=>-5,"msg"=>"No Act!");
}

echo json_encode($result);
$DB->close();
?>