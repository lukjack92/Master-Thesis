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
				<th scope="col" style="width: 2%">No.</th>
				<th scope="col" style="width: 8%">UserName</th>
				<th scope="col" style="width: 18%">Email</th>
				<th scope="col" style="width: 18%">LastModification</th>
				<!-- <th scope="col" style="width: 6%">Requires Reset Password</th> -->
				<th scope="col" style="width: 15%">Phone Number</th>
				<th scope="col" style="width: 16%">Last score in the Quiz</th></tr>
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
                        <!-- <td>'.$row['requiresReset'].'</td> -->
						<td>'.$row['phoneNumber'].'</td>';
						$row = json_decode($row['infoQuiz'], JSON_PRETTY_PRINT);
						$data .= '<td>'.$row['category']."</br>".$row['result'].'</td>';
                    }

				} else {		
					$data .= 'No data.';
                } 
                $data .= '</tr>';
                $data .= '</tbody></table>';
				echo $data;
}
?>