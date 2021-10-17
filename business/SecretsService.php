<?php

class SecretsService {
    
    private $database = null;
    
    public function __construct(){
        $this->database = new Database();
    }
    
    public function addSecrets(?string $userId, ?string $secretName,  $KVPairs){
        
        $secretsDAO = new SecretsDAO();
        $userDAO = new LoginDAO();
        
        $conn = $this->database->getConnection();
        $conn->autocommit(FALSE);
        $conn->begin_transaction();

        $secretsDAO->addSecret($secretName, $conn);
        if($conn->insert_id == 0){
            $conn->rollback();
            $conn->close();
            return "Error";
        }
        $secretId = $conn->insert_id;
        
        foreach($KVPairs as $KVPair){
            $secretsDAO->addKeyValuePair($KVPair->getKey(), $KVPair->getValue(), $conn);
            if($conn->insert_id == 0){
                $conn->rollback();
                $conn->close();
                return "Error";
            }
            $keyId = $conn->insert_id;
    
            $successfulSKV = $secretsDAO->relateSecretAndKeyValue($secretId, $keyId, $conn);
            if(!$successfulSKV){
                $conn->rollback();
                $conn->close();
                return "Error";
            }
        }
        $successfulUS = $secretsDAO->relateUserAndSecret($userId, $secretId, $conn);
        if(!$successfulUS){
            $conn->rollback();
            $conn->close();
            return "Error";
        }
        
        $conn->commit();
        $conn->close();
        
        return TRUE;
    }
    
    public function getSecrets(?int $userId){
        $dao = new SecretsDAO();
        $secretsArr = array();
        
        $conn = $this->database->getConnection();
        
        $results = $dao->getUserSecretsList($userId, $conn);
        if($results == null){
            $conn->close();
            return null;
        }
        foreach($results as $result){
           $secret = $dao->getSecret($result, $conn);
           if($secret != null){
               array_push($secretsArr, $secret);
           }
        }
        
        $conn->close();
        return $secretsArr;
    }
    
    public function getKVPair(?int $secretId){
        $conn = $this->database->getConnection();
        $dao = new SecretsDAO();
        $keyIds = $dao->getKeyIds($secretId, $conn);

        if($keyIds == null){
            $conn->close();
            return null;
        }
        
        $KVPairs = array();

        foreach($keyIds as $key){
            $kvpair = $dao->getKVPair($key[0], $conn);
            array_push($KVPairs, $kvpair);
        }
        $conn->close();
        return $KVPairs;
    }

    public function deleteSecret(?int $secretId){
        $dao = new SecretsDAO();
        $conn = $this->database->getConnection();
        
        $conn->autocommit(FALSE);
        $conn->begin_transaction();
        
        
        $keyIds = $dao->getKeyIds($secretId, $conn);

        $secretsKeyDeleted = $dao->deleteSecretsKeys($secretId, $conn);
        if(!$secretsKeyDeleted){
            $conn->rollback();
            $conn->close();
            return FALSE;
        }

        foreach($keyIds as $key){
            $KVPairDeleted = $dao->deleteKVPair($key[0], $conn);
            if(!$KVPairDeleted){
                $conn->rollback();
                $conn->close();
                return FALSE;
            }
        }

        $secretDeleted = $dao->deleteSecret($secretId, $conn);
        if(!$secretDeleted){
            $conn->rollback();
            $conn->close();
            return FALSE;
        }
        $conn->commit();
        $conn->close();
        return TRUE;
    }

    public function updateKVPair($kvpairs){
        $conn = $this->database->getConnection();
        $dao = new SecretsDAO();

        $conn->autocommit(FALSE);
        $conn->begin_transaction();

        foreach($kvpairs as $kvpair){
            $isSuccessful = $dao->updateKVPair($kvpair, $conn);
            if(!$isSuccessful){
                $conn->rollback();
                $conn->close();
                return false;
            }
        }
        $conn->commit();
        $conn->close();
        return true;
    }

    public function doesSecretExist(?int $userId, ?string $secretName){
        $conn = $this->database->getConnection();
        $dao = new SecretsDAO();
        $doesExist = $dao->doesSecretExist($secretName, $userId, $conn);
        $conn->close();
        if($doesExist){
            return true;
        }
        return false;
    }
}
?>
