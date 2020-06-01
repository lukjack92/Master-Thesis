<?php
	
//Initialize the session
session_start();

// Logs handle
require_once ("func_msg/functions.php");

msg_logs_users($_SESSION['usersInfo']['email']." - User from AppMobileProfile ","Successfully logged out from Profile App");

// Unset all of the session variables
unset($_SESSION['loggedInApp']);
unset($_SESSION['usersInfo']);	
	
//Redirect to login page
header("Location: loginProfileApp.php");

?>