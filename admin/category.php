<?php
session_start();
	if (isset ($_SESSION['admin'])){}
	else {header('location:auth.php');}
require_once '../SQL_Connect.php';

if( isset($_GET['project']))
	{
	getProjectsList($sql);
	}
elseif (isset($_GET['topic']))
	{
	getTopicsList($sql,$_GET['project_id']);
	}
elseif (isset($_GET['del_topic']))
	{
	delTopic($sql,$_GET['del_topic']);
	}
elseif (isset($_GET['del_project']))
	{
	delProject($sql,$_GET['del_project']);
	}
elseif (isset($_GET['add_project']))
	{
	addProject($sql,$_GET['add_project']);
	}
elseif (isset($_GET['add_topic_name']))
	{
	addTopic($sql,$_GET['add_topic_name'],$_GET['project_id']);
	}
else
	{exit;}

function getProjectsList ($sql)
	{
	$query="SELECT id, name FROM projects WHERE deleted is NULL";
	$result = $sql->query($query);
	while ($row = $result->fetch_assoc())
		{
		$arr[0][]=$row['id'];
		$arr[1][]=$row['name'];
		}
	echo json_encode($arr);
	}
function getTopicsList ($sql,$project_id)
	{
	$query='SELECT id, name FROM topics WHERE deleted is NULL AND project_id='.$project_id;
	$result = $sql->query($query);
	while ($row = $result->fetch_assoc())
			{
			$arr[0][]=$row['id'];
			$arr[1][]=$row['name'];
			}
		if (isset($arr))
			{
			echo json_encode($arr);
			}
		else
			{
			$arr[0][0]=0;
			$arr[1][0]='пусто';
			echo json_encode($arr);
			}
	}
function delTopic($sql,$id)
	{
	$query='UPDATE `merk46ru_tech`.`topics` SET `deleted`= 1 WHERE `id`='.$id;
	$sql->query($query);
	}
function delProject($sql,$id)
	{
	$query='UPDATE `merk46ru_tech`.`projects` SET `deleted`= 1 WHERE `id`='.$id;
	$sql->query($query);
	}
function addProject ($sql,$name )
	{
	$query='INSERT INTO `merk46ru_tech`.`projects` (`name`) VALUES (\''.$name.'\');';
	$sql->query($query);
	}
function addTopic ($sql,$name,$project_id)
	{
	
	$query='INSERT INTO `merk46ru_tech`.`topics` (`project_id`, `name`) VALUES (\''.$project_id.'\', \''.$name.'\');';
	$sql->query($query);
	if (isset($sql->error))
		{
		echo $sql->error;
		}
	}
$sql->close();
?>