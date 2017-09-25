<?php
	include("include/connect.php");
	include("include/functions.php");
	$error = "";
	define("ONE_MEGABYTE",1048576);

	//if the user is already logged it will not have access to this page
	if ( logged_in() ) {
		header('Location: profile.php');
		exit();
	}

	if ( isset($_POST['submit']) ) 
	{
		$firstName = mysqli_real_escape_string($con,$_POST['fname']);
		$lastName = mysqli_real_escape_string($con,$_POST['lname']);
		$email = mysqli_real_escape_string($con,$_POST['email']);
		$password = $_POST['password'];
		$passwordConfirm = $_POST['passwordConfirm'];
		
		$image = $_FILES['image']['name'];
		$tmp_image = $_FILES['image']['tmp_name'];
		$tmp_size = $_FILES['image']['size'];

		$conditions = isset($_POST['conditions']);
		
		$date = date("d, F, Y");
		//test
		//echo $firstName."<br />".$lastName."<br />".$email."<br />".$passwordConfirm."<br />".$image."<br />".$tmp_size;
		
		//check all the fields
		if ( strlen($firstName) < 3 ) 
			{
				$error = "First Name to short";
			}
			elseif ( strlen($lastName) < 3 ) 
				{
					$error = "First Name to short";
				}
			elseif ( !filter_var($email, FILTER_VALIDATE_EMAIL) ) 
				{
					$error = "Not a valid email";
				}
			elseif ( email_exists($email, $con) )
				{
					$error = "Someone already registered with this email";
				}
			elseif ( strlen($password) < 8 ) 
				{
					$error = "Password must be great than 8 characteres";
				}
			elseif ( $password !== $passwordConfirm ) 
				{
					$error = "Password does not match";
				}
			elseif ( $image == "" ) 
				{
					$error = "Please Upload your image";
				}
			elseif ( $tmp_size  > ONE_MEGABYTE ) 
				{
					$error = "Image size must be less them 1 Megabyte";
				}
			elseif (!$conditions)
				{
					$error = "You must be agree with our terms and conditions.";
				}
			else 
				{
					//ENCRIPT PASSWORD
					$password = password_hash($password; PASSWORD_DEFAULT);

					// get the extention of an image
					$imageExt = explode(".", $image);
					$imageExtention = $imageExt[1];

					//Check for image extention
					if ( $imageExtention =='PNG' || $imageExtention =='png' ||
								$imageExtention =='JPG' || $imageExtention =='jpg') 
						{
							# code...
						

							//Make the name of the image unique
							$image = rand(0, 100000).rand(0, 100000).rand(0, 100000). time().".".$imageExtention;
							$insertQuery = "INSERT INTO users (firstName,lastName, email, password, image, created)
																				VALUES ('$firstName', '$lastName', '$email', '$password', '$image', '$date')";
							//run it
						
							if ( mysqli_query($con, $insertQuery) ) 
								{
									//now save the image in our folder
									if (move_uploaded_file($tmp_image, "images/$image")) 
										{
											$error = "You are successefully registered";

											unset($_POST['submit']);

											unset($con,$_POST['fname']);
											unset($_POST['lname']);
											unset($_POST['email']);
		 									unset($_POST['password']);
		 									unset($_POST['passwordConfirm']);
		
											unset($_FILES['image']);
		


										}
									else 
										{
											$error = "Image not upload";
										}
								}
							else
								{
									$error = "Query problem...";
								}
							
						}//end if extention
					else
						{
							$error = "File is not an image";
						}

				}//end else





	}// end if submit
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Registration page</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div id="error" 

		class="<?= ( (strstr($error, "success") )?'success':'error') ?>" 
		style="display: <?= (($error !== "")?'block;':'')?>"
	>
		
		<?= "<h3>".$error."</h3>" ?>
		
	</div>
	
	<div id="wrapper">

		<div id="menu">
				<a href="index.php">Sign Up</a>	
				<a href="login.php">Login</a>
		</div>
		
		<div id="formDiv">
			
			<form action="index.php" method="POST" enctype="multipart/form-data">
						
						<input type="text" name="fname" placeholder="First Name" class="inputFields" required><br><br>
						<input type="text" name="lname" placeholder="Last Name" class="inputFields" required><br><br>
						<input type="text" name="email" placeholder="email" class="inputFields" required><br><br>
						<input type="password" name="password" placeholder="Password" class="inputFields" required><br><br>
						<input type="password" name="passwordConfirm" class="inputFields" placeholder="Re-enter password" required><br><br>
						<input type="file" name="image"><br><br>
						
						<input type="checkbox" name="conditions">
						<label for="conditions">I am agree with terms and conditions</label><br><br>

						<input type="submit" class="theButtons" name="submit">
			</form>
		
		</div>
	</div><!-- end wrapper -->
	
</body>
</html>