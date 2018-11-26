<?php
if(!defined('IN_CRONLITE'))exit();
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, width=device-width">
   <title><?php echo $conf['sitename']?> - <?php echo $conf['title']?></title>
  <meta name="keywords" content="<?php echo $conf['keywords']?>">
  <meta name="description" content="<?php echo $conf['description']?>">
  <link rel="icon" href="favicon.ico" type="image/x-icon">
  <link href="//lib.baomitu.com/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="//lib.baomitu.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
  <link href="<?php echo $cdnserver?>assets/qiuqiu/css/style.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="<?php echo $cdnserver?>assets/qiuqiu/css/font.css">
  <script src="//lib.baomitu.com/jquery/1.12.4/jquery.min.js"></script>
  <script src="<?php echo $cdnserver?>assets/qiuqiu/js/function.js"></script>
  <script src="//lib.baomitu.com/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<style>
img.logo{width:14px;height:14px;margin:0 5px 0 3px;}
body{
background:#ecedf0 url("assets/img/bj.png") fixed;
background-repeat:repeat;}
.onclick{cursor: pointer;touch-action: manipulation;}
</style>
</head>
<div id="bob">
<div id="hd">
	<div class="head">
