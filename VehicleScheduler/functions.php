<?php
/*****************
* Shane Workman : CarScheduler
* 01/03/2016
*****************/

	function Display ($vehId, $currentDay) {
		global $display;
		global $conn;
		$aQuery = "SELECT Active, VehDesc FROM Vehicles WHERE VehId = $vehId;";
		$results = sqlsrv_query($conn, $aQuery, array(), array('Scrollable' => 'buffered'));
		$row = sqlsrv_fetch_array($results);
		$active = $row[0];
		$vehDesc = $row[1];
		if ($active == 1) {	
			$i = 8.0;
			$display .='<tr><td>#'.$vehId.' '.$vehDesc.'</td>';
			while ($i < 17.4) {		
				$query = "SELECT Events.Id, Events.Name FROM Events WHERE Events.Active = 1 AND Date = '$currentDay' AND VehId = $vehId AND ((StartTime <= $i) AND (EndTime > $i))";
				$results = sqlsrv_query($conn, $query, array(), array('Scrollable' => 'buffered'));
				if (sqlsrv_num_rows($results) > 0) {
					$row = sqlsrv_fetch_array($results);
					$display .= '<td><a href="http://server05116/Intranet/VehicleScheduler/info.php?id='.$row[0].'">'.$row[1].'</a></td>';
				} else {
					$display .= '<td><a href="http://server05116/Intranet/VehicleScheduler/reserve.php?date='.$currentDay.'&vehId='.$vehId.'" style="text-decoration: none; font-size:20px">******</a></td>';
				}
				$i += .5;
			}
		} else {
			$display .= '<tr><td>'.$vehDesc.'</td><td colspan="19" align="center"><font color="red">AT FOX FOR MAINTENANCE</font></td></tr>';
		}			
		return $display;
	}
	
	function VehSelect ($vehId) {
		global $conn;
		$vehDisplay = '<select name="vehicleId">';
		$vQuery = "SELECT VehId, VehDesc FROM Vehicles WHERE Active = 1;";
		$results = sqlsrv_query($conn, $vQuery, array(), array('Scrollable' => 'buffered'));
		while ($row = sqlsrv_fetch_array($results)) {
			if ($vehId == $row[0]) {
				$vehDisplay .= '<option selected value="'.$row[0].'">#'.$row[0].' '.$row[1].'</option>';
			} else {
				$vehDisplay .= '<option value="'.$row[0].'">#'.$row[0].' '.$row[1].'</option>';
			}	
		}
		$vehDisplay .='</select> <br />';
		return $vehDisplay;
	}
	
	function EmpSelect () {
		global $conn;
		$eDisplay = '<select name="empId">';
		$eQuery = "SELECT employee, lastname, firstname FROM employee_info ORDER BY lastname ASC;";
		$results = sqlsrv_query($conn, $eQuery, array(), array('Scrollable' => 'buffered'));
		while ($row = sqlsrv_fetch_array($results)) {
				$eDisplay .= '<option value="'.$row[0].'">'.$row[0].' '.$row[1].', '.$row[2].'</option>';	
		}
		$eDisplay .='</select> <br />';
		return $eDisplay;
	}
	
	function ConvertTime($time) {
		switch ($time) {
			case "8.00": $rTime = '8:00 AM'; break;case "8.5": $rTime = '8:30 AM'; break;
			case "9.00": $rTime = '9:00 AM'; break;case "9.5": $rTime = '9:30 AM'; break;
			case "10.00": $rTime = '10:00 AM'; break;case "10.5": $rTime = '10:30 AM'; break;
			case "11.00": $rTime = '11:00 AM'; break;case "11.5": $rTime = '11:30 AM'; break;
			case "12.00": $rTime = '12:00 PM'; break;case "12.5": $rTime = '12:30 PM'; break;
			case "13.00": $rTime = '1:00 PM'; break;case "13.5": $rTime = '1:30 PM'; break;
			case "14.00": $rTime = '2:00 PM'; break;case "14.5": $rTime = '2:30 PM'; break;
			case "15.00": $rTime = '3:00 PM'; break;case "15.5": $rTime = '3:30 PM'; break;
			case "16.00": $rTime = '4:00 PM'; break;case "16.5": $rTime = '4:30 PM'; break;
			case "17.00": $rTime = '5:00 PM'; break;case "17.5": $rTime = '5:30 PM'; break;
			default: $rTime = 'ERROR'; break;
		} // End Time conversion!
		return $rTime;
	}
	
?>