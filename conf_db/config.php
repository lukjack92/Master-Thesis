<?php

/* Database credentials */

define('DB_SERVER', 'db.mikr.us');
define('DB_USERNAME', 'uw336');
define('DB_PASSWORD', '506f7233');
define('DB_NAME', 'uw336');
define('TB_CODE', 'secret_code');
define('TB_TABLE', 'android');
define('TB_USERS', 'users');
define('TB_DATA', 'us_users');
 
/* Attempt to connect to MySQL database */
$link = @mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if($link === false){
    //die("ERROR: Could not connect. " . mysqli_connect_error());
	//echo "Error, please check it.";
} else {
	//echo "Connected";
	//mysqli_query($link, "SET CHARSET utf8");
	//mysqli_query($link, "SET CHARACTER_SET utf8_unicode_ci");
}
?>