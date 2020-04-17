<?php 
    
    $response = array();
    header('Content-Type: application/json');

    $URL = 'ljack.com.pl';
    $DB_SERVER = $URL;
	$DB_USERNAME = 'admin';
	$DB_PASSWORD = 'admin12345';
	$DB_NAME = 'test';

    $link = @mysqli_connect($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

    // Check connection
    if($link === false){
        if(mysqli_connect_error()) {
            $response["error"] = TRUE;
            $response["message"] = "Failed to connect to database";
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
    }

    if(isset($_POST["type"]) && ($_POST["type"]=="signup") && isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"])) {
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $email = $_POST['email'];

        //Check user email whether its already regsitered
        $checkEmailQuery = "select * from users_api where email = '$email'";
        $result = mysqli_query($link,$checkEmailQuery);
        if($result->num_rows>0){
            $response["error"] = TRUE;
            $response["message"] ="Sorry email already found.";
            echo json_encode($response);
            exit;
        } else {
            $signupQuery = "INSERT INTO users_api(username,email,password) values('$username','$email','$password')";
            $signupResult = mysqli_query($link,$signupQuery);
            if($signupResult){
                // Get Last Inserted ID
                $id = mysqli_insert_id($link);
                // Get User By ID
                $userQuery = "SELECT id,username,email FROM users_api WHERE id = ".$id;
                $userResult = mysqli_query($link,$userQuery);
                 
                $user = mysqli_fetch_assoc($userResult);

                $response["error"] = FALSE;
                $response["message"] = "Successfully signed up.";
                $response["user"] = $user;
                echo json_encode($response);
                exit;
            } else {
                $response["error"] = TRUE;
                $response["message"] ="Unable to signup try again later.";
                echo json_encode($response);
                exit;
            }  
        }
    }else if(isset($_POST["type"]) && ($_POST["type"]=="login") && isset($_POST["email"]) && isset($_POST["password"])){
        //login user
     
        $email = $_POST["email"];
        $password = md5($_POST["password"]);
     
        $userQuery = "select id,username,email from users_api where email = '$email' and password = '$password'";
        $result = mysqli_query($link,$userQuery);
        // print_r($result); exit;
        if($result->num_rows==0){
            $response["error"] = TRUE;
            $response["message"] ="user not found or Invalid login details.";
            echo json_encode($response);
            exit;
        }else{
            $user = mysqli_fetch_assoc($result);
            $response["error"] = FALSE;
            $response["message"] = "Successfully logged in.";
            $response["user"] = $user;
            echo json_encode($response);
            exit;
        }
     
    }else {
        // Invalid parameters
        $response["error"] = TRUE;
        $response["message"] ="Invalid parameters";
        echo json_encode($response);
        exit;
    }
?>