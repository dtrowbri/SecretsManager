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
        $addPasswordQuery = "insert into passwords (`PasswordId`,`PasswordHash`) values (null,?)";
        $stmt = $conn->prepare($addPasswordQuery);
        $stmt->bind_param('s', $passwordHash);
        
        $stmt->execute();
        
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
        $userQuery = "select * from users where Login = ?";
        $stmt = $conn->prepare($userQuery);
        $stmt->bind_param('s', $Login);

        $stmt->execute();
        $results = $stmt->get_result();
        
        if($results->num_rows > 0){
            return true;
        } else {
            return false;
        }
    }
}

?>
