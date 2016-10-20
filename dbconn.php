<?php
require_once('dbinfo.php');

try 
{
	$db = new PDO($dsn, $user, $password);
	$db = setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db->exec("CREATE DATABASE IF NOT EXISTS camagru");
/*	$sql = "use camagru";
	$db->exec($sql);
	$users = "CREATE TABLE IF NOT EXISTS Users (user_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
											firstname VARCHAR(30) NOT NULL, 
											lastname VARCHAR(30) NOT NULL, 
											username VARCHAR(30) NOT NULL, 
											email VARCHAR(30) NOT NULL, 
											password VARCHAR(20) NOT NULL)";
	$db->exec($users);
*/
	$images = "CREATE TABLE IF NOT EXISTS Images(images_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
											user_id INT(6) NOT NULL, 
											upload_time DATETIME,
											FOREIGN KEY(user_id) REFERENCES Users(user_id))";
	$comments = "CREATE TABLE IF NOT EXISTS Comments (comments_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
											comments TEXT, 
											user_id INT(6), 
											images_id INT(6), 
											comment_time DATETIME,
											FOREIGN KEY(user_id) REFERENCES Users(user_id), 
											FOREIGN KEY(images_id) REFERENCES Images(images_id))";
	$likes = "CREATE TABLE IF NOT EXISTS Likes (likes_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,  
											likes_count INT(6),
											user_id INT(6), 
											images_id INT(6), 
											FOREIGN KEY(user_id) REFERENCES Users(user_id), 
											FOREIGN KEY(images_id) REFERENCES Images(images_id))";
	$db->exec($users) or die;
	$db->exec($users);

}
catch(PDOException $e) 
{
	die("failed to connect: " .$e->getMessage());
}

?>
