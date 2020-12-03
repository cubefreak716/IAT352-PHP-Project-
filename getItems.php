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
?>
<?php

  //incoming string
  $filterString = $_REQUEST['metertype'];
  $filterlist = explode(",", $filterString);

  $selectedMeterType = array($filterlist[0],$filterlist[1]);
  $selectedOperationHours = array($filterlist[2],$filterlist[3],$filterlist[4],$filterlist[5]);
  $selectedOperationDays = array($filterlist[6],$filterlist[7]);
  $selectedZoneType = array($filterlist[8],$filterlist[9],$filterlist[10],$filterlist[11],$filterlist[12],$filterlist[13],$filterlist[14]);
  $selectedPaymentMethods = array($filterlist[15],$filterlist[16],$filterlist[17],$filterlist[18]);
  $pageNum = intval($filterlist[19]);

  $query0 = "SELECT * FROM pay_stations WHERE ";

  $query ="";
  //meter type
  $numItem=0;
  $check_if_all_empty = 0;
  foreach($selectedMeterType as $value){
    if(!empty($value)){
      if($numItem==0){
        $query .= "pay_stations.METER_TYPE LIKE binary '%" . $value . "%' ";
      }
      else if($numItem < count($selectedMeterType)){
        $query .= " OR ";
        $query .= "pay_stations.METER_TYPE LIKE binary '%" . $value . "%' ";
      }
      else{
        $query .= "pay_stations.METER_TYPE LIKE '%" . $value . "%' ";
      }
    $numItem++;
    }
    else{
      $check_if_all_empty ++;
    }
  }
  if($check_if_all_empty==2){
    //display all
    $query .= "pay_stations.METER_TYPE LIKE binary '%%' ";
  }
  //operation hours
  $numItem=0;
  $check_if_all_empty = 0;
  foreach($selectedOperationHours as $value){
    if(!empty($value)){
      if($numItem==0){
        $query .= "AND ";
        $query .= "pay_stations.OPERATION_HOURS LIKE '%" . $value . "%' ";
      }
      else if($numItem < count($selectedOperationHours)){
        $query .= " OR ";
        $query .= "pay_stations.OPERATION_HOURS LIKE '%" . $value . "%' ";
      }
      else{
        $query .= "pay_stations.OPERATION_HOURS LIKE '%" . $value . "%' ";
      }
    $numItem++;
    }
    else{
      $check_if_all_empty ++;
    }
  }
  if($check_if_all_empty==4){
    //display all
    $query .= "AND pay_stations.OPERATION_HOURS LIKE binary '%%' ";
  }

  //operation days
  $numItem=0;
  $check_if_all_empty = 0;
  foreach($selectedOperationDays as $value){
    if(!empty($value)){
      if($numItem==0){
        $query .= "AND ";
        $query .= "pay_stations.OPERATION_DAYS LIKE '%" . $value . "%' ";
      }
      else if($numItem < count($selectedOperationDays)){
        $query .= " OR ";
        $query .= "pay_stations.OPERATION_DAYS LIKE '%" . $value . "%' ";
      }
      else{
        $query .= "pay_stations.OPERATION_DAYS LIKE '%" . $value . "%' ";
      }
    $numItem++;
    }
    else{
      $check_if_all_empty ++;
    }
  }
  if($check_if_all_empty==2){
    //display all
    $query .= "AND pay_stations.OPERATION_DAYS LIKE binary '%%' ";
  }
  //zone type
  $numItem=0;
  $check_if_all_empty = 0;
  foreach($selectedZoneType as $value){
    if(!empty($value)){
      if($numItem==0){
        $query .= "AND ";
        $query .= "pay_stations.ZONE_TYPE LIKE '%" . $value . "%' ";
      }
      else if($numItem < count($selectedZoneType)){
        $query .= " OR ";
        $query .= "pay_stations.ZONE_TYPE LIKE '%" . $value . "%' ";
      }
      else{
        $query .= "pay_stations.ZONE_TYPE LIKE '%" . $value . "%' ";
      }
    $numItem++;
    }
    else{
      $check_if_all_empty ++;
    }
  }
  if($check_if_all_empty==7){
    //display all
    $query .= "AND pay_stations.ZONE_TYPE LIKE binary '%%' ";
  }
  //paymethod
  $numItem=0;
  $check_if_all_empty = 0;
  foreach($selectedPaymentMethods as $value){
    if(!empty($value)){
      if($numItem==0){
        $query .= "AND ";
        $query .= "pay_stations.PAYMENT_METHODS LIKE '%" . $value . "%' ";
      }
      else if($numItem < count($selectedPaymentMethods)){
        $query .= " OR ";
        $query .= "pay_stations.PAYMENT_METHODS LIKE '%" . $value . "%' ";
      }
      else{
        $query .= "pay_stations.PAYMENT_METHODS LIKE '%" . $value . "%' ";
      }
    $numItem++;
    }
    else{
      $check_if_all_empty ++;
    }
  }
  if($check_if_all_empty==7){
    //display all
    $query .= "AND pay_stations.PAYMENT_METHODS LIKE binary '%%' ";
  }
  //limit page
  $maxItemPerPage = 8;
  $offset = ($pageNum-1) * $maxItemPerPage;
  $totalPagesSQL = "SELECT COUNT(*) FROM pay_stations WHERE ";
  $totalPagesSQL = $totalPagesSQL.$query;
  $result2 = mysqli_query($connection, $totalPagesSQL);
  $total_rows = mysqli_fetch_array($result2)[0];
  $total_pages = ceil($total_rows / $maxItemPerPage);
  $noLimitQuery = $query0.$query;
  $query .= "LIMIT $offset, $maxItemPerPage";

  $query = $query0.$query;
