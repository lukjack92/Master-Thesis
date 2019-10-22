<?php

error_reporting(0);

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

  <div class="pull-right">
	<button class="btn btn-success" data-toggle="modal" data-target="#createViewModal">Create An Question</button>
  </div></br></br>

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
<!--
	<div id="confirmBox">
		<div class="message"></div>
		<button class="yes">Yes</button>
		<button class="no">No</button>
	</div>
-->

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

<!--Modal to remove question -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="delQuestionModal">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">Are you sure you want to delete this question?</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  </div>
      <div class="modal-body">
        <button type="button" class="btn btn-primary" id="modal-btn-yes">Yes</button>
        <button type="button" class="btn btn-primary" id="modal-btn-no">No</button>
      </div>
    </div>
  </div>
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
		<input type="submit" value="Upload File" name="submit">
</form>
	
	<button type="button" class="btn btn-primary" id="" onclick="buttonViewCategory()">Category</button>
	<button type="button" class="btn btn-primary" id="" onclick="buttonAllDatabases()">View All Database</button>
	
	<div id="time"></div>
	<div id="database_content"></div>

<!--Modal View -->
<div class="modal fade" id="updateViewModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" id="myModalLabel">Question Review</h4>
<div class="d-none" id="myID"></div>
<div class="pull-left">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
</div>
</div>
<div class="modal-body">

<div class="form-group">
<div class="row">
<div class="col-2">
<h5>Question</h5>
</div>
<div class="col-8">
<span id="spanQuestion"></span> 
</div>
<div class="col-2">
<button type="button" class="btn btn-primary" id="edit" onclick="buttonEdit('spanQuestion')">Edit</button>
</div>
</div>
</div>

<div class="form-group">
<div class="row">
<div class="col-2">
<h5>Answer 1</h5> 
</div>
<div class="col-8">
	<span id="spanOdp1"></span>
</div>
<div class="col-2">
<button type="button" class="btn btn-primary" id="edit" onclick="buttonEdit('spanOdp1')">Edit</button>
</div>
</div>
</div>

<div class="form-group">
<div class="row">
<div class="col-2">
<h5>Answer 2</h5>
</div>
<div class="col-8">
<span id="spanOdp2"></span>
</div>
<div class="col-2">
<button type="button" class="btn btn-primary" id="edit" onclick="buttonEdit('spanOdp2')">Edit</button>
</div>
</div>
</div>

<div class="form-group">
<div class="row">
<div class="col-2">
<h5>Answer 3</h5>	
</div>
<div class="col-8">
<span id="spanOdp3"></span>
</div>
<div class="col-2">
<button type="button" class="btn btn-primary" id="edit" onclick="buttonEdit('spanOdp3')">Edit</button>
</div>
</div>
</div>

<div class="form-group">
<div class="row">
<div class="col-2">
<h5>Answer 4</h5>	
</div>
<div class="col-8">
<span id="spanOdp4"></span>
</div>
<div class="col-2">
<button type="button" class="btn btn-primary" id="edit" onclick="buttonEdit('spanOdp4')">Edit</button>
</div>
</div>
</div>

<div class="form-group">
<div class="row">
<div class="col-2">
<h5>Correct answer</h5>
</div>
<div class="col-8">
<span id="spanCorrOdp"></span>
</div>
<div class="col-2">
<button type="button" class="btn btn-primary" id="edit"  onclick="buttonEdit('spanCorrOdp')">Edit</button>
</div>
</div>
</div>

<!--
<div class="form-group">
<div class="pull-left">
<label for="first_name">Question</label>
</div>
<input type="text" id="update_login" name="login"placeholder="Login" class="form-control" />
</div>

<div class="form-group">
<div class="pull-left">
<label for="first_name">Answer 1</label>
</div>
<input type="text" id="update_first_name" name="first_name"placeholder="First Name" class="form-control" />
</div>
 
<div class="form-group">
<div class="pull-left">
<label for="last_name">Answer 2</label>
</div>
<input type="text" id="update_last_name" name="last_name"placeholder="Last Name" class="form-control" />
</div>
*-->
 
