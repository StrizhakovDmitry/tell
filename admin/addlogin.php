<?php
	session_start();
	if (isset ($_SESSION['admin'])){}
	else {header('location:auth.php');}
	define("DB_HOST", "localhost");
	define("DB_LOGIN", "merk46ru_tech");
	define("DB_PASSWORD", "127001");
	define("DB_NAME", "merk46ru_tech");
$sql = new mysqli (DB_HOST,DB_LOGIN,DB_PASSWORD,DB_NAME);
if (mysqli_connect_errno()){echo mysqli_connect_error();exit;};
$sql->query("SET NAMES utf8");
function addUser($sql,$login,$pass,$name,$city)
	{
	//$sql->query('USE '.DB_NAME);
	$sql->query("INSERT INTO users (login,password,name,city) VALUES ('".$login."','".$pass."','".$name."',".$city.")");	
	}
$login = strip_tags(trim($_GET['login']));
$pass =	strip_tags(trim($_GET['pass']));
$name = strip_tags(trim($_GET['name']));
$city = strip_tags(trim($_GET['city']));
if ($pass == '')$pass = "нету";
if ($login == '')exit;
if ($name == '')$name = "Анонимус";

	
addUser ($sql,$login,$pass,$name,$city);
$sql->close();





?>