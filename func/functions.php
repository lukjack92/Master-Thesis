<?php
/*
function updateAuthCounter($number, $counter, $link, $time) {

	$blocked_seconds = 45;
	$current_time = time();

	if($counter <= 2) {
		
		if($number == 0) {	
		
			$time = strtotime($time);
			$time_to_blocked = $time+$blocked_seconds;
			
			$time_info = date("Y-m-d H:i:s",$time_to_blocked);
			
			if($current_time < $time_to_blocked) {
				$_SESSION['errorCount'] = "<div class='alert alert_pass'>AuthCounter is equal 3. You have exceeded the numbers of login attempts and must be wait 5 minutes. Odblokuje się o ".$time_info."</div>"; 
			} else {
				$query = 'update users set authCounter = 0 where login="'.$_POST['login'].'"';
				@mysqli_query($link, $query);
			}
			
			$query = 'update users set authCounter = "'.$number.'" where login="'.$_POST['login'].'"';
			@mysqli_query($link, $query);							
		}
	
		if($number == 1) {
			$number = $counter+1;
			$query = 'update users set authCounter = "'.$number.'" where login="'.$_POST['login'].'"';
			@mysqli_query($link, $query);						
		}
	} else {
		
		
		$time = strtotime($time);
		echo "</br>";
		echo $time;
		echo "</br>";
		echo date("Y-m-d H:i:s",$time);
		echo "</br>";
		$time_to_blocked = $time+$blocked_seconds;
		echo "Blocked: ".$time_to_blocked;
		echo "</br>";
		echo date("Y-m-d H:i:s",$time_to_blocked);
		echo "</br>";
		
		echo "Current: ".$current_time;
		echo "</br>";
		if($current_time < $time_to_blocked) {
			$_SESSION['errorCount'] = "<div class='alert alert_pass'>AuthCounter is equal 3. You have exceeded the numbers of login attempts and must be wait 5 minutes.</div>"; 
		} else {
			$query = 'update users set authCounter = 0 where login="'.$_POST['login'].'"';
			@mysqli_query($link, $query);
		}
	}
}
*/

function updateAuthCounter_CheckTime($bool,$authCount,$link,$timestamp) {
	
	$blocked_seconds = 45;
	$current_time = time();
	
	//Password is false
	if($bool == false) {
		$_SESSION["loggedIn"] = false;
		
		if($authCount < 3) {
			$authCount = $authCount+1;
			$query = 'update users set authCounter = "'.$authCount.'" where login="'.$_POST['login'].'"';
			@mysqli_query($link, $query);
		} else {
			$authCount = $authCount+1;
			$_SESSION['errorCount'] = "<div class='alert alert_pass'>AuthCounter is larger than 3. You can't login. Password is not correct.</div>";
			$query = 'update users set authCounter = "'.$authCount.'" where login="'.$_POST['login'].'"';
			@mysqli_query($link, $query);
		}
	} else { 
	
		$_SESSION['loggedIn'] = true;
	
		if($authCount < 3) {
			$query = 'update users set authCounter = 0 where login="'.$_POST['login'].'"';
			@mysqli_query($link, $query);
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
				$_SESSION['errorCount'] = "<div class='alert alert_pass'>AuthCounter is large than 3. You must be wait 5 minut, then you will be able to log in after: <b>".date("H:i:s",$time_to_blocked)."</b></div>"; 
				//$_SESSION['loggedIn'] = false;
		
			} else {
				$query = 'update users set authCounter = 0 where login="'.$_POST['login'].'"';
				@mysqli_query($link, $query);
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
		$_SESSION['error'] = '<center class="alert alert-danger">Nie dodano użytkownika, bo już istnieje</center>'; 
	} else {
		$add_user_sql = "INSERT INTO users (login, password, firstName, lastName, permission) VALUES ('$login', '$password', '$firstName', '$lastName', '$permission')";
		mysqli_query($link,$add_user_sql);
		$_SESSION['error'] = '<center class="alert alert-danger">Dodano nowego użytkownika</center>'; 
	}
}
?>


