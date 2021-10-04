CREATE TABLE `userpasswords` (
  `UserId` int(10) unsigned NOT NULL,
  `PasswordId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`UserId`,`PasswordId`),
  UNIQUE KEY `UserId_UNIQUE` (`UserId`),
  KEY `FK_userpasswords_passowords_PasswordId_idx` (`PasswordId`),
  CONSTRAINT `FK_userpasswords_passowords_PasswordId` FOREIGN KEY (`PasswordId`) REFERENCES `passwords` (`PasswordId`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `FK_userpasswords_users_UserId` FOREIGN KEY (`UserId`) REFERENCES `users` (`UserId`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8