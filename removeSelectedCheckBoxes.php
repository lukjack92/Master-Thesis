<?php 

session_start();
require_once "conf_db/config.php";
require_once 'func_msg/functions.php';
//if($_SESSION["permission"] != "admin"){
if(!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] !== true){
		header("Location: index.php");
		exit;
} else { 
    if($_POST['arrayCheckBoxes'] != "")
	{	
        //The removing multi questions 

        foreach ($_POST['arrayCheckBoxes'] as $value) {
        	$query = "delete from questions where id = '$value'";
		    @mysqli_query($link,$query);
		    msg_logs_users($_SESSION['login'], "[delQuestion] The user has been removed question.");
		    //echo '<div class="alert alert-success" role="alert">The question has been removed!</div>';
        }
        unset($_POST);
        echo '<div class="alert alert-success" role="alert">The question has been removed!</div>';
	}
}
?>