<?php
require_once '../shared/authenticationCheck.php';
require_once '../../autoLoader.php';

//$keyId = $_POST["keyId"];
//$key = $_POST["key"];
//$value = $_POST["value"];
$secretId = $_POST["secretId"];
$numOfKVPairs = $_POST['numOfKVPairs'];

$KVPairs = array();

for($i = 1; $i <= $numOfKVPairs; $i++){
    $keyId = "keyId" . $i;
    $key = "key" . $i;
    $value = "value" . $i;
    
    $KVPair = new KVPair($_POST[$keyId], $_POST[$key], $_POST[$value]);
    array_push($KVPairs, $KVPair);
}




$service = new SecretsService();
$isSuccessful = $service->updateKVPair($KVPairs);
/*
if(!$isSuccessful){
    require_once '../../_header.php';
    echo '<p>Error: Failed to update the key or value!</p>';
    require_once '../../_footer.php';
} else {
    header("Location: ./secrets.php");
}*/
?>
