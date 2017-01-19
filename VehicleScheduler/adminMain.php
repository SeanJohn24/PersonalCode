<?php
/*****************
* Shane Workman : CarScheduler
* 01/04/2016
*****************/
$pageTitle = 'Administrative Page';
include ('header.php');
require ('dbConn.php');
include ('functions.php');

?>
<div style="width: 1024px; margin-left:auto; margin-right:auto">
	<fieldset>
	<h3><u>Administrative Options</u></h3>
<a href='http://server05116/Intranet/VehicleScheduler/admin.php'>Edit Reservations</a>
<a style="float:right" href='http://server05116/Intranet/VehicleScheduler/changePass.php'>Change Password</a><br />
<a href='http://server05116/Intranet/VehicleScheduler/milage.php'>Enter Milage</a><br />
<a href='http://server05116/Intranet/VehicleScheduler/vehicleList.php'>Vehicle List</a><br />
	</fieldset>
</div>
<?php
include ('footer.php');
?>