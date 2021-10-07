<?php

//require_once '../autoLoader.php';

class LoginService {
    
    private $database = null;
    
    public function __construct(){
        $this->database = new Database();
    }
    
    public function validateLogin(?string $Login, ?string $passwordHash){
        $conn = $this->database->getConnection();
        $dao = new LoginDAO();
        
        $userId = $dao->getLoginId($Login, $conn);
        if($userId == "Error"){
            $conn->close();
            return FALSE;
        }

        $passwordId = $dao->getPasswordId($userId, $conn);
        if($passwordId == "Error"){
            $conn->close();
            return FALSE;
        }

        $authenticated = $dao->validatePasswordMatch($passwordHash, $passwordId, $conn);
        $conn->close();

        if($authenticated){
            return TRUE;
        } else {
            return FALSE;
        }

    }
    
    public function getUserId(?string $Login){
        $conn = $this->database->getConnection();
        $dao = new LoginDAO();
        $userId = $dao->getLoginId($Login, $conn);
        $conn->close();
        return $userId;
    }
    
    public function getUserName(?string $userId){
        $conn = $this->database->getConnection();
        $dao = new LoginDAO();
        $userName = $dao->getUserName($userId, $conn);
        $conn->close();
        return $userName;
    }
}

?>