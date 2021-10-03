<html>
<head>
</head>
<body>
	<div>
		<form action="./addsecrethandler.php" method="post">
			<div>
				<label for="SecretName">Secret: </label>
				<input type="text" placeholder="Secret" name="SecretName">
			</div>
			<div>
				<label for="Key">Key: </label>
				<input type="text" name="Key">
				<label for="Value">Value:</label>
				<input type="text" name="Value">
			</div>
			<input type="submit" value="Add Secret">
		</form>
	</div>
</body>
</html>