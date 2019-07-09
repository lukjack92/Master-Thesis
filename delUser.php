<?php 

session_start();
require_once "conf_db/config.php";
require_once "func_msg/functions.php";

if($_SESSION["permission"] != "admin"){
		header("Location: index.php");
		exit;
} else {
	if(isset($_POST['id']) && $_POST['id'] != "") {
		$user_id = $_POST['id'];
		$query = "select login from users where id = '$user_id'";
		$result = @mysqli_query($link,$query);
		$row = @mysqli_fetch_assoc($result);
		$user = $row['login'];
		$query = "DELETE FROM users WHERE id = '$user_id'";
		@mysqli_query($link,$query);
		msg_logs_users($_SESSION['login'], "[Dalete user] The user '$user' has been removed!");
		echo '<div class="alert alert-success" role="alert">The user <b>'.$user.'</b> has been removed!</div>';
		unset($_POST);
	}
}
?> 