<?php

session_start();
require_once "conf_db/config.php";
require_once "func_msg/functions.php";
$i=0;
$ii=0;

if(!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] !== true){
        header("Location: login.php");
        exit;
} else {
        if($_FILES['fileToUpload']['name'] != "") {

            //$file = $_FILES['fileToUpload']['name'];
            $fileType = basename($_FILES["fileToUpload"]["name"]);
            $fileType = pathinfo($fileType,PATHINFO_EXTENSION);

            // Check format the file
            if($fileType != "txt" ) {
                $_SESSION['ok'] = "<div class='alert alert-danger' role='alert'><b>The file ". basename( $_FILES["fileToUpload"]["name"]). " do not has supported file format, its should be .txt</b></div>";
                msg_logs_users($_SESSION['login'],"The file ". basename( $_FILES["fileToUpload"]["name"]). " has not supported file format, it should be .txt");
                header("Location: welcome.php");
                exit;
            } 

            if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], "upload/".basename($_FILES["fileToUpload"]["name"]))) {
                
                //Operation on the file
                $file = fopen("upload/".basename( $_FILES["fileToUpload"]["name"]), "r");

                while(!feof($file)) {
                    $i++;
                    $ii++;
                    $content = fgets($file);
                    $carray = explode(";",$content);
                    if(count($carray) == 8) {
                        list($question,$ansa,$ansb,$ansc,$ansd,$odp,$category) = $carray;
                        $sql = "INSERT INTO `questions` (`question`, `ansa`, `ansb`, `ansc`, `ansd`, `odp`, `category`) VALUES ('$question', '$ansa', '$ansb', '$ansc', '$ansd', '$odp', '$category')";
                        @mysqli_query($link,$sql);
                    } else $ii--;
                }
                
                fclose($file);
                    
                //Adding category which has been added via upload the file 
                $query = "SELECT DISTINCT questions.category FROM questions LEFT JOIN category ON (questions.category = category.name) WHERE category.name IS NULL;";
            
                $result = @mysqli_query($link,$query);
                $json = Array();
                while($row = @mysqli_fetch_object($result)) {
                    $row_array['category'] = $row->category;
                    if($row_array['category'] != "")
                        array_push($json, $row_array);
                }
                
                if(!empty($json)) { 		
                    foreach($json as $value) {
                        $val = $value['category'];
                        echo $val." ";
                        $sql = "INSERT INTO `category` (`name`) VALUES ('$val')";
                        @mysqli_query($link,$sql);
                        echo "DODANO";
                    }
                }
            
                $_SESSION['ok'] = "<div class='alert alert-success' role='alert'><b>The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded. ".$ii." of ".$i."</b></div>";
                msg_logs_users($_SESSION['login'],"The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded ".$ii." of ".$i);
                header("Location: welcome.php");
            } else { $_SESSION['ok'] = "<div class='alert alert-danger' role='alert'><b>Sorry, there was error uploading your file.</b></div>";
                header("Location: welcome.php"); }

        } else { $_SESSION['ok'] = "<div class='alert alert-danger' role='alert'><b>There is no typed filename to upload.</b></div>";
                header("Location: welcome.php"); }
}
?>