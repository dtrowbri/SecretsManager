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
	<div>
		<form action="./createsecret.php" method="get">
			<input type="submit" value= "Create Secret">
		</form>
		
		<?php include("_displaySecrets.php"); ?>
		
	</div>
<?php 
    require_once '../../_footer.php';
?>
</body>
</html>