<html>
<head>
</head>
<body>
<?php 
require_once '../shared/authenticationCheck.php';
require_once '../../_header.php';
require_once '../../autoLoader.php';

$secretName = $_POST['SecretName'];
$key = $_POST['Key'];
$value = $_POST['Value'];
$login = $_SESSION['userid'];

$service = new SecretsService();
$doesExist = $service->doesSecretExist($login, $secretName);

if($doesExist){
    require_once '../../_header.php';
    echo '<p>Error: Secret already exists for this user. Please enter a different value.</p>';
    require_once '../../_footer.php';
}else {

    $results = $service->addSecrets($login, $secretName, $key, $value);
    
    if($results){
        echo '<div class="container"> Secret was created successfully</div>';
    } else {
        echo '<div class="container alert alert-danger">There was an error creating the secret.</div>';
    }
}
require_once '../../_footer.php';
?>
</body>
</html>
