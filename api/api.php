<?php 
    
	// Initialize the session
	session_start();

    $response = array();
    //header('Content-Type: application/json');

    // Logs handle
    require_once ("../func_msg/functions.php");

    $URL = 'ljack.com.pl';
    $DB_SERVER = $URL;
	$DB_USERNAME = 'admin';
	$DB_PASSWORD = 'admin12345';
	$DB_NAME = 'test';

    $link = mysqli_connect($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

    // Check connection
    if($link === false){
        if(mysqli_connect_error()) {
            $response["error"] = TRUE;
            $response["message"] = "Failed to connect to database";
            msg_logs_users_for_api($_POST["email"], "Failed to connect to database in API");
            echo json_encode($response);
            exit;
        }
    } else {
        mysqli_query($link, "SET CHARSET utf8");
        mysqli_query($link, "SET CHARACTER_SET utf8_unicode_ci");
    }

    if($_SERVER["REQUEST_METHOD"] == "GET") {
        $response["message"] = "It is AppPhone";
        echo json_encode($response);
        exit;
    } 

    if(isset($_POST["type"]) && ($_POST["type"]=="signup") && isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["phoneNumber"])) {
        $username = $link->real_escape_string($_POST['username']);
        $email = $link->real_escape_string($_POST["email"]);
        $password = $link->real_escape_string(md5($_POST["password"]));
        $phoneNumber = $link->real_escape_string($_POST["phoneNumber"]);

        $phoneNumber = "+".$phoneNumber;

        //Check user email whether its already regsitered
        $checkEmailQuery = "select * from users_api where email = '$email'";
        $result = mysqli_query($link,$checkEmailQuery);
        if(mysqli_num_rows($result)>0){
            $response["error"] = TRUE;
            $response["message"] ="Sorry email already found.";
            msg_logs_users_for_api($_POST["email"], "Sorry email already found in API");
            echo json_encode($response);
            exit;
        } else {
            $signupQuery = "INSERT INTO users_api(username,email,password,phoneNumber) values('$username','$email','$password','$phoneNumber')";
            $signupResult = @mysqli_query($link,$signupQuery);
            if($signupResult){
                // Get Last Inserted ID
                $id = mysqli_insert_id($link);
                // Get User By ID
                $userQuery = "SELECT id,username,email,phoneNumber FROM users_api WHERE id = ".$id;
                $userResult = mysqli_query($link,$userQuery);
                 
                $user = mysqli_fetch_assoc($userResult);

                $response["error"] = FALSE;
                $response["message"] = "Successfully signed up.";
                $response["user"] = $user;
                msg_logs_users_for_api($_POST["email"], "Successfully signed up in API");
                echo json_encode($response);
                exit;
            } else {
                $response["error"] = TRUE;
                $response["message"] ="Unable to signup try again later.";
                msg_logs_users_for_api($_POST["email"], "Unable to signup try again later in API");
                echo json_encode($response);
                exit;
            }  
        }
    }else if(isset($_POST["type"]) && ($_POST["type"]=="login") && isset($_POST["email"]) && isset($_POST["password"])){
        // Login user
        $email = $link->real_escape_string($_POST['email']);
        $password = $link->real_escape_string(md5($_POST["password"]));

        $userQuery = "select id,username,email,requiresReset from users_api where email = '$email' and password = '$password'";
        $result = mysqli_query($link,$userQuery);
        // print_r($result); exit;
        if($result->num_rows==0){
            $response["error"] = TRUE;
            $response["message"] ="User not found or Invalid login details.";
            msg_logs_users_for_api($_POST["email"], "User not found or Invalid login details in API");
            echo json_encode($response);
            exit;
        }else{
            $user = mysqli_fetch_assoc($result);
            $response["error"] = FALSE;
            $response["message"] = "Successfully logged in.";
            $response["user"] = $user;
            msg_logs_users_for_api($_POST["email"], "Successfully logged in API");

            //Value require to login App
            $_SESSION['loggedInApp'] = true;
            $_SESSION['usersInfo'] = $user;
            echo json_encode($response);
            exit;
        }
     
    } else if(isset($_POST["type"]) && ($_POST["type"]=="forgotPwdProfile") && isset($_POST["email"])) {

        $email = $link->real_escape_string($_POST['email']);
        $userQuery = "select id,email,phoneNumber from users_api where email = '$email'";
        $result = mysqli_query($link,$userQuery);
        if($result->num_rows==0){
            $response["error"] = TRUE;
            $response["message"] ="User not found";
            msg_logs_users_for_api($_POST["email"], "User not found for forgottenPassword");
            echo json_encode($response);
            exit;
        }else{
            $user = mysqli_fetch_assoc($result);
            $response["error"] = FALSE;
            $response["message"] = "One Time Password has been set up!";
            $response["user"] = $user;

            //Session if user is exist in DB
            $_SESSION['usersInfo'] = $user;
            $password = generateRandomCodeSMSAndPassword();
            $code = generateRandomCodeSMSAndPassword();

            $_SESSION['codeSms'] = $code;
            $_SESSION['password'] = $password;
            $password = md5($password);
            
            $query = "update users_api set password = '$password', oneTimePassword = '$code', requiresReset = 'true' where email = '$email'";

            if (mysqli_query($link,$query)) {
                msg_logs_users_for_api($_POST["email"], "CodeSMS set up: ".$code." password set up: ".$_SESSION['password']);
                echo json_encode($response);
                exit;
            } else {
                $response["error"] = TRUE;
                $response["message"] = "Something went wrong!";
                msg_logs_users_for_api($_POST["email"], "Password and code has been not set up!");
                echo json_encode($response);
                exit;
            }
        }
    }    
    else {
        // Invalid parameters
        $response["error"] = TRUE;
        $response["message"] ="Invalid parameters";
        echo json_encode($response);
        exit;
    }

    function generateRandomCodeSMSAndPassword() {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(8/strlen($x)) )),1,8);
    }
?>