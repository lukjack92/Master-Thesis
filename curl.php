<?php

require_once "conf_db/config.php";

$query = "select * from secret_code";
$result = mysqli_query($link,$query);
	while($row = mysqli_fetch_assoc($result)) {
		echo $row['code'];
	}

?>