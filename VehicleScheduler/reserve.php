<?php
/************************
* Shane Workman : For CarSchedular
* 10/28/2016
************************/
$pageTitle = 'Reservations';
include ('header.php');
require ('dbconn.php');
include ('functions.php');
		if (isset($_GET['date'])) {
			if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",($_GET['date']))) {
				$currentDay = ($_GET['date']);
			} else {
				$currentDay = '';
			}
		} else {
			$currentDay = '';
		}
		if (isset($_GET['vehId'])) {
			$vehId = ($_GET['vehId']);
		} else {
			$vehId = '';
		}		
		
$form = "";
$echo = "";
 if ($_SERVER['REQUEST_METHOD'] == 'POST')  {
	$err = array();
	
	if (empty($_POST['date'])) {
		$err[] = "You did not enter a date!";
	} elseif (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",($_POST['date']))) {
		$err[] = "You did not enter the date in the proper Format... YYYY-MM-DD!";
	} else {
		$date = trim($_POST['date']);
	}
	
	if (empty($_POST['email'])) {
		$err[] = "You did not enter your email.";
	} elseif (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) == false) {
		$err[] = "You entered an invalid Email format.";
	} else {
		$email = trim($_POST['email']);
	}
	$vehicleId = (int)$_POST['vehicleId'];
	$notes = $_POST['notes'];
	$timeOut = (float) $_POST['timeOut'];
	$timeIn = (float)$_POST['timeIn'];
	$priority = (int) $_POST['priority'];
	$empId = $_POST['empId'];
	//  $user = $_SERVER['AUTH_USER'];
	if ($timeOut >= $timeIn) {
		$err[] = "Your time in cannot be before or equal to your time out!";
	}	
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
		Foreach($err as $m)
		{
			echo " $m <br />";
		} echo "Please correct the errors.";
				$form .= '<fieldset>';
					$form .= '<form action="" method=\'POST\'>';
							$form .= '<div style="float:left; display:block;width: 35%">';
								$form .= '<label>*Date:</label> <br />';
								$form .= '<input type="text" name="date" placeholder="YYYY-MM-DD" /><br />';
								$form .= '<label>*Vehicle:</label><br />';
									$form .= VehSelect($vehId);
								$form .= '<label>*Name:</label> <br />';
									$form .= EmpSelect();
								$form .= '<label>*Email:</label><br />';
									$form .= '<input type="text" name="email" placeholder="first.last@nlcmh.org"/>';
							$form .= '</div>';
							$form .= '<div style="float:left; display:block;width: 20%">';
								$form .= '<label>*Time Out: </label><br />';
									$form .= '<select name="timeOut">';
										$form .= '<option value="8.00">8:00 AM</option><option value="8.5">8:30 AM</option>';
										$form .= '<option value="9.00">9:00 AM</option><option value="9.5">9:30 AM</option>';
										$form .= '<option value="10.00">10:00 AM</option><option value="10.5">10:30 AM</option>';
										$form .= '<option value="11.00">11:00 AM</option><option value="11.5">11:30 AM</option>';
										$form .= '<option value="12.00">12:00 PM</option><option value="12.5">12:30 PM</option>';
										$form .= '<option value="13.00">1:00 PM</option><option value="13.5">1:30 PM</option>';
										$form .= '<option value="14.00">2:00 PM</option><option value="14.5">2:30 PM</option>';
										$form .= '<option value="15.00">3:00 PM</option><option value="15.5">3:30 PM</option>';
										$form .= '<option value="16.00">4:00 PM</option><option value="16.5">4:30 PM</option>';
										$form .= '<option value="17.00">5:00 PM</option><option value="17.50">5:30 PM</option>';
									$form .= '</select><br />';
								$form .= '<label>*Time In:</label><br />';
									$form .= '<select name="timeIn">';
										$form .= '<option value="8.00">8:00 AM</option><option value="8.5">8:30 AM</option>';
										$form .= '<option value="9.00">9:00 AM</option><option value="9.5">9:30 AM</option>';
										$form .= '<option value="10.00">10:00 AM</option><option value="10.5">10:30 AM</option>';
										$form .= '<option value="11.00">11:00 AM</option><option value="11.5">11:30 AM</option>';
										$form .= '<option value="12.00">12:00 PM</option><option value="12.5">12:30 PM</option>';
										$form .= '<option value="13.00">1:00 PM</option><option value="13.5">1:30 PM</option>';
										$form .= '<option value="14.00">2:00 PM</option><option value="14.5">2:30 PM</option>';
										$form .= '<option value="15.00">3:00 PM</option><option value="15.5">3:30 PM</option>';
										$form .= '<option value="16.00">4:00 PM</option><option value="16.5">4:30 PM</option>';
										$form .= '<option value="17.00">5:00 PM</option><option value="17.50">5:30 PM</option>';
									$form .= '</select>';
							$form .= '</div>';
							$form .= '<div style="float:left; display:block; width: 40%;">';
								$form .= '<fieldset> <legend>*Priority:</legend>';
									$form .= '<input type="radio" name="priority" value="1" />1 : Client Transport(Long Distance)<br />';
									$form .= '<input type="radio" name="priority" value="2" />2 : Client Transport (Local)<br />';
									$form .= '<input type="radio" name="priority" value="3" />3 : Medicine Delivery<br />';
									$form .= '<input type="radio" name="priority" value="4" />4 : Conference(Long Distance)<br />';
									$form .= '<input type="radio" name="priority" value="5" checked="checked" />5 : Administrative<br />';
								$form .= '</fieldset>';
							$form .= '</div>';
							 $form .= '<br />';
							$form .= '<textarea style="width:95%" name="notes" placeholder="NOTES: Destination, Miles, Keeping after 5:00?"></textarea>';
							$form .= '<br /><label>* Denotes required fields!</label>';
						$form .= '<input type="submit" value="Submit" style="display:block ;margin-left:auto; margin-right:auto"/>';
					$form .= '</form>';
					$form .= '</fieldset>';
	} else {
		$checkQuery = "SELECT Id FROM Events WHERE Active = 1 AND Date = '$date' AND VehId = $vehicleId AND ((StartTime BETWEEN $timeOut AND $timeIn) OR (EndTime BETWEEN $timeOut AND $timeIn))";
		$checkResults = sqlsrv_query($conn, $checkQuery, array(), array('Scrollable' => 'buffered'));
		if (sqlsrv_num_rows($checkResults) > 0) {
			$echo = '<div style="width: 800px; margin-left:auto; margin-right:auto">';
			$echo .= '<fieldset>';
			$echo .= 'This vehicle appears to already be reserved.<br /> <a href="http://server05116/Intranet/VehicleScheduler/index.php?date='.$date.'">Click here</a> to go to Home view and see the availability. <br />';
			$echo .= 'Or <a href="http://server05116/Intranet/VehicleScheduler/reserve.php">Click here</a> to re-enter your request.';
			$echo .= '</fieldset>';
			$echo .= '</div>';			
			//echo $echo;

		} else {
			$aQuery = "SELECT Active FROM Vehicles WHERE VehId=$vehicleId;";
			$results = sqlsrv_query($conn, $aQuery, array(), array('Scrollable' => 'buffered'));
			$row = sqlsrv_fetch_array($results);
			$active = $row[0];
			if ($active == 1) {
				$iQuery = "INSERT INTO Events (VehId, Date, StartTime, EndTime, Name, Email, PriorId, Active, Notes, EmpId, EmpPosition, CostCenter, ProviderID) 
								Values ($vehicleId, '$date', $timeOut, $timeIn, '$name', '$email', $priority, 1, '$notes', '$empId', '$position', '$cost', '$provider')"; 
				if (sqlsrv_query($conn, $iQuery)) {
					$echo = '<div style="width: 800px; margin-left:auto; margin-right:auto">';
					$echo .= '<fieldset>';
					$echo .= 'Your request has been made!<br /><a href="http://server05116/Intranet/VehicleScheduler/index.php?date='.$date.'">Click here</a> to go to Home view and see the availability.<br />';
					$echo .= 'Or <a href="http://server05116/Intranet/VehicleScheduler/reserve.php">Click here</a> to reserve another vehicle for a different time and date.<br />';
					$echo .= '</fieldset>';
					$echo .= '</div>';							
				} else {
					$echo = '<div style="width: 800px; margin-left:auto; margin-right:auto">';
					$echo .= '<fieldset>';
					$echo .= 'Something went wrong with the database connection. The reservation couldn\'t be inserted. <br /> Please inform IT or <a href="http://server05116/Intranet/VehicleScheduler/reserve.php">Click here</a> to re-enter your request.';
					$echo .= '</fieldset>';
					$echo .= '</div>';							
				}
			} else {
				$echo = '<div style="width: 800px; margin-left:auto; margin-right:auto">';
				$echo .= '<fieldset>';
				$echo .= 'It appears this vehicle is blocked off for maintenance. <a href="http://server05116/Intranet/VehicleScheduler/reserve.php">Click here</a> to choose another vehicle.';
				$echo .= '</fieldset>';
				$echo .= '</div>';
			}
		}
	}
	 
 } else {
		$form .= '<fieldset>';
			$form .= '<form method=\'POST\'s action="">';
					$form .= '<div style="float:left; display:block;width: 35%">';
						$form .= '<label>*Date:</label> <br />';
								if ($currentDay != '') {
									$form .= '<input readonly type="date" name="date" value="'.$currentDay.'" /><br />';
								} else {
									$form .= '<input type="date" name="date" placeholder="YYYY-MM-DD" /><br />';
								}
						$form .= '<label>*Vehicle:</label><br />';
						$form .= VehSelect($vehId);		
						$form .= '<label>*Name:</label> <br />';
							$form .= EmpSelect();
						$form .= '<label>*Email:</label><br />';
							$form .= '<input type="text" name="email" placeholder="first.last@nlcmh.org"/>';
					$form .= '</div>';
					$form .= '<div style="float:left; display:block;width: 20%">';
						$form .= '<label>*Time Out: </label><br />';
							$form .= '<select name="timeOut">';
								$form .= '<option value="8.00">8:00 AM</option><option value="8.5">8:30 AM</option>';
								$form .= '<option value="9.00">9:00 AM</option><option value="9.5">9:30 AM</option>';
								$form .= '<option value="10.00">10:00 AM</option><option value="10.5">10:30 AM</option>';
								$form .= '<option value="11.00">11:00 AM</option><option value="11.5">11:30 AM</option>';
								$form .= '<option value="12.00">12:00 PM</option><option value="12.5">12:30 PM</option>';
								$form .= '<option value="13.00">1:00 PM</option><option value="13.5">1:30 PM</option>';
								$form .= '<option value="14.00">2:00 PM</option><option value="14.5">2:30 PM</option>';
								$form .= '<option value="15.00">3:00 PM</option><option value="15.5">3:30 PM</option>';
								$form .= '<option value="16.00">4:00 PM</option><option value="16.5">4:30 PM</option>';
								$form .= '<option value="17.00">5:00 PM</option><option value="17.50">5:30 PM</option>';
							$form .= '</select><br />';
						$form .= '<label>*Time In:</label><br />';
							$form .= '<select name="timeIn">';
								$form .= '<option value="8.00">8:00 AM</option><option value="8.5">8:30 AM</option>';
								$form .= '<option value="9.00">9:00 AM</option><option value="9.5">9:30 AM</option>';
								$form .= '<option value="10.00">10:00 AM</option><option value="10.5">10:30 AM</option>';
								$form .= '<option value="11.00">11:00 AM</option><option value="11.5">11:30 AM</option>';
								$form .= '<option value="12.00">12:00 PM</option><option value="12.5">12:30 PM</option>';
								$form .= '<option value="13.00">1:00 PM</option><option value="13.5">1:30 PM</option>';
								$form .= '<option value="14.00">2:00 PM</option><option value="14.5">2:30 PM</option>';
								$form .= '<option value="15.00">3:00 PM</option><option value="15.5">3:30 PM</option>';
								$form .= '<option value="16.00">4:00 PM</option><option value="16.5">4:30 PM</option>';
								$form .= '<option value="17.00">5:00 PM</option><option value="17.50">5:30 PM</option>';
							$form .= '</select>';
					$form .= '</div>';
					$form .= '<div style="float:left; display:block; width: 40%;">';
						$form .= '<fieldset> <legend>*Priority:</legend>';
							$form .= '<input type="radio" name="priority" value="1" />1 : Client Transport(Long Distance)<br />';
							$form .= '<input type="radio" name="priority" value="2" />2 : Client Transport (Local)<br />';
							$form .= '<input type="radio" name="priority" value="3" />3 : Medicine Delivery<br />';
							$form .= '<input type="radio" name="priority" value="4" />4 : Conference(Long Distance)<br />';
							$form .= '<input type="radio" name="priority" value="5" checked="checked" />5 : Administrative<br />';
						$form .= '</fieldset>';
					$form .= '</div>';
					 $form .= '<br />';
					$form .= '<textarea style="width:95%" name="notes" placeholder="NOTES: Destination, Miles, Keeping after 5:00?"></textarea>';
					$form .= '<br /><label>* Denotes required fields!</label>';
				$form .= '<input type="submit" value="Submit" style="display:block ;margin-left:auto; margin-right:auto"/>';
			$form .= '</form>';
			$form.= '</fieldset>';
	 
 }

?>
<div style="width: 1024px; margin-left:auto; margin-right:auto">
	<fieldset>
<?php 
		if ($echo == "") {
			echo $form; 
		} else {
			echo $echo;
		}
?>
<br style="clear: right; clear: left;" />
<!--		<p>If you bump, an Email will be sent to the current registered user, as well as adminstration.<br />
		Bumping is based on Priority, you must have a higher priority than the current user.</p><br />
		<p style="text-align: center"><b><i>BEFORE YOU BUMP SOMEONE, PLEASE CHECK WITH WAIVER TEAM FOR THEIR CAR.</i></b></p><br /> -->
		<p>Waiver Team has a 2016 Ford Fusion. Contact Sherrie Moseler @ 54388 to check availability. <br />
		ACT has ANOTHER 2016 Ford Fusion. Contact ACT for that availability, BEFORE bumping.<br />
		Sign out cars on actual PLANNED usage and <u>not as a placeholder</u>. If plans change, contact help desk immediately. <br />
		Report any mechanical issues or accidents to either Maintenance or Accounting.</p><br />
		<p style="text-align: center"><b>Please clean car after use. Return with a full fuel tank!</b></p>
	</fieldset>
</div>
<?php
include ('footer.php');
?>