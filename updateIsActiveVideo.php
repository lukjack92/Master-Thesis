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
	$id_video = $_POST['id'];
	$active = $_POST['active'];
	$query = "update video set isActive = '$active' where id = '$id_video'";
    @mysqli_query($link,$query);
    
    if($_POST['active'] == true) {
        echo '<div class="alert alert-success" role="alert">The video has been changed to active status as: <b>'.$active.'</b>!</div>';
        msg_logs_users($_SESSION['login'], "[isActiveVideo] ".$id_video." The video has been changed to '$active'.");  
    } else {
        echo '<div class="alert alert-danger" role="alert">The video has been changed to active status as: <b>'.$active.'</b>!</div>';
        msg_logs_users($_SESSION['login'], "[isActiveVideo] ".$id_video." The video has been changed to '$active'.");  
    }
    unset($_POST);
}
?>