<!DOCTYPE HTML>
<?php
session_start();


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
 ?>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title> IAT352 PHP Project </title>

  <meta name="viewport" content="width=device-width, initial=scale=1.0"> <!-- -->

  <!-- <link rel="stylesheet" href="css/normalize.css"> -->
  <link rel="stylesheet" href="css/main.php">
  <link rel="stylesheet" href="css/fonts.css">
  <link rel="stylesheet" href="css/louiscss.php">


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


<?php
if(isset($_SESSION["ID"])){
echo'<div class="index-favourite-box">
  <h2 class="index-heading-2"> Paystations</h2>
  <div class="bookmark-list box">';


  $paystayPref= 0;

  $ev= 0;

  $weekdays=0;

  $query="SELECT * from personalization where ID_user = '".$_SESSION['ID']."'";

  $result = mysqli_query($connection, $query);
  if(!$result){
    die("query failed");
  }
  else{
    // echo "success";
  }
if($row=mysqli_fetch_assoc($result)){
  while($row = mysqli_fetch_assoc($result)){

    $paystayPref= $row["paystations"];

    $ev= $row["ev"];

    $weekdays= $row["weekdays"];


  }
}


$queryPref="";

if($paystayPref&&$ev&&$weekdays){

}elseif ($paystayPref && $ev) {

}elseif ($paystayPref&&$weekdays) {
  $queryPref="WHERE pay_stations.METER_TYPE LIKE binary '%Paystation%' AND pay_stations.OPERATION_HOURS LIKE '%Mon - Fri%'";
}elseif($ev&&$weekdays){
  $queryPref="WHERE pay_stations.METER_TYPE LIKE binary '%EV%' AND pay_stations.OPERATION_HOURS LIKE '%Mon - Fri%'";

}elseif ($paystayPref) {
  $queryPref="WHERE pay_stations.METER_TYPE LIKE binary '%Paystation%' ";

}elseif ($ev) {
  $queryPref="WHERE pay_stations.METER_TYPE LIKE binary '%EV%'";

}elseif ($weekdays) {
  $queryPref="WHERE pay_stations.OPERATION_HOURS LIKE '%Mon - Fri%'";

}

      $query_getBookmarks = "SELECT * FROM bookmarks WHERE bookmarks.ID_user = '";
      $query_getBookmarks .= $_SESSION['ID']. "'";
      $result = mysqli_query($connection, $query_getBookmarks);

      if(!$result){
        die("query failed");
      }
      else{

        $isempty=0;
        while($row = mysqli_fetch_assoc($result)){
          // echo "<li>";
          $isempty+=1;
          //echo $row['ID_paystation'];
          if($queryPref!=""&&!$isempty==1){
            $queryPref.=" AND ";
          }else{
            $queryPref=" WHERE ";
          }
          $query_getStreetName = "SELECT * FROM pay_stations ".$queryPref."pay_stations.METER_ID ='";
          $query_getStreetName .= $row['ID_paystation']. "' LIMIT 0,4";
          $result2 = mysqli_query($connection, $query_getStreetName);
          while($strname = mysqli_fetch_assoc($result2)){
            echo "<a class='item2' href='item.php?data=".$strname["METER_ID"]."'>";
            if(strpos($strname["METER_TYPE"],'Paystation') !== false){
              echo "<img class='icon-meter-large' src='img/parking.png' alt='paystationicon'> ";
            }
            if(strpos($strname["METER_TYPE"],'EV') !== false){
              echo "<img class='icon-meter-large' src='img/charging.png' alt='chargingstationicon'> ";
            }
            echo "<br><div class='item-num'>";
            echo $strname["METER_ID"];
            echo "</div> <br>";

            echo $strname["ADDRESS"];
            echo "<br>";
            echo "<div class='item-stationtype'> Rate: ";
            echo $strname["HOURLY_RATE"];
            echo "</div>";
            echo "</a>";
          }
          // echo "</li>";
        }
      }
      if($isempty==0){
        // echo'<p>You Do Not Have Any Favourites. Here Are Some Suggestions:</p>';

          // echo "<li>";

          //echo $row['ID_paystation'];
          echo " ";
          $query_getStreetName = "SELECT * FROM pay_stations LIMIT 0,4";

          $result2 = mysqli_query($connection, $query_getStreetName);
          while($strname = mysqli_fetch_assoc($result2)){
            echo "<a class='item2' href='item.php?data=".$strname["METER_ID"]."'>";
            if(strpos($strname["METER_TYPE"],'Paystation') !== false){
              echo "<img class='icon-meter-large' src='img/parking.png' alt='paystationicon'> ";
            }
            if(strpos($strname["METER_TYPE"],'EV') !== false){
              echo "<img class='icon-meter-large' src='img/charging.png' alt='chargingstationicon'> ";
            }

            echo "<br><div class='item-num'>";
            echo $strname["METER_ID"];
            echo "</div> <br>";

            echo $strname["ADDRESS"];
            echo "<br>";
            echo "<div class='item-stationtype'> Rate: ";
            echo $strname["HOURLY_RATE"];
            echo "</div>";
            echo "</a>";
          }
          // echo "</li>";

      }
    echo'

  </div>
</div>';
}
?>
  <!-- <div class="index-heading-2"><h2>Popular Meters</h2></div> -->







<?php
if(!isset($_SESSION['ID'])){
  echo '<div class="index-bottom box">
    <div class="index-info">
      <div class="title">What is Paystation Finder</div>
      <p class="index-info-p">
        This is a website that helps you find a pay station matching your needs.

      </p>
    </div>
    <div class="index-info">
      <div class="title">Is it Free</div>
      <p class="index-info-p">
        Yes. This is service is 100% free.
      </p>
    </div>
    <div class="index-info">
      <div class="title">Will This Work Beyond Surrey</div>
      <p class="index-info-p">
      No, unfortunately this web application does not work with any other cities.
      However, we are looking towards expanding a greater audience at a later time.
      </p>
    </div>
  </div>
  ';
}
  ?>


</body>
</html>
