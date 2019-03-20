<?php

	// Initialize the session
	session_start();
	
	
	/*
	//Session timeout
	$time = $_SERVER['REQUEST_TIME'];
	
	$timeout_duration = 200;
	if(isset($_SESSION['LAST_ACTIVITY']) && ($time - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
		session_unset();
		session_destroy();
		session_start();
		header("Location: index.php");
		exit;
	}
		
	// Check if the user is logged in, if not then redirect him to login page
	if(!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] !== true){
		header("Location: index.php");
		exit;
	}
	
	$_SESSION['LAST_ACTIVITY'] = $time;
	
	*/
	
	require_once "../conf_db/config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css" integrity="sha384-PDle/QlgIONtM1aqA2Qemk5gPOE7wFq8+Em+G/hmo5Iq0CCmYZLv3fVRDJ4MMwEA" crossorigin="anonymous">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
		<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Baloo+Thambi" rel="stylesheet">
    <!-- Custom styles for this template -->

</head>
<body>

      <nav class="navbar navbar-expand-lg bg-dark">
		<a class="navbar-brand" href="logout.php"> <i class="fas fa-home"></i> Logout</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<img src="img/hamb.png" height="15" width="20">
			</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<!--
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link" href="#">About<span class="sr-only">(current)</span></a>
				</li>
			</ul>
		-->
		</div>
	  </nav>

<div class="container color_white">
<div id="cl"></div>
  
	<div id="time"></div>
		<div id="confirmBox">
		<div class="message"></div>
		<button class="yes">Yes</button>
		<button class="no">No</button>
	</div>
	
	<label>
	<form>
		<div class="form-group ">
			<label>New user</label>
			<input type="email" class="form-control" id="inputEmail1" placeholder="Login" autofocus required>
		</div>
		<div class="form-group">
			<label>Password</label>
			<input type="password" class="form-control" id="inputPassword1" placeholder="Password" required>
		</div>
			<div class="form-group">
			<label>FirstName</label>
			<input type="password" class="form-control" id="inputFirstName" placeholder="FirstName" required>
		</div>
		<div class="form-group">
			<label>LastName</label>
			<input type="password" class="form-control" id="inputLastName" placeholder="LastName" required>
		</div>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="checkbox" id="checkBoxPer" value="user"></input>
			<label class="form-check-label" for="inlineCheckbox1" id="label1">user permission</label>
		</div>
			<button type="submit" class="btn btn-primary">Submit</button>
			<a href="welcome.php" class="btn btn-primary">Back</a>
	</form>
	</label>
</div>
	<nav class="navbar-fixed-bottom">
		<div class="footer text-center bg-dark">
			Copyright &copy; <?php echo date("o") ?> Designed by Łukasz Jackowski
		</div>
	</nav>
	
  <script src="http://code.jquery.com/jquery-3.3.1.js"></script>
  	<script type="text/javascript" src="countdown.js"></script>
	<script type="text/javascript" src="test.js"></script>
</body>
</html>