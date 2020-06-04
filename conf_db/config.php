<?php

//require_once (dirname(__FILE__) . '/secret_key_to_databases.php');
require_once (dirname(__FILE__, 2) . '/func_msg/functions.php');
//require_once ('func_msg/functions.php');


/*Database credentials*/
//$URL1 = '77.55.214.222';
$URL1 = 'ljack.com.pl';
$URL2 = 'front.mikr.us';
//$URL2 = '51.38.133.125';

$DB_PORT = 3306;
$DB_SERVER = " ";
$DB_USERNAME = " ";
$DB_PASSWORD = " ";
$DB_NAME = " ";

define('TB_CODE', 'secret_code');
define('TB_TABLE', 'android');
define('TB_USERS', 'users');
define('TB_DATA', 'us_users');
define('TB_QUESTIONS', 'questions');

if(isSiteAvailible($URL1,$DB_PORT)) {
	$DB_SERVER = $URL1;
	$DB_USERNAME = 'admin';
	$DB_PASSWORD = 'admin12345';
	$DB_NAME = 'test';

} elseif(isSiteAvailible($URL2,$DB_PORT)) {
	$DB_SERVER = $URL2;
	$DB_USERNAME = 'a177';
	$DB_PASSWORD = 'MjRh_72a7';
	$DB_NAME = 'db_a177';
} else {
	msg_logs("Databases are down!");
}

//Uncomment following line in order to check which server's database is using
//$infoDATABASE = "MySQL form domain: ".$DB_SERVER;
	
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