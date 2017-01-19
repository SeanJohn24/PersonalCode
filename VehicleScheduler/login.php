<?php
/********************************
* Shane Workman : Vehicle Scheduler
* 11/21/2016
********************************/
$pageTitle = 'Login';
include ('header.php');
require ('dbConn.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$errors = '';
	if (isset($_POST['username'])) {
		$user = $_POST['username'];
	} else {
		$errors .= 'You did not enter a username!<br />';
	}
	if (isset($_POST['password'])) {
		$pass = hash('sha256', $_POST['password']);
	} else {
		$errors .= 'You did not enter a password!<br />';
	}
		$iQuery = "SELECT * FROM Users WHERE Username = '$user' AND Password = '$pass';";
		$results = sqlsrv_query($conn, $iQuery, array(), array('Scrollable' => 'buffered'));
		
		if (sqlsrv_num_rows($results) > 0) {
			session_start();
			$_SESSION['Username']= $user;
			header('Location: http://server05116/Intranet/VehicleScheduler/adminMain.php'); 
						exit();
		} else {
			$errors .= 'Your Username or Password did not match what we have on file. If you believe this a mistake contact helpdesk!';
		}
	if ($errors != '') {
		echo $errors;
	}
} else {
	// NOT A POST... NOT SURE IF WE NEED ANYTHING HERE UNLESS BUILDING FORM IN PHP!
}

?>
<div style="width: 1024px; margin-left:auto; margin-right:auto">
	<fieldset>
		<div style="width:256px; margin-left:auto; margin-right:auto" >
			<form action="" method="POST">
				<label> Username:<br />
				<input type="text" name="username" /> </label><br /><br />
				<label> Password&nbsp: <br />
				<input type="password" name="password"/> </label> <br /> <br />
				<div style="width:50%;margin-left:auto; margin-right:auto">
				<input type="submit" value="Login" />
				</div>
			</form>
		</div>
	</fieldset>
</div>
<?php
include ('footer.php');
?>
