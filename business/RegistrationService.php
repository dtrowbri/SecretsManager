<?php

//require_once '../autoLoader.php';
//require_once '../database/database.php';
//require_once '../database/registrationDAO.php';

class RegistrationService {

    private $database = null;
    
    public function __construct(){
        echo "creating database object";
        $this->database = new Database();
        echo "database object created";
    }
    
    public function registerNewUser(?string $login, ?string $passwordHash){
        $conn = $this->database->getConnection();
        $dao = new RegistrationDAO();
        
        $conn->autocommit(FALSE);
        $conn->begin_transaction();
        
        $dao->addUser($login, $conn);
        if($conn->insert_id == 0){
            $conn->rollback();
            $conn->close();
            return FALSE;
        }
        $userInsertId = $conn->insert_id;
        
        $dao->addPassword($passwordHash, $conn);
        if($conn->insert_id == 0){
            $conn->rollback();
            $conn->close();
            return FALSE;
        }
        $passwordInsertId = $conn->insert_id;

        $isSuccess = $dao->relateUserAndPassword($userInsertId, $passwordInsertId, $conn);
        if(!$isSuccess){
            $conn->rollback();
            $conn->close();
            return FALSE;
        }
        $conn->commit();
        $conn->close();
        
        return TRUE;
    }
    
    public function doesLoginExist(?string $Login){
        echo "does user exist";
        $conn = $this->database->getConnection();
        echo "connection to database created";
       $dao = new RegistrationDAO();
        echo "registration dao created";
       $doesExist = $dao->doesLoginExist($Login, $conn);
        echo "verified if user exists";
       $conn->close();
       return $doesExist;
    }

}

?>
