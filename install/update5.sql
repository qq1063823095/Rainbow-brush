ALTER TABLE `shua_orders`
ADD COLUMN `tradeno` varchar(32) DEFAULT NULL;

ALTER TABLE `shua_kms`
ADD COLUMN `money` varchar(32) DEFAULT NULL;

ALTER TABLE `shua_tools`
ADD COLUMN `validate` tinyint(2) NOT NULL DEFAULT '0',
MODIFY COLUMN `goods_param` varchar(180) DEFAULT NULL;

ALTER TABLE `shua_site`
ADD COLUMN `pay_type` int(1) NOT NULL DEFAULT '0';

ALTER TABLE `shua_tixian`
ADD COLUMN `pay_type` int(1) NOT NULL DEFAULT '0';

ALTER TABLE `shua_shequ`
ADD COLUMN `paypwd` varchar(255) DEFAULT NULL;