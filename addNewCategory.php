<?php 

session_start();
require_once "conf_db/config.php";
require_once "func_msg/functions.php";

if(!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] !== true) {
		header("Location: index.php");
		exit;
} else {
	if($_POST['category'] != "") {
		$category = mysqli_real_escape_string($link,$_POST['category']);
		//$add_user_sql = "INSERT INTO `category` (`name`) VALUES ('$category')";
		//$add_user_sql = "INSERT INTO category name VALUES '$_POST[category]'";
		//$add_user_sql = "insert into category (`name`) select '".$category."' from category Where not exist(select name from category where name='".$category."') limit 1";
		$add_user_sql = "insert into category (NAME) Select ('$category') Where not exists(select * from category where NAME=('$category'))";

		if(mysqli_query($link,$add_user_sql)) {
			echo '<div class="alert alert-success" role="alert">A new category has been added!</div>';
			msg_logs_users($_SESSION['login'], "A new category has been added!");

		} else { echo '<div class="alert alert-danger" role="alert">A new category has not been added!</div>';
				msg_logs_users($_SESSION['login'], "A new category has not been added, because it is exists in database!");
		}
			unset($_POST);
	} else {
		echo '<div class="alert alert-danger" role="alert">There is requite this the filed to add it!</div>'; 
	}
}
?>