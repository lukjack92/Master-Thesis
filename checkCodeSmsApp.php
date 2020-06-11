<?php

// Initialize the session
session_start();

//require_once (dirname(__FILE__) . '/conf_db/config.php');
//require_once ("func_msg/functions.php");

require_once (dirname(__FILE__) . '/conf_db/config.php');
require_once (dirname(__FILE__) . '/func_msg/functions.php');

function generateRandomPassword() {
    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(8/strlen($x)) )),1,8);
}

if(isset($_SESSION['usersInfo']['email']) && isset($_POST['code'])) {
    $email = $link->real_escape_string($_SESSION['usersInfo']['email']);
    $userQuery = "select oneTimePassword from users_api where email = '$email'";
    $result = mysqli_query($link,$userQuery);

    //if($result->num_rows==0){
    if(mysqli_query($link,$userQuery)) {
        $code = mysqli_fetch_assoc($result);
        if($_POST['code'] == $code['oneTimePassword']) {
        //if($_POST['code'] == $_SESSION['codeSms']) {
            $password = generateRandomPassword();
            $_SESSION['password'] = $password;
            $password = md5($password);
            $query = "update users_api set password = '$password', requiresReset = 'true' where email = '$email'";

            if(mysqli_query($link,$query)) {
                $response["error"] = FALSE;
                $response["message"] = "Password was set up: ".$_SESSION['password'];
                msg_logs_users_for_api($email, "Password was set up: ".$_SESSION['password']);
                unset($_SESSION['usersInfo']['email']);
                unset($_SESSION['resetPassword2FA']);
                echo json_encode($response);
                exit;
            } else {
                $response["error"] = TRUE;
                $response["message"] = "Something went wrong!";
                msg_logs_users_for_api($email, "Password was not set up!");
                unset($_SESSION['usersInfo']['email']);
                unset($_SESSION['resetPassword2FA']);
                echo json_encode($response);
                exit;
            }
        } else {
            $response["error"] = TRUE;
            $response["message"] = "CodeSMS was incorrect!";
            msg_logs_users_for_api($email, "CodeSMS was incorrect! ".$_POST['code']);
            //unset($_SESSION['usersInfo']['email']);
            echo json_encode($response);
            exit;
        }
    } else {
        $response["error"] = TRUE;
        $response["message"] = "Something went wrong!";
        msg_logs_users_for_api($email, "CodeSMS was incorect! ");
        //unset($_SESSION['usersInfo']['email']);
        echo json_encode($response);
        exit;
    }
} else {
    $response["error"] = FALSE;
    $response["message"] = "Something went wrong!";
    echo json_encode($response);
    exit;
}
?>