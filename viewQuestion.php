<?php

session_start();

$isActive = "";

require_once "conf_db/config.php";

if(!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] !== true){
	header("Location: index.php");
	exit;
} else {
	if($_POST['id'] != "")
	{	
		$question = $_POST['id'];
		$query = "select * from questions where id = '$question'";
		$result = @mysqli_query($link,$query);
		//$result = @mysqli_query($link,$query);
		//$row = @mysqli_fetch_assoc($result);
		//$user = $row['login'];
		//msg_logs_users($_SESSION['login'], "[isActive] The user '$user' has been changed to '$active'.");
		unset($_POST);
		while($row = mysqli_fetch_assoc($result)) {
				$response['id'] = $row['id'];
				$response['question'] = $row['question'];
				$response['ansa'] = $row['ansa'];
				$response['ansb'] = $row['ansb'];
				$response['ansc'] = $row['ansc'];
				$response['ansd'] = $row['ansd'];
				$response['odp'] = $row['odp'];
				$response['category'] = $row['category'];
		}
	}
	echo json_encode($response);
}
?>