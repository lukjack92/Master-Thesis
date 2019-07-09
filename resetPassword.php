<?php 

session_start();
require_once "conf_db/config.php";
//require_once "func/functions.php";
require_once 'func_msg/functions.php';

if($_SESSION["permission"] != "admin"){
		header("Location: index.php");
		exit;
} else {
	if(isset($_POST['pass']) && $_POST['pass'] != "") {
		
		$password = password_hash($_POST['pass'], PASSWORD_DEFAULT);
		$reset_pass = 'update users set password = "'.$password.'" where login="'.$_POST['user'].'"';
		if(mysqli_query($link,$reset_pass)) {
			echo "<div class='alert alert-success' role='alert'><b>Password has been set and sent an email.</b></div>";
			msg_logs_users($_SESSION['login'], "[Reset pwd user] The password has been reset to ".$_POST['user'].".");
		} else {
			echo "<div class='alert alert-success' role='alert'><b>The password hasn't set.</b></div>";
			msg_logs_users($_SESSION['login'], "[Reset pwd user] The password hasn't set to ".$_POST['user'].".");
		} unset($_POST);
	} else {
		echo "<div class='alert alert-danger' role='alert'><b>You didn't set password!</b></div>";
	}
}
?>