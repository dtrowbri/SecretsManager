<html>
<head>
	<script>
		function displaySearchResults(){
			var filterElem = document.getElementById("filterSecretsInput");
			var filterValue = filterElem.value.toLowerCase();
			
			var tableRows = document.getElementById("tableBody");
			for(let i = 0; i < tableRows.children.length; i++){
				if(tableRows.children[i].id.toLowerCase().startsWith(filterValue)){
					showChildrenElements(tableRows.children[i]);
				} else {
					hideChildrenElements(tableRows.children[i]);
				}
			}
		}

		function hideChildrenElements(parent){
			parent.style.visibility = "collapse";
			var children = parent.children;
			if(children.length > 0){
				for(let i = 0; i < children.length; i++){
					hideChildrenElements(children[i]);
				}
			} else {
				return;
			}
		}

		function showChildrenElements(parent){
			parent.style.visibility = "visible";
			var children = parent.children;
			if(children.length > 0){
				for(let i = 0; i < children.length; i++){
					showChildrenElements(children[i]);
				}
			} else {
				return;
			}
		}
	</script>
</head>
<body>
<?php 
    require_once '../shared/authenticationCheck.php';
    require_once '../../autoLoader.php';
    require_once '../../_header.php';
    
    echo "test";
    $userId = $_SESSION["userid"];
    echo "test2";
	$service = new SecretsService();
    echo "test3";
	$secrets = $service->getSecrets($userId);
	echo "test4";
?>
	<div class="container">
		
		<div class="row" style="margin-top: 30px;">
			<div class="col" id="filterSecretsDiv">
				<input type="text" placeholder="Filter Secrets" name="filter" class="form-control shadow-sm p-3 mb-5 bg-body rounded" id="filterSecretsInput" oninput="displaySearchResults();">
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
