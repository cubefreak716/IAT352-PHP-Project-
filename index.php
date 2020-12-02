<!DOCTYPE HTML>
<?php
session_start();
 ?>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title> IAT352 PHP Project </title>

  <meta name="viewport" content="width=device-width, initial=scale=1.0"> <!-- -->

  <!-- <link rel="stylesheet" href="css/normalize.css"> -->
  <link rel="stylesheet" href="css/main.php">
  <link rel="stylesheet" href="css/fonts.css">
  <!-- <link rel="stylesheet" href="css/main.css"> -->


</head>

<body>
  <?php
  if(isset($_SESSION['log_username'])){
    $ID_user = $_SESSION['log_username'];
  }
  ?>

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


  <div class="box index-top">
    <div class="overlay">
      <div class="index-heading">
        <h1>Surrey <br>Paystation<br> Finder</h1>
        <p class="heading-subtitle">Helping you find the best paystation since 2020</p>
        <a href="browse.php"><div class="index-browsebutton">Browse Meters</div></a>
      </div>
    </div>
    <img class="index-image" src="img/Pay-Parking-t2.jpg" alt="payparkingheader">
  </div>

  <div class="index-bottom box">
    <div class="index-info">
      <div class="title">What is Paystation Finder</div>
      <p>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ornare tincidunt lacus sit amet pellentesque. Nulla sodales eros risus, vitae tincidunt magna viverra sagittis. convallis mi eu, sodales tellus.
    </div>
    <div class="index-info ">
      <div class="title">Company Values</div>
      <p>
        Duis id sapien odio. Nunc vitae semper lacus, sagittis cursus magna. Quisque sed est et risus euismod vulputate non eget ex. Quisque rutrum diam in feugiat posuere.
      </p>
    </div>
    <div class="index-info">
      <div class="title">Future Products</div>
      <p>
        Sed ac justo nec nisi rutrum luctus. Maecenas justo sapien, ullamcorper sed malesuada feugiat, commodo ac sem. Morbi id turpis ultrices, dapibus dui eget, interdum sapien.
      </p>
    </div>
  </div>


</body>
</html>
