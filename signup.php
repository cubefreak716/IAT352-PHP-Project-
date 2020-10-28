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

<!-- registration form -->
<div class="signup-signupbox">
  <h1>Sign up</h1>

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




</body>

</html>
