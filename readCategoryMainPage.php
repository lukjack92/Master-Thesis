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

$start_from = ($page-1)*$_SESSION['limit2'];

$data = '<!--The form determine the number a records occurred in table.-->
		<form action="#" method="post" id="rangeRecords" class="border rounded mx-auto paddingTable">
   		 <div class="form-group">
      		<label for="inputStateCategory"><b>THE RANGE OF RECORDS OCCURRENCES IN THIS TABLE</b></label>
      		<select name="inputStateCategory" class="form-control col-4 mx-auto">
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
			    <!-- <th scope="col" style="width: 4%"><input type="checkbox" id="allCheckBoxes" onclick="selectAllCheckBox()" name="vehicle1" ></th> -->
				<th scope="col" style="width: 6%">No.</th>
				<th scope="col" style="width: 56%">Category</th>
				<th scope="col" style="width: 14%">IsActive</th>
				<th scope="col" style="width: 2%">Amount</th>
				<th scope="col" style="width: 20%">Action</th>
			</tr>
		</thead>
		<tbody>';
				$sql = "SELECT COUNT(a.category) counter, b.id, b.name, b.isActive FROM category b LEFT Join questions a ON b.name = a.category GROUP BY b.NAME, b.id limit $start_from,$_SESSION[limit2]";
				$result = @mysqli_query($link, $sql);
				$id = 0;
				if(@mysqli_num_rows($result) > 0) {
					// Output data of each rows
					//<th scope="col" style="width: 4%"><input type="checkbox" id="allCheckBoxes" onclick="selectAllCheckBox()" name="vehicle1" ></th> 
					//<td><input type="checkbox" name="allCheckBox" onclick="actionCheckBox()" value="'.$row['id'].'"></td>
					while($row = mysqli_fetch_assoc($result)) {
					$data .= '<tr>
					    <!-- <td><input type="checkbox" id="singleCheckBox" name="singleCheckBox" onclick="selectSingleCheckBox()" value="'.$row['id'].'"></td> -->
						<td scope="row">'.++$start_from.'</td>
						<td>'.$row['name'].'</td>';

						$action_yes = "";
						$action_no = "";
						
						if($row['isActive'] == "true") $action_yes="active"; else $action_no="active";
						
						$data .= '<td><div class="btn-group btn-group-toggle" data-toggle="buttons">';
						$data .= '<label class="btn btn-secondary '.$action_yes.'"><input type="radio" name="options" id="option1" autocomplete="off" onchange="updateIsActiveCategory('.$row['id'].",".$row['isActive'].')"> Yes </label>';
						$data .= '<label class="btn btn-secondary '.$action_no.'"><input type="radio" name="options" id="option2" autocomplete="off" onchange="updateIsActiveCategory('.$row['id'].",".$row['isActive'].')"> No </label></td>';
					
						if ($row['counter'] == 0) {
							$row['counter'] = '<p style="color:red;"><b>Empty</b></p>';
						} 
							
					$data .= '<td>'.$row['counter'].'</td>
						<td>
							<button type="button" class="btn btn-primary testbutton2" onclick="viewQuestionFromCategory(\''.$row['name'].'\')">View</button>
							<button type="button" class="btn btn-danger testbutton2" onclick="delCategory('.$row['id'].',\''.$row['name'].'\')">Delete</button>
						</td></tr>';
					}
				} else {		
					$data .= 'No data.';
				} 
				$data .= '</tbody></table>';
				
				//$sql = "SELECT COUNT(a.category) counter, b.id, b.name FROM category b LEFT Join questions a ON b.name = a.category GROUP BY b.NAME, b.id";
				$sql = "select * from category";
				$result = @mysqli_query($link, $sql);
				$total_record = @mysqli_num_rows($result);
				//echo $total_record;
				$total_page = ceil($total_record/$_SESSION['limit2']);
				
				if($page>1) $data .= '<button type="button" class="btn btn-primary testbuttonLeft" onclick="buttonViewCategory('.($page-1).')">Prev</button>';
				
				for($i=1;$i<=$total_page;$i++) $data .= '<button type="button" class="btn btn-primary testbuttonLeft" onclick="buttonViewCategory('.$i.')">'.$i.'</button>';

				if($page<$total_page) $data .= '<button type="button" class="btn btn-primary testbuttonLeft" onclick="buttonViewCategory('.($page+1).')">Next</button>';
				
				echo $data;
}
?>