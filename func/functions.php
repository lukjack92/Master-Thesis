<?php

function updateAuthCounter($number, $counter, $link) {
	if($number == 0) {
		$query = 'update users set authCounter = "'.$number.'" where login="'.$_POST['login'].'"';
		@mysqli_query($link, $query);							
	}
	
	if($number == 1) {
		$number = $counter+1;
		$query = 'update users set authCounter = "'.$number.'" where login="'.$_POST['login'].'"';
		@mysqli_query($link, $query);						
	}
}

?>