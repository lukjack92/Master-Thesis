<?php 

session_start();
require_once "conf_db/config.php";
require_once 'func_msg/functions.php';

//if($_SESSION["permission"] != "admin"){
if(!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] !== true){
		header("Location: index.php");
		exit;
} else {
	if($_POST['id'] != "")
	{	
		$question = $_POST['id'];
		$query = "delete from questions where id = '$question'";
		@mysqli_query($link,$query);
		//$result = @mysqli_query($link,$query);
		//$row = @mysqli_fetch_assoc($result);
		//$user = $row['login'];
		msg_logs_users($_SESSION['login'], "[delQuestion] The user has been removed question.");
		//unset($_POST);
		echo '<div class="alert alert-success" role="alert">The question has been removed!</div>';
	}
}
?> 