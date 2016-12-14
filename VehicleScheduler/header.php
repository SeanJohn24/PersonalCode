<?php
/****************
* Shane Workman : For CarScheduler.
* 10/27/2016 - 
****************/
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title><?php echo $pageTitle; ?> </title>
		<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
		<meta name='viewport' content='width=device-width, initial-scale=1.0'>
		
		<style>
			.Alpha {
				border: 1px solid black;
				table-layout: fixed;
				<!-- width:990px; -->
				empty-cells: show;
				}
			.Alpha td:first-child{
				font-weight:bold;
				width: 60px;
			}
			.Bravo {
				border: 1px solid black;
				table-layout: fixed;
				empty-cells: show;
				display: block;
				float: left;
				width: 400px;
				
			}
			.Bravo td:first-child {
				text-align: right;
				font-weight:bold;
			}
			th, td{
				border: 1px solid black;
				overflow: hidden;				
			}
			#show_textbox:not(:checked) + select {display:none;}
		</style>
	</head>
	
	<body>
			<?php 
				session_start();
					if (isset($_SESSION['Username'])) {
						echo "	
							<div style='width: 1024px; margin-left: auto; margin-right:auto'>
							<img src='Graphics/header.jpg' />
							<h1 style='float:right'> Vehicle Schedules </h1> <br />
							<p> Hello, {$_SESSION['Username']}<a style='float:right' href='http://server/intranet/logout.php'>Logout</a><br />
							<a href='http://server/intranet/admin.php'>Administrative Page</a><a style='float:right' href='http://server/intranet/changePass.php'>Change Password</a></p>
							</div> 
							<br style='clear: right; clear: left;' /> ";
					} else {
						echo '	
							<div style="width: 1024px; margin-left: auto; margin-right:auto">
							<img src="Graphics/header.jpg" />
							<h1 style="float:right"> Vehicle Schedules </h1> <br />
							<a style="float:right" href="http://server/intranet/login.php">Admin-Login</a>
							</div> 
							<br style="clear: right; clear: left;" /> ';
					} 
				session_write_close();
			
			?>

	<!-- Start of page specific Content!!! -->

	