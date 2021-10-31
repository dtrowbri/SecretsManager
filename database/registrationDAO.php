<?php

class RegistrationDAO {
    public function addUser(?string $user, $conn){
        $addUserQuery = "insert into users (`UserId`,`Login`) values (null,?)";
        $stmt = $conn->prepare($addUserQuery);
        $stmt->bind_param('s', $user);
        
        $stmt->execute();
        
        if($stmt->affected_rows == 1){
            return TRUE;
        }else {
            return FALSE;
        }
    }
    
    public function addPassword(?string $passwordHash, $conn){      
        echo "adding new user";
        $addPasswordQuery = "insert into passwords (`PasswordId`,`PasswordHash`) values (null,?)";
        $stmt = $conn->prepare($addPasswordQuery);
        echo "stmt prepared";
        $stmt->bind_param('s', $passwordHash);
        echo "stmt bound";
        $stmt->execute();
        echo "stmt execute";
        
        if($stmt->affected_rows == 1){
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function relateUserAndPassword(?int $UserId, ?int $passwordId, $conn){
        $relationQuery = "insert into userpasswords (`UserId`, `PasswordId`) values (?,?)";
        $stmt = $conn->prepare($relationQuery);
        $stmt->bind_param('ii', $UserId, $passwordId);
        
        $stmt->execute();
        
        if($stmt->affected_rows == 1){
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function doesLoginExist(?string $Login, $conn){
        echo "does login exist";
        $userQuery = "select * from users where Login = ?";
        $stmt = $conn->prepare($userQuery);
        echo "stmt prepared";
        $stmt->bind_param('s', $Login);
        echo "param bound";
        $stmt->execute();
        echo "stmt executed";
        $results = $stmt->get_result();
        
        if($results->num_rows > 0){
            return true;
        } else {
            return false;
        }
    }
}

?>
