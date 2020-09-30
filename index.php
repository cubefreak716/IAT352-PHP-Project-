<!DOCTYPE HTML>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title> IAT352 PHP Project </title>

  <meta name="viewport" content="width=device-width, initial=scale=1.0"> <!-- -->

  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/main.php">
  <link rel="stylesheet" href="css/fonts.css">


</head>

<body>


<nav>
  <a href="index.php"> Home </a>
  <a href="browse.php"> Browse </a>
  <a href="settings.php"> Settings </a>
  <a href="signup.php"> Sign up </a>
</nav>

<div class="box index-top">
  <div class="index-heading">
    <h1>Surrey Parking Meter Nav </h1>
  </div>

  <div class="index-signupbox">
    <h2>Sign up</h2>
    <a href="signup.php"><div class="index-signupbutton">Confirm</div></a>
  </div>

</div>

<div class="index-heading-2"><h2>Favourite Meters</h2></div>
<div class="box index-bottom">

  <a href="item.php">
    <div class="index-meterbox">
      Meter 1
    </div>
  </a>
  <a href="item.php">
    <div class="index-meterbox">
      Meter 2
    </div>
  </a>
  <a href="item.php">
    <div class="index-meterbox">
      Meter 3
    </div>
  </a>

</div>


<?php
  echo "test";

?>

</body>
</html>
