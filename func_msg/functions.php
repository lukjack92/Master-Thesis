<?php

function isSiteAvailible($host){
	$port = 3306;
	$connection = @fsockopen($host, $port);
    return is_resource($connection)?true:false;
}

function msg_logs($msg) {
	
	$error_msg = date('D Y-m-d H:i:s A')." Addr IP: ".$_SERVER['REMOTE_ADDR']." ".$msg."\n";	
	$logFileName = "logs/log_".date('Ymd').".txt";

	if(file_exists($logFileName)) {
		$fHandler = fopen($logFileName,'a+');
		fwrite($fHandler, $error_msg);
		fclose($fHandler);
	}
	else {
		$fHandler = fopen($logFileName,'w');
		fwrite($fHandler, $error_msg);
		fclose($fHandler);
	}
}

// Collecting logs from users
function msg_logs_users($user, $msg) {
	$error_msg = date('D Y-m-d h:i:s A')." Addr IP: ".$_SERVER['REMOTE_ADDR']." ".$user." ".$msg."\n";	
	$logFileName = "logs/log_".date('Ymd').".txt";

	if(file_exists($logFileName)) {
		$fHandler = fopen($logFileName,'a+');
		fwrite($fHandler, $error_msg);
		fclose($fHandler);
	}
	else {
		$fHandler = fopen($logFileName,'w');
		fwrite($fHandler, $error_msg);
		fclose($fHandler);
	}
}

// Collecting logs from users
function msg_logs_users_for_api($user, $msg) {
	$error_msg = date('D Y-m-d h:i:s A')." Addr IP: ".$_SERVER['REMOTE_ADDR']." ".$user." ".$msg."\n";	
	$logFileName = "../logs/log_".date('Ymd').".txt";

	if(file_exists($logFileName)) {
		$fHandler = @fopen($logFileName,'a+');
		@fwrite($fHandler, $error_msg);
		@fclose($fHandler);
	}
	else {
		$fHandler = @fopen($logFileName,'w');
		@fwrite($fHandler, $error_msg);
		@fclose($fHandler);
	}
}

?>