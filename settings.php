<!DOCTYPE HTML>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title> IAT352 PHP Project </title>

  <meta name="viewport" content="width=device-width, initial=scale=1.0"> <!-- -->

  <link rel="stylesheet" href="css/normalize.css">
  <!-- <link rel="stylesheet" href="css/main.php"> -->
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/louiscss.php">
  <link rel="stylesheet" href="css/fonts.css">
</head>

<body>


  <nav class="box">
    <div class="nav-title">Paystation Finder </div>
    <a href="index.php"><div class="nav-button">  Home  </div></a>
    <a href="browse.php"><div class="nav-button"> Browse </div></a>
    <a href="settings.php"> <div class="nav-button"> Settings  </div></a>
    <a href="signup.php"><div class="signup-button">  Sign up </div></a>
  </nav>

<?php
$myfile =fopen("registrationText.txt","r") or die ("Unable to open file!");
 ?>

<h1> Profile Settings</h1>

<div class="square">
  <p>Profile Picture</p>
  <!--
  Profile Picture
  -->
</div>
<div class="userinfo">

  <p>User Name Goes Here:</p>
  <div class="userinfosquare">
    <!-- to be read from text file -->
    <?php
    echo "<p>", fgets($myfile), "</p>";
     ?>
  </div>
  <p>Password</p>
  <div class="userinfosquare">
    <!-- to be read from text file -->
    <?php
    echo "<p>", fgets($myfile), "</p>";
     ?>
  </div>
  <p>Email</p>
  <div class="userinfosquare">
    <!-- to be read from text file -->
    <?php
    echo "<p>", fgets($myfile), "</p>";
     ?>
  </div>
  <p>Phone Number</p>
  <div class="userinfosquare">
    <!-- to be read from text file -->
    <?php
    echo "<p>", fgets($myfile), "</p>";

     ?>
  </div>
  <p>Notification Type</p>
    <!-- to be read from text file possibly? -->
    <div class="userinfosquare">
    <?php
    $notifType = fgets($myfile);
    echo $notifType;
    fclose($myfile);
    ?>
  </div>
</label>


</div>


</body>
</html>
