ALTER TABLE `shua_pay`
ADD COLUMN `domain` varchar(64) DEFAULT NULL;
ALTER TABLE `shua_site`
ADD COLUMN `alert` text DEFAULT NULL;

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
  `status` int(1) NOT NULL DEFAULT 0,
PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `shua_config` VALUES ('gift_open', '0');
INSERT INTO `shua_config` VALUES ('cishu', '3');
INSERT INTO `shua_config` VALUES ('verify_open', '1');