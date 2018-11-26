<?php
/**
 * 自助下单系统
**/
include("../includes/common.php");
$title='自助下单系统管理中心';
include './head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>
<?php
$mysqlversion=$DB->count("select VERSION()");
?>
  <div class="container" style="padding-top:70px;">
    <div class="col-sm-12 col-md-3">
		<div class="list-group">
			<div class="list-group-item list-group-item-success">
				<h3 class="panel-title">数据管理</h3>
			</div>
			<a class="list-group-item" href="./list.php"><span class="glyphicon glyphicon-list" aria-hidden="true">&nbsp;订单管理</span></a>
			<a class="list-group-item" href="./classlist.php"><span class="glyphicon glyphicon-list" aria-hidden="true">&nbsp;分类管理</span></a>
			<a class="list-group-item" href="./shoplist.php"><span class="glyphicon glyphicon-list" aria-hidden="true">&nbsp;商品管理</span></a>
			<a class="list-group-item" href="./fakalist.php"><span class="glyphicon glyphicon-list" aria-hidden="true">&nbsp;发卡管理</span></a>
			<a class="list-group-item" href="./sitelist.php"><span class="glyphicon glyphicon-list" aria-hidden="true">&nbsp;分站列表</span></a>
			<a class="list-group-item" href="./record.php"><span class="glyphicon glyphicon-list" aria-hidden="true">&nbsp;收支明细</span></a>
			<?php if($conf['fenzhan_tixian']==1){?><a class="list-group-item" href="./tixian.php"><span class="glyphicon glyphicon-list" aria-hidden="true">&nbsp;余额提现</span></a><?php }?>
		</div>
		<div class="list-group">
			<div class="list-group-item list-group-item-success">
				<h3 class="panel-title">系统设置</h3>
			</div>
			<a class="list-group-item" href="./set.php?mod=site"><span class="glyphicon glyphicon-edit" aria-hidden="true">&nbsp;网站信息配置</span></a>
			<a class="list-group-item" href="./set.php?mod=gonggao"><span class="glyphicon glyphicon-edit" aria-hidden="true">&nbsp;网站公告配置</span></a>
			<a class="list-group-item" href="./shequlist.php"><span class="glyphicon glyphicon-edit" aria-hidden="true">&nbsp;社区对接配置</span></a>
			<a class="list-group-item" href="./set.php?mod=mail"><span class="glyphicon glyphicon-edit" aria-hidden="true">&nbsp;发信邮箱配置</span></a>
			<a class="list-group-item" href="./set.php?mod=pay"><span class="glyphicon glyphicon-edit" aria-hidden="true">&nbsp;支付接口配置</span></a>
			<a class="list-group-item" href="./set.php?mod=upimg"><span class="glyphicon glyphicon-edit" aria-hidden="true">&nbsp;网站Logo上传</span></a>
		</div>
	</div>
    <div class="col-sm-12 col-md-9 center-block">
      <div class="panel panel-primary">
        <div class="panel-heading text-center"><h3 class="panel-title" id="title">后台管理首页</h3></div>
