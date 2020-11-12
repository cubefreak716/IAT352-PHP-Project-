<!DOCTYPE HTML>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title> IAT352 PHP Project </title>

  <meta name="viewport" content="width=device-width, initial=scale=1.0"> <!-- -->

  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/main.php">
  <link rel="stylesheet" href="css/fonts.css">
  <!-- <link rel="stylesheet" href="css/main.css"> -->
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

    <!-- Filter box -->
    <div class="browse-box box">
      <form class="queryForm" action="browse.php" method="post">
      <div class="filter-box">
        <div class="filter-type-name">Meter type</div>
        <ul>
          <li><input type="checkbox" name="metertype[]" value="Paystation">Paystation</li>
          <li><input type="checkbox" name="metertype[]" value="EV">EV charging station</li>
        </ul>
        <div class="filter-type-name">Operation Hours</div>
        <ul>
          <li><input type="checkbox" name="ophours[]" value="6:00 AM to 6:00 PM">6:00am - 6:00pm</li>
          <li><input type="checkbox" name="ophours[]" value="8:00 AM to 11:00 PM">8:00am - 11:00pm</li>
          <li><input type="checkbox" name="ophours[]" value="Outside of City Hall/Library Hours">City Hall/Library Hours</li>
          <li><input type="checkbox" name="ophours[]" value="24 Hours">24 hours </li>
        </ul>
        <div class="filter-type-name">Operation Days</div>
        <ul>
          <li><input type="checkbox" name="opdays[]" value="7 Days/Week">7 days a week</li>
          <li><input type="checkbox" name="opdays[]" value="Mon - Fri">Weekdays</li>
        </ul>
        <div class="filter-type-name">Hourly Rate</div>
        <ul>
          <li>Rate slider</li>
        </ul>
        <div class="filter-type-name">Daily Rate</div>
        <ul>
          <li>Rate slider</li>
        </ul>
        <div class="filter-type-name">Zone Type</div>
        <ul>
          <li><input type="checkbox" name="zonetype[]" value="On-Street Parking">On-street</li>
          <li><input type="checkbox" name="zonetype[]" value="Public">Public</li>
          <li><input type="checkbox" name="zonetype[]" value="employee">Employee</li>
          <li><input type="checkbox" name="zonetype[]" value="underground">Underground</li>
          <li><input type="checkbox" name="zonetype[]" value="pavedoffstreet">Surface Paved Off-street</li>
          <li><input type="checkbox" name="zonetype[]" value="Surface Gravel Off-Street">Surface Gravel Off-street</li>
          <li><input type="checkbox" name="zonetype[]" value="fleet">Fleet</li>
        </ul>
        <div class="filter-type-name">Payment Methods</div>
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

        $maxItemPerPage = 8;
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
            echo "</div> ";
            if(strpos($row["METER_TYPE"],'Paystation') !== false){
              echo "<img class='icon-meter' src='img/parking.png' alt='paystationicon'> ";
            }
            if(strpos($row["METER_TYPE"],'EV') !== false){
              echo "<img class='icon-meter' src='img/charging.png' alt='chargingstationicon'> ";
            }

            echo $row["ADDRESS"];
            echo " ";
            // echo "</div> <div class='item-stationtype'>";
            // echo $row["METER_TYPE"];
            // echo "</div> ";
            echo "<div class='item-hourrate'> Rate: ";
            echo $row["HOURLY_RATE"];
            echo "</div>";
            // echo $row["OPERATION_DAYS"];
            // echo " ";
            // echo $row["ZONE_TYPE"];
            // echo " ";
            // echo $row["PAYMENT_METHODS"];
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
