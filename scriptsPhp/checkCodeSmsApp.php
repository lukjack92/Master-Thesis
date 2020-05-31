<?php

// Initialize the session
session_start();

require_once "../func/functions.php";
require_once "../func_msg/functions.php";

if($_SESSION['usersInfo']['email'] && isset($_POST['code'])) {

    $email = $link->real_escape_string($_SESSION['usersInfo']['email']);
    $userQuery = "select id,email,oneTimePassowrd from users_api where email = '$email'";
    $result = mysqli_query($link,$userQuery);

    if(mysqli_num_rows($result)>0){
        $code = mysqli_fetch_assoc($result);
        //if($_POST['code'] === $code['oneTimePassowrd']) {
        if($_POST['code'] === $_SESSION['codeSms']) {
            $password = generateRandomCodeSMSAndPassword();
            $_SESSION['password'] = $password;
            $password = md5($password);
            $query = "update users_api set password = '$password', requiresReset = 'true' where email = '$email'";

            if (mysqli_query($link,$query)) {
                $response["error"] = FALSE;
                $response["message"] = "Password was set up: "+$_SESSION['password'];
                msg_logs_users_for_api($_POST["email"], "Password was set up: ".$_SESSION['password']);
                echo json_encode($response);
                exit;
            } else {
                $response["error"] = TRUE;
                $response["message"] = "Something went wrong!";
                msg_logs_users_for_api($_POST["email"], "Password was not set up! ".$_POST['code']);
                echo json_encode($response);
                exit;
            }
        } else {
            $response["error"] = TRUE;
            $response["message"] = "CodeSMS was incorect!";
            msg_logs_users_for_api($_POST["email"], "CodeSMS was incorect! ".$_POST['code']);
            echo json_encode($response);
            exit;
        }
        function generateRandomCodeSMSAndPassword() {
            return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(8/strlen($x)) )),1,8);
        }
    }
}
?>