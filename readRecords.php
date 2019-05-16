<?php

session_start();

$isActive = "";
$action_yes = "";
$action_no = "";


require_once "conf_db/config.php";

if(!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] !== true){
	header("Location: index.php");
	exit;
} else {

$data = '<table class="table table table-bordered table-striped">
		<thead>
			<tr>
				<th>No.</th>
				<th>Login</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Is Active</th>
				<th>Permission</th>';
				
				if($_SESSION['permission'] == "admin"){ 
					$data .= '<th>Action</th>';
				}
			$data .= '</tr>
		</thead>
		<tbody>';

				$sql = 'select * from users';
				$result = @mysqli_query($link, $sql);
				$id = 0;

				if(mysqli_num_rows($result) > 0) {
					// Output data of each rows
					while($row = mysqli_fetch_assoc($result)) {
						$data .= '<tr>
						<td>'.++$id.'</td>
						<td id="login_modal">';
						if($_SESSION["login"] === $row["login"]) { 
							$data .= '<b>'.$row["login"].'</b>';
						} else { $data .= $row['login']; }
						
						$data .= '</td>
						<td id="fN_modal">'.$row['firstName'].'</td>
						<td id="lN_modal">'.$row['lastName'].'</td>';
						
						if($_SESSION['permission'] == "admin") {
							//$data .= '<td> <input type="checkbox"'; 
							//$data .= $row['isActive']=="true" ? 'checked ' : '';
							//$data .= 'onchange="updateIsActive('.$row['id'].",".$row['isActive'].')" data-toggle="toggle"></td>';
							
							$action_yes = "";
							$action_no = "";
							
							if($row['isActive'] == "true") $action_yes="active"; else $action_no="active";
							
							$data .= '<td><div class="btn-group btn-group-toggle" data-toggle="buttons">';
							$data .= '<label class="btn btn-secondary '.$action_yes.'"><input type="radio" name="options" id="option1" autocomplete="off" onchange="updateIsActive('.$row['id'].",".$row['isActive'].')"> Yes </label>';
							$data .= '<label class="btn btn-secondary '.$action_no.'"><input type="radio" name="options" id="option2" autocomplete="off" onchange="updateIsActive('.$row['id'].",".$row['isActive'].')"> No </label></td>';
						} else 

							if($row['isActive'] == "true")
								$isActive = '<td><i class="material-icons">done</i>Active</td>';
							else
								$isActive = '<td style="color:red";><i class="material-icons">clear</i><b>Inactive</b></td>';
							
							$data .= $isActive;
							$data .= '<td id="perm_modal">'.$row['permission'].'</td>';
						if($_SESSION['permission'] == "admin"){
							$data .= '<td> <button type="button" class="btn btn-primary" onclick="getDetails('.$id .",". $row['id'].')">Update</button> <button type="button" class="btn btn-primary" onclick="deleteUser('. $row['id'] .')">Delete</button></td>';
						} 
						$data .= '</tr>';
					}
				} else {		
					$data .= 'No data.';
				} 
				$data .= '</tbody></table>';
	
				echo $data;
}
?>