<?php
	session_start();
	if (isset ($_SESSION['admin'])){}
	else {header('location:auth.php');}
	/*define("DB_HOST", "localhost");
	define("DB_LOGIN", "root");
	define("DB_PASSWORD", "127001");
	define("DB_NAME", "merk46ru_tech");
$sql = new mysqli (DB_HOST,DB_LOGIN,DB_PASSWORD,DB_NAME);
if (mysqli_connect_errno()){echo mysqli_connect_error();exit;};
*/
require_once '../SQL_Connect.php';
function select($sql,$query)
	{
	$sql->query('USE '.DB_NAME);
	$result = $sql->query($query);
	while ($a = $result->fetch_assoc())
		{
		$row[] = $a;
		}
	return ($row);
	}

function query($sql,$query)
	{
	$sql->query('USE '.DB_NAME);
	$sql->query($query);
	}
	
$query1 = "ALTER TABLE users ADD disabled tinyint(1) default NULL";		
$select = "SELECT * FROM users";
$query2 = "UPDATE users SET disabled = 1 WHERE password = 6346346";
query ($sql,$query1);

//$a = select($sql,$select);
//print_r($a);
query ($sql,$query2);

?>