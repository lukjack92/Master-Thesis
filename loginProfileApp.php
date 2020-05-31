<?php

	// Initialize the session
	session_start();
	
	// Checking if the user is already logged in, if yes then redirect him to welcome page
	if(isset($_SESSION['loggedInApp']) && $_SESSION['loggedInApp'] === true) {
		header("Location: profileApp.php");
		exit;
	}
	
	require_once "conf_db/config.php";
	require_once "func/functions.php";
	require_once 'func_msg/functions.php';
	 
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
		<h3>Login to Profile App</h3>
		<form>
			<label>Email</label>
			<div class="form-group has-feedback">
				<input class="form-control" type="text" id="email" autofocus required>
			</div>
			<label>Password</label>
			<div class="form-group has-feedback">
				<input class="form-control" type="password" id="password"  required>
			</div>
			
			<div class="form-group">
            <button class="btn btn-lg btn-primary btn-block" onclick="loginToApp()">Log in</button>
            
            </div>
        </form>
        <button class="btn btn-lg btn-primary btn-block" onclick="forgottenPassword()" >I've forgotten password</button>
		<!-- Feedback from api.php -->
        <div id="feedbackFromApi" role="alert"> 
		<?php 
			if(isset($_SESSION['removeUser'])) {
				echo $_SESSION['removeUser'];
				unset($_SESSION['removeUser']);
			}
		?>
		</div>
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
    <script src="https://code.jquery.com/jquery-3.4.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/js/bootstrap.min.js" integrity="sha384-7aThvCh9TypR7fIc2HV4O/nFMVCBwyIUKL8XCtKE+8xgCgl/PQGuFsvShjr74PBp" crossorigin="anonymous"></script>
	<script type="text/javascript" src="loginToApp.js"></script></body>
	<script type="text/javascript" src="forgottenPasswordProfile.js"></script>
</html>