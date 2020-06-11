<?php

$file = dirname(__FILE__) . '/secret_key_to_databases.php';

if(!file_exists($file)){
	echo sprintf('The file %s does not exist',$file);
	exit;
}

require_once (dirname(__FILE__) . '/secret_key_to_databases.php');
require_once (dirname(__FILE__, 2) . '/func_msg/functions.php');

define('TB_CODE', 'secret_code');
define('TB_TABLE', 'android');
define('TB_USERS', 'users');
define('TB_DATA', 'us_users');
define('TB_QUESTIONS', 'questions');

if(isSiteAvailible($URL1,$DB_PORT_1)) {
	$DB_SERVER = $URL1;
	$DB_USERNAME = $DB_USERNAME_1;
	$DB_PASSWORD = $DB_PASSWORD_1;
	$DB_NAME = $DB_NAME_1;
} elseif(isSiteAvailible($URL2,$DB_PORT_2)) {
	$DB_SERVER = $URL2;
	$DB_USERNAME = $DB_USERNAME_2;
	$DB_PASSWORD = $DB_PASSWORD_2;
	$DB_NAME = $DB_NAME_2;
} else {
	msg_logs("Databases are down!");
}

//Uncomment following line in order to check which server's database is using
//$infoDATABASE = "Database conected from: ".$DB_SERVER;
	
/* Attempt to connect to MySQL database */
$link = @mysqli_connect($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_NAME, $DB_PORT);

// Check connection
if($link === false){
	msg_logs(mysqli_connect_error());
} else {
	//echo " Connected12";
	mysqli_query($link, "SET CHARSET utf8");
	mysqli_query($link, "SET CHARACTER_SET utf8_unicode_ci");
}
?>