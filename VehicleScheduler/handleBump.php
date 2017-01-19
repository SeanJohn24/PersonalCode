<?php
/*****************************
* Shane Workman  : Car Scheduler
* 11/03/2016
*****************************/
$pageTitle = 'Bump Info';
include ('header.php');
require ('dbConn.php');
include ('functions.php');

$errors = '';
$notPost = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST')  {
	$err = array();
	
	if (!empty($_POST['date'])){
		$currentDate = date('Y-m-d');
		if ($currentDate <= $_POST['date']) {
			$date = $_POST['date'];
		} else {
			$err[] = 'You can\'t Bump a reservation in the past!';
		}
	} else {
		$err[] = 'Something went wrong, Please notify IT that DATE did not pull forward!';
	}
	if (!empty($_POST['oldId'])) {
		$bumpedId = $_POST['oldId'];
	} else {
		$err[] = 'Something went wrong, Please notify IT that the BUMPED ID did not pull forward!';
	}
	if (!empty($_POST['vehId'])) {
		$vehId = $_POST['vehId'];
	} else {
		$err[] = 'Something went wrong, Please notify IT that the Vehicle ID did not pull forward!';
	}
	if (!empty($_POST['oldPriorId'])) {
		$oldPriorId = $_POST['oldPriorId'];
	} else {
		$err[] = 'Something went wrong, Please notify IT that the Priority ID did not pull forward!';
	}
	if (!empty($_POST['oldEmail'])) {
		$oldEmail = $_POST['oldEmail'];
	} else {
		$err[] = 'Something went wrong, Please notify IT that the the bumped users email did not pull forward!';
	}
	if (empty($_POST['email'])) {
		$err[] = "You did not enter your email, that is a required field!!";
	} elseif (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) == false) {
		$err[] = "You entered an invalid email format.";
	} else {
		$email = trim($_POST['email']);
	}
	if (!empty($_POST['notes'])) {
		$notes = trim($_POST['notes']);
	} else {
		$err[] = "You did not enter any notes, that is a required field!!";
	}
	if ($_POST['timeIn'] <= $_POST['timeOut']) {
		$err[] = "Your checkout (Time Out) time cannot be after the return (Time In) time!";
	} else {
		$timeOut = $_POST['timeOut'];
		$timeIn = $_POST['timeIn'];
	}
	$prior = $_POST['priority'];
	if($prior >= $oldPriorId ) {
		$err[] = 'Priority Error! Your priority seems to be lower than the original reservation.'; 
	}
	$empId = $_POST['empId'];
		$eQuery = "SELECT  lastname, firstname, position, costcenter, providerID FROM employee_info WHERE employee = '$empId';";
		$results = sqlsrv_query($conn, $eQuery, array(), array('Scrollable' => 'buffered'));
		if (sqlsrv_num_rows($results) > 0) {
			$row = sqlsrv_fetch_array($results);
				$name = substr($row[1], 0, 5).' '.substr($row[0], 0, 5);
				$position = $row[2];
				$cost = $row[3];
				$provider = $row[4];			
		} else {
			$err[] = "That Employee ID cannot be found in the database, Please try again or contact help desk if you believe this to be an error.";
		}
	
	
	if (!empty($err)) {
		$errors .= '<p>';
		foreach($err as $m) {
			$errors .= $m .'<br />';
		}
		$errors.= 'Please correct the errors.<br />
					<a href="http://server05116/Intranet/VehicleScheduler/info.php?id='.$bumpedId.'">Back</a></p>';		
		
	} else {
		$checkQuery = "SELECT Id FROM Events WHERE Active = 1 AND Date = '$date' AND VehId = $vehId AND ((StartTime BETWEEN $timeOut AND $timeIn) OR (EndTime BETWEEN $timeOut AND $timeIn))";
		$checkResults = sqlsrv_query($conn, $checkQuery, array(), array('Scrollable' => 'buffered'));
		if (sqlsrv_num_rows($checkResults) < 2 ) {
			//$errors .= sqlsrv_num_rows($checkResults);
			$iQuery = "INSERT INTO Events (VehId, Date, StartTime, EndTime, Name, Email, PriorId, Active, Notes, EmpId, EmpPosition, CostCenter, ProviderID)
							VALUES ($vehId, '$date', $timeOut, $timeIn, '$name', '$email', $prior, 1, '$notes', '$empId', '$position', '$cost', '$provider')";
			if (sqlsrv_query($conn, $iQuery)) {
				$uQuery = "UPDATE Events SET Active=0, UserName='$name' WHERE id=$bumpedId";
				$sQuery = "SELECT Events.Date, Vehicles.VehDesc, Events.Name, Events.Email, Events.PriorId, Priority.[Desc], Events.Notes, Events.StartTime, Events.EndTime, Events.VehId
						FROM Events JOIN Vehicles ON Events.VehId = Vehicles.VehId
									JOIN Priority ON Events.PriorId = Priority.Id
						WHERE Events.Id = '$bumpedId';";
						$results = sqlsrv_query($conn, $sQuery, array(), array('Scrollable' => 'buffered'));
				if (sqlsrv_query($conn, $uQuery) && $results > 0) {
									$row = sqlsrv_fetch_array($results);
											//$odateObj = $row[0];
											//$odate = $odateObj->format('Y-m-d');
											$ovehDesc = $row[1];
											$oname = $row[2];
											$oemail = $row[3];
											$opriorId = $row[4];
											$opriorDesc = $row[5];
											$onotes = $row[6];
											$otimeOut = $row[7];
											$otimeIn = $row[8];
											$ovehId = $row[9];
											$sTime = ConvertTime($otimeOut);
											$eTime = ConvertTime($otimeIn);
										
$message = $name.' Bumped the reservation for '.$oname.', '.$oemail.', '.$ovehDesc.' on '.$date.', from '.$sTime.' to '.$eTime.'. 
	The reason for the bump is:
			'.$notes.'. 
	Sincerly, 
	Car Scheduler';
	
									ini_set('SMTP','1.2.3.13');
									ini_set('smtp_port',25);
									$to = 'help.desk@nlcmh.org, Danielle.Ross@nlcmh.org, Hilary.Rappuhn@nlcmh.org, ellen.walczak@nlcmh.org, melissa.bentgen@nlcmh.org';
									$to .= ', '.$email;
									$to .= ', '.$oemail;
									$subject='Reserved Vehicle Bumped!!';
									$headers = 'From: notify@nlcmh.org' . "\r\n" .
									'X-Mailer: PHP/' . phpversion();
									mail($to, $subject, $message, $headers);
					
					
				} else {
					$errors .= 'There was a problem updating the record. Please Contact IT, let them know the day and vehicle you were trying to bump!';
				}
			} else {
				$errors .= 'There was a problem inserting the record. Please Contact IT, let them know the day and vehicle you were trying to bump!';
			}
		} else {
			$errors .= 'It appears that the times in which you are attempting too use overlap with another reservation as well... Can not bump two reservations, call help desk.';
		}
	}	
} else {
	$notPost = '<p>ERROR, Page request is missing some info. Please notify IT, note how you got here for debugging.</p>';
}

?>
	<div style="width: 1024px; margin-left:auto; margin-right:auto">
		<fieldset>
			<?php 
				if (!empty($errors)) {
					echo $errors;
				} elseif (!empty($notPost)) {
					echo $notPost; 
				} else {
					header('Location: http://server05116/Intranet/VehicleScheduler/index.php?date='.$date); 
						exit();
				}
			?>
		</fieldset>
	</div>
<?php
include ('footer.php');
?>