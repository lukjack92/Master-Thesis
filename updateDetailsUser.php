<?php
require_once "conf_db/config.php";

if($_POST["login"] != "" && $_POST["firstName"] != "" && $_POST["lastName"] != "" && $_POST["permission"] != "" && $_POST['userID']) {
	$query = "update users set login = '$_POST[login]', firstName = '$_POST[firstName]', lastName = '$_POST[lastName]', permission = '$_POST[permission]' where id = '$_POST[userID]'";
	mysqli_query($link,$query);
	unset($_POST);
	echo "User has updated";
} else {
	echo "Nie wszystko jest pełne";
}
?>