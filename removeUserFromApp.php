<?php 

session_start();
require_once "conf_db/config.php";
require_once 'func_msg/functions.php';

if(!isset($_SESSION["loggedInApp"]) || $_SESSION["loggedInApp"] !== true){
		header("Location: loginProfileApp.php");
		exit;
} else {
	if(isset($_POST['email']) && $_POST['email'] != "")
	{	
		$user = $_POST['email'];
		$query = "delete from users_api where email = '$user'";
        if (mysqli_query($link,$query)) {
            $response["error"] = FALSE;
            //$response["message"] = '<center class="alert alert-success">Success the account has been removed.</center>';
            $_SESSION['removeUser'] = '<center class="alert alert-success">Success the account has been removed.</center>';
            unset($_SESSION["loggedInApp"]);
            msg_logs_users($_POST['email'], "[My account has been deleted]");
        } else {
            $response["error"] = TRUE;
            $response["message"] = '<center class="alert alert-danger">Something went wrong.</center>';
            //echo '<center class="alert alert-danger">Something went wrong.</center>';
            msg_logs_users($_POST['email'], "[Delete the user from App Error] ".mysqli_error($link));
            
        }

        echo json_encode($response);
	}
}
?> 