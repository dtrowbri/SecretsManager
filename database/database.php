<?php

class Database {
    private $server = "34.127.126.35";
    private $user = "admin";
    private $password = "Thisisnotagoodpassword1234!#$";
    private $database = "secretsmanager";
    private $port = "3306";
    
    public function getConnection(){
        $conn = new mysqli($this->server, $this->user, $this->password, $this->database, $this->port);
        
        if($conn->connect_error){
            echo "Connection failed " . $conn->connect_error;
            return null;
        } else {
            return $conn;
        }
    }
    
}
?>
