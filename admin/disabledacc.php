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
function query($sql,$query)
	{
	$sql->query('USE '.DB_NAME);
	$sql->query($query);
	}
$id = $_GET['id'];

$query = 'UPDATE users SET disabled = 1 WHERE id = '.$id;
query($sql,$query);
$sql->close();
?>