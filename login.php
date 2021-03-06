<?php
	include("include/connect.php");
	include("include/functions.php");
	$error = "";
	
	//if the user is already logged it will not have access to this page
	if ( logged_in() ) {
		header('Location: profile.php');
		exit();
	}



	if ( isset($_POST['submit']) ) 
	{
		
		$email = mysqli_real_escape_string($con,$_POST['email']);
		$password = mysqli_real_escape_string($con,$_POST['password']);

		$checkBox =  isset($_POST['keep']);
	
		$email = $_POST['email'];
		$password = $_POST['password'];

		// 
		if (email_exists($email, $con)) {
			// Test
			//$error = "Email Exists";
			$result = mysqli_query($con, "SELECT password FROM users WHERE email='$email'");
			$retrievepassword = mysqli_fetch_assoc($result);

			if ( !password_verify($password, $retrievepassword['password']) ) 
				{
					$error ="Wrong password";
				}
			else 
				{
				$_SESSION['email'] = $email;

					if ($checkBox =="on") {
						setcookie("email", $email, time()+3600 );//1 hour
					}

					header('Location: profile.php');
				}

			
		}
		else
		{
			$error = "Email Don't Exists";
		}


	}// end if submit
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login Page</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div id="error" 
			 class="<?= ( (strstr($error, "Don") )?'error':'success') ?>"
			 style="display: <?= (($error !== "")?'block;':'')?>"
				><?= "<h3>".$error."</h3>" ?></div>
	
	<div id="wrapper">
		
		<div id="menu">
				<a href="index.php">Sign Up</a>	
				<a href="login.php">Login</a>
		</div>
		
		<div id="formDiv">
			
			<form action="login.php" method="POST" >
						<input type="text" name="email" class="inputFields" placeholder="Email" required><br><br>
						<input type="password" name="password" class="inputFields" required><br><br>
						
						<input type="checkbox" name="keep">
						<label for="keep">Keep me logged in.</label>	<br />	<br />

						<input type="submit" class="theButtons" name="submit" value="login">
						
			</form>
		
		</div>
	</div><!-- end wrapper -->
	
</body>
</html>