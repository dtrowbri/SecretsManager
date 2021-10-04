CREATE TABLE `usersecrets` (
  `UserId` int(10) unsigned NOT NULL,
  `SecretsId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`UserId`,`SecretsId`),
  KEY `FK_usersecrets_secrets_SecretId_idx` (`SecretsId`),
  CONSTRAINT `FK_usersecrets_secrets_SecretId` FOREIGN KEY (`SecretsId`) REFERENCES `secrets` (`SecretId`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `FK_usersecrets_users_UserId` FOREIGN KEY (`UserId`) REFERENCES `users` (`UserId`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8