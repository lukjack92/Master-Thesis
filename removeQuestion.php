<?php 

session_start();
require_once "conf_db/config.php";
require_once 'func_msg/functions.php';

if($_SESSION["permission"] != "admin"){
		header("Location: index.php");
		exit;
} else {
	if($_POST['id'] != "")
	{	
		$question = $_POST['id'];
		echo $question;
		$query = "delete from questions where id = '$question'";
		@mysqli_query($link,$query);
		//$result = @mysqli_query($link,$query);
		//$row = @mysqli_fetch_assoc($result);
		//$user = $row['login'];
		//msg_logs_users($_SESSION['login'], "[isActive] The user '$user' has been changed to '$active'.");
		//unset($_POST);
		echo '<div class="alert alert-success" role="alert">The question has been deleted!</div>';
	}
}
?> 