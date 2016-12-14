<?php
/********************************
* Shane Workman : Vehicle Scheduler
* 11/17/2016
********************************/
$pageTitle = 'Administrative';
include ('header.php');
require ('dbConn.php');
$table = 'This should never show!';
					session_start();
					if (!isset($_SESSION['Username'])) {
						header('Location: http://server/intranet/logout.php'); 
						exit();
					} session_write_close();


if (isset($_GET['date'])) {

		if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",($_GET['date']))) {

			if (($_GET['date']) >= date('Y-m-d')){
				$currentDay = $_GET['date'];
			} else {
				echo "Date cannot be in the past! Please pick a date that is today or future.";
				$currentDay = date('Y-m-d');
			}
		} else {
			echo "You typed an invalid date, please use YYYY-MM-DD format.";
			$currentDay = date('Y-m-d');
		}
		
	} else {
		$currentDay = date('Y-m-d');
	}
	
		$sQuery = "SELECT Events.Id, Vehicles.VehDesc, Events.Name, Events.Email, Events.StartTime, Events.EndTime FROM Events 
					JOIN Vehicles ON Vehicles.[VehId] = Events.[VehId]
					WHERE Date = '$currentDay' AND Active = 1 
					ORDER BY Events.StartTime ASC, Events.VehId ASC";
		$sResults = sqlsrv_query($conn, $sQuery, array(), array('Scrollable' => 'buffered')); //or die(print_r(sqlsrv_errors(), true));
	if ($sResults) {	
			if (sqlsrv_num_rows($sResults) > 0) {
				$table = '<table>';
				$table .= '<tr><th>Name</th><th>Email</th><th>Vehicle</th><th>Time Out</th><th>Time In</th></tr>';
				while ($row = sqlsrv_fetch_array($sResults)) {
					$timeOut = $row[4];
					$timeIn = $row[5];
						switch ($timeOut) {
							case "8.00": $sTime = '8:00 AM'; break;case "8.5": $sTime = '8:30 AM'; break;
							case "9.00": $sTime = '9:00 AM'; break;case "9.5": $sTime = '9:30 AM'; break;
							case "10.00": $sTime = '10:00 AM'; break;case "10.5": $sTime = '10:30 AM'; break;
							case "11.00": $sTime = '11:00 AM'; break;case "11.5": $sTime = '11:30 AM'; break;
							case "12.00": $sTime = '12:00 PM'; break;case "12.5": $sTime = '12:30 PM'; break;
							case "13.00": $sTime = '1:00 PM'; break;case "13.5": $sTime = '1:30 PM'; break;
							case "14.00": $sTime = '2:00 PM'; break;case "14.5": $sTime = '2:30 PM'; break;
							case "15.00": $sTime = '3:00 PM'; break;case "15.5": $sTime = '3:30 PM'; break;
							case "16.00": $sTime = '4:00 PM'; break;case "16.5": $sTime = '4:30 PM'; break;
							case "17.00": $sTime = '5:00 PM'; break;case "17.5": $sTime = '5:30 PM'; break;
							default: $sTime = 'ERROR'; break;
						} // Start Time conversion!
						switch ($timeIn) {
							case "8.00": $eTime = '8:00 AM'; break;case "8.5": $eTime = '8:30 AM'; break;
							case "9.00": $eTime = '9:00 AM'; break;case "9.5": $eTime = '9:30 AM'; break;
							case "10.00": $eTime = '10:00 AM'; break;case "10.5": $eTime = '10:30 AM'; break;
							case "11.00": $eTime = '11:00 AM'; break;case "11.5": $eTime = '11:30 AM'; break;
							case "12.00": $eTime = '12:00 PM'; break;case "12.5": $eTime = '12:30 PM'; break;
							case "13.00": $eTime = '1:00 PM'; break;case "13.5": $eTime = '1:30 PM'; break;
							case "14.00": $eTime = '2:00 PM'; break;case "14.5": $eTime = '2:30 PM'; break;
							case "15.00": $eTime = '3:00 PM'; break;case "15.5": $eTime = '3:30 PM'; break;
							case "16.00": $eTime = '4:00 PM'; break;case "16.5": $eTime = '4:30 PM'; break;
							case "17.00": $eTime = '5:00 PM'; break;case "17.5": $eTime = '5:30 PM'; break;
							default: $eTime = 'ERROR'; break;
						} // End Time conversion!
				$table .= '<tr><td>'.$row[2].'</td>
								<td>'.$row[3].'</td>
								<td><a href="http://server/intranet/adminEdit.php?id='.$row[0].'">'.$row[1].'</a></td>
								<td>'.$sTime.'</td>
								<td>'.$eTime.'</td></tr>';
				}
				$table .= '</table>';

			} else {	
				$table = 'There are no reservations for This day!';
			}  
	} else {
		echo 'There was a problem getting the data from the datebase, Please report this error to help desk!';
	}
//$newDate = date("m-d-Y", strtotime($currentDay));	
//$legend = $newDate . ' Editable Vehicle Schedules';
$legend = '<b>'.$currentDay.'</b> Editable Vehicle Schedules';
?>
<div style="width: 1024px; margin-left:auto; margin-right:auto">
<fieldset>
	<fieldset><legend><?php echo $legend; ?></legend>
		<?php
			echo $table;
		?>
	</fieldset>
	<hr />
		<fieldset style="display: block; width: 50%;margin-left:auto; margin-right:auto"><legend>Please input the date you'd like to view!</legend>
		<form action="" method="GET">
			<input type="date" name="date" value="" placeholder="YYYY-MM-DD" style="display: block; width: 50%; margin-left:auto; margin-right:auto"/>
			<br />
			<input type="submit" value="Submit" style="display: block; width: 25%; margin-left:auto; margin-right:auto" />
		</form>
	</fieldset>
</fieldset>	
</div>

<?php
include ('footer.php');
