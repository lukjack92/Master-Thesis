<?php 

session_start();
require_once "conf_db/config.php";
require_once 'func_msg/functions.php';

if($_SESSION["permission"] != "admin"){
		header("Location: index.php");
		exit;
} else {
	
	if(isset($_POST['pass']) && $_POST['pass'] != "") {
		$user = $_POST['user_confirm'];
		$sql = "select * from users where login='$user'";
		$result = mysqli_query($link, $sql);
		$row = mysqli_fetch_assoc($result);
		if(password_verify($_POST['pass'], $row['password'])) { 
			$response['status'] = true;
			$response['message'] = "<div class='alert alert-succes' role='alert'><b>Password correct!!</b></div>";
			msg_logs_users($_SESSION['login'], "[Reset pwd user confirm] The password is correct to $user.");
		} else {
			$response['status'] = false;
			$response['message'] = "<div class='alert alert-danger' role='alert'><b>Password incorrect!!</b></div>";
			msg_logs_users($_SESSION['login'], "[Reset pwd user confirm] The password is incorrect to $user.");
		}
		
	} else{
		$response['status'] = false;
		$response['message'] = "<div class='alert alert-warning' role='alert'><b>You didn't enter you password!</b></div>";
	} unset($_POST);
	
	echo json_encode($response);
}
?>