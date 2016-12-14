<?php
/*****************
* Shane Workman : CarScheduler
* 10/27/2016
*****************/
$pageTitle = 'Vehicle Calender';
include ('header.php');
require ('dbConn.php');
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
	
	
	//Build line for Vehicle id 184 '13 Dodge Van Blue 052x488
	{
	$i = 8.0;
	$display = '<tr><td>#184 \'13 Dodge Van Blue 052x488</td>';
	while ($i < 17.4)
	{
		$query = "SELECT Id, Name FROM Events WHERE Active = 1 AND Date = '$currentDay' AND VehId = 184 AND ((StartTime <= $i) AND (EndTime > $i))";
		$results = sqlsrv_query($conn, $query, array(), array('Scrollable' => 'buffered'));
		if (sqlsrv_num_rows($results) > 0) {
			$row = sqlsrv_fetch_array($results);
			$display .= '<td><a href="http://server/intranet/info.php?id='.$row[0].'">'.$row[1].'</a></td>';
		} else {
			$display .= '<td><a href="http://server/intranet/reserve.php?date='.$currentDay.'&vehId=184" style="text-decoration: none; font-size:20px">* &nbsp &nbsp *</a></td>';
		}
		$i = $i + .5;
	}}
	//Build line for Vehicle id 200 '16 Ford Fusion Blue 052x484
	{
	$i = 8.0;
	$display .= '</tr><tr><td>#200 \'16 Ford Fusion Blue 052x484</td>';
	while ($i < 17.4)
	{
		$query = "SELECT Id, Name FROM Events WHERE Active = 1 AND Date = '$currentDay' AND VehId = 200 AND ((StartTime <= $i) AND (EndTime > $i))";
		$results = sqlsrv_query($conn, $query, array(), array('Scrollable' => 'buffered'));
		if (sqlsrv_num_rows($results) > 0) {
			$row = sqlsrv_fetch_array($results);
			$display .= '<td><a href="http://server/intranet/info.php?id='.$row[0].'">'.$row[1].'</a></td>';
		} else {
			$display .= '<td><a href="http://server/intranet/reserve.php?date='.$currentDay.'&vehId=200" style="text-decoration: none; font-size:20px">* &nbsp &nbsp *</a></td>';
		}
		$i = $i + .5;
	}}
	//Build line for Vehicle id 202 '16 Ford Fusion Gray 052x469
	{
	$i = 8.0;
	$display .= '</tr><tr><td>#202 \'16 Ford Fusion Gray 052x469</td>';
	while ($i < 17.4)
	{
		$query = "SELECT Id, Name FROM Events WHERE Active = 1 AND Date = '$currentDay' AND VehId = 202 AND ((StartTime <= $i) AND (EndTime > $i))";
		$results = sqlsrv_query($conn, $query, array(), array('Scrollable' => 'buffered'));
		if (sqlsrv_num_rows($results) > 0) {
			$row = sqlsrv_fetch_array($results);
			$display .= '<td><a href="http://server/intranet/info.php?id='.$row[0].'">'.$row[1].'</a></td>';
		} else {
			$display .= '<td><a href="http://server/intranet/reserve.php?date='.$currentDay.'&vehId=202" style="text-decoration: none; font-size:20px">* &nbsp &nbsp *</a></td>';
		}
		$i = $i + .5;
	}}
	//Build line for Vehicle id 203 '16 Ford Fusion Silver 052x489
	{
	$i = 8.0;
	$display .= '</tr><tr><td>#203 \'16 Ford Fusion Silver 052x489</td>';
	while ($i < 17.4)
	{
		$query = "SELECT Id, Name FROM Events WHERE Active = 1 AND Date = '$currentDay' AND VehId = 203 AND ((StartTime <= $i) AND (EndTime > $i))";
		$results = sqlsrv_query($conn, $query, array(), array('Scrollable' => 'buffered'));
		if (sqlsrv_num_rows($results) > 0) {
			$row = sqlsrv_fetch_array($results);
			$display .= '<td><a href="http://server/intranet/info.php?id='.$row[0].'">'.$row[1].'</a></td>';
		} else {
			$display .= '<td><a href="http://server/intranet/reserve.php?date='.$currentDay.'&vehId=203" style="text-decoration: none; font-size:20px">* &nbsp &nbsp *</a></td>';
		}
		$i = $i + .5;
	}}
	//Build line for Vehicle id 204 '16 Ford Fusion Blue 052x499
	{
	$i = 8.0;
	$display .= '</tr><tr><td>#204 \'16 Ford Fusion Blue 052x499</td>';
	while ($i < 17.4)
	{
		$query = "SELECT Id, Name FROM Events WHERE Active = 1 AND Date = '$currentDay' AND VehId = 204 AND ((StartTime <= $i) AND (EndTime > $i))";
		$results = sqlsrv_query($conn, $query, array(), array('Scrollable' => 'buffered'));
		if (sqlsrv_num_rows($results) > 0) {
			$row = sqlsrv_fetch_array($results);
			$display .= '<td><a href="http://server/intranet/info.php?id='.$row[0].'">'.$row[1].'</a></td>';
		} else {
			$display .= '<td><a href="http://server/intranet/reserve.php?date='.$currentDay.'&vehId=204" style="text-decoration: none; font-size:20px">* &nbsp &nbsp *</a></td>';
		}
		$i = $i + .5;
	}}
	//Build line for Vehicle id 205 '16 Ford Fusion Black 052x494
	{
	$i = 8.0;
	$display .= '</tr><tr><td>#205 \'16 Ford Fusion Black 052x494</td>';
	while ($i < 17.4)
	{
		$query = "SELECT Id, Name FROM Events WHERE Active = 1 AND Date = '$currentDay' AND VehId = 205 AND ((StartTime <= $i) AND (EndTime > $i))";
		$results = sqlsrv_query($conn, $query, array(), array('Scrollable' => 'buffered'));
		if (sqlsrv_num_rows($results) > 0) {
			$row = sqlsrv_fetch_array($results);
			$display .= '<td><a href="http://server/intranet/info.php?id='.$row[0].'">'.$row[1].'</a></td>';
		} else {
			$display .= '<td><a href="http://server/intranet/reserve.php?date='.$currentDay.'&vehId=205" style="text-decoration: none; font-size:20px">* &nbsp &nbsp *</a></td>';
		}
		$i = $i + .5;
	}}
	//Build line for Vehicle id 206 '16 Handicap Van Red 052x502
	{
	$i = 8.0;
	$display .= '</tr><tr><td>#206 \'16 Handicap Van Red 052x502</td>';
	while ($i < 17.4)
	{
		$query = "SELECT Id, Name FROM Events WHERE Active = 1 AND Date = '$currentDay' AND VehId = 206 AND ((StartTime <= $i) AND (EndTime > $i))";
		$results = sqlsrv_query($conn, $query, array(), array('Scrollable' => 'buffered'));
		if (sqlsrv_num_rows($results) > 0) {
			$row = sqlsrv_fetch_array($results);
			$display .= '<td><a href="http://server/intranet/info.php?id='.$row[0].'">'.$row[1].'</a></td>';
		} else {
			$display .= '<td><a href="http://server/intranet/reserve.php?date='.$currentDay.'&vehId=206" style="text-decoration: none; font-size:20px">* &nbsp &nbsp *</a></td>';
		}
		$i = $i + .5;
	}}
	//Build line for Vehicle id 208 '16 Ford Fusion Blue 052x467
	{
	$i = 8.0;
	$display .= '</tr><tr><td>#208 \'16 Ford Fusion Blue 052x467</td>';
	while ($i < 17.4)
	{
		$query = "SELECT Id, Name FROM Events WHERE Active = 1 AND Date = '$currentDay' AND VehId = 208 AND ((StartTime <= $i) AND (EndTime > $i))";
		$results = sqlsrv_query($conn, $query, array(), array('Scrollable' => 'buffered'));
		if (sqlsrv_num_rows($results) > 0) {
			$row = sqlsrv_fetch_array($results);
			$display .= '<td><a href="http://server/intranet/info.php?id='.$row[0].'">'.$row[1].'</a></td>';
		} else {
			$display .= '<td><a href="http://server/intranet/reserve.php?date='.$currentDay.'&vehId=208" style="text-decoration: none; font-size:20px">* &nbsp &nbsp *</a></td>';
		}
		$i = $i + .5;
	}}
	
	?>