<table class="table table-bordered">
<tbody>
<tr height="25">
<td align="center"><font color="#808080"><b><span class="glyphicon glyphicon-tint"></span>订单总数</b></br><span id="count1"></span>条</font></td>
<td align="center"><font color="#808080"><b><i class="glyphicon glyphicon-check"></i>已处理订单</b></br></span><span id="count2"></span>条</font></td>
<td align="center"><font color="#808080"><b><i class="glyphicon glyphicon-exclamation-sign"></i>待处理订单</b></span></br><span id="count3"></span>条</font></td>
</tr>
<tr height="25">
<td align="center"><font color="#808080"><b><i class="glyphicon glyphicon-time"></i>运营天数</b></br><span id="yxts"></span>天</font></td>
<td align="center"><font color="#808080"><b><span class="glyphicon glyphicon-tint"></span>今日订单数</b></br><span id="count4"></span>条</font></td>
<td align="center"><font color="#808080"><b><i class="glyphicon glyphicon-usd"></i>今日交易额</b></br></span><span id="count5"></span>元</font></td>
</tr>
<tr height="25">
<td align="center"><font color="#808080"><b><i class="glyphicon glyphicon-globe"></i>分站总数</b></span></br><span id="count6"></span>个</font></td>
<td align="center"><font color="#808080"><b><i class="glyphicon glyphicon-globe"></i>今日新开分站</b></br></span><span id="count7"></span>个</font></td>
<td align="center"><font color="#808080"><b><span class="glyphicon glyphicon-check"></span>今日分站提成</b></br><span id="count8"></span>元</font></td>
</tr>
<tr height="25">
<td align="center"><font color="#808080"><b><i class="glyphicon glyphicon-usd"></i>分站总提成</b></br><span id="count9"></span>元</font></td>
<td align="center"><font color="#808080"><b><i class="glyphicon glyphicon-gbp"></i>分站总资金</b></span></br><span id="count10"></span>元</font></td>
<td align="center"><font color="#808080"><b><i class="glyphicon glyphicon-usd"></i>待处理提现</b></br></span><span id="count11"></span>元</font></td>
</tr>
<tr height="25">
<td align="center"><font color="#808080"><b><span class="glyphicon glyphicon-check"></span>QQ钱包交易额</b></br><span id="count12"></span>元</font></td>
<td align="center"><font color="#808080"><b><i class="glyphicon glyphicon-check"></i>微信交易额</b></br></span><span id="count13"></span>元</font></td>
<td align="center"><font color="#808080"><b><i class="glyphicon glyphicon-check"></i>支付宝交易额</b></span></br><span id="count14"></span>元</font></td>
</tr>
<tr height="25">
<td align="center" colspan="3">
<a href="./set.php?mod=template" class="btn btn-sm btn-default"><i class="glyphicon glyphicon-cog"></i> 首页模板设置</a>&nbsp;
<a href="./choujiang.php" class="btn btn-sm btn-default"><i class="glyphicon glyphicon-cog"></i> 抽奖商品设置</a>&nbsp;
<a href="./set.php?mod=invite" class="btn btn-sm btn-default"><i class="glyphicon glyphicon-cog"></i> 推广链接设置</a>&nbsp;
<a href="./set.php?mod=dwz" class="btn btn-sm btn-default"><i class="glyphicon glyphicon-cog"></i> 防红接口设置</a>
</td>
</tr>
<tr height="25">
<td align="center" colspan="3"><a href="../" class="btn btn-sm btn-info"><i class="glyphicon glyphicon-home"></i>网站首页</a>&nbsp;<a href="./login.php?logout" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-log-out"></i>退出登录</a>&nbsp;<a href="./update.php" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-home"></i>检测更新</a></td>
</tr>
</tbody>
</table>
</div>
<div class="panel panel-info">
	<div class="panel-heading text-center">
		<h3 class="panel-title">安全中心</h3>
	</div>
	<ul class="list-group">
<?php
foreach($sec_msg as $row){
	echo $row;
}
if(count($sec_msg)==0)echo '<li class="list-group-item"><span class="btn-sm btn-success">正常</span>&nbsp;暂未发现网站安全问题</li>';
?>
	</ul>
</div>
    </div>
  </div>
<script>
$(document).ready(function(){
	$('#title').html('正在加载数据中...');
	$.ajax({
		type : "GET",
		url : "ajax.php?act=getcount",
		dataType : 'json',
		async: true,
		success : function(data) {
			$('#title').html('后台管理首页');
			$('#yxts').html(data.yxts);
			$('#count1').html(data.count1);
			$('#count2').html(data.count2);
			$('#count3').html(data.count3);
			$('#count4').html(data.count4);
			$('#count5').html(data.count5);
			$('#count6').html(data.count6);
			$('#count7').html(data.count7);
			$('#count8').html(data.count8);
			$('#count9').html(data.count9);
			$('#count10').html(data.count10);
			$('#count11').html(data.count11);
			$('#count12').html(data.count12);
			$('#count13').html(data.count13);
			$('#count14').html(data.count14);
		}
	});
})
</script>