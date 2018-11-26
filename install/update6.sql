ALTER TABLE `shua_config` ENGINE=InnoDB;
ALTER TABLE `shua_class` ENGINE=InnoDB;
ALTER TABLE `shua_tools` ENGINE=InnoDB;
ALTER TABLE `shua_orders` ENGINE=InnoDB;
ALTER TABLE `shua_kms` ENGINE=InnoDB;
ALTER TABLE `shua_pay` ENGINE=InnoDB;
ALTER TABLE `shua_site` ENGINE=InnoDB;
ALTER TABLE `shua_tixian` ENGINE=InnoDB;
ALTER TABLE `shua_points` ENGINE=InnoDB;
ALTER TABLE `shua_shequ` ENGINE=InnoDB;
ALTER TABLE `shua_logs` ENGINE=InnoDB;

INSERT INTO `shua_config` VALUES ('fenzhan_price2', '20');
INSERT INTO `shua_config` VALUES ('gg_reguser', '<div class="alert alert-success">分站系统新上线，首开限时优惠中，仅需10元即可开通！</div><div class="alert alert-info">点击下方按钮系统全自动为你开通分站，无需手工搭建，更不需要建站技术即可拥有自己的平台。</div>');

ALTER TABLE `shua_tools`
ADD COLUMN `cost2` decimal(10,2) NOT NULL DEFAULT '0.00';

ALTER TABLE `shua_orders`
ADD COLUMN `money` decimal(10,2) NOT NULL DEFAULT '0.00',
ADD COLUMN `djzt` tinyint(2) NOT NULL DEFAULT '0',
ADD COLUMN `djorder` varchar(32) DEFAULT NULL;

ALTER TABLE `shua_site`
ADD COLUMN `ktfz_price` decimal(10,2) NOT NULL DEFAULT '0.00',
ADD COLUMN `ktfz_price2` decimal(10,2) NOT NULL DEFAULT '0.00',
ADD COLUMN `ktfz_domain` text DEFAULT NULL;

ALTER TABLE `shua_shequ`
ADD COLUMN `status` tinyint(1) NOT NULL DEFAULT '0';

ALTER TABLE `shua_pay`
ADD COLUMN `domain` varchar(64) DEFAULT NULL;

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