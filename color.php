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

    function myRandom($colors, $str) {
        for ($i = 0; $i < 100; $i++) {
          $max = count($colors) - 1;
          $min = 0;
          $rand = rand($min, $max);
          print('
          <div style="background-color : '.$colors[$rand].'; width : 10%; height:10%; float: left;">
      <!--
          <p style="position: absolute;  top: auto;">'.$str.'</p>
            <br>Rand: '.$rand.'
            <br>Color: '.$colors[$rand].'
      -->
          </div>');
        }
    }


    if ($date == 01){
      myRandom($newYears, 'Happy New Year');
      //print($date.' 1');
    } elseif ($date >= 5 && $date <= 9 ) {
      myRandom($summer, 'It\'s Summer!');
      //print($date.' 2');
    } elseif ($date == 10) {
      myRandom($holloween, 'Holloween');
      //print($date.' 3');
    } elseif ($date == 12) {
      myRandom($christmas, 'Merry Christmas');
      //print($date.' 4');
    } else {
      myRandom($colors);
      //print($date.' 5');
    }


    // refreshes the page every 300ms.
    print('<script> setTimeout(function() {        location.reload();        }, 300); </script>');
  ?>
