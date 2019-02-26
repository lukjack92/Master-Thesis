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
	
	$password_err = $no_matched = $confirm_password_err = $success = "";
	
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		// Validate password and confirm_password
		if(empty($_POST["password"]))
			$password_err = "<span class='alert'>Please enter a password.</span>";
		elseif(strlen($_POST['password']) < 6) {
			$password_err = "<span class='alert'>Password must have least 6 characters.</span>";
		}
		if(empty($_POST["confirm_password"]))
			$confirm_password_err = "<span class='alert'>Please enter a confirm password.</span>";
		elseif($_POST["password"] === $_POST["confirm_password"])
		{
			//echo "Add to database";
			
			$new_pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
			$query = 'update users set password = "'.$new_pass.'" where login="'.$_SESSION["login"].'"';
			@mysqli_query($link, $query);
			
			$success = '<div class="alert alert-success" role="alert"><center>The password has been reset.</center></div>';
			
		} else { $no_matched = '<span class="alert"><div class= "alert alert-danger" role="alert"><center>The password is no matched.</center></div></span>';}
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
  <link rel="stylesheet" href="style.css">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Login Panel</title>
	    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
  <!-- Bootstrap -->

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

</head>
<body>
<div class="container color_white">
	<div class="page-header">
        <h1>Reset password for user: <b><?php echo htmlspecialchars($_SESSION["login"]); ?></b> </h1>
		<h2> FirstName: <?php echo htmlspecialchars($_SESSION['firstName']) ?> </h2>
		<h2> LastName: <?php echo $_SESSION['lastName'] ?> </h2>
    </div>
	
	<p>
		<a href="welcome.php" class="btn btn-primary">Back page</a>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>
	
	 <div class=" col-md-offset-4 col-md-4">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group has-feedback <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" autofocus required> 
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group has-feedback <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" required>
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
				<span class="help-block"><?php echo $no_matched; ?></span>
				<span class="help-block"><?php echo $success; ?></span>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>
        </form>
    </div>    
	
	<nav class=" navbar-default navbar-fixed-bottom">
		<div class=" footer text-center">
			Copyright &copy; <?php echo date("o"); ?> Designed by Łukasz Jackowski
		</div>
	</nav>
	  <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</div>
</body>
</html>