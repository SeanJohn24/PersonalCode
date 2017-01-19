<?php
/********************************
* Shane Workman : Vehicle Scheduler
* 11/21/2016
********************************/
$pageTitle = 'Admin Edit';
include ('header.php');
require ('dbConn.php');
include ('functions.php');
					session_start();
					if (!isset($_SESSION['Username'])) {
						header('Location: http://server05116/Intranet/VehicleScheduler/logout.php'); 
						exit();
					} session_write_close();

if (isset($_GET['id'])) {
		$resId = $_GET['id'];
	} else {
		echo 'There was an Error Accessing the database or due to a broken link. Please email IT<br />';
		echo 'Please <a href="http://server05116/Intranet/VehicleScheduler/index.php">Click Here</a> to return to the availability page.';
	}

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
		$table = '<tr><td>Date:</td><td>'.$date.'</td></tr>';
		$table .= '<tr><td>Assigned to:</td><td>'.$name.'</td></tr>';
		$table .= '<tr><td>Email:</td><td>'.$email.'</td></tr>';
		$table .= '<tr><td>Vehicle:</td><td>#'.$vehId.' '.$vehDesc.'</td></tr>';
		$table .= '<tr><td>Priority:</td><td>'.$priorId.' : '.$priorDesc.'</td></tr>';
		$table .= '<tr><td style="font-weight:normal; !Important;"><b>Time Out:</b> '.$sTime.'</td><td><b>Time In:</b> '.$eTime.'</td></tr>';
		$table .= '<tr><td style="text-align: left; font-weight:normal;width:400px !Important;" colspan=2>Notes: <br />'.$notes.'</td></tr>';
		$backToAvail = '<a href="http://server05116/Intranet/VehicleScheduler/admin.php?date='.$date.'">Back</a>';
	} else {
		echo 'There was an Error Accessing the database or due to a broken link. Please email IT<br />';
		echo 'Please <a style="float:right" href="http://server05116/Intranet/VehicleScheduler/index.php">Click Here</a> to return to the availability page and try again!';
	}
?>
<div style="width: 1024px; margin-left:auto; margin-right:auto">
	<fieldset>
			<?php echo $backToAvail;?>
			<h1>Reservation Info</h1>
			<table class="Bravo">
				<?php echo $table; ?>
			</table>
		<fieldset>
			<form action="http://server05116/Intranet/VehicleScheduler/adminChange.php" method="post">
				<label><input type="checkbox" id="show_textbox" name="changeCheckOut" />Change check out time? :
							<select name="timeOut">
								<option value="8.00">8:00 AM</option><option value="8.5">8:30 AM</option>
								<option value="9.00">9:00 AM</option><option value="9.5">9:30 AM</option>
								<option value="10.00">10:00 AM</option><option value="10.5">10:30 AM</option>
								<option value="11.00">11:00 AM</option><option value="11.5">11:30 AM</option>
								<option value="12.00">12:00 PM</option><option value="12.5">12:30 PM</option>
								<option value="13.00">1:00 PM</option><option value="13.5">1:30 PM</option>
								<option value="14.00">2:00 PM</option><option value="14.5">2:30 PM</option>
								<option value="15.00">3:00 PM</option><option value="15.5">3:30 PM</option>
								<option value="16.00">4:00 PM</option><option value="16.5">4:30 PM</option>
								<option value="17.00">5:00 PM</option><option value="17.50">5:30 PM</option>
							</select></label> <br />
				<label><input type="checkbox"  id="show_textbox"name="changeCheckIn" />Change check in time? &nbsp :
							<select name="timeIn">
								<option value="8.00">8:00 AM</option><option value="8.5">8:30 AM</option>
								<option value="9.00">9:00 AM</option><option value="9.5">9:30 AM</option>
								<option value="10.00">10:00 AM</option><option value="10.5">10:30 AM</option>
								<option value="11.00">11:00 AM</option><option value="11.5">11:30 AM</option>
								<option value="12.00">12:00 PM</option><option value="12.5">12:30 PM</option>
								<option value="13.00">1:00 PM</option><option value="13.5">1:30 PM</option>
								<option value="14.00">2:00 PM</option><option value="14.5">2:30 PM</option>
								<option value="15.00">3:00 PM</option><option value="15.5">3:30 PM</option>
								<option value="16.00">4:00 PM</option><option value="16.5">4:30 PM</option>
								<option value="17.00">5:00 PM</option><option value="17.50">5:30 PM</option>
							</select></label> <br />
						<input hidden type="text" name="resId" value="<?php echo $resId;?>" />
				<label><input type="checkbox" name="cancel" />Cancel Reservation</label>
				<div style="float:right">
				<input type="submit" value="Submit" />
				</div>
			</form>	
		</fieldset>
	</fieldset>	
</div>
<?php
include ('footer.php');
?>