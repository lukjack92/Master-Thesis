<?php

require_once 'func_msg/functions.php';

/* Database credentials */
$URL1 = '77.55.214.222';
$URL2 = 'db.mikr.us';

$DB_SERVER = " ";
$DB_USERNAME = " ";
$DB_PASSWORD = " ";
$DB_NAME = " ";

define('TB_CODE', 'secret_code');
define('TB_TABLE', 'android');
define('TB_USERS', 'users');
define('TB_DATA', 'us_users');
define('TB_QUESTIONS', 'questions');

if(isSiteAvailible($URL1)){
	$DB_SERVER = $URL1;
	$DB_USERNAME = 'admin';
	$DB_PASSWORD = 'admin12345';
	$DB_NAME = 'test';
	//echo $DB_SERVER;

} elseif(isSiteAvailible($URL2)) {
	$DB_SERVER = $URL2;
	$DB_USERNAME = 'uw336';
	$DB_PASSWORD = '506f7233';
	$DB_NAME = 'uw336';
	//echo $DB_SERVER;
	
} else {
	echo "Databases are down!";
	msg_logs("Databases are down!");
}

//echo $DB_SERVER;
	
/* Attempt to connect to MySQL database */
$link = @mysqli_connect($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

// Check connection
if($link === false){
    //die("ERROR: Could not connect. " . mysqli_connect_error());
	echo "<div class='alert alert-danger' role='alert'><center><b>Error, please check it. Check to the log.</b></center></div>";
} else {
	//echo " Connected";
	mysqli_query($link, "SET CHARSET utf8");
	mysqli_query($link, "SET CHARACTER_SET utf8_unicode_ci");
}

?>