<html>
<head>
</head>
<body>
	<div class="container">
<?php 
    require_once '../../_header.php';
    require_once '../../autoLoader.php';

            $userid = $_SESSION["userid"];
            $secretId = $_POST["secretId"];
            $secretName = $_POST["secretName"];
            
            $service = new SecretsService();
            $kvPair = $service->getKVPair($secretId);
            
            echo '<div class="form-group">';
            echo '<label for="secretName" class="form-label">Secret</label>';
            echo '<input type="text" value="' . $secretName . '" name="secretName" class="form-control shadow-sm p-3 mb-5 bg-body rounded">';
            echo '</div>';
            
            echo '<div class="row"> <div class="col">';
            echo '<label for="key" class="form-label">Key</label>';
            echo '<input type="text" value="' . $kvPair->getKey() . '" name="key" class="form-control shadow-sm p-3 mb-5 bg-body rounded">';
            echo '</div>';
            
            echo '<div class="col">';
            echo '<label for="value" class="form-label">Value: </label>';
            echo '<input type="text" value="' . $kvPair->getValue() . '" name="value" class="form-control shadow-sm p-3 mb-5 bg-body rounded">';
            echo '</div></div>';
        ?>
	</div>
<?php require_once '../../_footer.php'; ?>
</body>
</html>