<div style="width: 1024px; margin-left:auto; margin-right:auto">
	<fieldset>	
		<div>
			<?php echo '<a href="http://server/intranet/index.php?date='.$previousDay.'">Previous Day</a><a href="http://server/intranet/index.php?date='.$nextDay.'" style="float:right">Next Day</a>';	?>
		</div>
		<h1 style="width: 20%; margin-left:auto; margin-right:auto"> <?php echo $currentDay; ?> </h1>
	<div>
			<br /><br />
			<label>* = Available</label><a href="http://server/intranet/reserve.php" style="float:right;">Reserve a Car</a>
			<table class="Alpha">
				<tr>
					<th>Vehicle</th><th>8:00</th><th>8:30</th><th>9:00</th><th>9:30</th><th>10:00</th><th>10:30</th><th>11:00</th><th>11:30</th><th>12:00</th><th>12:30</th><th>1:00</th>
					<th>1:30</th><th>2:00</th><th>2:30</th><th>3:00</th><th>3:30</th><th>4:00</th><th>4:30</th><th>5:00</th>
				</tr>
				<?php echo $display; ?>
			</table>		
			<br /><br />
	</div>	
		<fieldset style="display: block; width: 50%; margin-left:auto; margin-right:auto"><legend>Please input the date you'd like to view!</legend>
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