<?php

	// Initialize the session
	session_start();
	
	// Check if the user is logged in, if not then redirect him to login page
	if(!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] !== true){
		header("Location: index.php");
		exit;
	}
	
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
	
	require_once "conf_db/config.php";
?>
<!DOCTYPE html>
<html lang="en">
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
  
  <?php if($_SESSION['permission'] == "admin"){ ?>
  
  <div class="alert alert-danger alert-dismissible fade show" id="danger" style="display:none" role="alert">
  <strong>Holy guacamole!</strong> You should check in on some of those fields below.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

  <div class="alert alert-success alert-dismissible fade show" id="success" style="display:none" role="alert">
  <strong>Holy guacamole!</strong>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
  
  <div class="pull-right">
	<button class="btn btn-success" data-toggle="modal" data-target="#add_new_record_modal">Add New User</button>
  </div></br>
  <?php } ?>

<!-- Bootstrap Modal - To Add New Record -->
<!-- Modal -->
<div class="modal fade" id="add_new_record_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" id="myModalLabel">Add New User</h4>
<div class="pull-left">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
</div>
</div>
<div class="modal-body">

<div class="form-group">
<div class="pull-left">
<label for="first_name">Login</label>
</div>
<input type="text" id="login" name="login"placeholder="Login" class="form-control" />
</div>

<div class="form-group">
<div class="pull-left">
<label for="first_name">First Name</label>
</div>
<input type="text" id="first_name" name="first_name"placeholder="First Name" class="form-control" />
</div>
 
<div class="form-group">
<div class="pull-left">
<label for="last_name">Last Name</label>
</div>
<input type="text" id="last_name" name="last_name"placeholder="Last Name" class="form-control" />
</div>

<div class="form-group">
<div class="pull-left">
<label for="permission">Password</label>
</div>
<input type="password" class="form-control" name="password" id="password" placeholder="Password" />
</div>
 
<div class="form-group">
<div class="pull-left">
<label for="permission">Permission</label>
</div>
      <select id="inputState" class="form-control">
      <option selected>User</option>
      <option>Admin</option>
      </select>
</div>
 
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
<button type="button" class="btn btn-primary" onclick="addUser()">Add User</button>
</div>
</div>
</div>
</div>
  
  
<div class="modal fade" id="updateUserModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" id="myModalLabel">Update User</h4>
<div class="pull-left">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
</div>
</div>
<div class="modal-body">

<div class="form-group">
<div class="pull-left">
<label for="first_name">Login</label>
</div>
<input type="text" id="update_login" name="login"placeholder="Login" class="form-control" />
</div>

<div class="form-group">
<div class="pull-left">
<label for="first_name">First Name</label>
</div>
<input type="text" id="update_first_name" name="first_name"placeholder="First Name" class="form-control" />
</div>
 
<div class="form-group">
<div class="pull-left">
<label for="last_name">Last Name</label>
</div>
<input type="text" id="update_last_name" name="last_name"placeholder="Last Name" class="form-control" />
</div>

<div class="form-group">
<div class="pull-left">
<label for="update_permission">Permission</label>
</div>
      <select id="updateInputState" class="form-control">
      <option selected>User</option>
      <option>Admin</option>
      </select>
</div>
 
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
<button type="button" class="btn btn-primary" onclick="updateUser()">Update User</button>
<input type="hidden" id="hidden_user_id">
</div>
</div>
</div>
</div>
    <div class="page-header">
		<p>
			<h1>List of users</h1>
			<h2> FirstName: <?php echo $_SESSION['firstName'] ?> </h2>
			<h2> LastName: <?php echo $_SESSION['lastName'] ?> </h2>
		</p>
	</div>
  
	<div id="time"></div>
<!--
	<div id="confirmBox">
		<div class="message"></div>
		<button class="yes">Yes</button>
		<button class="no">No</button>
	</div>
-->

<!-- Modal -->
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


	<a href="welcome.php" class="btn btn-primary testbutton2">Back page</a>

	<div id="record_content"></div>
	
</div>
	<nav class="navbar-fixed-bottom">
		<div class="footer text-center bg-dark">
			Copyright &copy; <?php echo date("o") ?> Designed by Łukasz Jackowski
		</div>
	</nav>
	<script src="https://code.jquery.com/jquery-3.4.0.min.js"></script>
	<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.4.0/js/bootstrap4-toggle.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<!--<script type="text/javascript"src="bootstrap-4.3/js/bootstrap.min.js"></script>
	<script type="text/javascript"src="http://code.jquery.com/jquery-3.3.1.js"></script>-->
  	<script type="text/javascript" src="countdown.js"></script>
	<script type="text/javascript" src="test.js"></script>
	
</body>
</html>