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
}
?>