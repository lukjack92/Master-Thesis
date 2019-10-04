<?php 

require_once "conf_db/config.php";
require_once 'func_msg/functions.php';

$code = "";

if(empty($_GET['code'])) {
echo '

		<!DOCTYPE HTML>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="api physisc">
    <meta name="author" content="Łukasz Jackowski">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Welcome</title>

    <!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css" integrity="sha384-PDle/QlgIONtM1aqA2Qemk5gPOE7wFq8+Em+G/hmo5Iq0CCmYZLv3fVRDJ4MMwEA" crossorigin="anonymous">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Baloo+Thambi" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="sticky-footer.css" rel="stylesheet">
	<link rel="stylesheet" href="style.css">
  </head>
  <body>
      <nav class="navbar navbar-expand-lg bg-dark">
		<a class="navbar-brand" href="login.php"> <i class="fas fa-home"></i> Login</a>
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
    <!-- Begin page content -->	
<div class="container">
    <main role="main" class=" center color-white">
      <h1 class="black" >API for the PHYSICS application</h1>
		<img src="img/logo.jpg">
        <p class="lead">It&#39;s API used by mobile application.</p>
    </main>
</div>
	<nav class="navbar-fixed-bottom">
		<div class="footer text-center bg-dark">
			Copyright &copy; '. date("o") . ' Designed by Łukasz Jackowski
			<h6 class="text-danger">This version is in development</h6>
		</div>
	</nav>
  </body>
</html>
';
}
else {
	$query = "select * from " . TB_CODE;
	
	if($result = @mysqli_query($link,$query)) {
		//Fetch row
		while($row=mysqli_fetch_assoc($result)) {
			$code = $row['code'];
		}
	} else {
		//echo "Database is down!"
		msg_logs("Request to resource. Database is down!");
	};

	if($_GET['code'] === $code) {
		
		header('Content-Type: application/json; charset=utf-8;');

		$query_sql="select * from " . TB_QUESTIONS;
		$result = $link->query($query_sql);

		$json = Array();

		while ($obj = mysqli_fetch_object($result)) {
			//$row_array['id'] = $obj->id;
			$row_array['question'] = htmlspecialchars($obj->question);
			$row_array['ansa'] = htmlspecialchars($obj->ansa);
			$row_array['ansb'] = htmlspecialchars($obj->ansb);
			$row_array['ansc'] = htmlspecialchars($obj->ansc);
			$row_array['ansd'] = htmlspecialchars($obj->ansd);
			$row_array['odp'] = htmlspecialchars($obj->odp);
		
			array_push($json, $row_array);
		}
			echo json_encode($json, JSON_UNESCAPED_UNICODE);

			msg_logs("Request to resource.");

			mysqli_free_result($result);
			mysqli_close($link);
	} 
	else {
		//http_response_code(403);
		//header("Location: code.php");
		
		echo '
		<!DOCTYPE HTML>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="api physisc">
    <meta name="author" content="Łukasz Jackowski">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Welcome</title>

    <!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css" integrity="sha384-PDle/QlgIONtM1aqA2Qemk5gPOE7wFq8+Em+G/hmo5Iq0CCmYZLv3fVRDJ4MMwEA" crossorigin="anonymous">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Baloo+Thambi" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="sticky-footer.css" rel="stylesheet">
	<link rel="stylesheet" href="style.css">
  </head>
  <body>
      <nav class="navbar navbar-expand-lg bg-dark">
		<a class="navbar-brand" href="login.php"> <i class="fas fa-home"></i> Login</a>
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
    <!-- Begin page content -->
<div class="container">
    <main role="main" class="center color-white">
      <h1>Incorrect Code</h1>
      <p class="lead">The code in URL isn&#39t correct.</p> 
    </main>
</div>
	<nav class="navbar-fixed-bottom">
		<div class="footer text-center bg-dark">
			Copyright &copy; '. date("o") . ' Designed by Łukasz Jackowski
			<h7 class="text-danger">This version is in development</h7>
		</div>
	</nav>
  </body>
</html>
		';
	}
}
?>
