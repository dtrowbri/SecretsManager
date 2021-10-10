<script>
	function addRow(){
		$.ajax({
			type: 'POST',
			url: '@Url.Content("./_addKeyValueRow.php")',
			success: function(data){
				alert("adding row");
				$('#extraRows').innerHtml = data;
			}
		});
	}
</script>
<?php 
require_once '../shared/authenticationCheck.php';
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
			<button type="button" onclick="addRow()">Add Row</button>
			<div id="extraRows">
			</div>
			<input type="submit" value="Add Secret" class="btn btn-primary">
			<button type="button" onclick="window.location.href='./secrets.php'" class="btn btn-primary" style="margin-left: 50px;">Cancel</button>
		</form>
	</div>
<?php require_once '../../_footer.php'; ?>
</body>
</html>