<!DOCTYPE HTML>
<?php
session_start();

 ?>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title> IAT352 PHP Project </title>

  <meta name="viewport" content="width=device-width, initial=scale=1.0"> <!-- -->

  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/louiscss.php">
  <link rel="stylesheet" href="css/fonts.css">

  <?php
      if(isset($_GET["data"]))
      {

          $data = $_GET["data"];
          $_SESSION['current-item'] = $_GET["data"];
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

    $query="SELECT * from pay_stations where METER_ID = '".$_SESSION['current-item']."'";

    $result = mysqli_query($connection, $query);
    if(!$result){
      die("query failed");
    }
    else{
      // echo "success";
    }
    while($row = mysqli_fetch_assoc($result)){

      $meterAddress= $row["ADDRESS"];

      $meterType= $row["METER_TYPE"];

      $operationHours= $row["OPERATION_HOURS"];

      $operationDays= $row["OPERATION_DAYS"];

      $zoneType= $row["ZONE_TYPE"];

      $paymentMethods= $row["PAYMENT_METHODS"];

      $hourlyRate=$row["HOURLY_RATE"];

      $dailyRate= $row["DAILY_RATE"];

      $maximumHours=$row["MAXIMUM_HOURS"];

      $modelName= $row["METER_MODEL"];

      $lat=$row["Latitude"];
      $lon=$row["Longitude"];
    }
  ?>

</head>

<body>


  <nav class="box">
    <div class="nav-title">Paystation Finder </div>
    <a href="index.php"><div class="nav-button">  Home  </div></a>
    <a href="browse.php"><div class="nav-button"> Browse </div></a>
    <a href="settings.php"> <div class="nav-button"> Settings  </div></a>
    <a href="signup.php"><div class="signup-button">  Sign up </div></a>
  </nav>

<?php
$myfile =fopen("registrationText.txt","r") or die ("Unable to open file!");
  // $idname = $_GET['Id'];
  // echo "<h1> $idname </h1>";
 ?>

<h1> <?php echo $meterAddress ?></h1>

<div class="square">
  <p>Picture of Parking Model</p>
  <!--
  Profile Picture
  -->
</div>

<div class="container">

<div id="googleMap" style="width:35%;height:400px;"></div>

<script>
function myMap() {
var mapProp= {
  center:new google.maps.LatLng(<?php echo $lat.",".$lon; ?>),
  zoom:20,
};
var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
}
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAGdq4mHp4USTKJUduSaukvGy5tcdtf4IU&callback=myMap"></script>
<div class="iteminfo">

  <p>Meter type: <?php echo $meterType  ?></p>
  <p>Operation Hours: <?php echo $operationHours  ?> </p>
  <p>Operation Days: <?php echo $operationDays  ?> </p>
  <p>Hourly Rate: <?php echo $hourlyRate  ?></p>
  <p>Daily Rate: <?php echo $dailyRate  ?></p>
  <p>Maximum Hours: <?php echo $maximumHours  ?></p>
  <p>Zone Type: <?php echo $zoneType  ?></p>
  <p>Payment Methods: <?php echo $paymentMethods  ?></p>

</div>
<br>


<?php
  if(isset($_SESSION['log_username'])){
    echo "<form method='post'>";
    echo "<input type='checkbox' id='bk' name='bookmark' value='bookmark'>";
    echo "<input type='submit' id='bookmark' name='bookmark-button' value='Bookmark' /> ";
    //bookmark table connection
    echo "</form>";

    if(isset($_POST['bookmark'])){
        $ID_user = $_SESSION['log_username'];
        $ID_paystation = $_SESSION['current-item'];

        //good Input
        $query_check = "SELECT * FROM bookmarks ";
        $query_check.= "WHERE BINARY";
        $query_check.= " bookmarks.ID_paystation = '" .$ID_paystation. "' ";
        $result = mysqli_query($connection, $query_check);
        if($result && mysqli_num_rows($result)!=0){
          //no previous entry all good for registration
          echo "Bookmark already exists";
        }
        else{
          $query_bookmark  = "INSERT INTO bookmarks (";
          $query_bookmark .= "  ID_user, ID_paystation";
          $query_bookmark .= ") VALUES (";
          $query_bookmark .= " '{$ID_user}', '{$ID_paystation}'";
          $query_bookmark .= ")";

          $result_bookmark = mysqli_query($connection, $query_bookmark);
          if($result_bookmark){
            echo "everything is hunkeydory";
          }
          else{
            echo "everything is not hunkeydory";
          }
        }


    }

    echo "<form method='post'>";
    echo "<input type='checkbox' id='ocpy' name='occupy' value='occupy'>";
    echo "<input type='submit' id='occupy' name='occupy-button' value='Occupy' /> ";
    //bookmark table connection
    echo "</form>";
  }
 ?>

</div>


</body>
</html>
