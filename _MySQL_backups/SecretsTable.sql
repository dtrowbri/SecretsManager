CREATE TABLE `secrets` (
  `SecretId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `SecretName` varchar(100) NOT NULL,
  PRIMARY KEY (`SecretId`),
  UNIQUE KEY `SecretId_UNIQUE` (`SecretId`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8