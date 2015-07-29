<?php
require_once 'check.php';
require_once '../SQL_Connect.php';
/*
	define("DB_HOST", "localhost");
	define("DB_LOGIN", "root");
	define("DB_PASSWORD", "127001");
	define("DB_NAME", "techtell");
$sql = new mysqli (DB_HOST,DB_LOGIN,DB_PASSWORD,DB_NAME);
if (mysqli_connect_errno()){echo mysqli_connect_error();exit;};*/
function createTable($sql)
	{
	if ($sql->query("
	CREATE TABLE topics (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`project_id` INT(11) NOT NULL,
	`name` VARCHAR (11) NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (project_id) REFERENCES projects(id) 
	)
	") === TRUE)
		{
		printf("Таблица успешно создана.\n");
		}
	}

		
	
createTable($sql);
$sql->close();
?>