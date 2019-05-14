<?php
require_once "conf_db/config.php";

if($_POST["login"] != "" && $_POST["firstName"] != "" && $_POST["lastName"] != "" && $_POST["permission"] != "" && $_POST['userID']) {
	
	$query = "select * from users where login = '$_POST[login]' and id != '$_POST[userID]'";
	$result = mysqli_query($link,$query);
	
	$numResults = mysqli_num_rows($result);
	
	if($numResults > 0) {
		echo "Don't add a new user, but the user's exist";
	} else {
	
		$query = "update users set login = '$_POST[login]', firstName = '$_POST[firstName]', lastName = '$_POST[lastName]', permission = '$_POST[permission]' where id = '$_POST[userID]'";
		mysqli_query($link,$query);
		unset($_POST);
		echo "User has updated";
	}
} else {
	echo "Nie wszystko jest pełne";
}
?>