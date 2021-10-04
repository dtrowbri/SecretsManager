<html>
<head>
</head>
<body>
<?php 
require_once '../../_header.php';
require_once '../../autoLoader.php';

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
    echo '<div class="container alert alert-danger">The username or password is incorrect. Please try again.</div>';
}

require_once '../../_footer.php';
?>
</body>
</html>
