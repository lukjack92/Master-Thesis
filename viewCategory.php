<?php 

session_start();
require_once "conf_db/config.php";
require_once 'func_msg/functions.php';

//if($_SESSION["permission"] != "admin"){
if(!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] !== true){
		header("Location: index.php");
		exit;
} else {

	//$query = "SELECT DISTINCT category FROM questions";
	$query = "select name from category";
	//$query = "SELECT DISTINCT questions.category FROM questions LEFT JOIN category ON (questions.category = category.name) WHERE category.name IS NULL;";
	
	$result = @mysqli_query($link,$query);
	$json = Array();
	
	while($row = @mysqli_fetch_object($result))
	{
		$row_array['category'] = $row->name;
		array_push($json, $row_array);
	}

	//msg_logs_users($_SESSION['login'], "[delQuestion] The user has been removed question.");
	//unset($_POST);
	//$row_array['message'] = '<div class="alert alert-success" role="alert">Category</div>';
	//$row['message'] = "<div class='alert alert-danger' role='alert'><b>Category</b></div>";
	//$row_array['message'] = "<div><b>You didn't enter you password!</b></div>";
	
	array_push($json, $row);
	echo json_encode($json, JSON_UNESCAPED_UNICODE);
	//echo json_encode($json);
}
?> 