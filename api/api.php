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

    $link = @mysqli_connect($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

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
            msg_logs_users_for_api($_POST["email"], "Sorry email already found in API");
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
        // login user
        $email = $_POST["email"];
        $password = md5($_POST["password"]);
     
        $userQuery = "select id,username,email from users_api where email = '$email' and password = '$password'";
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
            $_SESSION['loggedInApp'] = true;
            $_SESSION['usersInfo'] = $user;
            echo json_encode($response);
            exit;
        }
     
    } elseif(isset($_POST["type"]) && ($_POST["type"]=="resetPwdProfile") && isset($_POST["email"]) && isset($_POST["password"])) {
        echo "Reset Password from UI";
    } elseif(isset($_POST["type"]) && ($_POST["type"]=="forgotPwdProfile") && isset($_POST["email"])) {
        $email = $_POST["email"];
        $userQuery = "select id,email from users_api where email = '$email'";
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
            $response["message"] = "Reset Password";
            $response["user"] = $user;
            $_SESSION['usersInfo'] = $user;
            $response['password'] = generateRandomPassword();
            echo json_encode($response);
            exit;
        }
    }    
    else {
        // Invalid parameters
        $response["error"] = TRUE;
        $response["message"] ="Invalid parameters";
        echo json_encode($response);
        exit;
    }

    function generateRandomPassword() {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(8/strlen($x)) )),1,8);
    }
?>

<?php

if(isset($_POST["phoneNumber"]) && isset($_POST["message"])) {

require 'vendor/autoload.php';

$sdk = new Aws\Sns\SnsClient([
                'region'  => 'eu-west-1',
                'version' => 'latest',
                'credentials' => ['key' => 'AKIA2O4NZ7JIT4ZH6ZU4', 'secret' => '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']
        ]);

        //$msg='Test';
        //$number='+48790602938';

        $msg=$_POST["message"];
        $number=$_POST["phoneNumber"];

        $result = $sdk->publish([
                'Message' => $msg,
                'SMSType' => 'Promotional',
                'PhoneNumber' => $number,
                'MessageAttributes' => ['AWS.SNS.SMS.SenderID' => [
                'DataType' => 'String',
                'StringValue' => 'Authentication SMS']
        ]]);

        print_r( $result );
} else {
        echo "Method GET is not allowed";
}
?>
