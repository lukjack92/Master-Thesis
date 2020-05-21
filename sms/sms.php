<?php

require_once "../conf_db/config.php";
require_once "../func/functions.php";
require_once '../func_msg/functions.php';

if(isset($_POST["phoneNumber"]) && isset($_POST["message"])) {

require 'vendor/autoload.php';

$sdk = new Aws\Sns\SnsClient([
                'region'  => 'eu-west-1',
                'version' => 'latest',
                'credentials' => ['key' => 'AKIA2O4NZ7JIT4ZH6ZU4', 'secret' => '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']
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