<?php
require_once 'check.php';
require_once '../SQL_Connect.php';
function getReports($sql)
	{
	$query = 'SELECT c.id as id, c.date as date, u.name as emloyee, c.tel_num as telnum, p.name as project, t.name as topic, c.commentary as commentary
FROM calls as c
JOIN users as u ON c.employee = u.id
JOIN projects as p ON c.project = p.id
JOIN topics as t ON c.topic = t.id WHERE u.id='.$_SESSION['id'].' AND c.deleted IS NULL AND c.date  > (NOW() - interval 1 day) ORDER BY c.date';
	$result = $sql->query($query);
	for($i=0;$row = $result->fetch_assoc();$i++)
		{
		$arr[$i][0] = $row['date'];
		//$arr[$i][1] = $row['emloyee'];
		$arr[$i][1] = $row['telnum'];
		$arr[$i][2] = $row['project'];
		$arr[$i][3] = $row['topic'];
		$arr[$i][4] = $row['commentary'];
		$arr[$i][5] = $row['id'];
		}
	if(isset($arr))
		{
		return $arr;
		}
	else
		{
		return false;
		}
	}

	
$a = getReports($sql);

	$jstring = json_encode($a);
	echo $jstring;
$sql->close();
?>