<?php

// Initialize the session
session_start();

require_once "../func/functions.php";
require_once "../func_msg/functions.php";
require "vendor/autoload.php";
require "secret_key_sns.php";

$credentials = new Aws\Credentials\Credentials($key, $secretKey);

if(isset($_SESSION['codeSms']) && isset($_POST["phoneNumber"])) {

$sdk = new Aws\Sns\SnsClient([
                'region'  => 'eu-west-1',
                'version' => 'latest',
                'credentials' => $credentials
        ]);

        $msg="One Time Password is: ".$_SESSION['codeSms'];
        $number=$_POST["phoneNumber"];

        $result = $sdk->publish([
                'Message' => $msg,
                'SMSType' => 'Promotional',
                'PhoneNumber' => $number,
                'MessageAttributes' => ['AWS.SNS.SMS.SenderID' => [
                'DataType' => 'String',
                'StringValue' => 'Physics']
        ]]);
        msg_logs_users_for_api("SMS","SMS was send to ".$_POST["phoneNumber"]." with the code: ".$_SESSION['codeSms']);

        $response["error"] = TRUE;
        $response["message"] = "success";
        echo json_encode($response);
        exit;       
        //print_r( $result );
} else {
        echo "Method GET is not allowed";
}
?>
