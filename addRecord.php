<?php 

require_once "conf_db/config.php";

if($_POST['login'] != "" && $_POST['first_name'] != "" && $_POST['last_name'] && $_POST['pass'] && $_POST['permission'])
{
	$login = htmlentities($_POST['login'],ENT_QUOTES,"UTF-8");
	$login = mysqli_real_escape_string($link,$login);
	
	$password = htmlentities($_POST['pass'],ENT_QUOTES,"UTF-8");
	$password = password_hash($password, PASSWORD_DEFAULT);
	$password = mysqli_real_escape_string($link,$password);
	
	$firstName = htmlentities($_POST['first_name'],ENT_QUOTES,"UTF-8");
	$firstName = mysqli_real_escape_string($link,$firstName);
	
	$lastName = htmlentities($_POST['last_name'],ENT_QUOTES,"UTF-8");
	$lastName = mysqli_real_escape_string($link,$lastName);
	
	$permission = htmlentities($_POST['permission'],ENT_QUOTES,"UTF-8");
	$permission = mysqli_real_escape_string($link,$permission);

	$sql = 'select * from users where login="'.$login.'"';
	$result = mysqli_query($link,$sql);
	$numResults = mysqli_num_rows($result);

	if($numResults > 0){
		echo "Nie dodano użytkownika, bo już istnieje"; 
	} else {
		$add_user_sql = "INSERT INTO users (login, password, firstName, lastName, permission) VALUES ('$login', '$password', '$firstName', '$lastName', '$permission')";
		mysqli_query($link,$add_user_sql);
		echo "Dodano nowego użytkownika"; 
		unset($_POST);
	}
	

	 // $login = $_POST['login'];
	 // $name = $_POST['first_name'];
	 // $last_name = $_POST['last_name'];
	 // $pass = $_POST['pass'];
	 // $permission = $_POST['permission'];
	
	// $add_user_sql = "INSERT INTO users (login, password, firstName, lastName, permission) VALUES ('$login', 'dupe', '$name', 'czesc', 'user')";
	// mysqli_query($link,$add_user_sql);
	// echo "Add a new user!";
	// unset($_POST);
// }else {
	// echo "There aren't fill whole form!";
}else {
	echo "There aren't fill whole form!";
}
?> 