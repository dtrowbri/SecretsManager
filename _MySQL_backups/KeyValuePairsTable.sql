CREATE TABLE `keyvaluepairs` (
  `KeyId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Key` varchar(255) NOT NULL,
  `Value` varchar(255) NOT NULL,
  PRIMARY KEY (`KeyId`),
  UNIQUE KEY `PairId_UNIQUE` (`KeyId`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8