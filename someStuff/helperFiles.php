<?php
/******************************************
* A few helper funcitons to use for this project.
*
*Created: 10/21/2016
*******************************************/

function tableRowGeneratorWithButtons($selectQuery, $headerCounter) {
		$tableBody = '';
		$idCounter = 0;
		while ($row = sqlsrv_fetch_array($selectQuery)) {
			$tableBody = $tableBody . "<tr>";
			for($a = 0;$a < $headerCounter;$a++) {
				$tableBody = $tableBody . "<td>{$row[$a]}</td>";
			}

			$tableBody = $tableBody . "</tr>";
		}
		return $tableBody;
}

		
	function tableRowLinkGenerator($idSelectQuery, $pageName, $variableName, $title) {
		$editButton = array();
		while ($ids = sqlsrv_fetch_array($idSelectQuery)) {
			for($a = 0;$a < count($ids);$a++) {
					$button = '<td><a href=\'http://server/Intranet/displayContents.php?=' . $a .'>Deactivate</a></td>';
					array_push($editButton, $button);
			}
		}
		return $editButton;
	}

?>