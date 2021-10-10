<?php
require_once '../shared/authenticationCheck.php';
require_once '../../autoLoader.php';

$keyId = $_POST["keyId"];
$key = $_POST["key"];
$value = $_POST["value"];
$secretId = $_POST["secretId"];

$KVPair = new KVPair($keyId, $key, $value);

$service = new SecretsService();
$isSuccessful = $service->updateKVPair($KVPair);

if(!$isSuccessful){
    require_once '../../_header.php';
    echo '<p>Error: Failed to update the key or value!</p>';
    require_once '../../_footer.php';
} else {
    header("Location: ./secrets.php");
}
?>
