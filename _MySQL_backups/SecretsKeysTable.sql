CREATE TABLE `secretskeys` (
  `SecretId` int(10) unsigned NOT NULL,
  `KeyId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`SecretId`,`KeyId`),
  KEY `FK_secretskeys_keyvaluepairs_KeyId_idx` (`KeyId`),
  CONSTRAINT `FK_secretskeys_keyvaluepairs_KeyId` FOREIGN KEY (`KeyId`) REFERENCES `keyvaluepairs` (`KeyId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_secretskeys_secrets_SecretId` FOREIGN KEY (`SecretId`) REFERENCES `secrets` (`SecretId`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8