<?php
  
date_default_timezone_set('UTC');
// basic php date functions
$todays_date = time();
 
 // setting variables for days, Months and Year
 $day  = date('d' , $todays_date);
 $month  = date('m' , $todays_date);
 $year  = date('Y' , $todays_date);
 // function to get the first day of the month it uses unix time stamp
 $first_day = mktime(0,0,0,$month,1,$year);
 // gets  the month in written out form ex January
 $month_name = date('F', $first_day);
 
 // What day the first  of the month falls in
 $first_of_month_day = date('l' ,$first_day);
 
 //  Finds the number of blank spaces need for the start of the month
 switch($first_of_month_day) {
        case "Sunday": $blank = 0; break;
        case "Monday": $blank = 1; break;
        case "Tuesday": $blank = 2; break; 
        case "Wednesday": $blank = 3; break;
        case "Thursday": $blank = 4; break;
        case "Friday": $blank = 5; break;
        case "Saturday": $blank = 6; break;
 }
 // gets how many days are in the month
//$days_in_month = cal_days_in_month(0, $month, $year);
$days_in_month = 30;
 //Makes the outline with title and Sunday - Saturday blocks
echo "<table border =6 width=394>";
echo" 
      <tr>
        <th colspan=7>$month_name $year</th>
      </tr>
     
      <tr>
        <td>Sunday</td>
        <td>Monday</td>
        <td>Tuseday</td>
        <td>Wedsday</td>
        <td>Thursday</td>
        <td>Friday</td>
        <td>Saturday</td>
      </tr>
    ";
$day_counter = $blank;
// Fills in the empty days if the month dose not start on a Sunday    
while($blank > 0){
    echo"<td height=50></td>";
    $blank--;
}
// This is the numbers that are filled in to the calendar 
$datecounter =1;
while( $days_in_month >= $datecounter){
  echo"<td height=50 width=50> $datecounter</td>";
  $datecounter++;
  $day_counter++;
  // This wiil make it move down a row after hitting 7 days
    if($day_counter >= 7 ){
      echo"</tr><tr>";
      $day_counter=0;
    }
      
}
?>