<?php

require_once "../func/functions.php";
require_once "../func_msg/functions.php";
require "vendor/autoload.php";
require "secret_key_sns.php";

$credentials = new Aws\Credentials\Credentials($key, $secretKey);

if(isset($_SESSION['usersInfo']['email']) && isset($_POST["phoneNumber"])) {

$sdk = new Aws\Sns\SnsClient([
                'region'  => 'eu-west-1',
                'version' => 'latest',
                'credentials' => $credentials
        ]);

        $six_digit_number = mt_rand(100000, 999999);

        $msg="One Time Password is: ".$six_digit_number;
        $number=$_POST["phoneNumber"];

        $result = $sdk->publish([
                'Message' => $msg,
                'SMSType' => 'Promotional',
                'PhoneNumber' => $number,
                'MessageAttributes' => ['AWS.SNS.SMS.SenderID' => [
                'DataType' => 'String',
                'StringValue' => 'Physics']
        ]]);
        msg_logs_users_for_api("SMS","SMS was send to ".$_POST["phoneNumber"]." and six-digit code: ".$six_digit_number);
        print_r( $result );
} else {
        echo "Method GET is not allowed";
}
?>
