<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '12345678');
define('DB_DATA', 'camagru');
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
$sql = "CREATE DATABASE IF NOT EXISTS camagru";
if ($conn->query($sql) != TRUE) {
	echo "Error creating database: " . $conn->error;
}
$conn->close();
$conn = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_DATA, DB_USERNAME, DB_PASSWORD);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "CREATE TABLE IF NOT EXISTS users (
	user_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	userN VARCHAR(30) NOT NULL,
	uname VARCHAR(50) NOT NULL,
	hPass VARCHAR(100) NOT NULL,
	sname VARCHAR(30) NOT NULL,
	p_pic VARCHAR(30),
	email VARCHAR(50),
	verified BOOLEAN DEFAULT 0,
	notifications BOOLEAN DEFAULT 1
	)";
	try {
		$req = $conn->prepare($sql);
		$req->execute();
	} catch(PDOException $e)
	{
		echo "A thing went wrong: ".$e->getMessage();
	}
$sql = "CREATE TABLE IF NOT EXISTS feed (
	post_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	user_id INT(6) NOT NULL,
	post VARCHAR(30) NOT NULL,
	img_t VARCHAR(30) NOT NULL,
	`time` DATETIME DEFAULT CURRENT_TIMESTAMP
	)";
	try {
		$req = $conn->prepare($sql);
		$req->execute();
	}catch(PDOException $e)
	{
		echo "A thing went wrong: ".$e->getMessage();
	}
$sql = "CREATE TABLE IF NOT EXISTS likes (
	like_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	user_id INT(6) NOT NULL,
	post_id INT(6) NOT NULL,
	qty INT(6) UNSIGNED
	)";
	try {
	$req = $conn->prepare($sql);
	$req->execute();
		}catch(PDOException $e)
		{
			echo "A thing went wrong: ".$e->getMessage();
		}
$sql = "CREATE TABLE IF NOT EXISTS comment (
	com_id INT(6) NOT NULL AUTO_INCREMENT  PRIMARY KEY,
	`user_id` INT(6) NOT NULL ,
	`post_id` INT(6) NOT NULL ,
	`comment` VARCHAR(30)
	)";
	try{
		$req = $conn->prepare($sql);
		$req->execute();
	}catch(PDOException $e)
	{
		echo "A thing went wrong: ".$e->getMessage();
	}
	$conn=NULL;
	?>