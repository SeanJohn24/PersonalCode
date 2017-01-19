<?php
/********************************
* Shane Workman : Vehicle Scheduler
* 11/17/2016
********************************/
$pageTitle = 'Edit Reservations';
include ('header.php');
require ('dbConn.php');
include ('functions.php');
$table = '//This should never show!';
					session_start();
					if (!isset($_SESSION['Username'])) {
						header('Location: http://server05116/Intranet/VehicleScheduler/logout.php'); 
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
					JOIN Vehicles ON Vehicles.VehId = Events.VehId
					WHERE Date = '$currentDay' AND Events.Active = 1 
					ORDER BY Events.StartTime ASC, Events.VehId ASC";
		$sResults = sqlsrv_query($conn, $sQuery, array(), array('Scrollable' => 'buffered')); //or die(print_r(sqlsrv_errors(), true));
	if ($sResults) {	
			if (sqlsrv_num_rows($sResults) > 0) {
				$table = '<table>';
				$table .= '<tr><th>Name</th><th>Email</th><th>Vehicle</th><th>Time Out</th><th>Time In</th></tr>';
				while ($row = sqlsrv_fetch_array($sResults)) {					
					$sTime = ConvertTime($row[4]);
					$eTime = ConvertTime($row[5]);
				$table .= '<tr><td>'.$row[2].'</td>
								<td>'.$row[3].'</td>
								<td><a href="http://server05116/Intranet/VehicleScheduler/adminEdit.php?id='.$row[0].'">'.$row[1].'</a></td>
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
$legend = '<b>'.$currentDay.'</b> Editable Reservations';
?>
<div style="width: 1024px; margin-left:auto; margin-right:auto">
<fieldset>
	<fieldset><legend><?php echo $legend; ?></legend>
		<?php
			echo $table;
		?>
	</fieldset>
	<hr />
		<fieldset class="search" ><legend>Please input the date you'd like to view!</legend>
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
