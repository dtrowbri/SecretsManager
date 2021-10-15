<?php

session_start();

spl_autoload_register(function($class){
    
    $lastDirectories = substr(getcwd(), strlen(__DIR__));
    
    $numberOfLastDirectories = substr_count($lastDirectories, '\\');
    
    $directories = ["/business", "/database", "/presentation", "/presentation/login", "/presentation/secrets", "/presentation/signup", "/business/models"];
    
    foreach($directories as $dir){
        $currentDirectory = $dir;
        for($i = 0; $i < $numberOfLastDirectories; $i++){
            $currentDirectory = "../" . $currentDirectory;
        }
        
        $classFile = $currentDirectory . "/" . $class . ".php";
        
        if(is_readable($classFile)){
            if(require $dir . "/" . $class . ".php"){
                break;
            }
        }
    }
});
?>
