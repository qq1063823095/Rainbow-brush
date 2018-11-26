<?php
if(!defined('IN_CRONLITE'))exit();
if(checkmobile() && !$_GET['pc'] || $_GET['mobile']){include_once TEMPLATE_ROOT.'mall/WapProduct.php';exit;}
$title = '商品列表';
include TEMPLATE_ROOT.'mall/head.php';
?>
	<style>
		.tjBox{width:1180px;margin:0px auto;height:25px;line-height:25px;}
        .tjBox span,.tjBox a{display:inline-block;font-size:13px;color:#555;}
        .scrolltitle { height: 24px; font-size: 14px; width: 1160px; border-bottom: solid 1px #ddd; margin: 20px auto 15px auto; }
        a.abtn { display: block; height: 310px; width: 17px; overflow: hidden; background: url(//zuhaowan.zuhaowan.com/v1/images/arrow3.png) no-repeat 0px 50%; }
        a.aleft { float: left; }
        a.agrayleft { cursor: default; background-position: -34px 50%; }
        a.aright { float: right; background-position: -17px 50%; }
        a.agrayright { cursor: default; background-position: -51px 50%; }
        .scrolllist { width: 1215px; height: 310px; margin: 0 auto;position:relative;left:-8px; }
        .scrolllist .imglist_w { width: 1180px; height: 310px; overflow: hidden; float: left; position: relative;/*必要元素*/ }
        .scrolllist .imglist_w ul { width: 20000000px; position: absolute; left: 0px; top: 0px; }
        .scrolllist .imglist_w li { width: 216px; float: left; padding: 0 10px; }
        #player{position: fixed; top:300px;left: 15px;width: 168px;height: 300px;z-index:9999 ;margin-right: 315px;}
        .close_video{height: 30px;width: 30px;position: absolute;top: -15px;right: -15px;border-radius: 50%;z-index: 10000;cursor: pointer;text-align: center;line-height: 30px;font-size: 18px;background: rgba(0,0,0,0.6);color: #ffffff;}
        .video_title{text-align: center;font-size: 18px;line-height: 24px;} 
		.searchBC li:hover{color:#fff!important;background:#666!important;}
		.searchBC li:hover a{color:#fff!important;background:#666!important;}
		.searchBC .li_txt,.searchancedSS .li_txt{color:#fff!important;background:#df3234;}
		.searchBC .li_txt:hover,.searchancedSS .li_txt:hover{color:#fff!important;background:#df3234;}
		.rentZQ a{color:#555!important;}
		.Main_left .searchBox1 .serchlist .con .searchLiA { background:#FFC447; color:#fff; margin-bottom: 5px;}
		.Main_left .searchBox1 .serchlist .con .searchLiA:hover { background:#FF8247; color:#fff;}
		</style>

<div class="Main">


    <!-- 高级搜索 End -->
            <!-- SearchBar End -->
	
    <div class="Main_left_bottom" style="position:relative">

        <div class="clear"></div>
        <div class="table-a">
            <!--店铺轮播开始-->
             <!---->
            <!--店铺轮播结束-->
            <table width="100%" cellspacing="0" cellpadding="0" border="0" class="epic_s">
                <tbody id="AccountList" style="padding:10px 0;">
				
	<style>
		.ProductList {background: #B9B9B9; width:191px; height: 272px; float:left; margin-left:4px; margin-bottom: 5px; border: 2px solid #B9B9B9;transition:all .3s;-webkit-transition:all .3s;}
		.ProductList:hover { border-color:#e6292c; background: #e6292c; color:#fff;transition:all .3s;-webkit-transition:all .3s;}
		
		.ProductListBottom {bottom:0; height: 25px; line-height: 25px; color:#fff; }

	</style>
<?php

if ($_GET['search']=="yes"){
	$kw = trim(daddslashes($_GET['kw']));
	$rs=$DB->query("select * from shua_class where active=1 and name like'%{$kw}%' order by sort asc");
}else{
	$rs=$DB->query("select * from shua_class where active=1 order by sort asc");
}

while($row = $DB->fetch($rs)){
	if(!empty($row["shopimg"])){
		$productimg = $row["shopimg"];
	}else{
		$productimg = 'assets/img/Product/default.png';
	}
?>
<div class="ProductList">
	<a href="./?mod=PostProduct&cid=<?php echo $row["cid"]?>">
	<div style="background:#fff url(<?php echo $productimg?>)no-repeat center; background-size:100%;width:191px; height:247px;"></div>
	<div class="ProductListBottom"><?php echo $row["name"]?></div>
	</a>
</div>
<?php
}
?>	
		
		               </tbody>
            </table>
        </div>
        <div class="od_page" style="text-align: center;">
            <div class="pages"></div>
        </div>
    </div>
</div><div class="clear"></div>
<div class="anli_wrap"></div>

 
      <!--  bottom-bottom-->

<?php include TEMPLATE_ROOT.'mall/foot.php';?>

<link rel="stylesheet" type="text/css" href="<?php echo $cdnserver?>assets/mall/css/suspend.css?t=0709">

<?php
include TEMPLATE_ROOT.'mall/footer.php';
?>