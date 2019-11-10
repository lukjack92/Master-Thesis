<?php 

session_start();
require_once "conf_db/config.php";
require_once 'func_msg/functions.php';

if(!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] !== true) {
		header("Location: index.php");
		exit;
} else {
if($_POST['question'] != "" && $_POST['odp1'] != "" && $_POST['odp2'] && $_POST['odp3'] && $_POST['odp4'] && $_POST['corrOdp'])
{
	$array = array("Answer A" => 'ansa', "Answer B" => 'ansb', "Answer C" => 'ansc', "Answer D" => 'ansd');
	$odp;
	foreach ($array as $key => $value) {
		
		if($key == $_POST['corrOdp']){
			$odp = $value;
		}
	}
	//if($numResults > 0){
	//	echo '<div class="alert alert-danger" role="alert">No user <b>'.$login.'</b> added because it already exists!</div>'; 
	//	msg_logs_users($_SESSION['login'], "[Add user] No user '$login' added, because it already exists!");
	//} else {
		$cat="test";
		$add_user_sql = "INSERT INTO questions (question, ansa, ansb, ansc, ansd, odp, category) VALUES ('$_POST[question]', '$_POST[odp1]', '$_POST[odp2]', '$_POST[odp3]', '$_POST[odp4]', '$odp', '$cat')";
		mysqli_query($link,$add_user_sql);
	//	echo '<div class="alert alert-success" role="alert">The user <b>'.$login.'</b> added!</div>';
	//	msg_logs_users($_SESSION['login'], "[Add user] The user '$login' added!");
		echo "Added question";
		unset($_POST);
	}
 else {
	echo '<div class="alert alert-danger" role="alert">There aren&#39t fill whole form!</div>'; 
}
}
?>