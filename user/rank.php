<?php
/**
 * 分站排行
**/
include("../includes/common.php");
$title='今日分站排行';
include './head.php';
if($islogin2==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>
  <div class="container" style="padding-top:70px;">
    <div class="col-xs-12 col-sm-10 col-md-8 center-block" style="float: none;">
<?php

?>
<div class="panel panel-success">
     <div class="panel-heading">今日分站排行</div>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead><tr><th class="text-center">排名</th><th class="text-center">站点ID</th><th class="text-center">站点名称</th><th class="text-center">订单数</th><th class="text-center">销售金额</th></tr></thead>
          <tbody>
<?php
$thtime=date("Y-m-d").' 00:00:00';
$sql = "select a.zid,(select b.sitename from shua_site as b where a.zid=b.zid) as sitename,count(id) as count,sum(money) as money from shua_orders as a where addtime>'$thtime' and zid>1 group by zid order by money desc limit 10";
$rs=$DB->query($sql);
$i=1;
while($res = $DB->fetch($rs))
{
echo '<tr><td class="text-center"><span class="badge badge-danger">'.$i.'</span></td><td class="text-center"><b>'.$res['zid'].'</b></td><td class="text-center">'.$res['sitename'].'</td><td class="text-center">'.$res['count'].'</td><td class="text-center">'.$res['money'].'</td></tr>';
$i++;
}
?>
          </tbody>
        </table>
      </div>
    </div>
 </div>
</div>