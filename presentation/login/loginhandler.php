<?php
require_once '../../autoLoader.php';

session_status();
echo " session status: " . session_status();

$login = $_POST["Login"];
$password = $_POST["Password"];
$salt = "salt";
$passwordHash = hash("sha512", $salt . $password);

$loginService = new LoginService();
if($loginService->validateLogin($login, $passwordHash)){
    $userId = $loginService->getUserId($login);
    if($userId == "Error"){
        header("Location: ./login.php");
    }
    
    $_SESSION["authenticated"] = true;
    $_SESSION["userid"] = $userId;
    
    echo "userid : " . $userId;
    echo " userid : " . $_SESSION["userid"];
    
    header("Location: ../secrets/secrets.php");
} else {
    echo "The username or password is incorrect";
}

?>