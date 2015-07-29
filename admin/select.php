<?php
	session_start();
	if (isset ($_SESSION['admin'])){}
	else {header('location:auth.php');}/*
	define("DB_HOST", "localhost");
	define("DB_LOGIN", "merk46ru_tech");
	define("DB_PASSWORD", "127001");
	define("DB_NAME", "merk46ru_tech");
	
$sql = new mysqli (DB_HOST,DB_LOGIN,DB_PASSWORD,DB_NAME);*/
require_once '../SQL_Connect.php';
if (mysqli_connect_errno()){echo mysqli_connect_error();exit;};
function select($sql)
	{
		$query = "SELECT id, login, password, name, city FROM users WHERE disabled is NULL";
		$result = $sql->query($query);
		while ($a = $result->fetch_assoc())
		{
		$row[] = $a;
		}
	return ($row);
	}
$jstring = json_encode(select($sql));
echo $jstring;
$sql->close();