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
				<th scope="col" style="width: 50%">Questions</th>
				<th scope="col" style="width: 5%">Action</th>
			</tr>
		</thead>
		<tbody>';
		
				$sql = 'select * from questions';
				$result = @mysqli_query($link, $sql);
				$id = 0;
				if(@mysqli_num_rows($result) > 0) {
					// Output data of each rows
					while($row = mysqli_fetch_assoc($result)) {
				$data .= '<tr>
						<th scope="row">'.++$id.'</th>
						<td>'.$row['question'].'</td>
						<td>
							<button type="button" class="btn btn-primary testbutton2" onclick="viewQuestion('.$row['id'].')">View</button> <button type="button" class="btn btn-primary testbutton2" onclick="delQuestion('.$row['id'].')">Delete</button>
						</td>
					</tr>';
					}
				} else {		
					$data .= 'No data.';
				} 
				$data .= '</tbody></table>';
	
				echo $data;
}
?>