<?php
//start session
session_start();

//check if user is already connect
if (isset($_SESSION['username']) != "")
{
	header('Location: home.php');
}
//call the database and error file
require_once('database.php');
include 'alert.php';
//create a new instance 
$db = new PDO("mysql:dbname=camagru;$host", $user, $password);

$error = false;

if (isset($_POST['submit']))
{
	//prevention against sql injections
	$email = trim($_POST['email']);
	$email = strip_tags($email);
	$email = htmlspecialchars($email);

	$username = trim($_POST['uname']);
	$username = strip_tags($username);
	$username = htmlspecialchars($username);

	$password = $_POST['pword'];

	//email validation
	if (!filter_var($email, FILTER_VALIDATE_EMAIL))
	{
		$error = true;
		$emailError = "Please enter a valid email address";
	}

	//password validation
	if (!isset($_POST['pword']))
	{
		$error = true;
		$passwordError = "Please fill in the password field";
	}

	if (!$error)
	{
		$uname = mysql_real_escape_string($db, $username);
		$email = mysql_real_escape_string($db, $email);

		$passw = hash('sha256', $password);

		$result = $db->query("SELECT username, userEmail, password 
		   					FROM Users WHERE username=$uname OR userEmail=$email");	
		$row = $db->mysql_fetch_array($result);
		$count = $db->mysql_num_rows($result);//should be 1
		if ($count == 1 && $row['password'] == $passw)
		{
			$_SESSION['user'] = $row['username'];
			header('Location: home.php');
		}
		else
		{
			echo "Error during login";
		}
	}
}
?>
