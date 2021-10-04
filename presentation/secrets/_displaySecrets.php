<table class="table">
	<thead>
	</thead>
<tbody>
<?php 
	foreach($secrets as $secret){
	    echo '<tr style="height: 50px;">';
	       echo '<td style="padding: 0; margin-top: 100;"><form action="./viewSecret.php" method="POST" style="margin: 0; padding: 0;">';
           echo '<input type="hidden" name="secretId" value="' . $secret->getSecretId() . '">';
           echo '<input type="hidden" name="secretName" value="' . $secret->getSecretName() . '">';
           echo '<input type="submit" value="' . $secret->getSecretName() . '" style="width:100%; background-color: white; border-top: white; border-right: white; border-left: white; font-size: 36px; text-align: left; ">';
           echo '</form>';
           echo '</td>';
      
        echo "</tr>";
        
	}
?>
</tbody>
</table>

