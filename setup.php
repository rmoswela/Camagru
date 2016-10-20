<?php

require_once ('dbinfo.php');

$pdo = new PDO($dsn, $user, $password);
$pdo->query("DROP DATABASE IF EXISTS camagru;");

$pdo->query("CREATE DATABASE IF NOT EXISTS camagru;")
or die(print_r($pdo->errorInfo(), true));

$pdo->query("USE camagru;")
or die(print_r($pdo->errorInfo(), true));

$pdo->query("CREATE TABLE IF NOT EXISTS users(
         id INT AUTO_INCREMENT NOT NULL,
         email VARCHAR (60) NOT NULL UNIQUE ,
         username VARCHAR (60) NOT NULL,
         passwd VARCHAR (255) NOT NULL,
         active INT (1) NOT NULL  DEFAULT 0,
         code VARCHAR(255) NOT NULL,
         reg_date VARCHAR(60) NOT NULL,
         PRIMARY KEY (id));"
)
or die(print_r($pdo->errorInfo(), true));

$pdo->query("
           CREATE TABLE IF NOT EXISTS photos(
            id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
            user_id INT NOT NULL,
            upload_date DATETIME ,
            FOREIGN KEY (user_id) REFERENCES users(id)
           );")or die(print_r($pdo->errorInfo(), true));

$pdo->query("
           CREATE TABLE IF NOT EXISTS comments(
            id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
            user_id INT NOT NULL,
            photo_id INT NOT NULL,
            upload_date DATETIME ,
            FOREIGN KEY (user_id) REFERENCES users(id),
            FOREIGN KEY (photo_id) REFERENCES photos(id)
           );")or die(print_r($pdo->errorInfo(), true));


$pdo->query("
           CREATE TABLE IF NOT EXISTS likes(
            id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
            user_id INT NOT NULL,
            photo_id INT NOT NULL,
            upload_date DATETIME ,
            FOREIGN KEY (user_id) REFERENCES users(id),
            FOREIGN KEY (photo_id) REFERENCES photos(id)
           );")or die(print_r($pdo->errorInfo(), true));

?>
