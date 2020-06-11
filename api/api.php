<?php 
    
	// Initialize the session
	session_start();

    //$response = array();
    //header('Content-Type: application/json');

    // Logs handle
    require_once ("../func_msg/functions.php");
    //include('./conf_db/config.php');
    require_once (dirname(__FILE__, 2) . '/conf_db/config.php');

 /*   
    $URL = 'ljack.com.pl';
    $DB_SERVER = $URL;
	$DB_USERNAME = 'admin';
	$DB_PASSWORD = 'admin12345';
	$DB_NAME = 'test';
*/
    //$link = @mysqli_connect($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_NAME, $PORT);

    // Check connection
    if($link === false){
        if(mysqli_connect_error()) {
            $response["error"] = TRUE;
            $response["message"] = "Failed to connect to database";
            msg_logs_users_for_api("API -", "Failed to connect to database in API");
            echo json_encode($response);
            exit;
        }
    } 
    /* else {
        mysqli_query($link, "SET CHARSET utf8");
        mysqli_query($link, "SET CHARACTER_SET utf8_unicode_ci");
    }
*/
    if($_SERVER["REQUEST_METHOD"] == "GET") {
        $response["message"] = "It is API";
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
    }else if(isset($_POST["type"]) && ($_POST["type"]=="login") && isset($_POST["email"]) && isset($_POST["password"])) {
        // Login user
        $email = $link->real_escape_string($_POST['email']);
        $password = $link->real_escape_string(md5($_POST["password"]));

        $userQuery = "select id,username,email,requiresReset from users_api where email = '$email' and password = '$password'";
        $result = mysqli_query($link,$userQuery);
        // print_r($result); exit;
        if($result->num_rows==0){
            $response["error"] = TRUE;
            $response["message"] = "User not found or Invalid login details.";
            msg_logs_users_for_api($_POST["email"], "User not found or Invalid login details in API");
            echo json_encode($response);
            exit;
        }else{
            $user = mysqli_fetch_assoc($result);
            $response["error"] = FALSE;
            $response["message"] = "Successfully logged in.";
            $response["user"] = $user;
            msg_logs_users_for_api($_POST["email"], "Successfully logged in App");

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

            $codeSMS  = mt_rand(100000, 999999);

            $query = "update users_api set oneTimePassword = '$codeSMS' where email = '$email'";
            if (mysqli_query($link,$query)) {
                msg_logs_users_for_api($_POST["email"], "CodeSMS set up: ".$codeSMS);
                //Session if user is exist in DB for page checkCodeSMS.php
                $_SESSION['usersInfo'] = $user;
                $_SESSION['resetPassword2FA'] = "reset";
                //Session for sms.php
                $_SESSION['codeSms'] = $codeSMS;
                echo json_encode($response);
                exit;
            } else {
                $response["error"] = TRUE;
                $response["message"] = "Something went wrong!";
                msg_logs_users_for_api($_POST["email"], "CodeSMS has been not set up!");
                echo json_encode($response);
                exit;
            }
        }
    } elseif(isset($_POST["type"]) && $_POST["type"]=="category") {
        $userQuery = "select name from category where isActive = 'true'";
        $result = mysqli_query($link,$userQuery);
        if(@mysqli_num_rows($result) > 0) {
            $data = array();
            // Output data of each rows
            while($row = mysqli_fetch_assoc($result)) {
                array_push($data, $row);
            }
            $response["error"] = FALSE;
            $response["message"] = $data;
            echo json_encode($response);
            exit;

        } else {
            $response["error"] = TRUE;
            $response["message"] = "No data";
            echo json_encode($response);
            exit;
        }
    } elseif(isset($_POST["type"]) && $_POST["type"] == "questionsFromCategory" && $_POST["category"] != "") {
        $category = $link->real_escape_string($_POST['category']);
        
        $userQuery = "select * from category where name = '$category' and isActive = 'true'";
        $result = mysqli_query($link,$userQuery);
        if(mysqli_num_rows($result) > 0) { 
            $userQuery = "select id,question,ansa,ansb,ansc,ansd,odp from questions where category = '$category'";
            $result = mysqli_query($link,$userQuery);
            $data = array();
            if(mysqli_num_rows($result) > 0) {
                // Output data of each rows
                while($row = mysqli_fetch_assoc($result)) {
                    array_push($data, $row);
                }
                $response["error"] = FALSE;
                $response["message"] = $data;
                echo json_encode($response);
                exit;
    
            } else {  
                $response["error"] = TRUE;
                $response["message"] = "No data";
                echo json_encode($response); 
            }
        } else {
            $response["error"] = TRUE;
            $response["message"] = "No date or category is inactive!";
            echo json_encode($response);
        }
    } elseif(isset($_POST["type"]) && $_POST["type"] == "updateResultQuizForUser" && $_POST["email"] != "" && $_POST["result"] != "" && $_POST["category"] != "") {
        $category = $link->real_escape_string($_POST['category']);
        $result = $link->real_escape_string($_POST['result']);
        $email = $link->real_escape_string($_POST['email']);

        $userQuery = "UPDATE `users_api` SET `infoQuiz` = JSON_OBJECT(\"result\", '$result', \"category\", '$category') WHERE `email` = '$email'";
        mysqli_query($link,$userQuery);
        if(mysqli_affected_rows($link) > 0) { 
            $response["error"] = FALSE;
            $response["message"] = "Update successfully!";
            msg_logs_users_for_api($_POST["email"], "Result from Quiz: ".$result.". Category: ".$category);

            echo json_encode($response);
        } else {
            $response["error"] = TRUE;
            $response["message"] = "Something went wrong!";
            echo json_encode($response);
        }
    } else {
        // Invalid parameters
        $response["error"] = TRUE;
        $response["message"] ="Invalid parameters";
        echo json_encode($response);
        exit;
    }
?>