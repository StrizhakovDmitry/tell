<?php
session_start();
function check()
	{
	if(isset ($_SESSION['auth']) and $_SESSION['auth']==1)
		{
		return true;
		}
	else
		{
		header('location:auth.php');
		}
	}
check();
?>