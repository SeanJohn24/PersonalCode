<?php
/********************************
* Shane Workman : Vehicle Scheduler
* 10/27/2016
********************************/
$serverName = "SERVER05116\SQLEXPRESS"; //serverName\instanceName // 1.2.3.16
$connectionInfo = array( "Database"=>"CarScheduler", "UID"=>"phpUser", "PWD"=>"THAT1psw");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if(!$conn) {
     die( print_r( sqlsrv_errors(), true));
}
?>