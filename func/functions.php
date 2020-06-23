<?php

function updateAuthCounter_CheckTime($bool,$authCount,$link,$timestamp) {
	
	//Wating time to unlock account
	$blocked_seconds = 45;
	$current_time = time();
	
	//Password is false
	if($bool == false) {
		$_SESSION["loggedIn"] = false;
		
		if($authCount < 3) {
			$authCount = $authCount+1;
			$query = 'update users set authCounter = "'.$authCount.'" where login="'.$_POST['login'].'"';
			msg_logs_users($_POST['login'], "Password incorrect. AuthCounter increment ".$authCount.".");
			@mysqli_query($link, $query);
		} else {
			$authCount = $authCount+1;
			$_SESSION['errorCount'] = "<div class='alert alert_pass'>AuthCounter it's large than 3. The account has been blocked for some time.</div>";
			$query = 'update users set authCounter = "'.$authCount.'" where login="'.$_POST['login'].'"';
			msg_logs_users($_POST['login'], "Password incorrect. AuthCounter increment (".$authCount."). AuthCounter it's large than 3. The account has been blocked for some time.");
			@mysqli_query($link, $query);
		}
	} else { 
	
		$_SESSION['loggedIn'] = true;

		#The limit displaying the records in tables question and categories
		$_SESSION['limit'] = 10;
		$_SESSION['limit2'] = 10;
		$_SESSION['limit3'] = 10;

		if($authCount < 3) {
			$query = 'update users set authCounter = 0 where login="'.$_POST['login'].'"';
			@mysqli_query($link, $query);
			msg_logs_users($_SESSION['login'], "Successfully logged. AuthCounter is 0.");
		} else {
			$timestamp = strtotime($timestamp);
			//echo "</br>";
			//echo $timestamp;
			//echo "</br>";
			//echo date("Y-m-d H:i:s",$timestamp);
			//echo "</br>";
			$time_to_blocked = $timestamp+$blocked_seconds;
			//echo "Blocked: ".$time_to_blocked;
			//echo "</br>";
			//echo date("Y-m-d H:i:s",$time_to_blocked);
			//echo "</br>";
			//echo "Current: ".$current_time;
			//echo "</br>";
			if($current_time < $time_to_blocked) {
				$_SESSION['loggedIn'] = false;
				$_SESSION['errorCount'] = "<div class='alert alert_pass'>AuthCounter is large than 3. You must be wait, then you will be able to log in after: <b>".date("h:i:s",$time_to_blocked)."</b></div>"; 
				msg_logs_users($_SESSION['login'], "Password correct. AuthCounter increment (".$authCount."). AuthCounter is large than 3. You must be wait, then you will be able to log in after: ".date("h:i:s",$time_to_blocked)."");
				//$_SESSION['loggedIn'] = false;
		
			} else {
				$query = 'update users set authCounter = 0 where login="'.$_POST['login'].'"';
				@mysqli_query($link, $query);
				msg_logs_users($_SESSION['login'], "Successfully logged. AuthCounter is 0.");
			}
		}
	}
}

function addNewUser($login, $password, $firstName, $lastName, $permission, $link) {
	
	$login = htmlentities($login,ENT_QUOTES,"UTF-8");
	$login = mysqli_real_escape_string($link,$login);
	
	$password = htmlentities($password,ENT_QUOTES,"UTF-8");
	$password = password_hash($password, PASSWORD_DEFAULT);
	$password = mysqli_real_escape_string($link,$password);
	
	$firstName = htmlentities($firstName,ENT_QUOTES,"UTF-8");
	$firstName = mysqli_real_escape_string($link,$firstName);
	
	$lastName = htmlentities($lastName,ENT_QUOTES,"UTF-8");
	$lastName = mysqli_real_escape_string($link,$lastName);
	
	$permission = htmlentities($permission,ENT_QUOTES,"UTF-8");
	$permission = mysqli_real_escape_string($link,$permission);

	$sql = 'select * from users where login="'.$login.'"';
	$result = mysqli_query($link,$sql);
	$numResults = mysqli_num_rows($result);

	if($numResults > 0){
		$_SESSION['error'] = '<center class="alert alert-danger">The user is exists!</center>'; 
	} else {
		$add_user_sql = "INSERT INTO users (login, password, firstName, lastName, permission) VALUES ('$login', '$password', '$firstName', '$lastName', '$permission')";
		mysqli_query($link,$add_user_sql);
		$_SESSION['error'] = '<center class="alert alert-danger">A new user has been added</center>'; 
	}
}

?>


