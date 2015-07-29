<?php
require_once 'check.php';
require_once '../SQL_Connect.php';
$inData = json_decode($_POST['box']);


$employee = $_SESSION['id'];
$project = $inData[0];
$topic = $inData[1];
$tel_num = $inData[2];if ($tel_num==''){$tel_num='0';};
$commentary = $inData[3];if ($commentary == ''){$commentary = 'нет описания';};



function addCall($sql,$employee,$tel_num,$project,$topic,$commentary)
{
$query = "INSERT INTO calls (employee,tel_num,project,topic,commentary) VALUES ('".$employee."','".$tel_num."','".$project."','".$topic."','".$commentary."')";
$sql->query($query);
if ($sql->error == true)
	{
	return $sql->error;
	}
	else
	{
//return "Отчёт сохранен";
	}

}
$z = addCall($sql,$employee,$tel_num,$project,$topic,$commentary);
echo $z;
$sql->close();
?>