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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="countdown.js"></script>
	<script type="text/javascript" src="test.js"></script>
	<link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Baloo+Thambi" rel="stylesheet">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
<div class="container color_white">
<div id="cl"></div>
    <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["login"]); ?></b>. Welcome to our site.</h1>
		<h2> FirstName: <?php echo htmlspecialchars($_SESSION['firstName']) ?> </h2>
		<h2> LastName: <?php echo $_SESSION['lastName'] ?> </h2>
    </div>
	<div id="time"></div>

	<div id="confirmBox">
		<div class="message"></div>
		<button class="yes">Yes</button>
		<button class="no">No</button>
	</div>

    <p>
        <a href="reset.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>
	
	<div id="time"></div>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>#</th>
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
		
				if(mysqli_num_rows($result) > 0) {
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
						<td> <button type="button" class="btn btn-primary">View</button> <button type="button" class="btn btn-primary">Remove</button></td>
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
</div>
	<nav class=" navbar-default">
		<div class=" footer text-center">
			Copyright &copy; <?php echo date("o"); ?> Designed by Łukasz Jackowski
		</div>
	</nav>


</body>
</html>