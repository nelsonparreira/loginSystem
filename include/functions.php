<?php 
/**
 * Checks if email exists in the database
 * @param  [string] $email [descriptionthe email the user enter]
 * @param  [string] $con   [the connection to the database]
 * @return [boolean]       [True - if exits]
 */
function email_exists($email, $con){

	$result = mysqli_query($con, "SELECT id FROM users WHERE email='$email'");

	// user exists
	if ( mysqli_num_rows($result) == 1 ) 
		{
			return true;
		}
	else
		{
			return false;
		}
	
}//end function email_exists

/**
 * Check if the user is Logged in
 * @return [Boolean] [True if user logged in]
 */
function logged_in() {
	if (isset($_SESSION['email'])) 
		{
			return true;
		}
	else
		{
			return false;
		}
}