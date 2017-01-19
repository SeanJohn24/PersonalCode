<?php
/********************************
* Shane Workman : Vehicle Scheduler
* 12/21/2016
********************************/
$pageTitle = 'Vehicle List';
include ('header.php');
require ('dbConn.php');

					session_start();
					if (!isset($_SESSION['Username'])) {
						header('Location: http://server05116/Intranet/VehicleScheduler/logout.php'); 
						exit();
					} session_write_close();


		if (isset($_GET['VehId']) && isset($_GET['Action'])) {
			$selectId = $_GET['VehId'];
			$action = $_GET['Action'];
			$dQuery = "UPDATE Vehicles SET Active = 0 WHERE VehId = $selectId ;";
			$aQuery = "UPDATE Vehicles SET Active = 1 WHERE VehId = $selectId ;";
			if ($action == 'Activate') {
				if(sqlsrv_query($conn, $aQuery)) {				
					header('Location: vehicleList.php');
				} else {
					echo "If you see this message, Activate query failed. Please report this to help.desk.";
				}
			} elseif ($action == 'Deactivate') {
				if(sqlsrv_query($conn, $dQuery)) {				
					header('Location: vehicleList.php');
				} else {
					echo "If you see this message, Deactivate query failed. Please report this to help.desk.";
				}
			} else {
				echo "Action was set, but still caused an error. Please report this error to help.desk";
			}
		}

	$table = '<tr><th>Vehicle Number</th><th>Vehicle Description</th><th>Active</th><th colspan="2">Action</th></tr>';		
	$query = "SELECT VehId, VehDesc, Active FROM Vehicles";
	$results = sqlsrv_query($conn, $query, array(), array('Scrollable' => 'buffered'));
	while ($row = sqlsrv_fetch_array($results)) {
		if ($row[2] == 1){
			$active = 'Yes';
		} else {
			$active = 'No';
		}		
		$table .= '<tr>';
					$table .= '<td># '.$row[0].'</td>';
					$table .= '<td>'.$row[1].'</td>';
					$table .= '<td>'.$active.'</td>';
					$table .= '<td><a href="http://server05116/Intranet/VehicleScheduler/vehicleList.php?VehId='.$row[0].'&Action=Activate">Activate</a></td>';
					$table .= '<td><a href="http://server05116/Intranet/VehicleScheduler/vehicleList.php?VehId='.$row[0].'&Action=Deactivate">Deactivate</a></td>';
					$table .= '</tr>';
	}	
		
?>
<div style="width: 1024px; margin-left:auto; margin-right:auto">
	<fieldset>
		<h3><u>Current Vehicle List</u></h3>
		<table>
			<?php echo $table; ?>
		</table>
	</fieldset>
</div>
<?php
include ('footer.php');
?>  