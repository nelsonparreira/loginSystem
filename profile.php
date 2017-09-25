<?php
		include("include/connect.php");
		include("include/functions.php");
		
		if (logged_in()) 
		{
			echo "Your are IN";

		if ($_SESSION['last_id'] !== $_SERVER['REMOTE_ADDR'] ) {
				# code...
			}	
?>

<a href="changepwd.php">Change password</a>
<!-- LOGOUT BUtton -->
<a href="logout.php" style="float:right; 
														padding: 10px; 
														margin-right: 40px; 
														background-color: #eee; 
														color: #333; 
														text-decoration:none;">Logout</a>





<?php
		}
		else
		{
			echo "Your Not logged in";
			header('Location: login.php');
			exit();
		}

