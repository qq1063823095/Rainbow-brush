ALTER TABLE `shua_pay`
ADD COLUMN `ip` varchar(20) DEFAULT NULL,
ADD COLUMN `userid` varchar(32) DEFAULT NULL;

ALTER TABLE `shua_orders`
ADD COLUMN `userid` varchar(32) DEFAULT NULL;

ALTER TABLE `shua_site`
ADD COLUMN `power` int(11) NOT NULL DEFAULT '0';

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

INSERT INTO `shua_config` VALUES ('fenzhan_buy', '1');
INSERT INTO `shua_config` VALUES ('fenzhan_price', '10');
INSERT INTO `shua_config` VALUES ('fenzhan_free', '0');