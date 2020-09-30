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

<div class="signup-signupbox">
  <h1>Sign up</h1>

  <form action="registration.php" method="get">
    Username: <input type="text" name="username"><br>
    
    Password: <input type="text" name="password"><br>

    Confirm Password:<input type="text" name="password2"><br>

    Email: <input type="text" name="email"><br>

    Phone Number: <input type="text" name="phone"><br>

    Notification Type:
    <input type="radio" name="notification" value="sms">sms
    <input type="radio" name="notification" value="mail">email <br>

    <input type="submit" name="submit" value="Submit">

  </form>

</div>




</body>

</html>
