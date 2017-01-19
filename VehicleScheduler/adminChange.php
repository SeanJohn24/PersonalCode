<?php
/********************************
* Shane Workman : Vehicle Scheduler
* 11/21/2016
********************************/
$pageTitle = 'Admin Change';
include ('header.php');
require ('dbConn.php');
include ('functions.php');

					session_start();
					if (!isset($_SESSION['Username'])) {
						header('Location: http://server05116/Intranet/VehicleScheduler/logout.php'); 
						exit();
					} else {
						$loggedIn = $_SESSION['Username'];
					} 
					session_write_close();

if ($_SERVER['REQUEST_METHOD'] == 'POST')  {
	//Var_dump($_POST);
$errors = '';
$table = '';
$resId = $_POST['resId'];
		{ // Variable block --> get from Array --> select query on ID.
		$vQuery = "SELECT Events.[Date], Events.VehId, Events.StartTime, Events.EndTime, Events.Email, Vehicles.VehDesc, Events.Name 
							FROM Events JOIN Vehicles ON Vehicles.VehId = Events.VehId
							WHERE Id=$resId;";
		$vResults = sqlsrv_query($conn, $vQuery, array(), array('Scrollable' => 'buffered'));
		if (sqlsrv_num_rows($vResults) > 0) {
			$row = sqlsrv_fetch_array($vResults);
				$dateObj = $row[0];
				$date = $dateObj->format('Y-m-d');
				$vehicleId = $row[1];
				$timeOut = $row[2];
				$timeIn = $row[3]; 
				$email = $row[4];
				$vehDesc = $row[5];
				$name = $row[6];
				/* Don't need these atm. Just leaving here incase I do!
				$priorId = $row[4];
				$priorDesc = $row[5];
				$notes = $row[6];
				*/ 
		} else {
			$errors .= 'Couldn\'t connect to the database to grab required variables. Please inform help desk of this issue! <a style="float:right" href="http://server05116/Intranet/VehicleScheduler/admin.php">Admin Home</a>';
		}
	}


	
	if (isset($_POST['changeCheckOut'])) {
		$timeOut = $_POST['timeOut'];
		$changeCheckOut = 'Yes';
	} else {
		$changeCheckOut = 'No';
	}
	if (isset($_POST['changeCheckIn'])) {
		$timeIn = $_POST['timeIn'];
		$changeCheckIn = 'Yes';
	} else {
		$changeCheckIn = 'No';
	}
	if (isset($_POST['cancel'])) {
		$cancel = 'Yes';
	} else {
		$cancel = 'No';
	}
		
	if ($cancel == 'Yes') {
		$uQuery = "UPDATE Events SET Active = 0, UserName='$loggedIn' WHERE Id = $resId;";
		if (sqlsrv_query($conn, $uQuery)) {
			$table = 'The Reservation has been cancelled. --> <a style="float:right" href="http://server05116/Intranet/VehicleScheduler/admin.php">Admin Home</a>';
			{ // Handle Email in this block!
				$message = 
'Adminstration, at your request, has cancel the following reservation.
		Name: '.$name.'
		Email: '.$email.'
		Date: '.$date.'
		Vehicle: '.$vehDesc.'
	If this was done by mistake please contact one of the following to correct this measure.
		Danielle.Ross@nlcmh.org,
		melissa.bentgen@nlcmh.org,
		Hilary.Rappuhn@nlcmh.org, 
		Ellen.Walczak@nlcmh.org,
		help.desk@nlcmh.org!
						
	Sincerly, 
	Car Scheduler';		
						ini_set('SMTP','1.2.3.13');
						ini_set('smtp_port',25);
						$to = $email.',help.desk@nlcmh.org,Danielle.Ross@nlcmh.org, melissa.bentgen@nlcmh.org, Hilary.Rappuhn@nlcmh.org, ellen.walczak@nlcmh.org'; //
						$subject='Vehicle Reservation Cancelled!!';
						$headers = 'From: notify@nlcmh.org' . "\r\n" .
						'X-Mailer: PHP/' . phpversion();
						mail($to, $subject, $message, $headers);
			}	
		} else {
			$errors .= 'There was an ISSUE cancelling the reservation. Please notify help desk so that it can be investigated. --> <a style="float:right" href="http://server05116/Intranet/VehicleScheduler/admin.php">Admin Home</a>';
		}
	} elseif ($cancel == 'No' && $changeCheckIn != 'No' && $changeCheckOut != 'No') {
		if ($timeOut >= $timeIn) {
			$errors .= 'Your time in cannot be before or equal to your time out! --> <a style="float:right" href="http://server05116/Intranet/VehicleScheduler/adminEdit.php?id='.$resId.'">Back</a>';
		} else {
			$checkQuery = "SELECT * FROM Events WHERE Active = 1 AND Date = '$date' AND VehId = $vehicleId AND ((StartTime BETWEEN $timeOut AND $timeIn) OR (EndTime BETWEEN $timeOut AND $timeIn)) AND Id <> $resId";
			$checkResults = sqlsrv_query($conn, $checkQuery, array(), array('Scrollable' => 'buffered'));
			if (sqlsrv_num_rows($checkResults) > 0) {
				$errors .= 'Your new check out or check in time overlaps with another reservation. This edit cannot be made. Please click on home view to see the schedule. 
							Or  go <a style="float:right" href="http://server05116/Intranet/VehicleScheduler/adminEdit.php?id='.$resId.'">Back</a>';
			} else {
				$uQuery = "UPDATE Events SET StartTime = $timeOut, EndTime = $timeIn, UserName='$loggedIn' WHERE Id = $resId;";
				if (sqlsrv_query($conn, $uQuery)) {
						$iQuery = "SELECT Events.Date, Vehicles.VehDesc, Events.Name, Events.Email, Events.PriorId, Priority.[Desc], Events.Notes, Events.StartTime, Events.EndTime, Events.VehId
										FROM Events JOIN Vehicles ON Events.VehId = Vehicles.VehId
										JOIN Priority ON Events.PriorId = Priority.Id
										WHERE Events.Id = '$resId';";
						$results = sqlsrv_query($conn, $iQuery, array(), array('Scrollable' => 'buffered'));
						if (sqlsrv_num_rows($results) > 0) {
							$row = sqlsrv_fetch_array($results);
							$dateObj = $row[0];
							$date = $dateObj->format('Y-m-d');
							$vehDesc = $row[1];
							$name = $row[2];
							$email = $row[3];
							$priorId = $row[4];
							$priorDesc = $row[5];
							$notes = $row[6];
							$timeOut = $row[7];
							$timeIn = $row[8];
							$vehId = $row[9];
							$sTime = ConvertTime($timeOut);
							$eTime = ConvertTime($timeIn);
							$table .= '<table class="Bravo">';	
							$table .= '<tr><td>Date:</td><td>'.$date.'</td></tr>';
							$table .= '<tr><td>Assigned to:</td><td>'.$name.'</td></tr>';
							$table .= '<tr><td>Email:</td><td>'.$email.'</td></tr>';
							$table .= '<tr><td>Vehicle:</td><td>#'.$vehId.' '.$vehDesc.'</td></tr>';
							$table .= '<tr><td>Priority:</td><td>'.$priorId.' : '.$priorDesc.'</td></tr>';
							$table .= '<tr><td style="font-weight:normal; !Important;"><b>Time Out:</b> '.$sTime.'</td><td><b>Time In:</b> '.$eTime.'</td></tr>';
							$table .= '<tr><td style="text-align: left; font-weight:normal;width:400px !Important;" colspan=2>Notes: <br />'.$notes.'</td></tr>';
							$table .= '</table>';
							$table .= '<a style="float:right" href="http://server05116/Intranet/VehicleScheduler/admin.php">Admin Home</a>';
							
						} else {
							$errors .= 'There was an ISSUE getting the edited reservation data from the database. Please notify help desk.<a style="float:right" href="http://server05116/Intranet/VehicleScheduler/admin.php">Admin Home</a>';
						}				
					
				} else {
					$errors .= 'There was an ISSUE with the database updating the reservation. Please notify help desk so that it can be investigated. --> <a style="float:right" href="http://server05116/Intranet/VehicleScheduler/admin.php">Admin Home</a>';
				}
			}
		}
	} elseif ($cancel == 'No' && $changeCheckIn == 'No' && $changeCheckOut != 'No' ) {
		if ($timeOut >= $timeIn) {
			$errors .= 'Your time in cannot be before or equal to your time out! --> <a style="float:right" href="http://server05116/Intranet/VehicleScheduler/adminEdit.php?id='.$resId.'">Back</a>';
		} else {
			$checkQuery = "SELECT * FROM Events WHERE Active = 1 AND Date = '$date' AND VehId = $vehicleId AND ((StartTime BETWEEN $timeOut AND $timeIn) OR (EndTime BETWEEN $timeOut AND $timeIn)) AND Id <> $resId";
			$checkResults = sqlsrv_query($conn, $checkQuery, array(), array('Scrollable' => 'buffered'));
			if (sqlsrv_num_rows($checkResults) > 0) {
				$errors .= 'Your new check out or check in time overlaps with another reservation. This edit cannot be made. Please click on home view to see the schedule. 
							Or  go <a style="float:right" href="http://server05116/Intranet/VehicleScheduler/adminEdit.php?id='.$resId.'">Back</a>';
			} else {
				$uQuery = "UPDATE Events SET StartTime = $timeOut, EndTime = $timeIn, UserName='$loggedIn' WHERE Id = $resId;";
				if (sqlsrv_query($conn, $uQuery)) {
						$iQuery = "SELECT Events.Date, Vehicles.VehDesc, Events.Name, Events.Email, Events.PriorId, Priority.[Desc], Events.Notes, Events.StartTime, Events.EndTime, Events.VehId
										FROM Events JOIN Vehicles ON Events.VehId = Vehicles.VehId
										JOIN Priority ON Events.PriorId = Priority.Id
										WHERE Events.Id = '$resId';";
						$results = sqlsrv_query($conn, $iQuery, array(), array('Scrollable' => 'buffered'));
						if (sqlsrv_num_rows($results) > 0) {
							$row = sqlsrv_fetch_array($results);
							$dateObj = $row[0];
							$date = $dateObj->format('Y-m-d');
							$vehDesc = $row[1];
							$name = $row[2];
							$email = $row[3];
							$priorId = $row[4];
							$priorDesc = $row[5];
							$notes = $row[6];
							$timeOut = $row[7];
							$timeIn = $row[8];
							$vehId = $row[9];
							$sTime = ConvertTime($timeOut);
							$eTime = ConvertTime($timeIn);
							$table .= '<table class="Bravo">';	
							$table .= '<tr><td>Date:</td><td>'.$date.'</td></tr>';
							$table .= '<tr><td>Assigned to:</td><td>'.$name.'</td></tr>';
							$table .= '<tr><td>Email:</td><td>'.$email.'</td></tr>';
							$table .= '<tr><td>Vehicle:</td><td>#'.$vehId.' '.$vehDesc.'</td></tr>';
							$table .= '<tr><td>Priority:</td><td>'.$priorId.' : '.$priorDesc.'</td></tr>';
							$table .= '<tr><td style="font-weight:normal; !Important;"><b>Time Out:</b> '.$sTime.'</td><td><b>Time In:</b> '.$eTime.'</td></tr>';
							$table .= '<tr><td style="text-align: left; font-weight:normal;width:400px !Important;" colspan=2>Notes: <br />'.$notes.'</td></tr>';
							$table .= '</table>';
							$table .= '<a style="float:right" href="http://server05116/Intranet/VehicleScheduler/admin.php">Admin Home</a>';
							
						} else {
							$errors .= 'There was an ISSUE getting the edited reservation data from the database. Please notify help desk.<a style="float:right" href="http://server05116/Intranet/VehicleScheduler/admin.php">Admin Home</a>';
						}				
					
				} else {
					$errors .= 'There was an ISSUE with the database updating the reservation. Please notify help desk so that it can be investigated. --> <a style="float:right" href="http://server05116/Intranet/VehicleScheduler/admin.php">Admin Home</a>';
				}
			}
		}		
	} elseif ($cancel == 'No' && $changeCheckIn != 'No' && $changeCheckOut == 'No') {
		if ($timeOut >= $timeIn) {
			$errors .= 'Your time in cannot be before or equal to your time out! --> <a style="float:right" href="http://server05116/Intranet/VehicleScheduler/adminEdit.php?id='.$resId.'">Back</a>';
		} else {
			$checkQuery = "SELECT * FROM Events WHERE Active = 1 AND Date = '$date' AND VehId = $vehicleId AND ((StartTime BETWEEN $timeOut AND $timeIn) OR (EndTime BETWEEN $timeOut AND $timeIn)) AND Id <> $resId";
			$checkResults = sqlsrv_query($conn, $checkQuery, array(), array('Scrollable' => 'buffered'));
			if (sqlsrv_num_rows($checkResults) > 0) {
				$errors .= 'Your new check out or check in time overlaps with another reservation. This edit cannot be made. Please click on home view to see the schedule. 
							Or  go <a style="float:right" href="http://server05116/Intranet/VehicleScheduler/adminEdit.php?id='.$resId.'">Back</a>';
			} else {
				$uQuery = "UPDATE Events SET StartTime = $timeOut, EndTime = $timeIn, UserName='$loggedIn' WHERE Id = $resId;";
				if (sqlsrv_query($conn, $uQuery)) {
						$iQuery = "SELECT Events.Date, Vehicles.VehDesc, Events.Name, Events.Email, Events.PriorId, Priority.[Desc], Events.Notes, Events.StartTime, Events.EndTime, Events.VehId
										FROM Events JOIN Vehicles ON Events.VehId = Vehicles.VehId
										JOIN Priority ON Events.PriorId = Priority.Id
										WHERE Events.Id = '$resId';";
						$results = sqlsrv_query($conn, $iQuery, array(), array('Scrollable' => 'buffered'));
						if (sqlsrv_num_rows($results) > 0) {
							$row = sqlsrv_fetch_array($results);
							$dateObj = $row[0];
							$date = $dateObj->format('Y-m-d');
							$vehDesc = $row[1];
							$name = $row[2];
							$email = $row[3];
							$priorId = $row[4];
							$priorDesc = $row[5];
							$notes = $row[6];
							$timeOut = $row[7];
							$timeIn = $row[8];
							$vehId = $row[9];
							$sTime = ConvertTime($timeOut);
							$eTime = ConvertTime($timeIn);
							$table .= '<table class="Bravo">';	
							$table .= '<tr><td>Date:</td><td>'.$date.'</td></tr>';
							$table .= '<tr><td>Assigned to:</td><td>'.$name.'</td></tr>';
							$table .= '<tr><td>Email:</td><td>'.$email.'</td></tr>';
							$table .= '<tr><td>Vehicle:</td><td>#'.$vehId.' '.$vehDesc.'</td></tr>';
							$table .= '<tr><td>Priority:</td><td>'.$priorId.' : '.$priorDesc.'</td></tr>';
							$table .= '<tr><td style="font-weight:normal; !Important;"><b>Time Out:</b> '.$sTime.'</td><td><b>Time In:</b> '.$eTime.'</td></tr>';
							$table .= '<tr><td style="text-align: left; font-weight:normal;width:400px !Important;" colspan=2>Notes: <br />'.$notes.'</td></tr>';
							$table .= '</table>';
							$table .= '<a style="float:right" href="http://server05116/Intranet/VehicleScheduler/admin.php">Admin Home</a>';
							
						} else {
							$errors .= 'There was an ISSUE getting the edited reservation data from the database. Please notify help desk.<a style="float:right" href="http://server05116/Intranet/VehicleScheduler/admin.php">Admin Home</a>';
						}				
					
				} else {
					$errors .= 'There was an ISSUE with the database updating the reservation. Please notify help desk so that it can be investigated. --> <a style="float:right" href="http://server05116/Intranet/VehicleScheduler/admin.php">Admin Home</a>';
				}
			}
		}
	} elseif ($cancel == 'No' && $changeCheckIn == 'No' && $changeCheckOut == 'No') {
		$errors .= 'You have to make a selection before hitting submit. Please go <a href="http://server05116/Intranet/VehicleScheduler/adminEdit.php?id='.$resId.'">Back</a>!';
	} else {
		$errors .= 'Data selection error, Please report this to help.desk! <a style="float:right" href="http://server05116/Intranet/VehicleScheduler/admin.php">Admin Home</a>';
	}	
} else {
	$errors = 'You navigated to this page by error! Please click <a href="http://server05116/Intranet/VehicleScheduler/admin.php">Admin Home</a>!';
}
?>
<div style="width: 1024px; margin-left:auto; margin-right:auto">
	<fieldset>
		<?php //echo $backToAvail;?>
		<h1>Edit Reservation Info</h1>
			<?php
				if (!empty($errors)) {
					echo $errors;
				} else {
					echo $table;
				}
			?>
	</fieldset>
</div>
<?php
include ('footer.php');
?>