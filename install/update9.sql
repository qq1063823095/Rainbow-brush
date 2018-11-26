ALTER TABLE `shua_shequ`
ADD COLUMN `paytype` tinyint(1) NOT NULL DEFAULT '0';

ALTER TABLE `shua_tools`
ADD COLUMN `shopimg` text DEFAULT NULL;

ALTER TABLE `shua_class`
ADD COLUMN `shopimg` text DEFAULT NULL;

ALTER TABLE `shua_site`
ADD COLUMN `utype` int(1) NOT NULL DEFAULT '0',
ADD COLUMN `lasttime` datetime DEFAULT NULL,
ADD INDEX domain (`domain`),
ADD INDEX domain2 (`domain2`);

ALTER TABLE `shua_giftlog`
ADD COLUMN `input` varchar(64) DEFAULT NULL;

INSERT INTO `shua_config` VALUES ('tongji_time', '60');
INSERT INTO `shua_config` VALUES ('fenzhan_expiry', '12');
INSERT INTO `shua_config` VALUES ('faka_mail', '<b>商品名称：</b> [name]<br/><b>购买时间：</b>[date]<br/><b>以下是你的卡密信息：</b><br/>[kmdata]<br/>----------<br/><b>使用说明：</b><br/>[alert]<br/>----------<br/>QQ代刷网自助下单平台<br/>[domain]');