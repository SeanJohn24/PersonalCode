<?php
/********************************
* Shane Workman : Vehicle Scheduler
* 12/07/2016
********************************/
$pageTitle = 'Change Password';
include ('header.php');
require ('dbConn.php');
					
					session_start();
					if (!isset($_SESSION['Username'])) {
						header('Location: http://server/intranet/logout.php'); 
						exit();
					} session_write_close();

$errors ='';
$post = '';				
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$user = $_SESSION['Username'];
	if (!empty($_POST['oPassword'])){
		$oPass = hash('sha256', $_POST['oPassword']);
	} else {
		$errors .= 'You need to put in your Old Password before we can change it.<br />';
		$oPass = '';
	}
	if (!empty($_POST['nPassword'])){
		$nPass = hash('sha256', $_POST['nPassword']);
	} else {
		$errors .= 'You need to put in your New Password before we can change it.<br />';
		$nPass = '';
	}
	if (!empty($_POST['cPassword'])){
		$cPass = hash('sha256', $_POST['cPassword']);
	} else {
		$errors .= 'You need to Confirm your New Password before we can change it. <br />';
		$cPass = '';
	}
	if ($nPass == $cPass) {
		$iQuery = "SELECT Id FROM Users WHERE Username = '$user' AND Password = '$oPass';";
		$results = sqlsrv_query($conn, $iQuery, array(), array('Scrollable' => 'buffered'));
		if (sqlsrv_num_rows($results) > 0) {
			$row = sqlsrv_fetch_array($results);
			$userId = $row[0];
			$uQuery = "UPDATE Users SET Password='$nPass' WHERE Id = $userId;";
			if (sqlsrv_query($conn, $uQuery)) {
				$post = 'Your Password has sucessfully been updated!';
			} else {
				$errors .= 'There was an issue with the database updating your password, please inform helpdesk with as much detail as possible.';
				$errors .= 'Please correct these errors and try again!';	
			}	
		} else {
			$errors .= 'Your old Password did not match what we have on file!';
		}		
	} else {
		$errors .= 'New Password and Confirm Password must be that same!<br />';
	}
		
	// Build the form incase there are errors to post!
	$form = '<div style="width:256px; margin-left:auto; margin-right:auto" >';
	$form .='<form action="" method="POST">';
	$form .='<label> Username:<br />';
	$form .='<input readonly type="text" name="username" value="'.$_SESSION['Username'].'"/> </label><br /><br />';
	$form .='<label>Old Password&nbsp: <br />';
	$form .='<input type="password" name="oPassword"/> </label> <br /> <br />';
	$form .='<label>New Password&nbsp: <br />';
	$form .='<input type="password" name="nPassword"/> </label> <br /> <br />';
	$form .='<label>Confirm Password&nbsp: <br />';
	$form .='<input type="password" name="cPassword"/> </label> <br /> <br />';
	$form .='</div>';
	$form .='<div style="float:right;">';
	$form .='<input type="submit" value="Change Password" />';
	$form .='</div>';
	$form .='</form>';
} else {
	$form = '<div style="width:256px; margin-left:auto; margin-right:auto" >';
	$form .='<form action="" method="POST">';
	$form .='<label> Username:<br />';
	$form .='<input readonly type="text" name="username" value="'.$_SESSION['Username'].'"/> </label><br /><br />';
	$form .='<label>Old Password&nbsp: <br />';
	$form .='<input type="password" name="oPassword"/> </label> <br /> <br />';
	$form .='<label>New Password&nbsp: <br />';
	$form .='<input type="password" name="nPassword"/> </label> <br /> <br />';
	$form .='<label>Confirm Password&nbsp: <br />';
	$form .='<input type="password" name="cPassword"/> </label> <br /> <br />';
	$form .='</div>';
	$form .='<div style="float:right;">';
	$form .='<input type="submit" value="Change Password" />';
	$form .='</div>';
	$form .='</form>';
}				

?>
<div style="width: 1024px; margin-left:auto; margin-right:auto">
	<fieldset>
		<?php
			if (empty($post)) {
				echo $form;
			} elseif(!empty($errors)) {
				echo $errors . '<br />' . $form;
			} else {
				echo $post;
			}
		?>
	</fieldset>
</div>
<?php
include ('footer.php');
?>
