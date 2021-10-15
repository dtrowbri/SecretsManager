<?php

class SecretsService {
    
    private $database = null;
    
    public function __construct(){
        $this->database = new Database();
    }
    
    public function addSecrets(?string $userId, ?string $secretName,  $Key,  $Value){
        
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
        
        $secretsDAO->addKeyValuePair($Key, $Value, $conn);
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
        echo "get test";
        
        $dao = new SecretsDAO();
        $secretsArr = array();
        
        $conn = $this->database->getConnection();
        
        $results = $dao->getUserSecretsList($userId, $conn);
        if(count($results) == 0){
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
        $keyId = $dao->getKeyId($secretId, $conn);

        if($keyId == null){
            $conn->close();
            return null;
        }
        $kvpair = $dao->getKVPair($keyId, $conn);
        $conn->close();
        return $kvpair;
    }

    public function deleteSecret(?int $secretId){
        $dao = new SecretsDAO();
        $conn = $this->database->getConnection();
        
        $conn->autocommit(FALSE);
        $conn->begin_transaction();
        
        echo "1";
        
        $keyId = $dao->getKeyId($secretId, $conn);
        
        $secretsKeyDeleted = $dao->deleteSecretsKeys($secretId, $conn);
        if(!$secretsKeyDeleted){
            $conn->rollback();
            $conn->close();
            return FALSE;
        }
        
        $KVPairDeleted = $dao->deleteKVPair($keyId, $conn);
        if(!$KVPairDeleted){
            $conn->rollback();
            $conn->close();
            return FALSE;
        }
        echo "2";
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

    public function updateKVPair(?KVPair $kvpair){
        $conn = $this->database->getConnection();
        $dao = new SecretsDAO();
        $isSuccessful = $dao->updateKVPair($kvpair, $conn);
        $conn->close();
        return $isSuccessful;
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
