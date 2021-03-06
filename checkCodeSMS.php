<?php 

// Initialize the session
session_start();

//if(isset($_SESSION['usersInfo']['email'])) {
if(isset($_SESSION['resetPassword2FA']) && $_SESSION['resetPassword2FA'] == "reset") {
    echo '
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
                <a class="nav-link" href="signUpToApp.php">SignUp to App</a>
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
<div class="container">
<main role="main" class="center color-white">
  <h1><p class="lead">Code SMS</p></h1>
<form>
    <div class="form-group has-feedback">
        <h3><b><p>'.$_SESSION["usersInfo"]["email"].'</p></b><h3>
    </div>
    <label><b>Entry Code SMS which will get for a moment!</b></label>
    <div class="form-group has-feedback">
        <input class="form-control" type="text" id="codeSms"  required>
    </div>
    
    <div class="form-group">
    <button class="btn btn-lg btn-primary btn-block" onclick="checkCodeSmsApp()">Submit</button>
    
    </div>
</form>
<div id="feedbackFromApi" role="alert"> </div>
</main>
</div>
<nav class="navbar-fixed-bottom">
    <div class="footer text-center bg-dark">
        Copyright &copy; '. date("o") . ' Designed by Łukasz Jackowski
    </div>
</nav>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script> -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script type="text/javascript" src="./js/checkCodeSmsApp.js"></script></body>
</body>
</html>
    ';
} else {
    echo '
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
                <a class="nav-link" href="signUpToApp.php">SignUp to App</a>
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
<div class="container">
<main role="main" class="center color-white">
  <h1><p class="lead">Something went wrong</p></h1>
</main>
</div>
<nav class="navbar-fixed-bottom">
    <div class="footer text-center bg-dark">
        Copyright &copy; '. date("o") . ' Designed by Łukasz Jackowski
    </div>
</nav>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
    ';
}
?>