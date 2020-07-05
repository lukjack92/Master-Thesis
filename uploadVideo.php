<?php

error_reporting(E_ERROR | E_PARSE);
error_reporting(0);

function parse_size($size) {
    $unit = preg_replace('/[^bkmgtpezy]/i', '', $size); // Remove the non-unit characters from the size.
    $size = preg_replace('/[^0-9\.]/', '', $size); // Remove the non-numeric characters from the size.
    if ($unit) {
      // Find the position of the unit in the ordered string which is the power of magnitude to multiply a kilobyte by.
      return round($size * pow(1024, stripos('bkmgtpezy', $unit[0])));
    }
    else {
      return round($size);
    }
}

session_start();
require_once "conf_db/config.php";
require_once "func_msg/functions.php";

if(!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] !== true){
        header("Location: login.php");
        exit;
} else {
    // Checking to not exceed of limits POST Content-Length
    if ($_SERVER['CONTENT_LENGTH'] < parse_size(ini_get('post_max_size'))) {
        
            //$check = $_FILES["videoToUpload"]["name"];
            //$fileType = pathinfo($check,PATHINFO_EXTENSION);
            //echo $fileType;
            //echo $check;
            //echo "video/".$_FILES["videoToUpload"]["name"];
            //echo "video/".basename($_FILES["videoToUpload"]["name"]);

        if($_FILES['videoToUpload']['name'] != "") {

            //$file = $_FILES['videoToUpload']['name'];
            $fileType = basename($_FILES["videoToUpload"]["name"]);
            $fileType = pathinfo($fileType,PATHINFO_EXTENSION);
    
            // Check format the file
            if($fileType != "mp4" && $fileType != "avi" && $fileType != "mov" && $fileType != "3gp" && $fileType != "mpeg" && $fileType != "flv") {
                $_SESSION['ok'] = "<div class='alert alert-danger' role='alert'><b>The file ". basename( $_FILES["videoToUpload"]["name"]). " do not has supported file format. ".$fileType."</b></div>";
                msg_logs_users($_SESSION['login'],"The file ". basename( $_FILES["videoToUpload"]["name"]). " do not has supported file format. ".$fileType);
                header("Location: welcome.php");
                exit;
            }
             
            if(move_uploaded_file($_FILES["videoToUpload"]["tmp_name"], "video/".basename($_FILES["videoToUpload"]["name"]))) {

                //Add file
                echo "Add file";
                // Add path to DB
                exit;
            
                $_SESSION['ok'] = "<div class='alert alert-success' role='alert'><b>The file ". basename( $_FILES["videoToUpload"]["name"]). " has been uploaded.</b></div>";
                msg_logs_users($_SESSION['login'],"The file ". basename( $_FILES["videoToUpload"]["name"]). " has been uploaded.");
                header("Location: welcome.php");
            } else { $_SESSION['ok'] = "<div class='alert alert-danger' role='alert'><b>Sorry, there was error uploading your file.</b></div>";
                header("Location: welcome.php"); }

        } else { $_SESSION['ok'] = "<div class='alert alert-danger' role='alert'><b>There is no typed filename to upload.</b></div>";
                header("Location: welcome.php"); }

    } else {
        $_SESSION['ok'] = "<div class='alert alert-danger' role='alert'><b>The file exceeded the limit of ".parse_size(ini_get('post_max_size'))." bytes for POST Content-Length</b></div>";
        header("Location: welcome.php"); }
}
?>