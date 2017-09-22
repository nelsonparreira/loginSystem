<?php
		include("include/connect.php");
		include("include/functions.php");

		$error="";

		if ( logged_in() ) 
		{

			if( isset($_POST['savepass']))
				{
						$password = $_POST['password'];
						$passwordConfirm = $_POST['passwordConfirm'];

						if(strlen($password)  < 8 )
							{
									$error= "Password must be greater them 8 characteres";
							}
						elseif ( $password !== $passwordConfirm)
							{
									$error = "Passwords doesn't match.";
							}
						else
							{
								$password = md5($password);

								$email = $_SESSION['email'];
								if( mysqli_query($con, "UPDATE users SET password = '$password' WHERE email='$email'") )
									{
										$error = "Password changed successefully. <br> <a href='profile.php'>Click here </a>to go to the profile page.";
									}
							}
				}
		
?>
			<p><?= $error ?></p>
			<form action="changepwd.php" method="POST">
				<input type="password" name="password" placeholder="New-Password"><br><br>
				<input type="password" name="passwordConfirm" placeholder="Re-enter password"><br><br>

				<input type="submit" name="savepass" value="Save">
			</form>

<?php
	}
	else
		{
			echo "Your Not logged in";
			header('Location: login.php');
			exit();
		}