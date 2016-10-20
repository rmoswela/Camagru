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
	$firstname = trim($_POST['fname']);
	$firstname = strip_tags($firstname);
	$firstname = htmlspecialchars($firstname);

	$lastname = trim($_POST['lname']);
	$lastname = strip_tags($lastname);
	$lastname = htmlspecialchars($lastname);

	$email = trim($_POST['email']);
	$email = strip_tags($email);
	$email = htmlspecialchars($email);

	$username = trim($_POST['uname']);
	$username = strip_tags($username);
	$username = htmlspecialchars($username);

	$password = $_POST['pword'];
	$confirmPass = $_POST['cfpword'];

	//names validation
	if (empty($firstname) || empty( $lastname))
	{
		$error = true;
		$nameError = "Please enter your names";
	}
	else if (!preg_match("/^[a-zA-Z]+$/", $firstname) || !preg_match("/^[a-zA-Z]+$/", $lastname))
	{
		$error = true;
		$nameError = "Names contain letters and spaces";
	}

	//email validation
	if (!filter_var($email, FILTER_VALIDATE_EMAIL))
	{
		$error = true;
		$emailError = "Please enter a valid email address";
	}
	else
	{
		//check if email exists or not
		$result = $db->query("SELECT userEmail from Users WHERE userEmail=$email "); 
		$count = mysql_num_rows($result);

		if ($count != 0)
		{
			$error = true;
			$emailError = "Provided email is already in use.";
		}
	}

	//username validation
	if (!preg_match("/^\w$/", $username))
	{
		$error = true;
		$unameError = "Usernames should have letters, underscores and numbers only";
	}
	else
	{
		//check if username exists or not
		$result = $db->query("SELECT username from Users WHERE username=$username "); 
		$count = mysql_num_rows($result);

		if ($count != 0)
		{
			$error = true;
			$unameError = "Provided username is already in use.";
		}
	}


	//password validation
	if (isset($_POST['pword']) && isset($_POST['cfpword']))
	{
		if ($password !== $confirmPass)
		{
			$error = true;
			$passwordError = "Your Password and Confirmation Password do not match.";
		}
		else
		{
			//encrypt password
			$password = hash('sha256', $password);
		}
	}

	if (!$error)
	{
		$fname = mysql_real_escape_string($db, $firstname);
		$lname = mysql_real_escape_string($db, $lastname);
		$uname = mysql_real_escape_string($db, $username);
		$email = mysql_real_escape_string($db, $email);
		$result = $db->query("INSERT INTO Users (firstname, lastname, username, userEmail, password) 
							VALUES ('$fname', '$lname', '$uname', '$email', '$password'");
		if ($result)
		{
			$errType = "success";
			$errMSG = "Successfully logged in";
			unset($fname);
			unset($lname);
			unset($uname);
			unset($email);
			unset($password);
		}
		else
		{
			$errType = "danger";
			$errMSG = "Something went wrong";
		}
	}
}
?>
