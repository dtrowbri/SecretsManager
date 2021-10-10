<?php

class SecretsDAO {
    
    public function addSecret(?string $secret, $conn){
        $addSecretQuery = "insert into secrets (`SecretId`, `SecretName`) values (null, ?)";
        $stmt = $conn->prepare($addSecretQuery);
        $stmt->bind_param('s', $secret);
        
        $stmt->execute();
        
        if($stmt->affected_rows ==1){
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function addKeyValuePair(?string $key, ?string $value, $conn){
        $addKeyValuePairQuery = "insert into keyvaluepairs (`KeyId`, `Key`, `Value`) values (null, ?, ?)";
        $stmt = $conn->prepare($addKeyValuePairQuery);
        $stmt->bind_param('ss', $key, $value);
        
        $stmt->execute();
        
        if($stmt->affected_rows == 1){
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function relateSecretAndKeyValue(?int $secretId, ?int $keyValueId, $conn){
        $relateSecretAndKVQuery = "insert into secretskeys (`SecretId`, `KeyId`) values (?, ?)";
        $stmt = $conn->prepare($relateSecretAndKVQuery);
        $stmt->bind_param('ii', $secretId, $keyValueId);
        
        $stmt->execute();
        
        if($stmt->affected_rows == 1){
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function relateUserAndSecret(?int $userId, ?int $secretId, $conn){
        $relateUserAndSecret = "insert into usersecrets (`UserId`, `SecretsId`) values (?, ?)";
        $stmt = $conn->prepare($relateUserAndSecret);
        $stmt->bind_param('ii', $userId, $secretId);
        
        $stmt->execute();
        
        if($stmt->affected_rows == 1){
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function getSecret(?int $secretId, $conn){
        $getSecretsQuery = "select SecretId, SecretName from secrets where SecretId = ?";
        $stmt = $conn->prepare($getSecretsQuery);
        $stmt->bind_param('i', $secretId);
        
        $stmt->execute();
        $results = $stmt->get_result();
        
        if($results->num_rows == 1){
            $result = $results->fetch_assoc();
            $secret = new Secret($result["SecretId"], $result["SecretName"]);
            return $secret;
        } else {
            return null;
        }
    }
    
    public function getUserSecretsList(?int $userId, $conn){
        $secretsQuery = "select SecretsId from usersecrets where UserId = ?";
        $stmt = $conn->prepare($secretsQuery);
        $stmt->bind_param('i', $userId);
        
        $stmt->execute();
        $results = $stmt->get_result();
 
        if($results->num_rows > 0){
            $results = $results->fetch_all();
            $secretsArr = array();
            
            foreach($results as $result){
                array_push($secretsArr, $result[0]);
            }
            return $secretsArr;
        } else {
            return null;
        }
    }
    
    public function getKVPair(?int $keyId, $conn){
        $kvPairQuery = "select KeyId, `Key`, Value from keyvaluepairs where KeyId = ?";
        $stmt = $conn->prepare($kvPairQuery);
        $stmt->bind_param('i', $keyId);

        $stmt->execute();
        $results = $stmt->get_result();

        if($results->num_rows == 1){
            $result = $results->fetch_assoc();
            $kvpair = new KVPair($result["KeyId"], $result["Key"], $result["Value"]);

            return $kvpair;
        } else {
            return null;
        }
    }
    
    public function getKeyId(?int $secretId, $conn){
        $keyIdQuery = "select KeyId from secretskeys where SecretId = ?";
        $stmt = $conn->prepare($keyIdQuery);
        $stmt->bind_param('i', $secretId);
        
        $stmt->execute();
        $results = $stmt->get_result();
        
        if($results->num_rows == 1){
            $result = $results->fetch_assoc();
            return $result["KeyId"];
        } else {
            return null;
        }
        
    }

    public function deleteKVPair(?int $keyId, $conn){
        $deletionQuery = "delete from keyvaluepairs where KeyId = ?";
        $stmt = $conn->prepare($deletionQuery);
        $stmt->bind_param('i', $keyId);
        
        $stmt->execute();
        
        if($stmt->affected_rows == 1){
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function deleteSecretsKeys(?int $secretId, $conn){
        $deletionQuery = "delete from secretskeys where SecretId = ?";
        $stmt = $conn->prepare($deletionQuery);
        $stmt->bind_param('i', $secretId);
        
        $stmt->execute();
        
        if($stmt->affected_rows == 1 ){
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function deleteSecret(?int $secretId, $conn){
        $deletionQuery = "delete from secrets where SecretId = ?";
        $stmt = $conn->prepare($deletionQuery);
        $stmt->bind_param('i', $secretId);
        
        $stmt->execute();
        
        if($stmt->affected_rows == 1){
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function updateKVPair(?KVPair $kvpair, $conn){
        $query = "update `keyvaluepairs` set `Key` = ?, `Value` = ? where `KeyId` = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssi', $kvpair->getKey(), $kvpair->getValue(), $kvpair->getKeyId());
        
        $conn->autocommit(FALSE);
        $conn->begin_transaction();
        $stmt->execute();
        
        if($stmt->affected_rows == 1){
            $conn->commit();
            return true;
        } else {
            $conn->rollback();
            return false;
        }
    }
}

?>