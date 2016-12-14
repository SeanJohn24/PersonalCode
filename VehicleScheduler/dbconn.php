<?php
/********************************
* Shane Workman : Vehicle Scheduler
* 10/27/2016
********************************/
$serverName = "SERVER\SQLEXPRESS"; //serverName\Instance
$connectionInfo = array( "Database"=>"database", "UID"=>"user", "PWD"=>"password");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if(!$conn) {
     die( print_r( sqlsrv_errors(), true));
}
?>