<?php 

require_once "conf_db/config.php";

if($_POST['login'] != "" && $_POST['first_name'] != "" && $_POST['last_name'] && $_POST['pass'] && $_POST['permission'])
{
	//$login = htmlentities($_POST['login'],ENT_QUOTES,"UTF-8");
	$login = mysqli_real_escape_string($link,$_POST['login']);
	
	//$password = htmlentities($_POST['pass'],ENT_QUOTES,"UTF-8");
	$password = password_hash($_POST['pass'], PASSWORD_DEFAULT);
	$password = mysqli_real_escape_string($link,$password);
	
	//$firstName = htmlentities($_POST['first_name'],ENT_QUOTES,"UTF-8");
	$firstName = mysqli_real_escape_string($link,$_POST['first_name']);
	
	//$lastName = htmlentities($_POST['last_name'],ENT_QUOTES,"UTF-8");
	$lastName = mysqli_real_escape_string($link,$_POST['last_name']);
	
	//$permission = htmlentities($_POST['permission'],ENT_QUOTES,"UTF-8");
	$permission = mysqli_real_escape_string($link,$_POST['permission']);

	$sql = 'select * from users where login="'.$login.'"';
	$result = mysqli_query($link,$sql);
	$numResults = mysqli_num_rows($result);

	if($numResults > 0){
		//echo "Nie dodano użytkownika, bo już istnieje"; 
		echo "User: " .$login. " ".$firstName." ".$lastName;
	} else {
		$add_user_sql = "INSERT INTO users (login, password, firstName, lastName, permission) VALUES ('$login', '$password', '$firstName', '$lastName', '$permission')";
		mysqli_query($link,$add_user_sql);
		echo "Dodano nowego użytkownika"; 
		unset($_POST);
	}
}else {
	echo "There aren't fill whole form!";
}
?> 