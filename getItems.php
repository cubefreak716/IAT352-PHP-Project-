<html>
<head>
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
<?php
  //get current page number
  if(isset($_GET['pageNum'])){
    $pageNum = $_GET['pageNum'];
  } else{
    $pageNum = 1;
  }

  //pagination
  $maxItemPerPage = 8;
  $offset = ($pageNum-1) * $maxItemPerPage;
  $totalPagesSQL = "SELECT COUNT(*) FROM pay_stations";
  $result2 = mysqli_query($connection, $totalPagesSQL);
  $total_rows = mysqli_fetch_array($result2)[0];
  $total_pages = ceil($total_rows / $maxItemPerPage);

  //checkbox arrays
  $selectedMeterType = array();
  $selectedOperationHours = array();
  $selectedOperationDays = array();
  $selectedZoneType = array();
  $selectedPaymentMethods = array();

  $query = "SELECT * ";
  $query .= " FROM pay_stations ";
  $query .= "WHERE ";

  // echo $_REQUEST['metertype'];
  if(isset($_REQUEST['metertype'])){
    $selectedMeterType = $_REQUEST['metertype'];
    // $query .= "WHERE pay_stations.METER_TYPE = 'Paystation' ";
    if(!empty($_REQUEST["metertype"])){
        $query .= "pay_stations.METER_TYPE LIKE '%" . $selectedMeterType . "%' ";

    }
  }
  else{
    //nothing was selected
    $query .= "pay_stations.METER_TYPE LIKE '%%' ";
  }
  if(isset($_REQUEST['ophours'])){
      $selectedOperationHours = $_REQUEST['ophours'];
      $query .= "AND ";
      if(!empty($_REQUEST["ophours"])){
          $query .= "pay_stations.OPERATION_HOURS LIKE '%" . $selectedOperationHours . "%' ";
      }
  }
  else{
    //nothing was selected
    $query .= "AND ";
    $query .= "pay_stations.OPERATION_HOURS LIKE '%%' ";
  }


  //if meter type was selected
  // if(isset($_POST['metertype'])){
  //   $selectedMeterType = $_POST['metertype'];
  //   // $query .= "WHERE pay_stations.METER_TYPE = 'Paystation' ";
  //   if(!empty($_POST["metertype"])){
  //     foreach($selectedMeterType as $value){
  //       $query .= "pay_stations.METER_TYPE LIKE '%" . $value . "%' ";
  //       $query .= " OR ";
  //
  //     }
  //     $query = substr($query, 0,-4);
  //
  //   }
  // }
  // else{
  //   //nothing was selected
  //   $query .= "pay_stations.METER_TYPE LIKE '%%' ";
  // }
  //if operation hours was selected
  // if(isset($_POST['ophours'])){
  //     $selectedOperationHours = $_POST['ophours'];
  //               $query .= "AND ";
  //     if(!empty($_POST["ophours"])){
  //       foreach($selectedOperationHours as $value){
  //         $query .= "pay_stations.OPERATION_HOURS LIKE '%" . $value . "%' ";
  //         $query .= " OR ";
  //       }
  //       $query = substr($query, 0,-3);
  //     }
  // }
  // else{
  //   //nothing was selected
  //   $query .= "AND ";
  //   $query .= "pay_stations.OPERATION_HOURS LIKE '%%' ";
  // }
  //if operation days was selected
  if(isset($_POST['opdays'])){
      $selectedOperationDays = $_POST['opdays'];
                $query .= "AND ";
      if(!empty($_POST["opdays"])){
        foreach($selectedOperationDays as $value){
          $query .= "pay_stations.OPERATION_DAYS LIKE '%" . $value . "%' ";
          $query .= " OR ";
        }
        $query = substr($query, 0,-3);
      }
  }
  else{
    //nothing was selected
    $query .= "AND ";
    $query .= "pay_stations.OPERATION_DAYS LIKE '%%' ";
  }
  //if zone type was selected
  if(isset($_POST['zonetype'])){
      $selectedZoneType = $_POST['zonetype'];
                $query .= "AND ";
      if(!empty($_POST["zonetype"])){
        foreach($selectedZoneType as $value){
          $query .= "pay_stations.ZONE_TYPE LIKE '%" . $value . "%' ";
          $query .= " OR ";
        }
        $query = substr($query, 0,-3);
      }
  }
  else{
    //nothing was selected
    $query .= "AND ";
    $query .= "pay_stations.ZONE_TYPE LIKE '%%' ";
  }
  //if Payment method was selected
  if(isset($_POST['paymethod'])){
      $selectedPaymentMethods = $_POST['paymethod'];
                $query .= "AND ";
      if(!empty($_POST["paymethod"])){
        foreach($selectedPaymentMethods as $value){
          $query .= "pay_stations.PAYMENT_METHODS LIKE '%" . $value . "%' ";
          $query .= " OR ";
        }
        $query = substr($query, 0,-3);
      }
  }
  else{
    //nothing was selected
    $query .= "AND ";
    $query .= "pay_stations.PAYMENT_METHODS LIKE '%%' ";
  }

  $query .= "LIMIT $offset, $maxItemPerPage";

echo "<br>";
echo $query;
echo "<br>";
$result = mysqli_query($connection, $query);
if(!$result){
  die("query failed");
}
else{
  // echo "success";
}

?>

<!-- Items from future database -->
<div class="items-box">
  <?php
    // for loop to grab items from future database
    while($row = mysqli_fetch_assoc($result)){
      echo "<a href='item.php?data=".$row["METER_ID"]."'><div class='item'>";
      echo "<div class='item-num'>";
      echo $row["METER_ID"];
      echo "</div> ";
      if(strpos($row["METER_TYPE"],'Paystation') !== false){
        echo "<img class='icon-meter' src='img/parking.png' alt='paystationicon'> ";
      }
      if(strpos($row["METER_TYPE"],'EV') !== false){
        echo "<img class='icon-meter' src='img/charging.png' alt='chargingstationicon'> ";
      }
      echo $row["ADDRESS"];
      echo " ";
      echo "<div class='item-hourrate'> Rate: ";
      echo $row["HOURLY_RATE"];
      echo "</div>";
      echo "</div></a>";
    }

  ?>


  <!-- Page navigation for items -->
  <div class="box pages-bar">
    <?php
    if($pageNum != 1){
      echo "<a class='pagination-button' href='browse.php?pageNum=". ($pageNum - 1). "'> < </a>";
    }
    else{
      echo "<a class='disabled-pagination' href='browse.php?pageNum=". ($pageNum - 1). "'></a>";
    }
    echo "<div class='curr-page'>";
    echo $pageNum;
    echo "</div>";
    if($pageNum != $total_pages){
      echo "<a class='pagination-button' href='browse.php?pageNum=". ($pageNum + 1 ). "'> > </a>";
    }
    else{
      echo "<a class='disabled-pagination' href='browse.php?pageNum=". ($pageNum + 1 ). "'></a>";
    }
    ?>
    <!-- <a href="<?php echo 'browse.php?pageNum='.($pageNum + 1); ?>">></a> -->
  </div>





</div>
</div>
<!-- end of browse box -->

</body>
</html>
