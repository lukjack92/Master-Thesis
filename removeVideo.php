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
		$videoID = $_POST['id'];
		$query = "delete from video where id = '$videoID'";
		@mysqli_query($link,$query);
		msg_logs_users($_SESSION['login'], "[deVideoURL] The video has been removed.");
		unset($_POST);
		echo '<div class="alert alert-success" role="alert">[deVideoURL] The video has been removed.</div>';
	}
}
?> 