<?php

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class Database {
    private $server = "localhost";
    private $user = "root";
    private $password = "root";
    private $database = "secretsmanager";
    private $port = "3306";
    private $logger = null;
    
    public function __construct(){
        $this->logger = new Logger('main');
        $this->logger->pushHandler( new StreamHandler('../../app.log', Logger::DEBUG));
        $this->logger->debug("Creating database object", ['session' => session_id(), 'class' => 'Database', 'method' => 'construct']);
    }
    
    
    public function getConnection(){
        $conn = new mysqli($this->server, $this->user, $this->password, $this->database, $this->port);
        //$conn = new mysqli(null, 'admin', 'Thisisnotagoodpassword1234!#$', 'secretsmanager', 3306, '/cloudsql/sacred-brace-330505:us-west1:secretsmanagerdb');
        //$conn = new mysqli('34.127.126.35', 'admin', 'Thisisnotagoodpassword1234!#$', 'secretsmanager', 3306);//, '/cloudsql/sacred-brace-330505:us-west1:secretsmanagerdb');
        if($conn->connect_error){
            $this->logger->critical("Cannot connect to database server", ['session' => session_id(), 'class' => 'Database', 'method' => 'construct']);
            return null;
        } else {
            return $conn;
        }
    }
    
}
?>