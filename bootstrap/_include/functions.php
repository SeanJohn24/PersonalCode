<?php
/***********************
*Author: Shane Workman
        -made while watching Lynda.com Ray Villalobos course. Released 8/26/2015
*Date: 06/27/2017
*Purpose: Basic Set of functions to use in my bootstap templates.
**************************/

function copyrightDateRange() {
  $startYear = "2017";
  $curYear = date('y');
  substr($startYear, 2, 3) == $curYear ? $str = $startYear : $str = $startYear .' - '. $curYear;
  return $str;
}




 ?>
