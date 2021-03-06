<?php

	// Initialize the session
	session_start();
	
	// Check if the user is logged in, if not then redirect him to login page
	if(!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] !== true){
		header("Location: index.php");
		exit;
	}
?>

<!DOCTYPE HTML>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="api physisc">
    <meta name="author" content="Łukasz Jackowski">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Welcome</title>

    <!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css" integrity="sha384-PDle/QlgIONtM1aqA2Qemk5gPOE7wFq8+Em+G/hmo5Iq0CCmYZLv3fVRDJ4MMwEA" crossorigin="anonymous">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Baloo+Thambi" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="sticky-footer.css" rel="stylesheet">
	<link rel="stylesheet" href="style.css">
  </head>
  <body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<a class="navbar-brand" href="login.php"> <i class="fas fa-home"></i> Login</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarColor02">
				<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link" href="signUpToApp.php">SignUp to App <span class="sr-only">(current)</span></a>
				</li>	
				<li class="nav-item">
					<a class="nav-link" href="loginProfileApp.php">LogIn to App</a>
				</li>			
				<li class="nav-item">
					<a class="nav-link" href="app/app-debug.apk">Download .apk</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="info.php">About</a>
				</li>
				</ul>
			</div>
		</nav>
    <!-- Begin page content -->
<div class="container ">
	<main role="main" class=" center color-white">

		<p><b>Single line syntax in file</b></p>
		<p class="text-primary">Question;Answer_1;Answer_2;Answer_3;Answer_4;CorrectAnswer;CategoryOfQuestions;</p>
		<p>CorrectAnswer like this: <span class="text-primary">ansa, ansb, ansc, ansd </span></p>
		<p>Important is keep in mind to add a semicolon ; at the end each lines after CategoryOfQuestions;</p>
		<p><b>For example: </b><br/>
		W słynnym wzorze E=mc2 "c" oznacza;Masę jądra atomu;Stałą upływu czasu;Średnicę pola grawitacyjnego;Prędkość światła;ansd;PytanieTestowe;
		</p><br/>
		<p>Please remember do not add a new line after last question.</p>

	</main>
</div>
	<nav class="navbar-fixed-bottom">
		<div class="footer text-center bg-dark">
			Copyright &copy;  <?php echo date("o") ?> Designed by Łukasz Jackowski
		</div>
	</nav>
	<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>