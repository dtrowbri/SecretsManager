<?php

require_once '../../autoLoader.php';

$secretName = $_POST['SecretName'];
$key = $_POST['Key'];
$value = $_POST['Value'];
$login = $_SESSION['userid'];

$service = new SecretsService();
$results = $service->addSecrets($login, $secretName, $key, $value);

if($results){
    echo "Secret was created successfully";
} else {
    echo "There was an error creating the secret";
}

?>