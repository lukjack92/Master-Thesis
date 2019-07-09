<?php

session_start();

$isActive = "";

require_once "conf_db/config.php";

if(!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] !== true){
	header("Location: index.php");
	exit;
} else {

$data = '<table class="table table-bordered table-striped table-responsive table-hover">
		<thead>
			<tr>
				<th scope="col" style="width: 5%">No.</th>
				<th scope="col" style="width: 10%">Login</th>
				<th scope="col" style="width: 10%" >First Name</th>
				<th scope="col" style="width: 10%" >Last Name</th>
				<th scope="col" style="width: 10%" >Is Active</th>
				<th scope="col" style="width: 5%" >Permission</th>';
				
				if($_SESSION['permission'] == "admin"){ 
					$data .= '<th style="width: 12%">Action</th>';
				}
			$data .= '</tr>
		</thead>
		<tbody>';

				$sql = 'select * from users';
				$result = @mysqli_query($link, $sql);
				$id = 0;

				if(@mysqli_num_rows($result) > 0) {
					// Output data of each rows
					while($row = mysqli_fetch_assoc($result)) {
						$data .= '<tr>
						<th scope="row">'.++$id.'</th>
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
							if($row['login'] == $_SESSION['login']) {
								$data .= '<td><i class="material-icons">done</i>Active</td>';
							} else {
								$data .= '<td><div class="btn-group btn-group-toggle" data-toggle="buttons">';
								$data .= '<label class="btn btn-secondary '.$action_yes.'"><input type="radio" name="options" id="option1" autocomplete="off" onchange="updateIsActive('.$row['id'].",".$row['isActive'].')"> Yes </label>';
								$data .= '<label class="btn btn-secondary '.$action_no.'"><input type="radio" name="options" id="option2" autocomplete="off" onchange="updateIsActive('.$row['id'].",".$row['isActive'].')"> No </label></td>';
							}
						} else 

							if($row['isActive'] == "true")
								$isActive = '<td><i class="material-icons">done</i>Active</td>';
							else
								$isActive = '<td style="color:red";><i class="material-icons">clear</i><b>Inactive</b></td>';
							
							$data .= $isActive;
							$data .= '<td id="perm_modal">'.$row['permission'].'</td>';
						if($_SESSION['permission'] == "admin"){
							if($row['login'] == $_SESSION['login']) {
								$data .= '<td> <button type="button" class="btn btn-primary testbutton" onclick="getDetails('.$id .",". $row['id'].')">Update</button></td>';
							} else {
								if($row['isActive'] == "false"){
									$data .= '<td> <button type="button" class="btn btn-primary testbutton" disabled onclick="getDetails('.$id .",". $row['id'].')">Update</button><button type="button" class="btn btn-primary testbutton" disabled onclick="deleteUser('. $row['id'] .')">Delete</button></td>';
								} else {
									$data .= '<td> <button type="button" class="btn btn-primary testbutton" onclick="getDetails('.$id .",". $row['id'].')">Update</button><button type="button" class="btn btn-primary testbutton" onclick="deleteUser('. $row['id'] .')">Delete</button></td>';
								}
							}
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