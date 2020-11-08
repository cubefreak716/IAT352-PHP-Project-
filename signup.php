<!DOCTYPE HTML>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title> IAT352 PHP Project </title>

  <meta name="viewport" content="width=device-width, initial=scale=1.0"> <!-- -->

  <link rel="stylesheet" href="css/normalize.css">
  <!-- <link rel="stylesheet" href="css/main.php"> -->
  <link rel="stylesheet" href="css/main.css">
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

<div class="box">
  <!-- registration form -->
  <div class="signup-form">
    <h2>Sign up</h2>

    <form class="signupform" action="registration.php" method="get">
      <label for="Uname">Username: </label><br><input type="text" name="username"><br>

      <label for="Pword">Password: </label><br><input type="text" name="password"><br>

      <label for="Pword2">Confirm Password: </label><br><input type="text" name="password2"><br>

      <label for="Email">Email: </label> <br><input type="text" name="email"><br>

      <label for="Pnumber">Phone Number: </label> <br><input type="text" name="phone"><br>

      <label for="Notif">Notification Preference: </label><br>
      <input type="radio" name="notification" value="sms">sms
      <input type="radio" name="notification" value="mail">email <br><br>

      <label for="Propicture">Profile Picture</label>
      <input type="submit" name="upload" value="Upload">

      <br><br><br>

      <input type="submit" name="submit" value="Submit">

    </form>
  </div>

  <!-- log in form -->
  <div class="signup-form">
    <h2>Log In</h2>

    <form class="signupform" action="login.php" method="get">
      <label for="Uname">Username: </label><br><input type="text" name="username"><br>

      <label for="Pword">Password: </label><br><input type="text" name="password"><br>

      <br><br><br>

      <input type="submit" name="submit" value="Submit">

    </form>
  </div>

</div>


</body>

</html>
