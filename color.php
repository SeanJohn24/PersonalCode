<?php
  /***********************
  *Author: Shane Workman
  *Date: 06/15/2017
  *Purpose: Fun page randomizing color squares on the screen;
  **************************/
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
    } elseif ($date >= 5 && $date <= 9 ) {
      myRandom($summer);
    } elseif ($date == 10) {
      myRandom($holloween);
    } elseif ($date == 12) {
      myRandom($christmas);
    } else {
      myRandom($colors);
    }
?>
<script> setTimeout(function() {        location.reload();        }, 300); </script>
