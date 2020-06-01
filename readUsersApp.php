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
				<th scope="col" style="width: 13%">UserName</th>
				<th scope="col" style="width: 19%" >Email</th>
				<th scope="col" style="width: 19%" >LastModification</th>
				<th scope="col" style="width: 6%" >Requires Reset Password</th>
				<th scope="col" style="width: 15%" >Phone Number</th></tr>
		</thead>
		<tbody>';

				$sql = 'select * from users_api';
				$result = @mysqli_query($link, $sql);
				$id = 0;

				if(@mysqli_num_rows($result) > 0) {
					// Output data of each rows
					while($row = mysqli_fetch_assoc($result)) {
						$data .= '<tr>
						<th scope="row">'.++$id.'</th>
						<td>'.$row['username'].'</td>
						<td>'.$row['email'].'</td>
                        <td>'.$row['timestamp'].'</td>
                        <td>'.$row['requiresReset'].'</td>
                        <td>'.$row['phoneNumber'].'</td>';
                    }

				} else {		
					$data .= 'No data.';
                } 
                $data .= '</tr>';
                $data .= '</tbody></table>';
				echo $data;
}
?>