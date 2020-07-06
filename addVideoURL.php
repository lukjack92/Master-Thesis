<?php 

session_start();
require_once "conf_db/config.php";
require_once "func_msg/functions.php";

if(!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] !== true) {
		header("Location: index.php");
		exit;
} else {
	if($_POST['videoUrl'] != "") {
        $videoUrl = mysqli_real_escape_string($link,$_POST['videoUrl']);
        if (!filter_var($videoUrl, FILTER_VALIDATE_URL) === false) {
            $add_video_url = "INSERT INTO video (path, isActive) VALUES ('$videoUrl', 'true')";
            if(mysqli_query($link,$add_video_url)) {
                echo '<div class="alert alert-success" role="alert">URL has been added!</div>';
                msg_logs_users($_SESSION['login'], "URL has been added! path: ".$videoUrl);

            } else { echo '<div class="alert alert-danger" role="alert">Something went wrong!</div>';
                    msg_logs_users($_SESSION['login'], "Add URL Video. Something went wrong!");
            }
        } else {
            echo '<div class="alert alert-danger" role="alert">This is not URL</div>';
        }
			unset($_POST);
	} else {
		echo '<div class="alert alert-danger" role="alert">There is requite this the filed to add it!</div>'; 
	}
}
?>