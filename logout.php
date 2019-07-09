<?php
	
//Initialize the session
session_start();

require_once 'func_msg/functions.php';

msg_logs_users($_SESSION['login'], "Successfully logged out.");

// Unset all of the session variables
$_SESSION = array();
	
// Destroy the session
session_destroy();
	
//Redirect to login page
header("Location: login.php");

?>