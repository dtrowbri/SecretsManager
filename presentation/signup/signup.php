<html>
<head>
</head>
<body>
<?php 
    require_once '../../_header.php';
?>
	<div>
		<form action="./registration_handler.php" method="post">
			<div>
				<label for="Login">Login:</label>
				<input type="text" placeholder="Login" name="Login">
			</div>
			<div>
				<label for="password">Password:</label>
				<input type="password" placeholder="Password" name="password">
			</div>
			<div>
				<label for="passwordVerification">Re-enter password:</label>
				<input type="password" placeholder="password" name="passwordVerification">
			</div>
			<input type="submit" value="Sign Up">
		</form>
	</div>
<?php
    require_once '../../_footer.php';
?>
</body>
</html>