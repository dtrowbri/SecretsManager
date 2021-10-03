<html>
<head>
</head>
<body>
<?php 
    require_once '../../_header.php';
?>
<div class="container">
	<form action="./loginhandler.php" method="POST">
		<div class="form-group">
			<label for="Login">Login:</label>
			<input type="text" placeholder="Login" name="Login" class="form-control">
		</div>
		<div class="form-group">
			<label for="Password">Password:</label>
			<input type="password" placeholder="Password" name="Password" class="form-control">
		</div>
		<input type="submit" value="Login" class="btn btn-primary">
	</form>
</div>
<?php 
    require_once '../../_footer.php';
?>
</body>
</html>
