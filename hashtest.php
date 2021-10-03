<?php
$salt = "salt";
$password = "password";
$hash = hash("sha512", $salt . $password);
$hashraw = hash("sha512", $salt . $password, TRUE);
echo "<p>The hash of your password is " . $hash . "</p>" ;
echo "<p>String length of the sha512 hash is " . strlen($hash) . "</p>";

?>