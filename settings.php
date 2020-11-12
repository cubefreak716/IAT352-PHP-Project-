<!DOCTYPE HTML>
<?php session_start();
  // if(isset($_SESSION['log_username']))
 ?>
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

   $query="SELECT * from users where ID = '".$_SESSION['ID']."'";

   $result = mysqli_query($connection, $query);
   if(!$result){
     die("query failed");
   }
   else{
     // echo "success";
   }
   while($row = mysqli_fetch_assoc($result)){

     $username= $row["username"];

     $email= $row["email"];

     $phonenumber= $row["phone_number"];

     $photo= $row["photo"];



   }
 ?>
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



<h1> Profile Settings</h1>

<div class="square">
  <!-- <p>Profile Picture</p> -->
  <img src="<?php echo $photo; ?>" alt="Profile Picture" width="100%" height="100%">
</div>
<div class="userinfo">

  <p>Username :</p>
  <div class="userinfosquare">
    <!-- to be read from text file -->
    <?php
    echo "<p>",$username, "</p>";
     ?>
  </div>

  <p>Email</p>
  <div class="userinfosquare">
    <!-- to be read from text file -->
    <?php
    echo "<p>", $email, "</p>";
     ?>
  </div>
  <p>Phone Number</p>
  <div class="userinfosquare">
    <!-- to be read from text file -->
    <?php
    echo "<p>", $phonenumber, "</p>";

     ?>
  </div>
  <!-- <p>Notification Type</p>

    <div class="userinfosquare">
     -->
     <button onclick="location.href='edit.php'">Edit</button>
     <button onclick="location.href='logout.php'">Logout</button>
  </div>
</label>


</div>


</body>
</html>
