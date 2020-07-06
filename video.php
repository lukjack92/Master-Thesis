<?php 
	session_start();
	
    // Check if the user is logged in, if not then redirect him to login page
    if(!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] !== true) {
        header("Location: login.php");
        exit;
    }

    require_once "conf_db/config.php";

?>
<!DOCTYPE HTML>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="api physisc">
    <meta name="author" content="Łukasz Jackowski">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Welcome</title>

    <!-- Bootstrap core CSS -->
	<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.4.0/css/bootstrap4-toggle.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Baloo+Thambi" rel="stylesheet">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  </head>
  <body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="logoutAdmin.php"> <i class="fas fa-home"></i> Logout</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarColor02">
				<ul class="navbar-nav mr-auto">	
				<li class="nav-item active">
					<a class="nav-link" href="welcome.php"><i class="fa fa-chevron-left" aria-hidden="true"></i> BACK</a>
				</li>			
				</ul>
			</div>
		</nav>
    <!-- Begin page content -->
    
<div class="container color_white">

<div id="cl"><?php 
		if(isset($_SESSION['ok']) != "") {
			echo $_SESSION['ok'];
			unset($_SESSION['ok']);
		} 
	?></div>

    <div class="page-header">
        <h1>Movies</h1>
		<h2> FirstName: <?php echo $_SESSION['firstName'] ?> </h2>
		<h2> LastName: <?php echo $_SESSION['lastName'] ?> </h2>
    </div>
	
	<?php echo date("Y-m-d H:i");?>
	
	<div id="time"></div>
    <a href="welcome.php" class="btn btn-danger testbutton2">Back page</a>

    <?php
    if($link->connect_error) {
    ?> <div class="alert alert-danger" role="alert"><?php echo "Error from database: ".$link->connect_errno;?></div> <?php
    }else  {
        if($result = @$link->query("select * from video"))
        {
          $how = $result->num_rows;

          if($how == 0) {
            echo '<div class="alert alert-danger"><center><strong>There are no movies</strong></center></div>';
          }else {
            for($i = 1; $i <= $how; $i++) {
              $row = $result->fetch_assoc();
              $URL = $row['path'];
              $URL = str_replace("watch?v=","embed/",$URL);

              $action_yes = "";
			  $action_no = "";
						
			    if($row['isActive'] == "true") $action_yes="active"; else $action_no="active";

              ?>
                <div class="containerVideo">
                <iframe width="480" height="320" src="<?php echo $URL ?>"></iframe>
                <div>
                    <button type="button" class="btn btn-danger" onclick="delVideo('<?php echo $row['id'] ?>')">Delete</button>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-secondary <?php echo $action_yes ?>">
                            <input type="radio" name="options" id="option1" autocomplete="off" onchange="updateIsActiveVideo('<?php echo $row['id']?>','true')"> Active
                        </label>
                        <label class="btn btn-secondary <?php echo $action_no ?>">
                            <input type="radio" name="options" id="option2" autocomplete="off" onchange="updateIsActiveVideo('<?php echo $row['id']?>',false)"> Inactive
                        </label>
                    </div>
                </div>
            </div>
<?php
            }
        }
    }
}
            ?>

<!--
    <div>
        <div class="containerVideo">
            <video controls="controls" width="45%"  >
                <source src="video/small.mp4" type="video/mp4">
            </video>
            <div>
                <button type="button" class="btn btn-danger" onclick="">Delete</button>
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-secondary ">
                        <input type="radio" name="options" id="option1" autocomplete="off" > Active
                    </label>
                    <label class="btn btn-secondary active">
                        <input type="radio" name="options" id="option2" autocomplete="off"> Inactive
                    </label>
                </div>
            </div>
        </div>
        <div class="containerVideo">
            <video controls="controls"  width="45%"  >
                <source src="video/Grzegorz Karwasz Fizyka Mechanika falowa.mp4" type="video/mp4">
            </video>
            <div >
                <button type="button" class="btn btn-danger" onclick="">Delete</button>
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-secondary ">
                        <input type="radio" name="options" id="option1" autocomplete="off" > Active
                    </label>
                    <label class="btn btn-secondary active">
                        <input type="radio" name="options" id="option2" autocomplete="off"> Inactive
                    </label>
                </div>
            </div>
        </div>
        <div class="containerVideo">
            <video controls="controls"  width="45%" >
                <source src="video/Wstęp do dydaktyki kognitywnej.mp4" type="video/mp4">
            </video>
            <div>
                <button type="button" class="btn btn-danger" onclick="">Delete</button>
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-secondary ">
                        <input type="radio" name="options" id="option1" autocomplete="off" > Active
                    </label>
                    <label class="btn btn-secondary active">
                        <input type="radio" name="options" id="option2" autocomplete="off"> Inactive
                    </label>
                </div>
            </div>
        </div>
        <div class="containerVideo">
            <video controls="controls"  width="45%"  >
                <source src="video/small.mp4" type="video/mp4">
            </video>
            <div>
                <button type="button" class="btn btn-danger" onclick="">Delete</button>
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-secondary ">
                        <input type="radio" name="options" id="option1" autocomplete="off" > Active
                    </label>
                    <label class="btn btn-secondary active">
                        <input type="radio" name="options" id="option2" autocomplete="off"> Inactive
                    </label>
                </div>
            </div>
        </div>
        <div class="containerVideo">
            <video controls="controls"  width="45%"  >
                <source src="video/small.mp4" type="video/mp4">
            </video>
            <div>
                <button type="button" class="btn btn-danger" onclick="">Delete</button>
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-secondary ">
                        <input type="radio" name="options" id="option1" autocomplete="off" > Active
                    </label>
                    <label class="btn btn-secondary active">
                        <input type="radio" name="options" id="option2" autocomplete="off"> Inactive
                    </label>
                </div>
            </div>
        </div>
    </div>

    <?php
$dir    = 'video';
$files = array_slice(scandir($dir), 3);
print_r($files);
?>
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

<!--Modal to remove video -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="delVideoModal">
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


</div>
	<nav class="navbar-fixed-bottom">
		<div class="footer text-center bg-dark">
			Copyright &copy;  <?php echo date("o") ?> Designed by Łukasz Jackowski
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