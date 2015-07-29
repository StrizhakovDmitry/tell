<?php
	define("DB_HOST", "localhost");
	define("DB_LOGIN", "merk46ru_tech");
	define("DB_PASSWORD", "127001");
	define("DB_NAME", "merk46ru_tech");
$sql = new mysqli (DB_HOST,DB_LOGIN,DB_PASSWORD,DB_NAME);
$sql->query("SET NAMES utf8");
if (mysqli_connect_errno()){echo mysqli_connect_error();exit;};
?>