<?php

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class Database {
    private $server = "34.127.126.35";
    private $user = "admin";
    private $password = "Thisisnotagoodpassword1234!#$";
    private $database = "secretsmanager";
    private $port = "3306";
    private $logger = null;
    
    public function __construct(){
        $this->logger = new Logger('main');
        $this->logger->pushHandler( new StreamHandler('php://stdout', Logger::DEBUG));
        $this->logger->debug("Creating database object", ['session' => session_id(), 'class' => 'Database', 'method' => 'construct']);
    }
    
    
    public function getConnection(){
        $conn = new mysqli(null, $this->user, $this->password, $this->database, null, '/cloudsql/sacred-brace-330505:us-west1:secretsmanagerdb');
        
        if($conn->connect_error){
            $this->logger->critical("Cannot connect to database server", ['session' => session_id(), 'class' => 'Database', 'method' => 'construct']);
            return null;
        } else {
            return $conn;
        }
    }
    
}
?>
