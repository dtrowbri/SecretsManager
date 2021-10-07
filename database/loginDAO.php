<?php

//require_once './database.php';

class LoginDAO {
    
    public function getPasswordHash(?int $passwordId, $conn){
            $getPasswordHash = "select PasswordHash from passwords where PasswordId = ?";
            $stmt = $conn->prepare($getPasswordHash);
            $stmt->bind_param('i', $passwordId);
            $stmt->execute();
            
            $results = $stmt->get_result();
            
            if($results->num_rows == 1){
                $passwordHash = $results->fetch_assoc();
                return array_values($passwordHash)[0];
            } else {
                return "Error";
            }
    }
    
    public function getLoginId(?string $Login, $conn){
        $userIdQuery = "select UserId from users where Login = ?";
        $stmt = $conn->prepare($userIdQuery);
        $stmt->bind_param('s', $Login);
        
        $stmt->execute();
        $results = $stmt->get_result();
        
        if($results->num_rows == 1){
            return ($results->fetch_assoc())["UserId"];
        } else {
            return "Error";
        }
    }
    
    public function getPasswordId(?int $userId, $conn){
        $passwordIdQuery = "select PasswordId from userpasswords where UserId = ?";
        $stmt = $conn->prepare($passwordIdQuery);
        $stmt->bind_param('i', $userId);
        
        $stmt->execute();
        $results = $stmt->get_result();
        
        if($results->num_rows == 1){
            return ($results->fetch_assoc())["PasswordId"];
        } else {
            return "Error";
        }
    }
    
    public function validatePasswordMatch(?string $PasswordHash, $PasswordId, $conn){
        $passwordMatchQuery = "select PasswordHash from passwords where PasswordId = ? and PasswordHash = ?";
        $stmt = $conn->prepare($passwordMatchQuery);
        $stmt->bind_param('is', $PasswordId, $PasswordHash);
        
        $stmt->execute();
        $results = $stmt->get_result();
        
        if($results->num_rows == 1){
            
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function getUserName(?int $userid, $conn){
        $query = "select Login from users where UserId = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $userid);
        
        $stmt->execute();
        $results = $stmt->get_result();
        
        if($results->num_rows == 1){
            $result = $results->fetch_assoc();
            return $result["Login"];
        } else {
            return null;
        }
    }
}

?>