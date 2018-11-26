<?php
require '../includes/common.php';
if($islogin2==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");

$title='网站设置';
include 'head.php';
if($conf['fenzhan_cost2']<=0)$conf['fenzhan_cost2']=$conf['fenzhan_price2'];
?>
  <div class="container" style="padding-top:70px;">
    <div class="col-xs-12 col-sm-10 col-lg-8 center-block" style="float: none;">
<?php
$mod=isset($_GET['mod'])?$_GET['mod']:null;
if($mod=='user_n'){
	$qq=daddslashes(strip_tags($_POST['qq']));
	$pay_type=daddslashes(intval($_POST['pay_type']));
	$pay_account=daddslashes(strip_tags($_POST['pay_account']));
	$pay_name=daddslashes(strip_tags($_POST['pay_name']));
	$pwd=daddslashes(strip_tags($_POST['pwd']));
	if(!empty($pwd) && !preg_match('/^[a-zA-Z0-9\_\!\@\#\$~\%\^\&\*.,]+$/',$pwd)){
		exit("<script language='javascript'>alert('密码只能为英文与数字！');history.go(-1);</script>");
	}elseif(!preg_match('/^[0-9]{5,11}+$/', $qq)){
		exit("<script language='javascript'>alert('QQ格式不正确！');history.go(-1);</script>");
	}else{
		$DB->query("update shua_site set qq='$qq',pay_type='$pay_type',pay_account='$pay_account',pay_name='$pay_name' where zid='{$userrow['zid']}'");
		if(!empty($pwd))$DB->query("update shua_site set pwd='$pwd' where zid='{$userrow['zid']}'");
		exit("<script language='javascript'>alert('修改保存成功！');history.go(-1);</script>");
	}
}elseif($mod=='user'){
?>
<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title">用户资料设置</h3></div>
<div class="panel-body">
  <form action="./uset.php?mod=user_n" method="post" class="form-horizontal" role="form">
	<div class="form-group">
	  <label class="col-sm-2 control-label">ＱＱ</label>
	  <div class="col-sm-10"><input type="text" name="qq" value="<?php echo $userrow['qq']; ?>" class="form-control" placeholder="用于联系与找回密码"/></div>
	</div><br/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">提现方式</label>
	  <div class="col-sm-10"><select class="form-control" name="pay_type" default="<?php echo $userrow['pay_type']?>"><option value="0">支付宝</option><option value="1">微信</option><option value="2">QQ钱包</option></select></div>
	</div><br/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">提现账号</label>
	  <div class="col-sm-10"><input type="text" name="pay_account" value="<?php echo $userrow['pay_account']; ?>" class="form-control"/></div>
	</div><br/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">提现姓名</label>
	  <div class="col-sm-10"><input type="text" name="pay_name" value="<?php echo $userrow['pay_name']; ?>" class="form-control"/></div>
	</div><br/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">重置密码</label>
	  <div class="col-sm-10"><input type="text" name="pwd" value="" class="form-control" placeholder="不修改请留空"/></div>
	</div><br/>
	<div class="form-group">
	  <div class="col-sm-offset-2 col-sm-10"><input type="submit" name="submit" value="修改" class="btn btn-primary form-control"/><br/>
	 </div>
	</div>
  </form>
</div>
</div>
<script>
var items = $("select[default]");
for (i = 0; i < items.length; i++) {
	$(items[i]).val($(items[i]).attr("default")||0);
}
</script>
<?php
}elseif($mod=='site_n'){
	$sitename=daddslashes(strip_tags($_POST['sitename']));
	$title=daddslashes(strip_tags($_POST['title']));
	$keywords=daddslashes(strip_tags($_POST['keywords']));
	$description=daddslashes(strip_tags($_POST['description']));
	$kaurl=daddslashes(strip_tags($_POST['kaurl']));
	$anounce=daddslashes($_POST['anounce']);
	$modal=daddslashes($_POST['modal']);
	$bottom=daddslashes($_POST['bottom']);
	$alert=daddslashes($_POST['alert']);
	$ktfz_price=daddslashes($_POST['ktfz_price']);
	$ktfz_price2=daddslashes($_POST['ktfz_price2']);
	$ktfz_domain=daddslashes($_POST['ktfz_domain']);
	$template=isset($_POST['template'])?daddslashes($_POST['template']):null;
	if($sitename==null){
		exit("<script language='javascript'>alert('请确保各项不能为空');history.go(-1);</script>");
	}else{
		if($userrow['power']==1 && $ktfz_price2<$conf['fenzhan_cost2'])exit("<script language='javascript'>alert('专业分站价格不能低于成本价');history.go(-1);</script>");
		if(!empty($template) && (!preg_match('/^[a-zA-Z0-9]+$/',$template) || Template::exists($template)==false))exit("<script language='javascript'>alert('该模板首页文件不存在！');history.go(-1);</script>");
		$sds=$DB->query("update shua_site set sitename='$sitename',title='$title',keywords='$keywords',description='$description',kaurl='$kaurl',anounce='$anounce',modal='$modal',bottom='$bottom',alert='$alert',ktfz_price='$ktfz_price',ktfz_price2='$ktfz_price2',ktfz_domain='$ktfz_domain',template='$template' where zid='{$userrow['zid']}'");
		if($sds)exit("<script language='javascript'>alert('修改保存成功！');history.go(-1);</script>");
		else exit("<script language='javascript'>alert('修改保存失败:".$DB->error()."');history.go(-1);</script>");
	}
}elseif($mod=='site'){
	$mblist = Template::getList();
?>
<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title">网站信息设置</h3></div>
<div class="panel-body">
  <form action="./uset.php?mod=site_n" method="post" class="form-horizontal" role="form">
	<div class="form-group">
	  <label class="col-sm-2 control-label">网站名称</label>
	  <div class="col-sm-10"><input type="text" name="sitename" value="<?php echo $userrow['sitename']; ?>" class="form-control" required/></div>
	</div><br/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">标题栏后缀</label>
	  <div class="col-sm-10"><input type="text" name="title" value="<?php echo $userrow['title']; ?>" class="form-control"/></div>
	</div><br/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">关键字</label>
	  <div class="col-sm-10"><input type="text" name="keywords" value="<?php echo $userrow['keywords']; ?>" class="form-control"/></div>
	</div><br/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">网站描述</label>
	  <div class="col-sm-10"><input type="text" name="description" value="<?php echo $userrow['description']; ?>" class="form-control"/></div>
	</div><br/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">卡密购买地址</label>
	  <div class="col-sm-10"><input type="text" name="kaurl" value="<?php echo $userrow['kaurl']; ?>" class="form-control"/></div>
	</div><br/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">首页公告</label>
	  <div class="col-sm-10"><textarea class="form-control" name="anounce" rows="6"><?php echo htmlspecialchars($userrow['anounce']);?></textarea></div>
	</div><br/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">首页弹出公告</label>
	  <div class="col-sm-10"><textarea class="form-control" name="modal" rows="5"><?php echo htmlspecialchars($userrow['modal']);?></textarea></div>
	</div><br/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">首页底部排版</label>
	  <div class="col-sm-10"><textarea class="form-control" name="bottom" rows="5"><?php echo htmlspecialchars($userrow['bottom']);?></textarea></div>
	</div><br/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">在线下单提示</label>
	  <div class="col-sm-10"><textarea class="form-control" name="alert" rows="5"><?php echo htmlspecialchars($userrow['alert']);?></textarea></div>
	</div><br/>
	<?php if($userrow['power']==1){?>
	<div class="form-group">
	  <label class="col-sm-2 control-label">普通分站价格</label>
	  <div class="col-sm-10"><input type="text" name="ktfz_price" value="<?php echo $userrow['ktfz_price']>0?$userrow['ktfz_price']:$conf['fenzhan_price']; ?>" class="form-control"/><pre>前台自助开通分站的价格</pre></div>
	</div><br/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">专业分站价格</label>
	  <div class="col-sm-10"><input type="text" name="ktfz_price2" value="<?php echo $userrow['ktfz_price2']>$conf['fenzhan_cost2']?$userrow['ktfz_price2']:$conf['fenzhan_price2']; ?>" class="form-control"/><pre>前台自助开通分站的价格，不能低于成本价<?php echo $conf['fenzhan_cost2']?>元</pre></div>
	</div><br/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">分站可选择域名</label>
	  <div class="col-sm-10"><input type="text" name="ktfz_domain" value="<?php echo $userrow['ktfz_domain']; ?>" class="form-control"/><pre>默认使用主站域名，没有请留空，不要乱填写！多个域名用,隔开！</pre></div>
	</div><br/>
	<?php }?>
	<?php if($conf['fenzhan_template']==1){?>
	<div class="form-group">
	  <label class="col-sm-2 control-label">首页模板设置</label>
	  <div class="col-sm-10"><select class="form-control" name="template">
	  <?php foreach($mblist as $row){
	  echo '<option value="'.$row.'" '.($userrow['template']==$row?'selected':null).'>'.$row.'</option>';
		}
		?>
	  </select></div>
	</div><br/>
	<?php }?>
	<div class="form-group">
	  <div class="col-sm-offset-2 col-sm-10"><input type="submit" name="submit" value="修改" class="btn btn-primary form-control"/><br/>
	 </div>
	</div>
  </form>
</div>
<div class="panel-footer">
<span class="glyphicon glyphicon-info-sign"></span>
实用工具：<a href="uset.php?mod=copygg">一键复制其他站点排版</a>｜<a href="http://www.w3school.com.cn/tiy/t.asp?f=html_basic" target="_blank" rel="noreferrer">HTML在线测试</a>｜<a href="http://pic.xiaojianjian.net/" target="_blank" rel="noreferrer">图床</a>｜<a href="http://music.cccyun.cc/" target="_blank" rel="noreferrer">音乐外链</a>
</div>
</div>
<?php
}elseif($mod=='copygg_n' && $_POST['do']=='submit'){
	$url=$_POST['url'];
	$content=$_POST['content'];
	$url_arr = parse_url($url);
	if($url_arr['host']==$_SERVER['HTTP_HOST'])showmsg('无法自己复制自己',3);
	$data = get_curl($url.'api.php?act=siteinfo');
	$arr = json_decode($data,true);
	if(array_key_exists('sitename',$arr)){
		if(in_array('anounce',$content))$anounce = daddslashes(str_replace($arr['kfqq'],$userrow['qq'],$arr['anounce']));
		else $anounce = daddslashes($userrow['anounce']);
		if(in_array('modal',$content))$modal = daddslashes(str_replace($arr['kfqq'],$userrow['qq'],$arr['modal']));
		else $modal = daddslashes($userrow['modal']);
		if(in_array('bottom',$content))$bottom = daddslashes(str_replace($arr['kfqq'],$userrow['qq'],$arr['bottom']));
		else $bottom = daddslashes($userrow['bottom']);
		$sds=$DB->query("update shua_site set anounce='$anounce',modal='$modal',bottom='$bottom' where zid='{$userrow['zid']}'");
		if($sds)exit("<script language='javascript'>alert('修改保存成功！');history.go(-1);</script>");
		else exit("<script language='javascript'>alert('修改保存失败:".$DB->error()."');history.go(-1);</script>");
	}else{
		showmsg('获取数据失败，对方网站无法连接或非彩虹代刷系统。',4);
	}
}elseif($mod=='copygg'){
?>
<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title">一键复制其他站点排版</h3></div>
<div class="panel-body">
  <form action="./uset.php?mod=copygg_n" method="post" class="form-horizontal" role="form"><input type="hidden" name="do" value="submit"/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">站点URL</label>
	  <div class="col-sm-10"><input type="text" name="url" value="" class="form-control" placeholder="http://www.qq.com/" required/></div>
	</div><br/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">复制内容</label>
	  <div class="col-sm-10"><label><input name="content[]" type="checkbox" value="anounce" checked/> 首页公告</label><br/><label><input name="content[]" type="checkbox" value="modal" checked/> 弹出公告</label><br/><label><input name="content[]" type="checkbox" value="bottom" checked/> 底部排版</label></div>
	</div>
	<div class="form-group">
	  <div class="col-sm-offset-2 col-sm-10"><input type="submit" name="submit" value="修改" class="btn btn-primary form-control"/><br/>
	 </div>
	</div>
  </form>
</div>
</div>
<?php
}elseif($mod=='logo'){
echo '<div class="panel panel-success"><div class="panel-heading"><h3 class="panel-title">更改首页LOGO</h3></div><div class="panel-body">';
if($_POST['s']==1){
$extension=explode('.',$_FILES['file']['name']);
if (($length = count($extension)) > 1) {
$ext = strtolower($extension[$length - 1]);
}
copy($_FILES['file']['tmp_name'], ROOT.'assets/img/logo_'.$userrow['zid'].'.png');
echo "成功上传文件!<br>（可能需要清空浏览器缓存才能看到效果）";
}
if(file_exists(ROOT.'assets/img/logo_'.$userrow['zid'].'.png')){
	$logo = '../assets/img/logo_'.$userrow['zid'].'.png';
}else{
	$logo = '../assets/img/logo.png';
}
echo '<form action="uset.php?mod=logo" method="POST" enctype="multipart/form-data"><label for="file"></label><input type="file" name="file" id="file" /><input type="hidden" name="s" value="1" /><br><input type="submit" class="btn btn-block btn-success" value="确认上传" /></form><br>现在的图片：<br><img src="'.$logo.'" style="max-width:100%">';
echo '</div></div>';
}elseif($mod=='skimg'){
	
echo '<div class="panel panel-info"><div class="panel-heading"><h3 class="panel-title">提现收款图设置</h3></div><div class="panel-body">';
if($_POST['s']==1){
$extension=explode('.',$_FILES['shoukuan']['name']);
if (($length = count($extension)) > 1) {
$ext = strtolower($extension[$length - 1]);
}
copy($_FILES['shoukuan']['tmp_name'], ROOT.'assets/img/skimg/sk_'.$userrow['zid'].'.png');
echo "成功上传文件!<br>（可能需要清空浏览器缓存才能看到效果）";
}
if(file_exists(ROOT.'assets/img/skimg/sk_'.$userrow['zid'].'.png')){
	$logo = '../assets/img/skimg/sk_'.$userrow['zid'].'.png';
}else{
	$logo = '../assets/img/skimg/sk.png';
}
echo '<form action="uset.php?mod=skimg" method="POST" enctype="multipart/form-data"><label for="file"></label><input type="file" name="shoukuan" id="shoukuan" /><input type="hidden" name="s" value="1" /><br><input type="submit" class="btn btn-block btn-success" value="确认上传" /></form><br>现在的收款图：<br><img src="'.$logo.'" style="max-width:100%">';
echo '</div></div>';
}?>
	</div>
</div>