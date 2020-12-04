<!DOCTYPE HTML>
<?php session_start();
  if(isset($_SESSION['log_username'])){
  }else{
    header("Location: signup.php");
  }

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


     if($_SERVER["REQUEST_METHOD"] == "POST"){
       if(isset($_POST["paystations"])){
       $paystayPref= $_POST["paystations"];
     }else{
       $paystayPref=0;
     }
      if(isset($_POST["EV"])){
       $evPref=$_POST["EV"];
     }else{
       $evPref=0;
     }
     if(isset($_POST["weekends"])){
       $weekends=$_POST["weekends"];
     }else{
       $weekends=0;
     }
       $queryTest = "SELECT * from personalization where ID_user='{$_SESSION["ID"]}';";
       $resultTest = mysqli_query($connection, $query) or die ( mysqli_error());
       $rowTest = mysqli_fetch_assoc($resultTest);

       if($rowTest=mysqli_fetch_assoc($resultTest)){
         $query = "UPDATE personalization set paystations= $paystayPref, ev=$evPref, weekends=$weekends  where ID_user='{$_SESSION["ID"]}';";
         $result = mysqli_query($connection, $query) or die ( mysqli_error());
         

       }else{

       $query = "INSERT INTO personalization (ID_user, paystations, ev, weekends) VALUES ({$_SESSION["ID"]}, {$paystayPref}, {$evPref}, {$weekends});";
       $result = mysqli_query($connection, $query) or die ( mysqli_error());



     }
   }
   ?>



<html lang="en">
<head>
  <meta charset="utf-8">
  <title> IAT352 PHP Project </title>

  <meta name="viewport" content="width=device-width, initial=scale=1.0"> <!-- -->

  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/main.php">
  <!-- <link rel="stylesheet" href="css/main.css"> -->
  <link rel="stylesheet" href="css/louiscss.php">
  <link rel="stylesheet" href="css/fonts.css">
</head>

<body>


  <div class="nav-box">
    <nav class="box">
      <div class="nav-title">Paystation Finder </div>
      <a href="index.php"><div class="nav-button">  Home  </div></a>
      <a href="browse.php"><div class="nav-button"> Browse </div></a>
      <?php
      if(isset($_SESSION['log_username'])){
        echo "<a href='settings.php'><div class='nav-button'> Settings </div></a>";
        echo "<a href='logout.php'><div class='signup-button'> Log Out </div></a>";
      }
      else{
        echo "<a href='signup.php'><div class='signup-button'> Sign up/Sign in </div></a>";
      }
      ?>
    </nav>
    <div class="member-status-bar">
      <?php
        if(isset($_SESSION['log_username'])){
          echo "Welcome: ";
          echo $_SESSION['log_username'];
        }
        else{
          echo "Welcome guest";
        }
      ?>
    </div>
  </div>



<h1 class="itempage-heading"> Profile Settings</h1>
<div class="profile-box">
  <div class="square">
      <!-- <p>Profile Picture</p> -->
      <img class="profile-image" src="<?php echo $photo;?>" alt="Profile Picture">
  </div>
  <div class="userinfo">
    <p><em>Username :</em></p>
    <div class="userinfosquare">
      <?php
      echo "<p>",$username, "</p>";
       ?>
    </div>
    <p><em>Email</em></p>
    <div class="userinfosquare">
      <?php
      echo "<p>", $email, "</p>";
       ?>
    </div>
    <p><em>Phone Number</em></p>
    <div class="userinfosquare">
      <?php
      echo "<p>", $phonenumber, "</p>";
       ?>
    </div>
    <br>
    <div class="edit-features">
       <button onclick="location.href='edit.php'">Edit</button>
       <button onclick="location.href='logout.php'">Logout</button>
    </div>
      <!-- end of user info -->
    </div>
  </div>

  <!-- show bookmarked parkingstations -->
  <div class="favourite-box">
    <h2 class=""> Favourite Paystations</h2>
    <div class="bookmark-list">
      <ul>
      <?php
        $query_getBookmarks = "SELECT * FROM bookmarks WHERE bookmarks.ID_user = '";
        $query_getBookmarks .= $_SESSION['ID']. "'";
        $result = mysqli_query($connection, $query_getBookmarks);

        if(!$result){
          die("query failed");
        }
        else{
          while($row = mysqli_fetch_assoc($result)){
            echo "<li>";
            echo $row['ID_paystation'];
            echo " ";
            $query_getStreetName = "SELECT * FROM pay_stations WHERE pay_stations.METER_ID ='";
            $query_getStreetName .= $row['ID_paystation']. "'";
            $result2 = mysqli_query($connection, $query_getStreetName);
            while($strname = mysqli_fetch_assoc($result2)){
              echo "<a class='link' href='item.php?data=";
              echo $row['ID_paystation']. "'>";
              echo $strname['ADDRESS'];
              echo "</a>";
            }
            echo "</li>";
          }
        }
      ?>
      </ul>
    </div>
  </div>

<br>
<br>
  <form name="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
    <input type="checkbox" id="paystations" name="paystations" value=1>
<label for="paystations"> Show Regular paystations</label><br>
<input type="checkbox" id="EV" name="EV" value=1>
<label for="EV"> Show Electric paystations</label><br>
<input type="checkbox" id="weekends" name="weekends" value=1>
<label for="weekends"> Open on Weekends</label><br>
    <p><input name="submit" type="submit" value="Update" /></p>
  </form>


</body>
</html>
