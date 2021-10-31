<head>
</head>
<body>
<?php 
require_once '../../_header.php';
require_once '../../autoLoader.php';

$login = $_POST["Login"];
$password = $_POST["password"];
$passwordVerification = $_POST["passwordVerification"];

echo "creating registration service";
$registrationService = new RegistrationService();
echo "registration service created";
if($registrationService->doesLoginExist($login)){
    echo "The login " . $login . " is already in use, please use a different login";
} else {
    if($password != $passwordVerification){
        echo '<div class="container alert alert-danger">passwords do not match. Please try again.</div>';
    } else {
        $salt = "salt";
        $passwordHash = hash("sha512", $salt . $password);
        echo "registering new user";
        $isSuccessful = $registrationService->registerNewUser($login, $passwordHash);
        echo "new user registered";
        if($isSuccessful){
            echo '<div class="container">Your login has been successfully created.</div>';
        } else {
            echo '<div class="container alert alert-danger">There was an error creating your login. Please try again.</div>';
        }
    }
}
require_once '../../_footer.php';
?>
</body>
</html>
