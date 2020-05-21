<?php

require_once "../func/functions.php";
require_once "../func_msg/functions.php";

if(isset($_POST["phoneNumber"]) && isset($_POST["message"])) {

require 'vendor/autoload.php';

$sdk = new Aws\Sns\SnsClient([
                'region'  => 'eu-west-1',
                'version' => 'latest',
                'credentials' => ['key' => 'xxxxxxxxxxxxxxxxxxxxxxxxx', 'secret' => 'xxxxxxxxxxxxxxxxxxxxxxxx']
        ]);

        $msg=$_POST["message"];
        $number=$_POST["phoneNumber"];

        $result = $sdk->publish([
                'Message' => $msg,
                'SMSType' => 'Promotional',
                'PhoneNumber' => $number,
                'MessageAttributes' => ['AWS.SNS.SMS.SenderID' => [
                'DataType' => 'String',
                'StringValue' => 'Physics']
        ]]);
        msg_logs_users_for_api("SMS","SMS was send to ".$_POST["phoneNumber"]);
        print_r( $result );
} else {
        echo "Method GET is not allowed";
}
?>
