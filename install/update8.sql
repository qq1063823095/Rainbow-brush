ALTER TABLE `shua_pay`
ADD COLUMN `inviteid` int(11) DEFAULT NULL;

ALTER TABLE `shua_site`
ADD COLUMN `template` varchar(10) DEFAULT NULL;

ALTER TABLE `shua_tools`
MODIFY COLUMN `inputs` varchar(255) DEFAULT NULL;

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