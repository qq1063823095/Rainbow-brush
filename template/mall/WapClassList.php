<?php
if(!defined('IN_CRONLITE'))exit();

$rs=$DB->query("select * from shua_class where active=1 order by sort asc");

while($res = $DB->fetch($rs)){
	
	
echo "<ul class=\"mui-table-view mui-table-view-striped mui-table-view-condensed\">";
echo "<li class=\"mui-table-view-cell\">";
echo "<a href=\"javascript:void(0);\" url=\"./?mod=WapPostProduct&cid=$res[cid]\" style=\"color:#FF00FF ;font-weight:bold;\">";
echo "<div class=\"mui-table\">";	
echo "<div class=\"mui-table-cell mui-col-xs-12\">";
echo "<h4 class=\"mui-ellipsis-2\"><font style=\" background:#fba60a; color:#fff; padding:2px 3px; font-size:12px; margin-right:10px;\">热销</font>$res[name]</h4>";
echo "</div>";
echo "<div class=\"mui-table-cell mui-text-right\">";
echo "<button onclick=\"location='./?mod=WapPostProduct&cid=$res[cid]'\">立即<span style=\"font-weight:bold;\">购买</span></button>";


echo "</div>";		     
echo "</div>";
echo "</a>";
echo "</li>";
echo "</ul>";
echo "<div class=\"line\"></div>";
}

?>