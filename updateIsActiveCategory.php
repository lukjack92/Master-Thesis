<?php 

session_start();
require_once "conf_db/config.php";
require_once "func_msg/functions.php";

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] !== true){
		header("Location: login.php");
		exit;
}

if($_POST['id'] != "" && $_POST['active'] != "")
{	
	$id_category = $_POST['id'];
	$active = $_POST['active'];
	$query = "update category set isActive = '$active' where id = '$id_category'";
	@mysqli_query($link,$query);
	$query = "select name from category where id = '$id_category'";
	$result = @mysqli_query($link,$query);
	$row = @mysqli_fetch_assoc($result);
	$nameCategory = $row['name'];	
	echo '<div class="alert alert-success" role="alert">The category <b>'.$nameCategory.'</b> has been changed to active status as: <b>'.$active.'</b>!</div>';
	msg_logs_users($_SESSION['login'], "[isActive] The category '$nameCategory' has been changed to '$active'.");
    unset($_POST);
}
?>