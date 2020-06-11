<?php 
session_start();
require_once "conf_db/config.php";
require_once 'func_msg/functions.php';

if($_SESSION["permission"] != "admin"){
		header("Location: index.php");
		exit;
} else {
if($_POST['login'] != "" && $_POST['first_name'] != "" && $_POST['last_name'] && $_POST['pass'] && $_POST['permission'])
{
	//$login = htmlentities($_POST['login'],ENT_QUOTES,"UTF-8");
	$login = mysqli_real_escape_string($link,$_POST['login']);
	
	//$password = htmlentities($_POST['pass'],ENT_QUOTES,"UTF-8");
	$password = password_hash($_POST['pass'], PASSWORD_DEFAULT);
	$password = mysqli_real_escape_string($link,$password);
	
	//$firstName = htmlentities($_POST['first_name'],ENT_QUOTES,"UTF-8");
	$firstName = mysqli_real_escape_string($link,$_POST['first_name']);
	echo $firstName;
	//$lastName = htmlentities($_POST['last_name'],ENT_QUOTES,"UTF-8");
	$lastName = mysqli_real_escape_string($link,$_POST['last_name']);
	
	//$permission = htmlentities($_POST['permission'],ENT_QUOTES,"UTF-8");
	$permission = mysqli_real_escape_string($link,$_POST['permission']);

	$sql = 'select * from users where login="'.$login.'"';
	$result = mysqli_query($link,$sql);
	$numResults = mysqli_num_rows($result);

	if($numResults > 0){
		echo '<div class="alert alert-danger" role="alert">No user <b>'.$login.'</b> added because it already exists!</div>'; 
		//echo "User: " .$login. " ".$firstName." ".$lastName;
		msg_logs_users($_SESSION['login'], "[Add user] No user '$login' added, because it is already exists!");
	} else {
		$add_user_sql = "INSERT INTO users (login, password, firstName, lastName, permission) VALUES ('$login', '$password', '$firstName', '$lastName', '$permission')";
		mysqli_query($link,$add_user_sql);
		echo '<div class="alert alert-success" role="alert">The user <b>'.$login.'</b> added!</div>';
		msg_logs_users($_SESSION['login'], "[Add user] The user '$login' added!");
		unset($_POST);
	}
}else {
	echo '<div class="alert alert-danger" role="alert">There aren&#39t fill whole form!</div>'; 
}
}
?> 