CREATE TABLE `passwords` (
  `PasswordId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `PasswordHash` varchar(128) NOT NULL,
  PRIMARY KEY (`PasswordId`),
  UNIQUE KEY `PasswordId_UNIQUE` (`PasswordId`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8