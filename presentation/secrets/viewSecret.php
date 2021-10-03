<html>
<head>
</head>
<body>
	<div>
        <?php
            require_once '../../autoLoader.php';
            
            $userid = $_SESSION["userid"];
            $secretId = $_POST["secretId"];
            $secretName = $_POST["secretName"];
            
            $service = new SecretsService();
            $kvPair = $service->getKVPair($secretId);
            
            echo '<label for="secretName">Secret: </label>';
            echo '<input type="text" value="' . $secretName . '" name="secretName">';
            
            echo '<label for="key">Key:</label>';
            echo '<input type="text" value="' . $kvPair->getKey() . '" name="key">';
            
            echo '<label for="value">Value: </label>';
            echo '<input type="text" value="' . $kvPair->getValue() . '" name="value">';
        ?>
	</div>
</body>
</html>