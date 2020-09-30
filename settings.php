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
    <p>UserName</p>
  </div>
  <p>Password</p>
  <div class="userinfosquare">
    <!-- to be read from text file -->
    <p>Password</p>
  </div>
  <p>Email</p>
  <div class="userinfosquare">
    <!-- to be read from text file -->
    <p>Email@whatever.com</p>
  </div>
  <p>Phone Number</p>
  <div class="userinfosquare">
    <!-- to be read from text file -->
    <p>604444444</p>
  </div>
  <p>Notification Type</p>
    <!-- to be read from text file possibly? -->
  <label class="container">SMS
  <input type="radio" checked="checked" name="radio">
  <span class="checkmark"></span>
</label>
<label class="container">Email
  <input type="radio" name="radio">
  <span class="checkmark"></span>
</label>


</div>


</body>
</html>
