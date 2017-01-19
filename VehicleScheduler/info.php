<?php
/******************************
* Shane Workman : Car Scheduler.
* 11/2/2016
******************************/
$pageTitle = 'Reservation Info';
include ('header.php');
require ('dbConn.php');
include ('functions.php');
// some variables to set for header links
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
		$backToAvail = '<a href="http://server05116/Intranet/VehicleScheduler/index.php?date='.$date.'">Back</a>';
	} else {
		echo 'There was an Error Accessing the database or due to a broken link. Please email IT<br />';
		echo 'Please <a style="float:right" href="http://server05116/Intranet/VehicleScheduler/index.php">Click Here</a> to return to the availability page and try again!';
	}
	
	
?>
<div style="width: 1024px; margin-left:auto; margin-right:auto">
	<fieldset>
		<?php echo $backToAvail?>
		<h1>Reservation Info</h1>
		<table class="Bravo">
			<?php echo $table; ?>
		</table>
		<fieldset>
			<legend>Need to Bump this person?</legend>
			<form action="http://server05116/Intranet/VehicleScheduler/handleBump.php" method="POST">
				<div style="float:left; display:block; width:48%">
				<input type="hidden" type="text" name="oldId" value="<?php echo $resId ?>" />
				<input type="hidden" type="text" name="vehId" value="<?php echo $vehId ?>" />
				<input type="hidden" type="text" name="oldPriorId" value="<?php echo $priorId ?>" />
				<input type="hidden" type="text" name="oldEmail" value="<?php echo $email ?>" />
				<label>Date:</label>
				<input readonly type="date" name="date" value="<?php echo $date ?>" /><br />
				<label>*Your Name:</label>
				<?php echo EmpSelect(); ?>
				<label>*Your Email:</label>
				<input type="text"placeholder="your.name@nlcmh.org" name="email" value="" /><br />
				<label>*Time Out:</label>
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
						</select><br />
				<label>*Time In&nbsp  :</label>
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
						</select>
				<textarea name="notes" style="width:95%" placeholder="*NOTES: Destination, Miles, Why you need to bump??"></textarea>
				<label>* denotes required fields!</label>
				</div>
				<div style="float:left; display:block; width: 52%;">
					<fieldset> <legend>*New Priority:</legend>
						<input type="radio" name="priority" value="1" />1 : Client Transport(Long Distance)<br />
						<input type="radio" name="priority" value="2" />2 : Client Transport (Local)<br />
						<input type="radio" name="priority" value="3" />3 : Medicine Delivery<br />
						<input type="radio" name="priority" value="4" />4 : Conference(Long Distance)<br />
						<input type="radio" name="priority" value="5" checked="checked" />5 : Administrative<br />
					</fieldset>
				</div>
				<div style="float:right">
				<input type="submit" value="Bump" />
				</div>
			</form>
		</fieldset>
		<br style="clear: right; clear: left;" />
		<p>If you bump, an Email will be sent to the current registered user, as well as adminstration.<br />
		Bumping is based on Priority, you must have a higher priority than the current user.</p><br />
		<p style="text-align: center"><b><i>BEFORE YOU BUMP SOMEONE, PLEASE CHECK WITH WAIVER TEAM FOR THEIR CAR.</i></b></p><br />
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