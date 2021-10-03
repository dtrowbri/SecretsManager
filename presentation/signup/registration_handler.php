<?php

require_once '../../autoLoader.php';

$login = $_POST["Login"];
$password = $_POST["password"];
$passwordVerification = $_POST["passwordVerification"];

$registrationService = new RegistrationService();
if($registrationService->doesLoginExist($login)){
    echo "The login " . $login . " is already in use, please use a different login";
} else {
    if($password != $passwordVerification){
        echo "passwords don't match";
    } else {
        $salt = "salt";
        $passwordHash = hash("sha512", $salt . $password);
        $isSuccessful = $registrationService->registerNewUser($login, $passwordHash);
        if($isSuccessful){
            echo "Your login has been successfully created.";
        } else {
            echo "There was an error creating your login. Please try again.";
        }
    }
}
?>