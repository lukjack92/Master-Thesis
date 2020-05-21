<?php
    error_reporting(0);

	// Initialize the session
	session_start();
	
		// Check if the user is logged in, if not then redirect him to login page
	if(!isset($_SESSION["loggedInApp"]) || $_SESSION["loggedInApp"] !== true) {
		header("Location: loginProfileApp.php");
		exit;
    }

    require_once "conf_db/config.php";

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
	<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.4.0/css/bootstrap4-toggle.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Baloo+Thambi" rel="stylesheet">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Custom styles for this template -->

</head>
<body>

      <nav class="navbar navbar-expand-lg bg-dark">
		<a class="navbar-brand" href="logoutApp.php"> <i class="fas fa-home"></i> Logout</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				
			</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
	
			<ul class="navbar-nav mr-auto">
			<!--
				<li class="nav-item active">
					<a class="nav-link" href="#">About<span class="sr-only">(current)</span></a>
				</li>
			-->
			</ul>
	
		</div>
	  </nav>

<div class="container color_white">
    <div class="page-header">
        <h1>Manage settings</h1>
		<h5> Account for <?php echo $_SESSION['usersInfo']['email'] ?> </h5>
    </div>
    
    <!--Current time-->
    <?php echo date("Y-m-d H:i");?>
    
    <!--Session time displaying-->
	<div id="time"></div>

    <!-- Modal Expired-->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <button class="btn btn-primary yes">Yes</button>
                    <button class="btn btn-primary no">No</button>
                </div>
            </div>
        </div>

    </div>
        <div class="col-md-6 mx-auto form">
            <form method="post">
                <div class="form-group has-feedback">
                    <label class="pull-left"><b>Current Password</b></label>
                    <input type="password" id="current_password" placehol class="form-control" autofocus required> 
                </div>
                <div class="form-group has-feedback <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                    <label class="pull-left"><b>New Password</b></label>
                    <input type="password" id="new_password" class="form-control" required> 
                </div>
                <div class="form-group has-feedback">
                    <label class="pull-left"><b>Confirm Password</b></label>
                    <input type="password" id="re_enter_password" class="form-control" required>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary btn-block" value="Submit">
                    <a href="profileApp.php" class="btn btn-danger btn-block">Back</a>
                </div>
            </form>
        </div>
</div>

	<nav class="navbar-fixed-bottom">
		<div class="footer text-center bg-dark">
			Copyright &copy; <?php echo date("o"); ?> Designed by Łukasz Jackowski
			<h6 class="text-danger">This version is in development</h6>
			<?php if(isset($infoDATABASE) !== '') echo $infoDATABASE ?>
		</div>
	</nav>
	
	<script src="https://code.jquery.com/jquery-3.4.0.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/jquery-autosize@1.18.18/jquery.autosize.min.js"></script>
	<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.4.0/js/bootstrap4-toggle.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script type="text/javascript" src="countdown.js"></script>
    <!--<script type="text/javascript"src="bootstrap-4.3/js/bootstrap.min.js"></script>
	<script type="text/javascript"src="http://code.jquery.com/jquery-3.3.1.js"></script>-->  
</body>
</html>