</div>

<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal" >Cancel</button>
	<button type="button" class="btn btn-primary" id="buttonSaveUpdate">Save</button>
<!--<input type="hidden" id="hidden_user_id">-->
</div>
</div>
</div>
</div>


<!--Modal View Create An Question-->
<div class="modal fade" id="createViewModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" id="myModalLabel">Create An Question</h4>
<div class="d-none" id="myID"></div>
<div class="pull-left">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
</div>
</div>
<div class="modal-body">

<div class="form-group">
<div class="row">
<div class="col-2">
<h5>Question</h5>
</div>
<div class="col-8">
<span id=""></span> 
</div>
<div class="col-2">
<button type="button" class="btn btn-primary" id="edit" onclick="">Edit</button>
</div>
</div>
</div>

<div class="form-group">
<div class="row">
<div class="col-2">
<h5>Answer 1</h5> 
</div>
<div class="col-8">
	<span id=""></span>
</div>
<div class="col-2">
<button type="button" class="btn btn-primary" id="edit" onclick="">Edit</button>
</div>
</div>
</div>

<div class="form-group">
<div class="row">
<div class="col-2">
<h5>Answer 2</h5>
</div>
<div class="col-8">
<span id=""></span>
</div>
<div class="col-2">
<button type="button" class="btn btn-primary" id="" onclick="">Edit</button>
</div>
</div>
</div>

<div class="form-group">
<div class="row">
<div class="col-2">
<h5>Answer 3</h5>	
</div>
<div class="col-8">
<span id=""></span>
</div>
<div class="col-2">
<button type="button" class="btn btn-primary" id="" onclick="">Edit</button>
</div>
</div>
</div>

<div class="form-group">
<div class="row">
<div class="col-2">
<h5>Answer 4</h5>	
</div>
<div class="col-8">
<span id=""></span>
</div>
<div class="col-2">
<button type="button" class="btn btn-primary" id="" onclick="">Edit</button>
</div>
</div>
</div>

<div class="form-group">
<div class="row">
<div class="col-2">
<h5>Correct answer</h5>
</div>
<div class="col-8">
<span id=""></span>
</div>
<div class="col-2">
<button type="button" class="btn btn-primary" id=""  onclick="">Edit</button>
</div>
</div>
</div>

</div>
<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal" >Cancel</button>
	<button type="button" class="btn btn-primary" id="">Save</button>
</div>
</div>
</div>
</div>


<!--Modal View Update -->
<div class="modal fade" id="updateViewModalUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" id="myModalLabel">Update</h4>
<div class="pull-left">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
</div>
</div>
<div class="modal-body">
<div class="form-group">

<div class="form-group">
<div class="pull-left">
<label for="login">TEST EDIT</label>
</div>
<textarea class="form-control" id="textToEdit" ></textarea>
<!--
<input type="text" id="exampleFormControlTextarea1" name="login"placeholder="TEST" class="form-control" />-->
</div>
 
<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal" onclick="buttonCancel()">Cancel</button>
	<button type="button" id="buttonUpdate" class="btn btn-primary">Update</button>
<input type="hidden" id="hidden_user_id">
</div>
</div>
</div>
</div>
</div>
</div>

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
			Copyright &copy; <?php echo date("o"); ?> Designed by Łukasz Jackowski
			<h6 class="text-danger">This version is in development</h6>
		</div>
	</nav>
	
	<script src="https://code.jquery.com/jquery-3.4.0.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/jquery-autosize@1.18.18/jquery.autosize.min.js"></script>
	<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.4.0/js/bootstrap4-toggle.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<!--<script type="text/javascript"src="bootstrap-4.3/js/bootstrap.min.js"></script>
	<script type="text/javascript"src="http://code.jquery.com/jquery-3.3.1.js"></script>-->
  	<script type="text/javascript" src="countdown.js"></script>
	<script type="text/javascript" src="test.js"></script>

</body>
</html>