?>

<?php
    //xml
    $result = mysqli_query($connection, $query);
    $xmlFile = new DOMDocument('1.0', 'UTF-8');
    $xmlFile -> formatOutput=true;
    $meterstation = $xmlFile->createElement("stations");
    $meterstation = $xmlFile-> appendChild($meterstation);

    while($row = mysqli_fetch_assoc($result)){
      $station = $xmlFile -> createElement("station");
      $meterstation -> appendChild($station);

      $m_ID = $xmlFile -> createElement("ID", $row["METER_ID"]);
      $station ->appendChild($m_ID);

      $m_Type = $xmlFile -> createElement("Type", $row["METER_TYPE"]);
      $station ->appendChild($m_Type);

      $m_addr = $xmlFile -> createElement("Address", $row["ADDRESS"]);
      $station ->appendChild($m_addr);

      $m_HRate = $xmlFile -> createElement("Rate", $row["HOURLY_RATE"]);
      $station ->appendChild($m_HRate);
    }
    $xmlFile->saveXML();
    $xmlFile ->save("query.xml");
?>

<div class="items-box">
  <?php
    // for loop to grab items from future database
    $result = mysqli_query($connection, $query);
    if(!$result){
      die("query failed");
    }
    else{
      // echo "success";
    }
    $xmlFile = simplexml_load_file("query.xml") or die("Error");
    foreach($xmlFile->children() as $stations){
        echo "<a href='item.php?data=".$stations ->ID."'><div class='item'>";
        echo "<div class='item-num'>";
        echo $stations ->ID;
        echo "</div> ";
        if(strpos($stations ->Type,'Paystation') !== false){
          echo "<img class='icon-meter' src='img/parking.png' alt='paystationicon'> ";
        }
        if(strpos($stations ->Type,'EV') !== false){
          echo "<img class='icon-meter' src='img/charging.png' alt='chargingstationicon'> ";
        }
        echo $stations ->Address;
        echo " ";
        echo "<div class='item-hourrate'> Rate: ";
        echo $stations ->Rate;
        echo "</div>";
        echo "</div></a>";
    }

  ?>

  <!-- Page navigation for items -->
  <div class="box pages-bar">
    <?php
      if($pageNum != 1){
      echo "<a class='pagination-button' onclick='pagination(".($pageNum-1).")'> < </a>";
      }
      else{
        echo "<a class='disabled-pagination' onclick='pagination(".($pageNum-1).")'>  </a>";
      }
      echo "<div class='curr-page'>";
      echo $pageNum;
      echo "</div>";
      if($pageNum != $total_pages){
        echo "<a class='pagination-button' onclick='pagination(".($pageNum+1).")'> > </a>";
      }
      else{
        echo "<a class='disabled-pagination' onclick='pagination(".($pageNum+1).")'>  </a>";
      }
    ?>
  </div>

</div>


</body>
</html>
