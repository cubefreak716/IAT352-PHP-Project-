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

    <nav>
      <a href="index.php"> Home </a>
      <a href="browse.php"> Browse </a>
      <a href="settings.php"> Settings </a>
      <a href="signup.php"> Sign up </a>
    </nav>

    <!-- Filter box -->
    <div class="browse-box box">
      <form class="queryForm" action="browse.php" method="post">
      <div class="filter-box">
        Meter type
        <ul>
          <li><input type="checkbox" name="metertype[]" value="Paystation">Paystation</li>
          <li><input type="checkbox" name="metertype[]" value="EV">EV charging station</li>
        </ul>
        Operation Hours
        <ul>
          <li><input type="checkbox" name="ophours[]" value="6:00 AM to 6:00 PM">6:00am - 6:00pm</li>
          <li><input type="checkbox" name="ophours[]" value="8:00 AM to 11:00 PM">8:00am - 11:00pm</li>
          <li><input type="checkbox" name="ophours[]" value="Outside of City Hall/Library Hours">City Hall/Library Hours</li>
          <li><input type="checkbox" name="ophours[]" value="24 Hours">24 hours </li>
        </ul>
        Operation Days
        <ul>
          <li><input type="checkbox" name="opdays[]" value="7 Days/Week">7 days a week</li>
          <li><input type="checkbox" name="opdays[]" value="Mon - Fri">Weekdays</li>
        </ul>
        Hourly Rate
        <ul>
          <li>Rate slider</li>
        </ul>
        Daily Rate
        <ul>
          <li>Rate slider</li>
        </ul>
        Zone Type
        <ul>
          <li><input type="checkbox" name="zonetype[]" value="On-Street Parking">On-street</li>
          <li><input type="checkbox" name="zonetype[]" value="Public">Public</li>
          <li><input type="checkbox" name="zonetype[]" value="employee">Employee</li>
          <li><input type="checkbox" name="zonetype[]" value="underground">Underground</li>
          <li><input type="checkbox" name="zonetype[]" value="pavedoffstreet">Surface Paved Off-street</li>
          <li><input type="checkbox" name="zonetype[]" value="Surface Gravel Off-Street">Surface Gravel Off-street</li>
          <li><input type="checkbox" name="zonetype[]" value="fleet">Fleet</li>
        </ul>
        Payment Methods
        <ul>
          <li><input type="checkbox" name="paymethod[]" value="Cash">Cash</li>
          <li><input type="checkbox" name="paymethod[]" value="Credit Card">Credit Card</li>
          <li><input type="checkbox" name="paymethod[]" value="PayByPhone">Pay by Phone</li>
          <li><input type="checkbox" name="paymethod[]" value="Invoice">Invoice</li>
        </ul>

        <input type="submit" name="search" value="Search">

      </form>
      </div>


      <?php
        if(isset($_GET['pageNum'])){
          $pageNum = $_GET['pageNum'];
        } else{
          $pageNum = 1;
        }

        $maxItemPerPage = 10;
        $offset = ($pageNum-1) * $maxItemPerPage;
        $totalPagesSQL = "SELECT COUNT(*) FROM pay_stations";
        $result2 = mysqli_query($connection, $totalPagesSQL);
        $total_rows = mysqli_fetch_array($result2)[0];
        $total_pages = ceil($total_rows / $maxItemPerPage);

        $itemList = array();
        $itemList[] = 13;
        $itemList[] = 14;

        //checkbox arrays
        $selectedMeterType = array();
        $selectedOperationHours = array();
        $selectedOperationDays = array();
          //sliders
        $selectedZoneType = array();
        $selectedPaymentMethods = array();

        $query = "SELECT * ";
        $query .= " FROM pay_stations ";
        $query .= "WHERE ";

        //if meter type was selected
        if(isset($_POST['metertype'])){
          $selectedMeterType = $_POST['metertype'];
          // $query .= "WHERE pay_stations.METER_TYPE = 'Paystation' ";
          if(!empty($_POST["metertype"])){
            foreach($selectedMeterType as $value){
              $query .= "pay_stations.METER_TYPE LIKE '%" . $value . "%' ";
              $query .= " OR ";
            }
            $query = substr($query, 0,-4);

          }
        }
        else{
          //nothing was selected
          $query .= "pay_stations.METER_TYPE LIKE '%%' ";
        }
        //if operation hours was selected
        if(isset($_POST['ophours'])){
            $selectedOperationHours = $_POST['ophours'];
                      $query .= "AND ";
            if(!empty($_POST["ophours"])){
              foreach($selectedOperationHours as $value){
                $query .= "pay_stations.OPERATION_HOURS LIKE '%" . $value . "%' ";
                $query .= " OR ";
              }
              $query = substr($query, 0,-3);
            }
        }
        else{
          //nothing was selected
          $query .= "AND ";
          $query .= "pay_stations.OPERATION_HOURS LIKE '%%' ";
        }
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
            echo "</div> <div class='item-stationtype'>";
            echo $row["METER_TYPE"];
            echo "</div> ";
            echo $row["OPERATION_HOURS"];
            echo " ";
            echo $row["OPERATION_DAYS"];
            echo " ";
            echo $row["ZONE_TYPE"];
            echo " ";
            echo $row["PAYMENT_METHODS"];
            echo "</div></a>";
          }

          // for($i = 0; $i<count($itemList); $i++){
          // echo "<a href=";
          // echo '"item.php?Id='.$itemList[$i].'">';
          // echo "<div class='item'>";
          // print_r($itemList[$i]);
          // echo "</div></a>";
          // }

        ?>


        <!-- Page navigation for items -->
        <div class=" box pages-bar">
          <?php
          if($pageNum != 1){
            echo "<a href='browse.php?pageNum=". ($pageNum - 1). "'> < </a>";
          }
          echo "<em>";
          echo $pageNum;
          echo "</em>";
          if($pageNum != $total_pages){
            echo "<a href='browse.php?pageNum=". ($pageNum + 1 ). "'> > </a>";
          }
          ?>
          <!-- <a href="<?php echo 'browse.php?pageNum='.($pageNum + 1); ?>">></a> -->
        </div>





      </div>
    </div>
    <!-- end of browse box -->

  </body>
</html>
