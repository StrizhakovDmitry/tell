<?php
require_once 'check.php';
require_once '../SQL_Connect.php';
function delrow($sql)
	{
	$query='UPDATE calls SET deleted=1 WHERE id='.$_GET['id'].' AND employee='.$_SESSION['id'];
	$sql->query($query);
	if ($sql->error == true)
		{
		return $sql->error;
		}
	}
$a = delrow($sql);
echo $a;
$sql->close();
?>