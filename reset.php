<?php

	// Initialize the session
	session_start();
	
	// Check if the user is logged in, if not then redirect him to login page
	if(!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] !== true){
		header("Location: index.php");
		exit;
	}
	
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
	
	require_once "../conf_db/config.php";
	
	$password_err = $no_matched = $confirm_password_err = $success = $old_password_err = "";

	if($_SERVER["REQUEST_METHOD"] == "POST") {
		
		// Validate password and confirm_password
		if(empty($_POST["old_password"])) {
			$password_err = "<span class='alert'>Please enter a old password.</span>";
		} else {

			$sql = 'select * from users where login="'.$_SESSION["login"].'"';
			$result = mysqli_query($link,$sql);
			
			if(mysqli_num_rows($result) > 0) {
				// Output data of each rows
				while($row = mysqli_fetch_assoc($result)) {
					if(password_verify($_POST['old_password'], $row['password'])) { 
						if(empty($_POST["password"])) {
							$password_err = "<center class='alert_pass'>Please enter a password.</center>";
						}elseif(strlen($_POST['password']) < 6) {
							$password_err = "<center class='alert_pass'>Password must have least 6 characters.</center>";
						}elseif(empty($_POST["confirm_password"])) {
							$confirm_password_err = "<ceter class='alert_pass'>Please enter a confirm password.</center>";
						}elseif($_POST["password"] === $_POST["confirm_password"]) {
							//echo "Add to database";
							$new_pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
							$query = 'update users set password = "'.$new_pass.'" where login="'.$_SESSION["login"].'"';
							@mysqli_query($link, $query);
							
							$success = '<center class="alert alert-success">The password has been reset.</center>';
							
						} else { 
							$success = '<center class="alert alert-danger">The password is no matched.</center>';
						}	
					} else {
						$success = '<center class="alert alert-danger">Your old password isn&#39t correct!</center>';
					}
				}
			}
		}
	}
	
	$_SESSION['LAST_ACTIVITY'] = $time;
?>

<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="Shortcut icon" href="icon/icon.ico"/>
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Login Panel</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css" integrity="sha384-PDle/QlgIONtM1aqA2Qemk5gPOE7wFq8+Em+G/hmo5Iq0CCmYZLv3fVRDJ4MMwEA" crossorigin="anonymous">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
		<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Baloo+Thambi" rel="stylesheet">
  <!-- Bootstrap -->

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

</head>
<body>

      <nav class="navbar navbar-expand-lg bg-dark">
		<a class="navbar-brand" href="api.php"> <i class="fas fa-home"></i> Welcome</a>
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
	<div class="page-header">
        <h1>Reset password for user: <b><?php echo htmlspecialchars($_SESSION["login"]); ?></b> </h1>
		<h2> FirstName: <?php echo htmlspecialchars($_SESSION['firstName']) ?> </h2>
		<h2> LastName: <?php echo $_SESSION['lastName'] ?> </h2>
    </div>
	
	<p>
		<a href="welcome.php" class="btn btn-primary">Back page</a>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>
	
	 <div class="col-md-6 mx-auto bg-form-reset">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
			<div class="form-group has-feedback <?php echo (!empty($old_password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="old_password" placehol class="form-control" autofocus required> 
                <span class="help-block"><?php echo $old_password_err; ?></span>
            </div>
			<div class="form-group has-feedback <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>New Password</label>
                <input type="password" name="password" class="form-control" required> 
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group has-feedback <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" required>
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
				<span class="help-block"><?php echo $success; ?></span>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>
        </form>
    </div>    
	
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