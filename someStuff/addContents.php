<?php
/*************************************
* Page to display the contents of the table. Activate and Deactivate emails.
*
*Create: 10/21/2016
*
**************************************/
$page_title = 'Add Contents';
include ("header.php");
include ("helperFiles.php");
require ("dbconn.php");
/*
if (isset($_GET['ID'])) {
	$selectId = $_GET['ID'];
	$dQuery = "UPDATE PHISHING SET Active = 0 WHERE ID = $selectId";
	if (sqlsrv_query($conn, $dQuery))
		header('location: displayContents.php');		
	else
		echo 'If this shows, tell Shane to fix me!';
	
}
*/
IF ($_SERVER['REQUEST_METHOD'] == 'POST') {
		
	if (empty($_POST['email'])) {
		echo "You didn't enter an email!";
	} else {
		$today = date('y-m-d');
		$email = $_POST['email'];
		$iQuery = "INSERT INTO PhishingInfo (Email, Date, Active) VALUES ('$email', '$today' , 1);";
		$exc = sqlsrv_query($conn, $iQuery);
	}
	
	$bQuery = "SELECT ID, Email, Date FROM PhishingInfo WHERE Active= 1 ORDER BY ID";
	//$idQuery = "SELECT ID FROM PhishingInfo WHERE Active= 1 ORDER BY ID";
	$run = sqlsrv_query($conn, $bQuery);
	//$iRun = sqlsrv_query($conn, $idQuery);
	$pageNames = array ('displayContents.php');
	$varName = array('ID');
	$titles = array ('deactivate');
	$hCounter = sqlsrv_num_fields ($run);
	//$editButton = tableRowLinkGenerator($iRun, $pageNames, $varName, $titles);
	$tableBody = tableRowGeneratorWithButtons($run, $hCounter);
} else {
	
	$bQuery = "SELECT ID, Email, Date FROM PhishingInfo WHERE Active= 1 ORDER BY ID";
	//$idQuery = "SELECT ID FROM PhishingInfo WHERE Active = 1 ORDER BY ID";
	$run = sqlsrv_query($conn, $bQuery);
	//$iRun = sqlsrv_query($conn, $idQuery);
	$pageNames = array('displayContents.php');
	$varName = array('ID');
	$titles = array('deactivate');
	$hCounter = sqlsrv_num_fields ($run);
	//$editButton = tableRowLinkGenerator($iRun, $pageNames, $varName, $titles);
	$tableBody = tableRowGeneratorWithButtons($run, $hCounter);
	
}
?>

<h1>Emails in DB</h1>
<fieldset>
		<table>
			<tr>
				<th>Email</th>
				<th>Date</th>
			</tr>
		 <?php echo $tableBody; ?> 
		</table>
</fieldset>
<h1>Insert New Mark</h1>
<fieldset>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"  method="post">
			<p>Email: <input type="text" name="email" size="15" maxlength="50"  /></p>
			<p>* All fields required.</p>
			<p><input type="submit" value="Submit" class="button3"</p>
	</form>		
</fieldset>

<?php
include ("footer.php");
?>