<?php
  /***********************
  *Author: Shane Workman
  *Date: 06/15/2017
  *Purpose: Fun page randomizing color squares on the screen;
  **************************/
  $page_title = "Random Color Squares";
  //include("header.php");
  $colors = array("red", "orange", "yellow", "green", "blue", "indigo", "violet");
  $newYears = array("gold", "black", "silver");
  $christmas = array("red", "green", "white");
  $holloween = array("black", "orange", "white", "green", "red");
  $summer = array("red", "white", "blue");
  $date = date('m');

    function myRandom($colors) {
        for ($i = 0; $i < 100; $i++) {
          $max = count($colors) - 1;
          $min = 0;
          $rand = rand($min, $max);
          print('
          <div style="background-color : '.$colors[$rand].'; width : 10%; height:10%; float: left;"></div>');
        }
    }


    if ($date == 01){
      myRandom($newYears);
      //print($date.' 1');
    } elseif ($date >= 5 && $date <= 9 ) {
      myRandom($summer);
      //print($date.' 2');
    } elseif ($date == 10) {
      myRandom($holloween);
      //print($date.' 3');
    } elseif ($date == 12) {
      myRandom($christmas);
      //print($date.' 4');
    } else {
      myRandom($colors);
      //print($date.' 5');
    }
?>
<script> setTimeout(function() {        location.reload();        }, 300); </script>
