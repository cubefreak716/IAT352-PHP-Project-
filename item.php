<!DOCTYPE HTML>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title> IAT352 PHP Project </title>

  <meta name="viewport" content="width=device-width, initial=scale=1.0"> <!-- -->

  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/main.php">
  <link rel="stylesheet" href="css/louiscss.php">
  <link rel="stylesheet" href="css/fonts.css">
</head>

<body>


<nav>
  <a href="index.php"> Home </a>
  <a href="browse.php"> Browse </a>
  <a href="settings.php"> Settings </a>
  <a href="signup.php"> Sign up </a>
</nav>

<?php
$myfile =fopen("registrationText.txt","r") or die ("Unable to open file!");
 ?>

<h1> Insert Item Name</h1>

<div class="square">
  <p>Picture of Parking Model</p>
  <!--
  Profile Picture
  -->
</div>

<div class="container">

<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6201.8767840301925!2d-122.8539429915634!3d49.18978401278199!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x5485d82ad672ef79%3A0x7b44815a5cbce013!2sSurrey%20Central%20Station!5e0!3m2!1sen!2sca!4v1602109306684!5m2!1sen!2sca" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>

<div class="iteminfo">

  <p>Meter type:</p>
  <p>Operation Hours:</p>
  <p>Operation Days:</p>
  <p>Hourly Rate:</p>
  <p>Daily Rate:</p>
  <p>Maximum Hours:</p>
  <p>Zone Type:</p>
  <p>Payment Methods:</p>

</div>

</div>


</body>
</html>
