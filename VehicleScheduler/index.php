<?php
/*****************
* Shane Workman : CarScheduler
* 10/27/2016
*****************/
$pageTitle = 'Vehicle Calendar';
include ('header.php');
require ('dbConn.php');
include ('functions.php');
// some variables to set for header links
	if (isset($_GET['date'])) {
		if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",($_GET['date']))) {
			$currentDay = $_GET['date'];
		} else {
			echo "You typed an invalid date, please use YYYY-MM-DD format.";
			$currentDay = date('Y-m-d');
		}
		
	} else {
		$currentDay = date('Y-m-d');
	}
	$previousDay = date('Y-m-d',strtotime($currentDay . "-1 days"));
	$nextDay = date('Y-m-d',strtotime($currentDay . "+1 days"));
	$display = '';
	
	$vQuery = "SELECT VehId FROM Vehicles";
	$results = sqlsrv_query($conn, $vQuery, array(), array('Scrollable' => 'buffered'));
	while ($row = sqlsrv_fetch_array($results)) {
		Display($row[0], $currentDay);
	}

	?>
<div style="width: 1350px; margin-left:auto; margin-right:auto">
	<fieldset>	
		<div>
			<?php echo '<a href="http://server05116/Intranet/VehicleScheduler/index.php?date='.$previousDay.'">Previous Day</a><a href="http://server05116/Intranet/VehicleScheduler/index.php?date='.$nextDay.'" style="float:right">Next Day</a>';	?>
		</div>
		<h1 style="width: 20%; margin-left:auto; margin-right:auto"> <?php echo $currentDay; ?> </h1>
	<div>
			<br /><br />
			<label>****** = Available</label><a href="http://server05116/Intranet/VehicleScheduler/reserve.php" style="float:right;">Reserve a Car</a>
			<table class="Alpha">
				<tr>
					<th></th><th>8:00- 8:30</th><th>8:30- 9:00</th><th>9:00- 9:30</th><th>9:30- 10:00</th><th>10:00- 10:30</th><th>10:30- 11:00</th><th>11:00- 11:30</th><th>11:30- 12:00</th><th>12:00- 12:30</th><th>12:30- 1:00</th><th>1:00- 1:30</th>
					<th>1:30- 2:00</th><th>2:00- 2:30</th><th>2:30- 3:00</th><th>3:00- 3:30</th><th>3:30- 4:00</th><th>4:00- 4:30</th><th>4:30- 5:00</th><th>5:00- 5:30</th>
				</tr>
				<?php echo $display; ?>
			</table>		
			<br /><br />
	</div>	
		<fieldset class="search"><legend>Please input the date you'd like to view!</legend>
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
?>	