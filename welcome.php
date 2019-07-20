<?php

	// Initialize the session
	session_start();
	
		// Check if the user is logged in, if not then redirect him to login page
	if(!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] !== true){
		header("Location: login.php");
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
<html lang="pl">
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

	<div id="ok">
	<?php 
		if(isset($_SESSION['ok']) != "") {
			echo $_SESSION['ok'];
			unset($_SESSION['ok']);
		} 
	?>
	</div>

    <div class="page-header">
        <h1>Hi, <b><?php echo $_SESSION["login"]; ?></b>. Welcome to our site.</h1>
		<h2> FirstName: <?php echo $_SESSION['firstName'] ?> </h2>
		<h2> LastName: <?php echo $_SESSION['lastName'] ?> </h2>
    </div>
	
	<?php echo date("Y-m-d H:i:s");?>
	
	<div id="time"></div>

	<div id="confirmBox">
		<div class="message"></div>
		<button class="yes">Yes</button>
		<button class="no">No</button>
	</div>

    <p>
        <a href="reset.php" class="btn btn-warning">Reset Your Password</a>
		<?php 
			if($_SESSION['permission'] == "admin") echo '<a href="reset_user.php" class="btn btn-primary">The Reset Password For User</a>';
		?>
		<a href="user_list.php" class="btn btn-primary">List Of Users</a>
		<a href="logout.php" class="btn btn-danger">Sign Out Of Your Account</a>
    </p>

<form action="upload.php" method="post" enctype="multipart/form-data">
    Choose a file:
		<input type="file" name="fileToUpload" id="fileToUpload">
		<input type="submit" value="Upload Image" name="submit">
</form>
	
	<div id="time"></div>
	
	<table class="table table-bordered table-striped table-responsive table-hover">
		<thead>
			<tr>
				<th scope="col" style="width: 5%">No.</th>
				<th scope="col" style="width: 50%">Questions</th>
				<th scope="col" style="width: 5%">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php 
				$sql = 'select * from questions';
				$result = @mysqli_query($link, $sql);
				$id = 0;
				if(@mysqli_num_rows($result) > 0) {
					// Output data of each rows
					while($row = mysqli_fetch_assoc($result)) {
			?>
					<tr>
						<th scope="row"><?php echo ++$id ?></th>
						<td ><?php echo $row['question'] ?></td>
						<td>
							<button type="button" class="btn btn-primary testbutton2">View</button> <button type="button" class="btn btn-primary testbutton2" onclick="delQuestion(<?php echo $row['id'] ?>)">Remove</button>
						</td>
					</tr>
			<?php	
					}
				} else {		
					echo "No data.";
				}
			?>
		</tbody>
	</table> 

<!--
<table class="table table-bordered table-striped">
		<thead>
			<tr>
				<th>No.</th>
				<th>Question</th>
				<th>Answer A</th>
				<th>Answer B</th>
				<th>Answer C</th>
				<th>Answer D</th>
				<th>Correct answer</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php 
				$sql = 'select * from questions';
				$result = @mysqli_query($link, $sql);
				$id = 0;

				if(@mysqli_num_rows($result) > 0) {
					// Output data of each rows
					while($row = mysqli_fetch_assoc($result)) {
			?>
					<tr>
						<td><?php echo ++$id ?></td>
						<td><?php echo $row['question'] ?></td>
						<td><?php echo $row['ansa'] ?></td>
						<td><?php echo $row['ansb'] ?></td>
						<td><?php echo $row['ansc'] ?></td>
						<td><?php echo $row['ansd'] ?></td>
						<td><?php echo $row['odp'] ?></td>
						<td>
							<button type="button" class="btn btn-primary testbutton2">View</button> <button type="button" class="btn btn-primary testbutton2">Remove</button>
						</td>
					</tr>
			<?php	
					}
				} else {		
					echo "No data.";
				}
			?>
		</tbody>
	</table> 




	<table class="table table-bordered table-striped">
		<thead>
			<tr>
				<th>No.</th>
				<th>FirstName</th>
				<th>LastName</th>
				<th>Company</th>
				<th>Address</th>
				<th>City</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php 
				$sql = 'select * from us_users';
				$result = @mysqli_query($link, $sql);
				$id = 0;

				if(@mysqli_num_rows($result) > 0) {
					// Output data of each rows
					while($row = mysqli_fetch_assoc($result)) {
			?>
					<tr>
						<td><?php echo ++$id ?></td>
						<td><?php echo $row['first_name'] ?></td>
						<td><?php echo $row['last_name'] ?></td>
						<td><?php echo $row['company_name'] ?></td>
						<td><?php echo $row['address'] ?></td>
						<td><?php echo $row['city'] ?></td>
						<td>
							<button type="button" class="btn btn-primary testbutton2">View</button> <button type="button" class="btn btn-primary testbutton2">Remove</button>
						</td>
					</tr>
			<?php	
					}
				} else {		
					echo "No data.";
				}
			?>
		</tbody>
	</table> 
	
	<nav aria-label="Page navigation">
  <ul class="pagination">
    <li>
      <a href="#" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    <li><a href="#">1</a></li>
    <li><a href="#">2</a></li>
    <li><a href="#">3</a></li>
    <li><a href="#">4</a></li>
    <li><a href="#">5</a></li>
    <li>
      <a href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>
-->

</div>
	<nav class="navbar-fixed-bottom">
		<div class="footer text-center bg-dark">
			Copyright &copy; <?php echo date("o") ?> Designed by Łukasz Jackowski
		</div>
	</nav>
	
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  	<script type="text/javascript" src="countdown.js"></script>
	<script type="text/javascript" src="test.js"></script>
</body>
</html>
