<?php 
require_once '../../_header.php';
require_once '../../autoLoader.php';
?>
<html>
<head>
</head>
<body>
	<div class="container">
		<form action="./addsecrethandler.php" method="post">
			<div class="form-group">
				<label for="SecretName" class="form-label">Secret</label>
				<input type="text" placeholder="Secret" name="SecretName" class="form-control shadow-sm p-3 mb-5 bg-body rounded">
			</div>
			<div class="row">
					<div class="col">
    					<label for="Key" class="form-label">Key: </label>
    					<input type="text" name="Key" class="form-control shadow-sm p-3 mb-5 bg-body rounded">
					</div>
					<div class="col">
    					<label for="Value" class="form-label">Value:</label>
    					<input type="text" name="Value" class="form-control shadow-sm p-3 mb-5 bg-body rounded">
					</div>
			</div>
			<input type="submit" value="Add Secret" class="btn btn-primary">
		</form>
	</div>
<?php require_once '../../_footer.php'; ?>
</body>
</html>