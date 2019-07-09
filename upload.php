<?php

session_start();
require_once "conf_db/config.php";
require_once 'func_msg/functions.php';

if(!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] !== true){
	header("Location: login.php");
	exit;
} else {
	$file = $_FILES['fileToUpload']['name'];
	
	if($_FILES['fileToUpload']['name'] != "") {
		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], "upload/upload.txt")) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		
		//Operation on the file
		$file = fopen("upload/upload.txt", "r");
		
		while(!feof($file)) {
			$content = fgets($file);
			$carray = explode(";",$content);
			list($question,$ansa,$ansb,$ansc,$ansd,$odp) = $carray;
			$sql = "INSERT INTO `questions` (`question`, `ansa`, `ansb`, `ansc`, `ansd`, `odp`) VALUES ('$question', '$ansa', '$ansb', '$ansc', '$ansd', '$odp')";
			@mysqli_query($link,$sql);
		}
		fclose($file);
		
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
	} else { $_SESSION['ok'] = "Sorry, there was an error uploading your file."; 
	header("Location: welcome.php");}
}
?>