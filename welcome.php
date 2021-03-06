<?php

error_reporting(0);

	// Initialize the session
	session_start();
	
		// Check if the user is logged in, if not then redirect him to login page
	if(!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] !== true) {
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

	$loadScripts = 'loadReadDatabase.js';

	if(isset($_POST['submit'])){
		$selected_val = $_POST['inputState'];  // Storing Selected Value In Variable
		//echo "You have selected :" .$selected_val;  // Displaying Selected Value
	}

	if(isset($_POST['inputState'])) {
		$_SESSION['limit'] = $_POST['inputState'];
		$loadScripts = 'loadReadDatabase.js';
	}

	if(isset($_POST['inputStateCategory'])) {
		$_SESSION['limit2'] = $_POST['inputStateCategory'];
		$loadScripts = 'loadReadCategory.js';
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
		<a class="navbar-brand" href="logoutAdmin.php"> <i class="fas fa-home"></i> Logout</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<img src="img/hamb.png" height="15" width="20">
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
<div id="cl"><?php 
		if(isset($_SESSION['ok']) != "") {
			echo $_SESSION['ok'];
			unset($_SESSION['ok']);
		} 
	?></div>

  <div class="pull-right">
  <button class="btn btn-success testbutton2" data-toggle="modal" data-target="#addVideoViaURL">Add Video via URL</button>
	<button class="btn btn-success testbutton2" data-toggle="modal" data-target="#createViewModal1">Create A Question</button>
	<button class="btn btn-success testbutton2" data-toggle="modal" data-target="#createViewModalNewCategory">Create A Category</button>
  </div><br/><br/>

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
	
	<?php echo date("Y-m-d H:i");?>
	
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


<!--Modal Add Video via URL -->
<div class="modal fade" id="addVideoViaURL" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" id="myModalLabel">Add video via URL</h4>
<div class="pull-left">
	<button type="button" class="close" id="close" onclick="" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
</div>
</div>
<div class="modal-body">

<div class="form-group">
<div class="pull-left">
<label><b>Type or past URL do movie</b></label>
</div>
<input type="text" id="videoUrl" name="videoUrl" placeholder="Add URL" class="form-control" />
</div>
</div>
<div class="modal-footer">
	<!-- <button type="button" class="btn btn-default" data-dismiss="modal" >Cancel</button>-->
	<button type="button" class="btn btn-primary btn-next" id="" onclick="addVideoUrl()">Save</button>
</div>
</div>
</div>
</div>

<!--Modal Create a new category -->
<div class="modal fade" id="createViewModalNewCategory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" id="myModalLabel">Create A Category</h4>
<div class="pull-left">
	<button type="button" class="close" id="close" onclick="" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
</div>
</div>
<div class="modal-body">

<div class="form-group">
<div class="pull-left">
<label><b>Type a new category in order to add</b></label>
</div>
<input type="text" id="category" name="category" placeholder="A new category" class="form-control" />
</div>
</div>
<div class="modal-footer">
	<!-- <button type="button" class="btn btn-default" data-dismiss="modal" >Cancel</button>-->
	<button type="button" class="btn btn-primary btn-next" id="" onclick="saveNewCategory()">Save</button>
</div>
</div>
</div>
</div>

<!--Modal to remove question -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="delQuestionModal">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">Are you sure you want to delete that?</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  </div>
      <div class="modal-body">
        <button type="button" class="btn btn-primary" id="modal-btn-yes">Yes</button>
        <button type="button" class="btn btn-primary" id="modal-btn-no">No</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal to information what the file uploading should to be -->
<div class="modal fade" id="informationToUploadFile" tabindex="-1" role="dialog" aria-labelledby="informationToUploadFile" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<p>If you want to upload a file of the questions, it's should be in the right form. The semicolon is as separator.</p>
		<p>Look at <a href="infoUpload.php">here</a></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- END -->

    <p>
        <a href="reset.php" class="btn btn-warning testbutton2">Reset Your Password</a>
		<?php 
			if($_SESSION['permission'] == "admin") echo '<a href="reset_user.php" class="btn btn-primary testbutton2">Reset Password For User System</a>';
		?>
		<a href="user_list.php" class="btn btn-primary testbutton2">List of Users System</a>
		<a href="listUsersOfApp.php" class="btn btn-primary testbutton2">List of Users App</a>
		<a href="logoutAdmin.php" class="btn btn-danger testbutton2">Sign Out Of Your Account</a>
    </p>
<div class="bg-form-upload border rounded">
	<label><b>UPLOAD THE QUESTIONS FROM THE FILE TO DATABASE (SEE <a href="" data-toggle="modal" data-target="#informationToUploadFile">HERE</a>)</b></label>
	<form action="upload.php" method="post" enctype="multipart/form-data">
			<input type="file" name="fileToUpload" id="fileToUpload">
			<input type="submit" value="Upload File" name="submit">
	</form>
<!-- <hr>
	<label><b>UPLOAD THE VIDEO TO SERVER</b></label>
	<form action="uploadVideo.php" method="post" enctype="multipart/form-data">
			<input type="file" name="videoToUpload" id="videoToUpload">
			<input type="submit" value="Upload Video" name="submit">
	</form> -->
</div>

	<button type="button" class="btn btn-primary testbutton2" onclick="buttonAllDatabases()">View All Database</button>
	<button type="button" class="btn btn-primary testbutton2" onclick="buttonViewCategory()">Categories</button>
	<a href="video.php" class="btn btn-primary testbutton2">Movies</a>
	
	<div class="form-group">
		<button type="button" class="btn btn-danger testbutton2" id="removeBox" onclick="checkSelectedCheckBoxes()">Remove Selected</button>
	</div>
	<center><div id="loader"></div></center>
	
	<!--	<ul class="list-group" id="listCategories">
		</ul>
	-->
	
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
<h5>Answer A</h5> 
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
<h5>Answer B</h5>
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
<h5>Answer C</h5>	
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
<h5>Answer D</h5>	
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
<!--
<div class="col-8">
<span id="spanCorrOdp"></span>
</div>
<div class="col-2">
<button type="button" class="btn btn-primary" id="edit"  onclick="buttonEdit('spanCorrOdp')">Edit</button>
</div>-->
<div class="col-10">
      <select id="spanCorrOdp" class="form-control">
      <option value="Answer A" class="font-weight-bold">Answer A</option>
      <option value="Answer B" class="font-weight-bold">Answer B</option>
      <option value="Answer C" class="font-weight-bold">Answer C</option>
      <option value="Answer D" class="font-weight-bold">Answer D</option>
      </select>
</div>
</div>
</div>


<div class="form-group">
<div class="row">
<div class="col-2">
<h5>Choose category</h5>
</div>
<!--
<div class="col-8">
<span id="spanCategory"></span>
</div>
<div class="col-2">
<button type="button" class="btn btn-primary" id="edit"  onclick="buttonEdit('spanCategory')">Edit</button>
</div>-->
<div class="col-10">
      <select id="chooseCategory" class="form-control">
      </select>
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
<!--Modal 1 -->
<div class="modal fade" id="createViewModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" id="myModalLabel">Create A Question</h4>
<div class="pull-left">
	<button type="button" class="close" id="close" onclick="closeModal()" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
</div>
</div>
<div class="modal-body">

<div class="form-group">
<div class="pull-left">
<label><b>Type question 1/4</b></label>
</div><!--
<input type="text" id="question" name="question"placeholder="Question" class="form-control" /> -->
<textarea class="form-control" id="question" ></textarea>
</div>

</div>
<div class="modal-footer">
	<!-- <button type="button" class="btn btn-default" data-dismiss="modal" >Cancel</button>-->
	<button type="button" class="btn btn-primary btn-next" id="" onclick="nextModalTwo()">Next</button>
</div>
</div>
</div>
</div>

<!--Modal 2 -->
<div class="modal fade" id="createViewModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" id="myModalLabel2">Create A Question</h4>
<div class="pull-left">
	<button type="button" class="close" onclick="closeModal()" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
</div>
</div>
<div class="modal-body">

<div class="form-group">
<div class="pull-left">
<label><b>Type answers to this question 2/4</b></label>
</div><br><br>
<div class="form-group">
<label>The suggestion of answer A</label>
<input type="text" id="odp1" name="odp1" placeholder="Answer A" class="form-control" />
</div>
<div class="form-group">
<label>The suggestion of answer B</label>
<input type="text" id="odp2" name="odp2" placeholder="Answer B" class="form-control" />
</div>
<div class="form-group">
<label>The suggestion of answer C</label>
<input type="text" id="odp3" name="odp3" placeholder="Answer C" class="form-control" />
</div>
<div class="form-group">
<label>The suggestion of answer D</label>
<input type="text" id="odp4" name="odp4" placeholder="Answer D" class="form-control" />
</div>
</div>

</div>
<div class="modal-footer">
	<button type="button" class="btn btn-default btn-prev" id="" data-dismiss="modal" onclick="prevModalOne()">Prev</button>
	<button type="button" class="btn btn-primary btn-next" id="" onclick="nextModalThree()">Next</button>
</div>
</div>
</div>
</div>
<!--Modal 3 -->
<div class="modal fade" id="createViewModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" id="myModalLabel3">Create A Question</h4>
<div class="pull-left">
	<button type="button" class="close" onclick="closeModal()" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
</div>
</div>
<div class="modal-body">

<div class="form-group">
<div class="pull-left">
<label><b>Type the answer which is correctly 3/4</b></label>
</div>
</div>
<br>
<div class="form-group">
<div class="pull-left">
<label for="permission">Choose the correct answer:</label>
</div>
      <select id="chooseAnswer" class="form-control">
      <option class="font-weight-bold">Answer A</option>
      <option class="font-weight-bold">Answer B</option>
      <option class="font-weight-bold">Answer C</option>
      <option class="font-weight-bold">Answer D</option>
      </select>
</div>

</div>
<div class="modal-footer">
	<button type="button" class="btn btn-default btn-prev" id="" data-dismiss="modal" onclick="prevModalTwo()">Prev</button>
	<button type="button" class="btn btn-primary btn-next" id="" onclick="nextModalFour()">Next</button>
</div>
</div>
</div>
</div>

<!--Modal 4 -->
<div class="modal fade" id="createViewModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" id="myModalLabel4">Create A Question</h4>
<div class="pull-left">
	<button type="button" class="close" onclick="closeModal()" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
</div>
</div>
<div class="modal-body">

<div class="form-group">
<div class="pull-left">
<label><b>Type the category for this question 4/4</b></label>
</div>
</div>
<br>
<div class="form-group">
<div class="pull-left">
<label for="permission">Choose the category:</label>
</div>
      <select id="chooseCategoryNewQuestion" class="form-control">
      </select>
</div>

</div>
<div class="modal-footer">
	<button type="button" class="btn btn-default btn-prev" id="" data-dismiss="modal" onclick="prevModalThree()">Prev</button>
	<button type="button" class="btn btn-primary btn-next" id="" onclick="saveQuestion()">Save</button>
</div>
</div>
</div>
</div>

<!--End of Modal View Create An Question-->

<!--Modal View Update -->
<div class="modal fade" id="updateViewModalUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" id="myModalLabel">Update</h4>
<div class="pull-left">
<button type="button" class="close" onclick="close()" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
</div>
</div>
<div class="modal-body">
<div class="form-group">

<div class="form-group">
<div class="pull-left">
<label for="login">Edite</label>
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

</div>
	<nav class="navbar-fixed-bottom">
		<div class="footer text-center bg-dark">
			Copyright &copy; <?php echo date("o"); ?> Designed by Łukasz Jackowski
			<?php if(isset($infoDATABASE) !== '') echo $infoDATABASE ?>
		</div>
	</nav>
	
	<script src="https://code.jquery.com/jquery-3.4.0.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/jquery-autosize@1.18.18/jquery.autosize.min.js"></script>
	<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.4.0/js/bootstrap4-toggle.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<!--<script type="text/javascript"src="bootstrap-4.3/js/bootstrap.min.js"></script>
	<script type="text/javascript"src="http://code.jquery.com/jquery-3.3.1.js"></script>-->
	<script type="text/javascript" src="countdown.js"></script>
  	<script type="text/javascript" src="<?php echo $loadScripts ?>"></script>
</body>
</html>