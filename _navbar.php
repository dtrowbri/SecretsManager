<nav class="navbar navbar-expand-lg" style="background-color: #fd9843">
	<div class="container">
		<?php 
		      if(isset($_SESSION['userid']) == false || $_SESSION['userid'] == null || $_SESSION['userid'] == false){
		          echo '<a href="../login/login.php" class="navbar-brand">Login</a>';
		      } else {
	              echo '<a href="../login/logout.php" class="navbar-brand">Logout</a>'; 
	          }
		?>
		<a href="../signup/signup.php" class="navbar-brand">Sign up</a>
		<a href="../secrets/secrets.php" class="navbar-brand">Secrets</a>
	</div>
</nav>