CREATE TABLE `users` (
  `UserId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Login` varchar(100) NOT NULL,
  PRIMARY KEY (`UserId`),
  UNIQUE KEY `UserId_UNIQUE` (`UserId`),
  UNIQUE KEY `Login_UNIQUE` (`Login`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8