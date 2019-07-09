<?php

session_start();
require_once "conf_db/config.php";
require_once 'func_msg/functions.php';

if($_SESSION["permission"] != "admin"){
		header("Location: index.php");
		exit;
} else {	
if($_POST["login"] != "" && $_POST["firstName"] != "" && $_POST["lastName"] != "" && $_POST["permission"] != "" && $_POST['userID']) {
	
	$query = "select * from users where login = '$_POST[login]' and id != '$_POST[userID]'";
	$result = @mysqli_query($link,$query);
	
	$numResults = @mysqli_num_rows($result);
	
	if($numResults > 0) {
		echo '<div class="alert alert-danger" role="alert">This user <b>'.$_POST['login'].'</b> already is exists in database!</div>';
		msg_logs_users($_SESSION['login'], "[Updete user] This user ".$_POST['login']." already is exists in database!");
	} else {
	
		$query = "update users set login = '$_POST[login]', firstName = '$_POST[firstName]', lastName = '$_POST[lastName]', permission = '$_POST[permission]' where id = '$_POST[userID]'";
		@mysqli_query($link,$query);
		echo '<div class="alert alert-success" role="alert">The user <b>'.$_POST["login"].'</b> has been updeted!</div>';
		msg_logs_users($_SESSION['login'], "[Update user] Updated login=".$_POST["login"]." firstName=".$_POST["firstName"]." lastName=".$_POST["lastName"]." permission=".$_POST["permission"].".");
		unset($_POST);
	}
} else {
	echo '<div class="alert alert-success" role="alert">It has not been completely filled</div>';
}
}
?>