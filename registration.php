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

  <div class="nav-box">
    <nav class="box">
      <div class="nav-title">Paystation Finder </div>
      <a href="index.php"><div class="nav-button">  Home  </div></a>
      <a href="browse.php"><div class="nav-button"> Browse </div></a>
      <?php
      if(isset($_SESSION['log_username'])){
        echo "<a href='settings.php'><div class='nav-button'> ".$_SESSION['log_username']."";
        echo "</div></a>";
        echo "<a href='logout.php'><div class='signup-button'> Log Out </div></a>";
      }
      else{
        echo "<a href='signup.php'><div class='signup-button'> Sign up/Sign in </div></a>";
      }
      ?>
    </nav>
  </div>

<?php


  $username = $password = $email= $phone = $notification = "";
  $nameErr = $passwordErr = $emailErr = $phoneErr = "";

  if($_SERVER["REQUEST_METHOD"] == "POST"){
    //Username
    if(empty($_POST["username"])){
      $nameErr = "Username is required";
    } else{
      $username = test_input($_POST["username"]);
      if(!preg_match(("/^[a-zA-Z0-9]*$/"), $username)){
        $nameErr = "Only letters allowed";
      }
    }


  }

  function test_input($data) {
     $data = trim($data);
     $data = stripslashes($data);
     $data = htmlspecialchars($data);
     return $data;
  }

  echo $nameErr;


  // $username = !empty($_POST["username"]) ?$_POST["username"] : "username is required";




  // $password = !empty($_POST["password"]) ?$_POST["password"] : "Password is required";
  // $email = !empty($_POST["email"]) ?$_POST["email"] : "Email is required";
  // $phone = !empty($_POST["phone"]) ?$_POST["phone"] : "Phone number is required";
  // $notification = !empty($_POST["notification"]) ?$_POST["notification"] : "";
  //
  // $file = 'registrationText.txt';
  //
  // if($handle = fopen($file,'w')){
  //   echo "opened file <br/>";
  //   fwrite($handle, '');
  //   $content = "".$username."\n"
  //     .$password."\n"
  //     .$email."\n"
  //     .$phone."\n"
  //     .$notification."\n";
  //   fwrite($handle, $content);
  //
  //   fclose($handle);
  // }
  // else{
  //   echo "error";
  // }


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
