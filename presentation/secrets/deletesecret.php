<?php
require_once '../../autoLoader.php';

$secretId = $_POST["secretId"];


$service = new SecretsService();
$deletionSucceeded = $service->deleteSecret($secretId);

if($deletionSucceeded){
    header("Location: ./secrets.php");
} else {
    echo "<p>there was an error deleting the secret";
}
?>
