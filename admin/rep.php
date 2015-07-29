<?php
session_start();
	if (isset ($_SESSION['admin'])){}
	else {header('location:auth.php');}
require_once '../SQL_Connect.php';
$and = '';
$query = 'SELECT c.`id` as "номер",c.`date` as "добавлен",u.`name` as "сотрудником",c.`tel_num` as "телефон ", `p`.`name` as "проект", `t`.`name` as "тема", `c`.`commentary` as "описание" FROM merk46ru_tech.calls c JOIN merk46ru_tech.users u ON c.employee = u.id JOIN merk46ru_tech.projects p ON c.project = p.id JOIN merk46ru_tech.topics t ON c.topic = t.id ';
$where_string =' ';
$where = 'WHERE';
if (isset($_GET['start_date']))
	{
	$where = 'WHERE';
	$start_date = $_GET['start_date'];
	$where_string.= $and.'date > \''.$start_date.'\'';
	$and = ' AND ';
	}
if (isset ($_GET['end_date']))
	{
	$where = 'WHERE';
	$end_date = $_GET['end_date'];
	$where_string.= $and.'date < \''.$end_date.'\'';
	$and = ' AND ';
	}
if (isset($_GET['tel_num']))
	{
	$where = 'WHERE';
	$tel_num = $_GET['tel_num'];
	$where_string.= $and.'tel_num LIKE \'%'.$tel_num.'%\'';
	$and = ' AND ';
	}
if (isset($_GET['project']))
	{
	$where = 'WHERE';
	$project = $_GET['project'];
	$where_string.= $and.'project = \''.$project.'\'';
	$and = ' AND ';
	}	
if (isset($_GET['topic']))
	{
	$where = 'WHERE';
	$topic = $_GET['topic'];
	$where_string.= $and.'topic = \''.$topic.'\'';
	$and = ' AND ';
	}		
if (isset($_GET['employee']))
	{
	$where = 'WHERE';
	$employee = $_GET['employee'];
	$where_string.= $and.'employee = \''.$employee.'\'';
	$and = ' AND ';
	}	
if (isset($_GET['id']))
	{
	$where = 'WHERE';
	$id = $_GET['id'];
	$where_string.= $and.'id = \''.$id.'\'';
	$and = ' AND ';
	}	
//echo $query;
$query.= $where.$where_string.' '.$and.' c.deleted is NULL';
function select($sql, $query)
	{
		$result = $sql->query($query);
		while ($a = $result->fetch_assoc())
		{
		$row[] = $a;
		}
	if(isset($row))
		{
	return ($row);
		}
	else
		{
		return false;
		}
	}

$a =  select($sql, $query);
if (is_array ($a))
	{
	create_table ($a);
	} 
	else
	{
	echo 'По вашему запросу нечего не найдено';
	}


function create_table ($a)
	{
	$z = false;
	echo '<table border="1">';
	foreach ($a as $key => $value)
		{
		if ($z == false)
			{
				echo '<tr>';
				foreach ($value as $a => $b )
				{
				if ($a !='deleted')
					{
					echo '<td>'.$a.'</td>';
					}
				}
				echo '</tr>';
			$z = true;
			}
		echo '<tr>';
		foreach ($value as $a => $b )
			{
			if ($a !='deleted')
				{echo '<td>'.$b.'</td>';}
			}
			
		echo "</tr>";
		
		}
	echo "</table>";
	}
?>