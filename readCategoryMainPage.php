<?php

session_start();

$isActive = "";
//$sql = 'select * from category';
$sql = 'SELECT COUNT(a.category) counter, b.id, b.name FROM category b LEFT Join questions a ON b.name = a.category GROUP BY b.NAME, b.id';

require_once "conf_db/config.php";

if(!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] !== true){
	header("Location: index.php");
	exit;
} else {

$data = '<table class="table table-bordered table-striped table-responsive table-hover">
		<thead>
			<tr>
				<th scope="col" style="width: 6%"><input type="checkbox" id="allCheckBoxes" onclick="sellectAllCheckBox()" name="vehicle1" ></th>
				<th scope="col" style="width: 8%">No.</th>
				<th scope="col" style="width: 66%">Category</th>
				<th scope="col" style="width: 18%">Action</th>
				<th scope="col" style="width: 2%">Number</th>
			</tr>
		</thead>
		<tbody>';
				$result = @mysqli_query($link, $sql);
				$id = 0;
				if(@mysqli_num_rows($result) > 0) {
					// Output data of each rows
					while($row = mysqli_fetch_assoc($result)) {
				$data .= '<tr>
						<td><input type="checkbox" name="allCheckBox" onclick="actionCheckBox()" value="'.$row['id'].'"></td>
						<td scope="row">'.++$id.'</td>
						<td>'.$row['name'].'</td>
						<td>
							<button type="button" class="btn btn-primary testbutton2" onclick="viewQuestionFromCategory(\''.$row['name'].'\')">View</button> <button type="button" class="btn btn-danger testbutton2" onclick="delCategory('.$row['id'].')">Delete</button>
						</td>';
							
							if ($row['counter'] == 0) {
								$row['counter'] = '<p style="color:red;">Empty</p>';
							} 
							
						$data .= '<td>'.$row['counter'].'</td></tr>';
					}
				} else {		
					$data .= 'No data.';
				} 
				
				$data .= '</tbody></table>';
				echo $data;
}
?>