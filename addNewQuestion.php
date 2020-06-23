<?php 

session_start();
require_once "conf_db/config.php";
require_once 'func_msg/functions.php';

if(!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] !== true) {
		header("Location: index.php");
		exit;
} else {
	if($_POST['question'] != "" && $_POST['odp1'] != "" && $_POST['odp2'] && $_POST['odp3'] && $_POST['odp4'] && $_POST['corrOdp'] && $_POST['category'])
	{

		if($_POST['category'] == "No category") {
			$_POST['category'] = "";
		}

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
			$question = mysqli_real_escape_string($link,$_POST['question']);
			$odp1 = mysqli_real_escape_string($link,$_POST['odp1']);
			$odp2 = mysqli_real_escape_string($link,$_POST['odp2']);
			$odp3 = mysqli_real_escape_string($link,$_POST['odp3']);
			$odp4 = mysqli_real_escape_string($link,$_POST['odp4']);
			$category = mysqli_real_escape_string($link,$_POST['category']);
			
			$add_user_sql = "INSERT INTO questions (question, ansa, ansb, ansc, ansd, odp, category) VALUES ('$question', '$odp1', '$odp2', '$odp3', '$odp4', '$odp', '$category')";
			mysqli_query($link,$add_user_sql);
			echo '<div class="alert alert-success" role="alert">A new question has been added!</div>';
			msg_logs_users($_SESSION['login'], "A new question has been added!");
			//echo "Added question";
			unset($_POST);
		}
	else {
		echo '<div class="alert alert-danger" role="alert">There aren&#39t fill whole form!</div>'; 
	}
}
?>