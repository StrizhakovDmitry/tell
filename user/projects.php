<?php
	/*define("DB_HOST", "localhost");
	define("DB_LOGIN", "root");
	define("DB_PASSWORD", "127001");
	define("DB_NAME", "techtell");

$sql = new mysqli (DB_HOST,DB_LOGIN,DB_PASSWORD,DB_NAME);
if (mysqli_connect_errno()){echo mysqli_connect_error();exit;};*/
	require_once '../SQL_Connect.php';
function showProjects($sql)
	{
	if ($result = $sql->query("SELECT id,name FROM projects WHERE `deleted` is NULL "))
		{
		while ($row = $result->fetch_assoc())
			{
			$arr[0][] = $row['id'];
			$arr[1][] = $row['name'];
			};
		return $arr;
		}
	else
		{
		return $sql->error;
		}
	}
$projects = showProjects($sql);
echo json_encode($projects);
$sql->close();
?>