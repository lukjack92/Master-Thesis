<?php 

session_start();
require_once "conf_db/config.php";
require_once 'func_msg/functions.php';

if(!isset($_SESSION["loggedInApp"]) || $_SESSION["loggedInApp"] !== true){
		header("Location: loginProfileApp.php");
		exit;
} else {
	if($_POST['email'] != "" && $_POST['password'] != "" && $_POST['currentPwd'] != "")
	{	
        $currentPwd = $link->real_escape_string(md5($_POST['currentPwd']));
        $email = $link->real_escape_string($_POST['email']);
        $password = $link->real_escape_string(md5($_POST['password']));

        $userQuery = "select username from users_api where email = '$email' and password = '$currentPwd'";
        $result = mysqli_query($link,$userQuery);

        if(mysqli_num_rows($result)>0){
            $query = "update users_api set password = '$password' where email = '$email' and password = '$currentPwd'";
            if (mysqli_query($link,$query)) {
                $response["error"] = FALSE;
                //$response["message"] = '<center class="alert alert-success">Success the account has been removed.</center>';
                $response["message"] = 'Success, the password has been reset';
                msg_logs_users($_POST['email'], "[Success, the password has been reset!]");
            } else {
                $response["error"] = TRUE;
                $response["message"] = 'Something went wrong.';
                //echo '<center class="alert alert-danger">Something went wrong.</center>';
                msg_logs_users($_POST['email'], "Something went wrong during the password reset!".mysqli_error($link));
            }
        } else {
            $response["error"] = TRUE;
            $response["message"] = 'Incorect passowrd!';
            msg_logs_users($_POST['email'], "Incorect password!");
        }

        echo json_encode($response); 
    }
}
?> 