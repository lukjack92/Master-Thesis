<?php

session_start();

$isActive = "";

require_once "conf_db/config.php";

if(!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] !== true){
	header("Location: index.php");
	exit;
} else {

if(isset($_POST['page']))
	$page = $_POST['page'];
else 
	$page = 1;

$start_from = ($page-1)*$_SESSION['limit'];

$data = '
	<!--The form determine the number a records occurred in table.-->
	<form action="#" method="post" id="rangeRecords" class="border rounded mx-auto paddingTable">
    	<div class="form-group">
			<label for="inputStateCategory"><b>THE RANGE OF RECORDS OCCURRENCES IN THIS TABLE</b></label>
      		<select name="inputState" class="form-control col-4 mx-auto">
        		<option>5</option>
				<option>10</option>
				<option>15</option>
				<option>20</option>
				<option>40</option>
     		 </select>
    	</div>
		<div class="form-group mx-auto">
			<button type="submit" class="btn btn-primary">Save</button>
		</div>
	</form>
		<table class="table table-bordered table-striped table-responsive table-hover">
		<thead>
			<tr>
				<th scope="col" style="width: 4%"><input type="checkbox" id="allCheckBoxes" onclick="selectAllCheckBox()" name="vehicle1" ></th>
				<th scope="col" style="width: 6%">No.</th>
				<th scope="col" style="width: 72%">Questions</th>
				<th scope="col" style="width: 2%">Category</th>
				<th scope="col" style="width: 16%">Action</th>
			</tr>
		</thead>
		<tbody>';
		
				$sql = "select * from questions limit $start_from,$_SESSION[limit]";
				$result = @mysqli_query($link, $sql);
				$id = 0;
				if(@mysqli_num_rows($result) > 0) {
					// Output data of each rows
					while($row = mysqli_fetch_assoc($result)) {
				$data .= '<tr>
						<td><input type="checkbox" name="allCheckBox" onclick="actionCheckBox()" value="'.$row['id'].'"></td>
						<td scope="row">'.++$start_from.'</td>
						<td>'.$row['question'].'</td>';
						
						if ($row['category'] != "")
								$row['category'] = '<p style="color:green;"><b>Yes</b></p>';
						else	
								$row['category'] = '<p style="color:red;"><b>No</b></p>';
						$data .= '<td>'.$row['category'].'</td>
						<td>
							<button type="button" class="btn btn-primary testbutton2" onclick="viewQuestion('.$row['id'].')">View</button> <button type="button" class="btn btn-danger testbutton2" onclick="delQuestion('.$row['id'].')">Delete</button>
						</td>
					</tr>';
					}
				} else {		
					$data .= 'No data.';
				} 
				$data .= '</tbody></table>';
	
				$sql = "select * from questions";
				$result = @mysqli_query($link, $sql);
				$total_record = @mysqli_num_rows($result);
				//echo $total_record;
				$total_page = ceil($total_record/$_SESSION['limit']);
				
				if($page>1) $data .= '<button type="button" class="btn btn-primary testbuttonLeft" onclick="readDatabase('.($page-1).')">Prev</button>';
				
				for($i=1;$i<=$total_page;$i++) $data .= '<button type="button" class="btn btn-primary testbuttonLeft" onclick="readDatabase('.$i.')">'.$i.'</button>';

				if($page<$total_page) $data .= '<button type="button" class="btn btn-primary testbuttonLeft" onclick="readDatabase('.($page+1).')">Next</button>';
				
				
				echo $data;
}
?>