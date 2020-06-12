<?php 
//error_reporting(0);

session_start();
require_once "conf_db/config.php";
//require_once "func/functions.php";
require_once 'func_msg/functions.php';

if(!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] !== true){
		header("Location: index.php");
		exit;
} else {
	if($_POST["id"] != "" && $_POST['spanQuestion'] != "" && $_POST['spanOdp1'] != "" && $_POST['spanOdp2'] != "" && $_POST['spanOdp3'] != "" && $_POST['spanOdp4'] != "" && $_POST['spanCorrOdp'] != "" && ($_POST['chooseCategory'] != "" || $_POST['chooseCategory'] == "")) {
	
	//echo "Your ID: ".$_POST['id'];
	$array = array("Answer A" => 'ansa', "Answer B" => 'ansb', "Answer C" => 'ansc', "Answer D" => 'ansd');
	$odp;
	foreach ($array as $key => $value) {
		
		if($key == $_POST['spanCorrOdp']){
			$odp = $value;
			break;
		}
	}
	
	$query = "update questions set question = '$_POST[spanQuestion]', ansa = '$_POST[spanOdp1]', ansb = '$_POST[spanOdp2]', ansc = '$_POST[spanOdp3]', ansd = '$_POST[spanOdp4]', odp = '$odp', category = '$_POST[chooseCategory]' where id = '$_POST[id]'";
	@mysqli_query($link,$query);
	echo '<div class="alert alert-success" role="alert">The question has been updated!</div>';
	//msg_logs_users($_SESSION['login'], "[Update user] Updated login=".$_POST["login"]." firstName=".$_POST["firstName"]." lastName=".$_POST["lastName"]." permission=".$_POST["permission"].".");
	unset($_POST);
	
} else {
	echo '<div class="alert alert-danger" role="alert">Something went wrong! '. $_POST['id'].'</div>';
}
}
?>