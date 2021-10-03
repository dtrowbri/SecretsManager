<html>
<head>
</head>
<body>
<?php 
    require_once '../../_header.php';
?>
<div>
	<form action="./loginhandler.php" method="POST">
		<div>
			<label for="Login">Login:</label>
			<input type="text" placeholder="Login" name="Login">
		</div>
		<div>
			<label for="Password">Password:</label>
			<input type="password" placeholder="Password" name="Password">
		</div>
		<input type="submit" value="Login">
	</form>
</div>
<?php 
    require_once '../../_footer.php';
?>
</body>
</html>
