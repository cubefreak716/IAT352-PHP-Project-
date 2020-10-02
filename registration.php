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

<?php

  $username = "";
  $password = "";
  $email= "";
  $phone = "";
  $notification = "";

  $username = !empty($_GET["username"]) ?$_GET["username"] : "username is required";
  $password = !empty($_GET["password"]) ?$_GET["password"] : "Password is required";
  $email = !empty($_GET["email"]) ?$_GET["email"] : "Email is required";
  $phone = !empty($_GET["phone"]) ?$_GET["phone"] : "Phone number is required";
  $notification = !empty($_GET["notification"]) ?$_GET["notification"] : "";

  $file = 'registrationText.txt';

  if($handle = fopen($file,'w')){
    echo "opened file <br/>";
    fwrite($handle, '');
    $content = "".$username."\n"
      .$password."\n"
      .$email."\n"
      .$phone."\n"
      .$notification."\n";
    fwrite($handle, $content);

    fclose($handle);
  }
  else{
    echo "error";
  }


 ?>

 <?php
  
  echo "Username: ".$username."";
  echo "<br />";
  echo "Email:  ".$email."";
  echo "<br />";
  echo "Welcome! ";
  echo "<br />";


  ?>

</body>
</html>
