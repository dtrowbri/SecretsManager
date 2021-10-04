<html>
<head>
</head>
<body>
<?php 
    require_once '../../autoLoader.php';
    require_once '../../_header.php';
    
    $userId = $_SESSION["userid"];
    $service = new SecretsService();
    $secrets = $service->getSecrets($userId);
?>
	<div class="container">
		
		<div class="row" style="margin-top: 30px;">
			<div class="col">
				<input type="text" placeholder="Filter Secrets" name="filter" class="form-control shadow-sm p-3 mb-5 bg-body rounded">
			</div>
			<div class="col">
        		<form action="./createsecret.php" method="get">
        			<input type="submit" value= "Create Secret" class="btn btn-primary" style="font-size: 29px">
        		</form>
    		</div>
		</div>
		<?php include("_displaySecrets.php"); ?>
		
	</div>
<?php 
    require_once '../../_footer.php';
?>
</body>
</html>