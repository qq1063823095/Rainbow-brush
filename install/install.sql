DROP TABLE IF EXISTS `shua_config`;
create table `shua_config` (
`k` varchar(32) NOT NULL,
`v` text NULL,
PRIMARY KEY  (`k`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `shua_config` VALUES ('cache', '');
INSERT INTO `shua_config` VALUES ('version', '1056');
INSERT INTO `shua_config` VALUES ('admin_user', 'admin');
INSERT INTO `shua_config` VALUES ('admin_pwd', '123456');
INSERT INTO `shua_config` VALUES ('alipay_api', '2');
INSERT INTO `shua_config` VALUES ('tenpay_api', '2');
INSERT INTO `shua_config` VALUES ('qqpay_api', '2');
INSERT INTO `shua_config` VALUES ('wxpay_api', '2');
INSERT INTO `shua_config` VALUES ('style', '1');
INSERT INTO `shua_config` VALUES ('sitename', 'QQ空间业务自助下单平台');
INSERT INTO `shua_config` VALUES ('keywords', 'QQ空间业务自助下单平台');
INSERT INTO `shua_config` VALUES ('description', 'QQ空间业务自助下单平台');
INSERT INTO `shua_config` VALUES ('kfqq', '123456789');
INSERT INTO `shua_config` VALUES ('anounce', '<p>
<li class="list-group-item"><span class="btn btn-danger btn-xs">1</span> QQ名片赞日刷上万，超快空间人气日刷百万，球球冰红茶CDK超低价销售</li>
<li class="list-group-item"><span class="btn btn-success btn-xs">2</span> 温馨提示：请勿重复下单哦！必须要等待前面任务订单完成才可以下单！</li>
<li class="list-group-item"><span class="btn btn-info btn-xs">3</span> 下单之前请一定要看完该商品的注意事项再进行下单！</li>
<li class="list-group-item"><span class="btn btn-warning btn-xs">4</span> 所有业务全部恢复，都可以正常下单，欢迎尝试，有问题可以联系客服</li>
<li class="list-group-item"><span class="btn btn-primary btn-xs">5</span> 一般下单后会在1-30分钟内提交到服务器，就让单子来的更猛烈些吧！</li>
<div class="btn-group btn-group-justified">
<a target="_blank" class="btn btn-info" href="http://wpa.qq.com/msgrd?v=3&uin=123456&site=qq&menu=yes"><i class="fa fa-qq"></i> 联系客服</a>
<a target="_blank" class="btn btn-warning" href="http://qun.qq.com/join.html"><i class="fa fa-users"></i> 官方Q群</a>
<a target="_blank" class="btn btn-danger" href="./"><i class="fa fa-cloud-download"></i> APP下载</a>
</div></p>');
INSERT INTO `shua_config` VALUES ('kaurl', '');
INSERT INTO `shua_config` VALUES ('modal', '');
INSERT INTO `shua_config` VALUES ('bottom', '<table class="table table-bordered">
<tbody>
<tr height="50">
<td><button type="button" class="btn btn-block btn-warning"><a href="http://www.cccyun.cc" target="_blank"><span style="color:#ffffff">♚彩虹网址导航♚</span></a></button></td>
<td><button type="button" class="btn btn-block btn-warning"><a href="http://www.qqzzz.net/" target="_blank"><span style="color:#ffffff">♚彩虹云任务♚</span></a></button></td>
</tr>
<tr height="50">
<td><button type="button" class="btn btn-block btn-success"><a href="./" target="_blank"><span style="color:#ffffff">♚友链♚</span></a></button></td>
<td><button type="button" class="btn btn-block btn-success"><a href="./" target="_blank"><span style="color:#ffffff">♚友链♚</span></a></button></td>
</tr></tbody>
</table>');
INSERT INTO `shua_config` VALUES ('gg_search', '<span class="label label-primary">待处理</span> 说明正在努力提交到服务器！<p></p><p></p><span class="label label-success">已完成</span> 并不是刷完了只是开始刷了！<p></p><p></p><span class="label label-warning">处理中</span> 已经开始为您开单 请耐心等！<p></p><p></p><span class="label label-danger">有异常</span> 下单信息有误 联系客服处理！');
INSERT INTO `shua_config` VALUES ('gg_reguser', '<div class="alert alert-success">分站系统新上线，首开限时优惠中，仅需10元即可开通！</div><div class="alert alert-info">点击下方按钮系统全自动为你开通分站，无需手工搭建，更不需要建站技术即可拥有自己的平台。</div>');
INSERT INTO `shua_config` VALUES ('chatframe', '');
INSERT INTO `shua_config` VALUES ('fenzhan_expiry', '12');
INSERT INTO `shua_config` VALUES ('fenzhan_tixian', '0');
INSERT INTO `shua_config` VALUES ('fenzhan_buy', '1');
INSERT INTO `shua_config` VALUES ('fenzhan_price', '10');
INSERT INTO `shua_config` VALUES ('fenzhan_price2', '20');
INSERT INTO `shua_config` VALUES ('fenzhan_free', '0');
INSERT INTO `shua_config` VALUES ('tixian_rate', '90');
INSERT INTO `shua_config` VALUES ('tixian_min', '10');
INSERT INTO `shua_config` VALUES ('mail_smtp', 'smtp.qq.com');
INSERT INTO `shua_config` VALUES ('mail_port', '465');
INSERT INTO `shua_config` VALUES ('template', 'default');
INSERT INTO `shua_config` VALUES ('verify_open', '1');
INSERT INTO `shua_config` VALUES ('gift_open', '0');
INSERT INTO `shua_config` VALUES ('cishu', '3');
INSERT INTO `shua_config` VALUES ('tongji_time', '60');
INSERT INTO `shua_config` VALUES ('faka_mail', '<b>商品名称：</b> [name]<br/><b>购买时间：</b>[date]<br/><b>以下是你的卡密信息：</b><br/>[kmdata]<br/>----------<br/><b>使用说明：</b><br/>[alert]<br/>----------<br/>QQ代刷网自助下单平台<br/>[domain]');

DROP TABLE IF EXISTS `shua_class`;
CREATE TABLE `shua_class` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `zid` int(11) NOT NULL DEFAULT '1',
  `sort` int(11) NOT NULL DEFAULT '10',
  `name` varchar(255) NOT NULL,
  `shopimg` text DEFAULT NULL,
  `active` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `shua_tools`;
CREATE TABLE `shua_tools` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `zid` int(11) NOT NULL DEFAULT '1',
  `cid` int(11) NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '10',
  `name` varchar(255) NOT NULL,
  `value` int(11) NOT NULL DEFAULT '0',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `cost` decimal(10,2) NOT NULL DEFAULT '0.00',
  `cost2` decimal(10,2) NOT NULL DEFAULT '0.00',
  `input` varchar(120) NOT NULL,
  `inputs` varchar(250) DEFAULT NULL,
  `alert` text DEFAULT NULL,
  `shopimg` text DEFAULT NULL,
  `validate` tinyint(2) NOT NULL DEFAULT '0',
  `is_curl` tinyint(2) NOT NULL DEFAULT '0',
  `curl` varchar(255) DEFAULT NULL,
  `repeat` tinyint(2) NOT NULL DEFAULT '0',
  `multi` tinyint(1) NOT NULL DEFAULT '0',
  `shequ` tinyint(3) NOT NULL DEFAULT '0',
  `goods_id` int(11) NOT NULL DEFAULT '0',
  `goods_type` int(11) NOT NULL DEFAULT '0',
  `goods_param` varchar(180) DEFAULT NULL,
  `active` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`tid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `shua_orders`;
CREATE TABLE `shua_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tid` int(11) NOT NULL,
  `zid` int(11) NOT NULL DEFAULT '1',
  `input` varchar(64) NOT NULL,
  `input2` varchar(64) DEFAULT NULL,
  `input3` varchar(64) DEFAULT NULL,
  `input4` varchar(64) DEFAULT NULL,
  `input5` varchar(64) DEFAULT NULL,
  `value` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(2) NOT NULL DEFAULT '0',
  `djzt` tinyint(2) NOT NULL DEFAULT '0',
  `djorder` varchar(32) DEFAULT NULL,
  `url` varchar(32) DEFAULT NULL,
  `result` text DEFAULT NULL,
  `userid` varchar(32) DEFAULT NULL,
  `tradeno` varchar(32) DEFAULT NULL,
  `money` decimal(10,2) NOT NULL DEFAULT '0.00',
  `addtime` datetime DEFAULT NULL,
  `endtime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `shua_kms`;
CREATE TABLE `shua_kms` (
  `kid` int(11) NOT NULL AUTO_INCREMENT,
  `tid` int(11) NOT NULL,
  `zid` int(11) NOT NULL DEFAULT '1',
  `km` varchar(255) NOT NULL,
  `value` int(11) NOT NULL DEFAULT '0',
  `addtime` timestamp NULL DEFAULT NULL,
  `user` varchar(20) NOT NULL DEFAULT '0',
  `usetime` timestamp NULL DEFAULT NULL,
  `money` varchar(32) DEFAULT NULL,
  `orderid` int(11) NULL DEFAULT '0',
  PRIMARY KEY (`kid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `shua_faka`;
CREATE TABLE `shua_faka` (
  `kid` int(11) NOT NULL AUTO_INCREMENT,
  `tid` int(11) NOT NULL,
  `km` varchar(255) DEFAULT NULL,
  `pw` varchar(255) DEFAULT NULL,
  `addtime` datetime DEFAULT NULL,
  `usetime` datetime DEFAULT NULL,
  `orderid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`kid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `shua_pay`;
CREATE TABLE `shua_pay` (
  `trade_no` varchar(64) NOT NULL,
  `type` varchar(20) NULL,
  `zid` int(11) NOT NULL DEFAULT '1',
  `tid` int(11) NOT NULL,
  `input` text NOT NULL,
  `num` int(11) NOT NULL DEFAULT '1',
  `addtime` datetime NULL,
  `endtime` datetime NULL,
  `name` varchar(64) NULL,
  `money` varchar(32) NULL,
  `ip` varchar(20) NULL,
  `userid` varchar(32) DEFAULT NULL,
  `inviteid` int(11) DEFAULT NULL,
  `domain` varchar(64) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`trade_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `shua_site`;
CREATE TABLE `shua_site` (
  `zid` int(11) NOT NULL AUTO_INCREMENT,
  `upzid` int(11) NOT NULL DEFAULT '0',
  `utype` int(1) NOT NULL DEFAULT '0',
  `power` int(11) NOT NULL DEFAULT '0',
  `domain` varchar(50) NOT NULL,
  `domain2` varchar(50) DEFAULT NULL,
  `user` varchar(20) NOT NULL,
  `pwd` varchar(32) NOT NULL,
  `rmb` decimal(10,2) NOT NULL DEFAULT '0.00',
  `point` int(11) NOT NULL DEFAULT '0',
  `pay_type` int(1) NOT NULL DEFAULT '0',
  `pay_account` varchar(50) DEFAULT NULL,
  `pay_name` varchar(50) DEFAULT NULL,
  `qq` varchar(12) DEFAULT NULL,
  `sitename` varchar(80) DEFAULT NULL,
  `title` varchar(80) DEFAULT NULL,
  `keywords` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `kaurl` varchar(50) DEFAULT NULL,
  `anounce` text DEFAULT NULL,
  `bottom` text DEFAULT NULL,
  `modal` text DEFAULT NULL,
  `alert` text DEFAULT NULL,
  `price` text DEFAULT NULL,
  `ktfz_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `ktfz_price2` decimal(10,2) NOT NULL DEFAULT '0.00',
  `ktfz_domain` text DEFAULT NULL,
  `addtime` datetime DEFAULT NULL,
  `lasttime` datetime DEFAULT NULL,
  `endtime` datetime DEFAULT NULL,
  `template` varchar(10) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`zid`),
  INDEX domain (`domain`),
  INDEX domain2 (`domain2`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=2;

DROP TABLE IF EXISTS `shua_tixian`;
CREATE TABLE `shua_tixian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `zid` int(11) NOT NULL,
  `money` decimal(10,2) NOT NULL DEFAULT '0.00',
  `realmoney` decimal(10,2) NOT NULL DEFAULT '0.00',
  `pay_type` int(1) NOT NULL DEFAULT '0',
  `pay_account` varchar(50) NOT NULL,
  `pay_name` varchar(50) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '0',
  `addtime` datetime DEFAULT NULL,
  `endtime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `shua_points`;
CREATE TABLE `shua_points` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `zid` int(11) NOT NULL DEFAULT '0',
  `action` varchar(255) NOT NULL,
  `point` decimal(10,2) NOT NULL DEFAULT '0.00',
  `bz` varchar(1024) DEFAULT NULL,
  `addtime` datetime DEFAULT NULL,
  `orderid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `shua_shequ`;
CREATE TABLE `shua_shequ` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `paypwd` varchar(255) DEFAULT NULL,
  `paytype` tinyint(1) NOT NULL DEFAULT '0',
  `type` tinyint(3) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `shua_logs`;
CREATE TABLE `shua_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `action` varchar(32) NOT NULL,
  `param` varchar(255) NOT NULL,
  `result` text DEFAULT NULL,
  `addtime` datetime DEFAULT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `shua_gift`;
CREATE TABLE `shua_gift` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `tid` int(11) NOT NULL,
  `rate` int(3) NOT NULL,
  `ok` int(1) NOT NULL DEFAULT 0,
  `not` int(1) NOT NULL DEFAULT 0,
PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `shua_giftlog`;
CREATE TABLE `shua_giftlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `zid` int(11) NOT NULL DEFAULT 0,
  `tid` int(11) NOT NULL,
  `gid` int(11) NOT NULL,
  `userid` varchar(32) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `addtime` datetime DEFAULT NULL,
  `tradeno` varchar(32) DEFAULT NULL,
  `input` varchar(64) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `shua_invite`;
CREATE TABLE `shua_invite`(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `qq` VARCHAR(20) NOT NULL UNIQUE,
  `key` VARCHAR(30) NOT NULL UNIQUE,
  `ip` VARCHAR(25) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `shua_invitelog`;
CREATE TABLE `shua_invitelog`(
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nid` int(11) NOT NULL,
  `zid` int(11) NOT NULL DEFAULT '1',
  `date` datetime DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `orderid` int(11) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;