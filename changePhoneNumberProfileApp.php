<?php 

session_start();
require_once "conf_db/config.php";
require_once 'func_msg/functions.php';

if(!isset($_SESSION["loggedInApp"]) || $_SESSION["loggedInApp"] !== true){
		header("Location: loginProfileApp.php");
		exit;
} else {
	if($_POST['phoneNumber'] != "" && $_POST['email'] != "" && $_POST['prefix'] != "")
	{	
        $prefix = $link->real_escape_string($_POST['prefix']);
        $number = $link->real_escape_string($_POST['phoneNumber']);
        $email = $link->real_escape_string($_POST['email']);

        $prefixNumber = "+".$prefix . $number;

        $userQuery = "select username from users_api where email = '$email'";
        $result = mysqli_query($link,$userQuery);

        if(mysqli_num_rows($result)>0){
            $query = "update users_api set phoneNumber = '$prefixNumber' where email = '$email'";
            if (mysqli_query($link,$query)) {
                $response["error"] = FALSE;
                //$response["message"] = '<center class="alert alert-success">Success the account has been removed.</center>';
                $response["message"] = 'Success, the PhoneNumber has been updated';
                msg_logs_users($_POST['email'], "[Success, the PhoneNumber has been updated]");
            } else {
                $response["error"] = TRUE;
                $response["message"] = 'Something went wrong.';
                //echo '<center class="alert alert-danger">Something went wrong.</center>';
                msg_logs_users($_POST['email'], "Something went wrong during the phoneNumber updated!".mysqli_error($link));
            }
        } else {
            $response["error"] = TRUE;
            $response["message"] = 'Something went wrong!';
            msg_logs_users($_POST['email'], "Something went wrong during the phoneNumber updated! Probably the email is not exist in DB!".mysqli_error($link));
        }
        echo json_encode($response); 
    } else {
        $response["error"] = TRUE;
        $response["message"] = 'Something went wrong!';
        msg_logs_users("Error", "Lack all required attributes in method POST!");
    }
}
?> 