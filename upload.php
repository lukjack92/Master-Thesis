
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
                if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], "upload/upload.txt")) {

                //Operation on the file
                $file = fopen("upload/upload.txt", "r");
                while(!feof($file)) {
                        $content = fgets($file);
                        $carray = explode(";",$content);
                        list($question,$ansa,$ansb,$ansc,$ansd,$odp,$category) = $carray;
                        $sql = "INSERT INTO `questions` (`question`, `ansa`, `ansb`, `ansc`, `ansd`, `odp`, `category`) VALUES ('$question', '$ansa', '$ansb', '$ansc', '$ansd', '$odp', '$category')";
                        @mysqli_query($link,$sql);
                }
                fclose($file);
        $_SESSION['ok'] = "<div class='alert alert-success' role='alert'><b>The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.</b></div>";
        msg_logs_users($_SESSION['login'],"The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.");
        header("Location: welcome.php");
        } else {
        echo "Sorry, there was error uploading your file.";
    }
        } else { $_SESSION['ok'] = "<div class='alert alert-danger' role='alert'><b>There hasn't been typed file to upload.</b></div>";
        header("Location: welcome.php");}
}
?>
