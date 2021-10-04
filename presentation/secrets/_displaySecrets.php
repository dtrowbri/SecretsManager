<table>
	<thead>
	</thead>
<tbody>
<?php 
	foreach($secrets as $secret){
	    echo "<tr>";
	       echo '<td><form action="./viewSecret.php" method="POST">';
           echo '<input type="hidden" name="secretId" value="' . $secret->getSecretId() . '">';
           echo '<input type="hidden" name="secretName" value="' . $secret->getSecretName() . '">';
           echo '<input type="submit" value="' . $secret->getSecretName() . '" style="background: white; border: white; border-bottom: solid black; width: 80%;">';
           echo '</form>';
           echo '</td>';
      
        echo "</tr>";
        
	}
	
?>
</tbody>
</table>

