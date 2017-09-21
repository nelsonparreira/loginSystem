<?php
		include("include/connect.php");
		include("include/functions.php");
		
		if (logged_in()) 
		{
			echo "Your are IN";
?>
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

