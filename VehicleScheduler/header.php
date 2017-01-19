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
			body {
				background-color: #dcdcc6;	
			}
			.Alpha {
				width:990px;
				}
			.Alpha td:first-child{
				font-weight:bold;
				width: 10%;
			}
			.Alpha th {
				overflow: hidden;
				word-wrap: break-word;
				overflow-wrap: break-word;

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
			td, th{
				border: 1px solid black;					
			}
			fieldset {
				boarder: Solid 1px  #000000;
				background-color:  #FFFFFF !important;
			}
			.search {
				boarder: Solid 1px  #000000;
				background-color:  #dcdcc6 !important;
				display: block; 
				width: 50%; 
				margin-left:auto; 
				margin-right:auto;
			}
			
			#show_textbox:not(:checked) + select {display:none;}
		</style>
	</head>
	
	<body>
			<?php 
				session_start();
					if (isset($_SESSION['Username'])) {
						echo "	
							<div style='width: 1350px; margin-left: auto; margin-right:auto'>
							<img src='../Graphics/header.jpg' />
							<h1 style='float:right'> Vehicle Schedules </h1> <br /> <a style='float:right' href='http://server05116/Intranet/VehicleScheduler/logout.php'>Logout</a><br />
							<a href='http://server05116/Intranet/VehicleScheduler/adminMain.php'>Administrative Page</a><div style='float:right'> Hello, {$_SESSION['Username']} </div>
							</div>
							<br style='clear: right; clear: left;' />";
					} else {
						echo '	
							<div style="width: 1350px; margin-left: auto; margin-right:auto">
							<img src="../Graphics/header.jpg" />
							<h1 style="float:right"> Vehicle Schedules </h1> <br />
							<a style="float:right" href="http://server05116/Intranet/VehicleScheduler/login.php">Admin-Login</a>
							</div> 
							<br style="clear: right; clear: left;" /> ';
					} 
				session_write_close();
			
			?>

	<!-- Start of page specific Content!!! -->

	