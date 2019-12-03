<?php

	// Initialize the session
	session_start();
	
	// Checking if the user is already logged in, if yes then redirect him to welcome page
	if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true) {
		header("Location: welcome.php");
		exit;
	}
	
	require_once "conf_db/config.php";
	require_once "func/functions.php";
	require_once 'func_msg/functions.php';
	
	$login_err = $password_err = $not_exist_err = "";
	 
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		
		// Validate login and password
		if(empty($_POST["login"]))
			$login_err = "<span class='alert'>Please enter a login.</span>";
		if(empty($_POST["password"]))
			$password_err = "<span class='alert'>Please enter a password.</span>";
		
		// Loading welcome.php page
		if(!empty($_POST["login"]) && !empty($_POST["password"])) {
			
			$login = htmlentities($_POST["login"],ENT_QUOTES,"UTF-8");
			$login = @mysqli_real_escape_string($link,$login);
			
			$sql = 'select * from users where login="'.$login.'"';
	
			$result = @mysqli_query($link,$sql);
	
			if(@mysqli_num_rows($result) > 0) {
				// Output data of each rows
				if($row = mysqli_fetch_assoc($result)) {				
					
					if($row['isActive'] == "true") {
						$_SESSION['firstName'] = htmlspecialchars($row['firstName']);
						$_SESSION['lastName'] = $row['lastName'];
									
						if(password_verify($_POST['password'], $row['password'])) { 
							//$_SESSION['loggedIn'] = true;
							$_SESSION['login'] = $_POST['login'];
							$_SESSION['permission'] = $row['permission'];
							
							updateAuthCounter_CheckTime(true,$row['authCounter'],$link,$row['update_time']);					
							
							if(!empty($_SESSION['errorCount'])) {
								$not_exist_err = $_SESSION['errorCount'];
								unset($_SESSION['errorCount']);
							}
							
							if($_SESSION['loggedIn'] === true) {
								//Loading page welcome.php
								header("Location: welcome.php");
								exit;
							}
							
						} else {
							//Incorrect password
							updateAuthCounter_CheckTime(false,$row['authCounter'],$link,$row['update_time']);
							
							if(!empty($_SESSION['errorCount'])) {
								$not_exist_err = $_SESSION['errorCount'];
								unset($_SESSION['errorCount']);
							} else {
								$not_exist_err = "<div class='alert alert_pass'>That password combination is not correct. Check and try again.</div>";
							}
						}
					} else {
						$not_exist_err = "<div class='alert alert_pass'>This username <b>" . $_POST['login'] . "</b> is inactive. Please conntact to administrator.</div>";
						msg_logs_users($_POST['login'], "Account is inactive.");
					}
				}
			} else {	
				$not_exist_err = "<div class='alert alert_pass'>This username <b>" . $_POST['login'] . "</b> combination is not correct. Check and try again.</div>";
				msg_logs_users($_POST['login'], "The user doesn't exists.");
			}
		}
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css" integrity="sha384-PDle/QlgIONtM1aqA2Qemk5gPOE7wFq8+Em+G/hmo5Iq0CCmYZLv3fVRDJ4MMwEA" crossorigin="anonymous">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Baloo+Thambi" rel="stylesheet">
	<link href="style.css" rel="stylesheet">
	<link rel="stylesheet" href="fontello/css/fontello.css">
    <title>API - Log in</title>
  </head>
<body>
    <nav class="navbar navbar-expand-lg bg-dark">
		<a class="navbar-brand" href="index.php"> <i class="fas fa-home"></i> Home Page</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<!-- <span class="navbar-toggler-icon"></span> -->
				<img src="img/hamb.png" height="15" width="20">
			</button>
			<!--
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link" href="#">About<span class="sr-only">(current)</span></a>
				</li>
			</ul>
		</div>
		-->
	</nav>

	<div class="bg-picture"> </div>
	
<div class="container">
	<div class="col-md-6 mx-auto bg-form">
		<h3>Login to API</h3>
		<form method="post">
			<label>Login</label>
			<div class="form-group has-feedback <?php echo (!empty($login_err)) ? 'has-error' : ''; ?>">
				<input class="form-control" type="text" name="login" autofocus required>
				<span class="help-block"> <?php echo $login_err; ?> </span>
			</div>
			<label>Password</label>
			<div class="form-group has-feedback <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
				<input class="form-control" type="password" name="password"  required>
				<span class="help-block"> <?php echo $password_err; ?> </span>
			</div>
			
			<div class="form-group">
				<button class="btn btn-lg btn-primary btn-block" type="submit">Log in</button>
			</div>
		</form>
		<span> <?php echo $not_exist_err; ?> </span>
	</div>

</div>
	<nav class="navbar-fixed-bottom ">
		<div class="footer text-center bg-dark">
			Copyright &copy; <?php echo date("o"); ?> Designed by Łukasz Jackowski
			<h6 class="text-danger">This version is in development</h6>
		</div>
	</nav>
	
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/js/bootstrap.min.js" integrity="sha384-7aThvCh9TypR7fIc2HV4O/nFMVCBwyIUKL8XCtKE+8xgCgl/PQGuFsvShjr74PBp" crossorigin="anonymous"></script>
</body>
</html>