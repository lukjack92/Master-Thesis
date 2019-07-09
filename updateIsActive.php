<?php 

session_start();
require_once "conf_db/config.php";
require_once 'func_msg/functions.php';

if($_SESSION["permission"] != "admin"){
		header("Location: index.php");
		exit;
} else {
	if($_POST['id'] != "" && $_POST['active'] != "")
	{	
		$user = $_POST['id'];
		$active = $_POST['active'];
		$query = "update users set isActive = '$active' where id = '$user'";
		@mysqli_query($link,$query);
		$query = "select login from users where id = '$user'";
		$result = @mysqli_query($link,$query);
		$row = @mysqli_fetch_assoc($result);
		$user = $row['login'];
		msg_logs_users($_SESSION['login'], "[isActive] The user '$user' has been changed to '$active'.");
		unset($_POST);
	}
}
?> 