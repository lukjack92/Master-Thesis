<?php 

require_once "conf_db/config.php";

if(isset($_POST['id']) && $_POST['id'] != "")
{
	$user_id = $_POST['id'];
	$query = "DELETE FROM users WHERE id = '$user_id'";
	mysqli_query($link,$query);
	unset($_POST);
}
?> 