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
  <?php
    //connection set up
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "louis_fourie";
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    //testing connection
    if(mysqli_connect_errno()){
      die("Database connection failed: " . mysqli_connect_error() .
      " (" . mysqli_connect_errno() . ")"
      );
    }
    else{

    }
  ?>

  <nav class="box">
    <div class="nav-title">Paystation Finder </div>
    <a href="index.php"><div class="nav-button">  Home  </div></a>
    <a href="browse.php"><div class="nav-button"> Browse </div></a>
    <a href="settings.php"> <div class="nav-button"> Settings  </div></a>
    <a href="signup.php"><div class="signup-button">  Sign up </div></a>
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

 $query  = "INSERT INTO users (";
 $query .= "  username, password, phone_number, email";
 $query .= ") VALUES (";
 $query .= " '{$username}', '{$password}', '{$phone}', '{$email}'";
 $query .= ")";

 $result = mysqli_query($connection, $query);

 if ($result) {
   // Success
   // redirect_to("successpage.php");
   echo "Success!";
 } else {
   // Failure
   // $message = "Subject creation failed";
   die("Database query failed. " . mysqli_error($connection));
 }


  echo "Username: ".$username."";
  echo "<br />";
  echo "Email:  ".$email."";
  echo "<br />";
  echo "Welcome! ";
  echo "<br />";

  mysqli_close($connection);
  ?>

</body>
</html>
