<?php
/*****************
* Shane Workman : CarScheduler
* 01/03/2016
*****************/
$pageTitle = 'Enter Milage';
include ('header.php');
require ('dbconn.php');
include ('functions.php');

					session_start();
					if (!isset($_SESSION['Username'])) {
						header('Location: http://server05116/Intranet/VehicleScheduler/logout.php'); 
						exit();
					} session_write_close();
					{ // Build display@!
					$display = '<div style="width: 1024px; margin-left:auto; margin-right:auto">';
					$display .= '<fieldset>';
					$display .= '<h2>Oldest 20 Reservations without Milage</h2>';
					$display .= '<form action="" method="post">';
					$display .= '<table class = "Alpha">';
					$display .= '<tr>';
					$display .= '<th>Edit</th>';
					$display .= '<th>Vehicle</th>';
					$display .= '<th>DATE</th>';
					$display .= '<th>Time Out</th>';
					$display .= '<th>Return Time</th>';
					$display .= '<th>Name</th>';
					$display .= '</tr>';
							
			$query = "SELECT TOP 20 Id, Events.VehId, Date, StartTime, EndTime, Email, VehDesc FROM Events 
							JOIN Vehicles ON Events.VehId = Vehicles.VehId WHERE OdometerStart IS NULL 
								AND OdometerEnd IS NULL	AND DATE < GETDATE() Order BY Date Asc, VehId Asc;";
			$results = sqlsrv_query($conn, $query, array(), array('Scrollable' => 'buffered'));
			if(sqlsrv_num_rows($results) > 0){
				while ($row = sqlsrv_fetch_array($results)) {
						$dateObj = $row[2];
						$date = $dateObj->format('Y-m-d');
						$sTime = ConvertTime($row[3]);
						$eTime = ConvertTime($row[4]);
						$display .= '<tr>
								<td><input type="radio" name="eventId" value="'.$row[0].'" </td>
								<td>#'.$row[1].' '.$row[6].'</td>
								<td>'.$date.'</td>
								<td>'.$sTime.'</td>
								<td>'.$eTime.'</td>
								<td>'.substr($row[5],0,-10).'</td>
								</tr>';	
				}
			} else {
					$display .= '<td colspan="6" align="center"><font color="red">There are currently no reservations without milage.</font></td>';
			}	
					$display .= '</table>';
					$display .= '<input type="text" placeholder="Beginning Milage" name="odoStart" value="" /> &nbsp';
					$display .= '<input type="text" placeholder="Ending Milage" name="odoEnd" value="" />	';	
					$display .= '<input style="float: right" type="Submit" value="Submit Milage" />';
					$display .= '</form>';
					$display .= '</fieldset>';
					$display .= '</div>';
					}				
					
					
		
if ($_SERVER['REQUEST_METHOD'] == 'POST')  {
		$err = array();
	
	if (!empty($_POST['eventId'])) {
		$eventId = $_POST['eventId'];
	} else {
		$err[] = "You did not select which reservation you'd like to enter milage for!";
	}
	if (empty($_POST['odoStart'])) {
		$err[] = "You did not enter the Beginning Odometer reading.";
	} elseif(!is_numeric($_POST['odoStart'])) {
		$err[] = "The Odometer reading must be NUMERIC only.";
	} else {
		$odoStart = $_POST['odoStart'];
	}
	if (empty($_POST['odoEnd'])) {
		$err[] = "You did not enter the Ending Odometer reading.";
	} elseif(!is_numeric($_POST['odoEnd'])) {
		$err[] = "The Odometer reading must be NUMERIC only.";
	} else {
		$odoEnd = $_POST['odoEnd'];
	}
	if ($odoEnd <= $odoStart) {
		$err[] =  "The beginning Odometer reading cannot be greater than or equal the the ending odometer reading.";
	}
	if (!empty($err)){
		$errors = '<p>';
		foreach($err as $m) {
			$errors .= $m .'<br />';
		}
		$errors.= 'Please correct the errors.<br />';
		echo $errors;			
		echo $display;
		
	} else {
		$uQuery = "UPDATE Events SET OdometerStart = $odoStart , OdometerEnd = $odoEnd
						WHERE Id = $eventId;";
		if (sqlsrv_query($conn, $uQuery)) {
			header('Location: http://server05116/Intranet/VehicleScheduler/milage.php');
		} else {
			echo "There was an issue inserting the milage into the database, please inform help.desk or try again. <br />";
			echo $display;
		}
	}
} else {
	echo $display;
	}
include ('footer.php');
?>	