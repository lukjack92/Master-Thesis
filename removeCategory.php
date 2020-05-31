<?php 

session_start();
require_once "conf_db/config.php";
require_once 'func_msg/functions.php';

//if($_SESSION["permission"] != "admin"){
if(!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] !== true){
		header("Location: index.php");
		exit;
} else {
	if($_POST['id'] != "" && $_POST['name'] != "")
	{	
		$categoryID = $_POST['id'];
		//echo $category;
		$categoryName = $_POST['name'];
		$query = "delete from category where id = '$categoryID'";
		@mysqli_query($link,$query);
		
		//Removing category where has been assigned.
		$query = "update questions set category = '' where category  = '$categoryName'";
		@mysqli_query($link,$query);
		//$result = @mysqli_query($link,$query);
		//$row = @mysqli_fetch_assoc($result);
		//$user = $row['login'];
		msg_logs_users($_SESSION['login'], "[delQuestion] The category has been removed.");
		//unset($_POST);
		echo '<div class="alert alert-success" role="alert">The category has been removed!</div>';
	}
}
?> 