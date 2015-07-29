<?php
function echoAuth ()
	{
	echo '<link rel="stylesheet" type="text/css" href="styles.css">
	<form  action="auth.php" method="POST">
	<div class="table authform">
		<div class="tr">
			<span id="caption" class="td">Авторизация</span>
		</div>
		<div class="tr">
			<span class="td"><input class = "authinput" placeholder="Логин" type="text" size="12" name = "login" tabindex="1"></span>
		</div>
		<div class="tr">
			<span class="td"><input class = "authinput" placeholder="Пароль" type="password" size="12" name="password" tabindex="1"></span>
		</div>
		<div class="tr">
			<span class="td" ><input class = "authbutton" type="submit" value="Войти" tabindex="1"></span>
		</div>
		<div class="tr">
			<span class="td" id="mess" ></span>
		</div>
	</div></form>';
	}
function echoErr()
	{
	echo '
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js"></script>
	<script type="text/javascript">$(function(){$("#mess").html("Неправильный логин или пароль")})</script>
	';
	}

if ($_SERVER["REQUEST_METHOD"]=="GET")
	{
	echoAuth ();
	/*if (isset($_GET['error']))
		{
		echoErr();
		}*/
	}
	else
	{
	if ($_SERVER["REQUEST_METHOD"]=="POST")
		{
		session_start();
		$login = strip_tags(trim($_POST['login']));
		$password = strip_tags(trim($_POST['password']));
		//$sql = new mysqli ('localhost','root','127001','techtell');
		require_once '../SQL_Connect.php';
		//if (mysqli_connect_errno()){echo mysqli_connect_error();exit;};
		function select($sql,$login,$password)
			{
			$query = 'SELECT id, name FROM users WHERE login="'.$login.'" AND password="'.$password.'" AND disabled is NULL';
			$result = $sql->query($query);
			$a = $result->fetch_assoc();
			return $a;
			//$_SESSION['name']=$a['name'];
				}
		if (select($sql,$login,$password)!=false)
			{
		$inf = select($sql,$login,$password);
		$sql->close(); 
		$_SESSION['id']=$inf['id'];
		$_SESSION['name']=$inf['name'];
		$_SESSION['auth']=1;
		echo "вы вошли как ".$_SESSION['name'];
		//echo $inf['name'];
		header('location:index.html');
			}
		else
			{
			//$sqli->close(); 
			//header('location:auth.php?error=1');
			echoAuth ();
			echoErr();
			}
		}
	}