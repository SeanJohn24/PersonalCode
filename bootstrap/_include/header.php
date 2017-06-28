<?php
  /***********************
  *Author: Shane Workman
          -made while watching Lynda.com Ray Villalobos course. Released 8/26/2015
  *Date: 06/27/2017
  *Purpose: Basic header for Bootstrap.
  **************************/
  require_once ('_include/functions.php');

  ?>
    <!DOCTYPE HTML>
      <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <!-- Bootstrap CDN links below! -->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
            integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
            <link rel="stylesheet" href="_include/style.css">

            <!-- Optional IE8 Support HTML 5 elements and responsive breakpoints
              <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
              <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            -->

            <title><?php print($page_title); ?></title>
        </head>
        <body>
        <!-- Start Page specific content below -->
