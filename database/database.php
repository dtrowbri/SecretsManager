<?php

class Database {
    private $server = "x8autxobia7sgh74.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
    private $user = "d8jpt1j5l95dqdc8";
    private $password = "c2fr7zshqy4hq7oa";
    private $database = "wbupv9ogyasn9zg1";
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
