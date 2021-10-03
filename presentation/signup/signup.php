<html>
<head>
</head>
<body>
<?php 
    require_once '../../_header.php';
?>
	<div class="container">
		<form action="./registration_handler.php" method="post">
			<div class="form-group">
				<label for="Login">Login</label>
				<input type="text" placeholder="Login" name="Login" class="form-control">
			</div>
			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" placeholder="Password" name="password" class="form-control">
			</div>
			<div class="form-group">
				<label for="passwordVerification">Re-enter password</label>
				<input type="password" placeholder="password" name="passwordVerification" class="form-control">
			</div>
			<input type="submit" value="Sign Up" class="btn btn-primary">
		</form>
	</div>
<?php
    require_once '../../_footer.php';
?>
</body>
</html>