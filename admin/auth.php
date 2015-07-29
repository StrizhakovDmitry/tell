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
	

if ($_SERVER["REQUEST_METHOD"]=="GET")
	{
	echoAuth ();
	}
	else
	{
if (($_SERVER["REQUEST_METHOD"]=="POST") and ($_POST['login']=='test')and($_POST['password']=='test'))
	{
	session_start();
	$_SESSION['admin']='pass';
	//echo "a";
	//exit;
	header('location:index.html');
	exit;
	}
else
	{
	echoAuth ();
	echo '<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js"></script>
	<script type="text/javascript">$(function(){$("#mess").html("Неправильный логин или пароль")})</script>';
	}
	}
