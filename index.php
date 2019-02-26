<?php 

require_once "../conf_db/config.php";

if(empty($_GET['code'])) {
echo '
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css" integrity="sha384-PDle/QlgIONtM1aqA2Qemk5gPOE7wFq8+Em+G/hmo5Iq0CCmYZLv3fVRDJ4MMwEA" crossorigin="anonymous">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Baloo+Thambi" rel="stylesheet">
	<link href="../physics/test.css" rel="stylesheet">
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="fontello/css/fontello.css">
    <title>API - Log in</title>
  </head>
<body>
    <nav class="navbar navbar-expand-lg bg-dark">
		<a class="navbar-brand" href="../physics/api.php"> <i class="fas fa-home"></i> Login to API</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<img src="../physics/img/hamb.png" height="15" width="20">
			</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link" href="#">About<span class="sr-only">(current)</span></a>
				</li>
			</ul>
		</div>
	</nav>
	
<div class="container">
	<div class="starter-template color-white center vertical-center">
        <h1>API for the PHYSICS application</h1>
		<img src="img/logo.jpg">
        <p class="lead">It&#39;s API used by mobile application.</p>
      </div>
</div>
	
	<nav class="navbar-fixed-bottom">
		<div class="footer text-center bg-dark">
			Copyright &copy; '. date("o") . ' Designed by Łukasz Jackowski
		</div>
	</nav>
	
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/js/bootstrap.min.js" integrity="sha384-7aThvCh9TypR7fIc2HV4O/nFMVCBwyIUKL8XCtKE+8xgCgl/PQGuFsvShjr74PBp" crossorigin="anonymous"></script>
</body>
</html>

';
}
else {
	$query = "select * from " . TB_CODE;

	if($result = mysqli_query($link,$query)) {
		//Fetch row
		while($row=mysqli_fetch_assoc($result)) {
			$code = $row['code'];
		}
	}

	if($_GET['code'] === $code) {

		header('Content-Type: application/json; charset=utf-8');

		$query_sql="select * from " . TB_TABLE;
		$result = $link->query($query_sql);

		$json = Array();

		while ($obj = mysqli_fetch_object($result)) {
			$row_array['id'] = $obj->id;
			$row_array['firstName'] = htmlspecialchars($obj->firstName);
			$row_array['lastName'] = htmlspecialchars($obj->lastName);
		
			array_push($json, $row_array);
		}
			echo json_encode($json, JSON_UNESCAPED_UNICODE);
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
	<link href="../physics/test.css" rel="stylesheet">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Inccorect Code</title>

    <!-- Bootstrap core CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css" integrity="sha384-PDle/QlgIONtM1aqA2Qemk5gPOE7wFq8+Em+G/hmo5Iq0CCmYZLv3fVRDJ4MMwEA" crossorigin="anonymous">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Baloo+Thambi" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="sticky-footer.css" rel="stylesheet">
  </head>
  <body>
      <nav class="navbar navbar-expand-lg bg-dark">
		<a class="navbar-brand" href="../physics/boot.php"> <i class="fas fa-home"></i> Login to API</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<img src="../physics/img/hamb.png" height="15" width="20">
			</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link" href="#">About<span class="sr-only">(current)</span></a>
				</li>
			</ul>
		</div>
	</nav>
    <!-- Begin page content -->
    <main role="main" class="container color-white">
      <h1>Incorrect Code</h1>
      <p class="lead">The code in URL isn&#39t correct.</p> 
    </main>

	<nav class="navbar-fixed-bottom">
		<div class="footer text-center bg-dark">
			Copyright &copy; '. date("o") . ' Designed by Łukasz Jackowski
		</div>
	</nav>
  </body>
</html>
		';
	}
}
?>