<?php

	// Initialize the session
	session_start();
	
		// Check if the user is logged in, if not then redirect him to login page
	if($_SESSION["permission"] != "admin"){
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

	$_SESSION['LAST_ACTIVITY'] = $time;
	
	*/
	
	require_once "conf_db/config.php";
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
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
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

    <div class="page-header">
        <h1>Reset password of user</h1>
		<h2> FirstName: <?php echo $_SESSION['firstName'] ?> </h2>
		<h2> LastName: <?php echo $_SESSION['lastName'] ?> </h2>
    </div>
	
	<?php echo date("Y-m-d H:i:s");?>
	
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
	
	<table class="table table table-bordered table-striped table-hover">
		<thead>
			<tr>
				<th scope="col" style="width: 5%">No.</th>
				<th scope="col" style="width: 16%">User</th>
				<th scope="col" style="width: 20%">FirstName</th>
				<th scope="col" style="width: 15%">LastName</th>
				<th scope="col" style="width: 15%">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php 
				
				$sql = 'select * from users';
				$result = @mysqli_query($link, $sql);
				$id = 0;

				if(@mysqli_num_rows($result) > 0) {
					// Output data of each rows
				while($row = mysqli_fetch_assoc($result)) {
					
					if($row['login'] != $_SESSION['login']){
						++$id;
						if($row['isActive'] == "false") {
						?> <tr style="color:red;"><th scope="row"><?php echo $id; ?></th><td><?php echo $row['login']; ?></td><td><?php echo $row['firstName']; ?></td><td><?php echo $row['lastName']; ?></td><td><button type="button" disabled onclick="actionReset('<?php echo $row['login'] ?>')" class="btn btn-primary">The reset password for that <?php echo $row['login'] ?></button></td></tr>
						<?php	
						} else { ?> <tr><th scope="row"><?php echo $id; ?></th><td><?php echo $row['login']; ?></td><td><?php echo $row['firstName']; ?></td><td><?php echo $row['lastName']; ?></td><td><button type="button" onclick="actionReset('<?php echo $row['login'] ?>')" class="btn btn-primary">The reset password for that <?php echo $row['login'] ?></button></td></tr>
				<?php }
					}
				}		 
				}else { echo "Database is down!"; }
			?>
		</tbody>
	</table>
	<input type="hidden" id="reset_user">
<!-- Modal authentication_the_operation-->
<div class="modal fade" id="authentication_the_operation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" id="myModalLabel">The operation authentication the reset</h4>
<div class="pull-left">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
</div>
</div>
<div class="modal-body">

<div class="form-group">
<div class="pull-left">
<label for="permission">Your password</label>
</div>
<input type="password" class="form-control" name="password" id="password" placeholder="Password" />
</div>
 
</div>
<div class="modal-footer">
<button type="button" class="btn btn-primary btn-block" onclick="confirmPassword('<?php echo $_SESSION['login']; ?>')">Confirm</button>
</div>
</div>
</div>
</div>

<!-- Modal authentication_the_operation-->
<div class="modal fade" id="set_password" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" id="myModalLabelUser"></h4>
<div class="pull-left">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
</div>
</div>
<div class="modal-body">

<div class="form-group">
<div class="pull-left">
<label for="permission">New password</label>
</div>
<input type="password" class="form-control" name="password" id="setPassword" placeholder="Password" />
</div>
 
</div>
<div class="modal-footer">
<button type="button" class="btn btn-primary btn-block" onclick="resetPassUser()">Confirm</button>
</div>
</div>
</div>
</div>

</div>
	<nav class="navbar-fixed-bottom">
		<div class="footer text-center bg-dark">
			Copyright &copy; <?php echo date("o"); ?> Designed by Łukasz Jackowski
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
