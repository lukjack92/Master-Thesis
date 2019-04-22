<?php 

require_once "conf_db/config.php";

if($_POST['id'] != "" && $_POST['active'] != "")
{	
	$user_id = $_POST['id'];
	$active = $_POST['active'];
	$query = "update users set isActive = '$active' where id = '$user_id'";
	mysqli_query($link,$query);
	unset($_POST);
}
?> 