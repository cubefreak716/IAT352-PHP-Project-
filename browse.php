<?php
  session_start();
  $pageNum = 1;
?>
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

  <script>
    function getXMLHTTPRequest(){
      var request = false;
      try{
        // Firefox
        request = new XMLHttpRequest();
      } catch (err){
        try{
          //ie
          request = new ActiveXObject("Msxml2.XMLHTTP");
        }catch(err){
          try{
            //other ie
            request = new ActiveXObject("Microsoft.XMLHTTP");
          }catch(err){
            request = false;
          }
        }
      }
      return request;

    }

    function changePage(){
      var clist = document.forms[0];
      var filterString = "";
      // var current_page = ","+document.getElementsByClassName("curr-page");

      for(i = 0; i < clist.length; i++){
        if (clist[i].checked) {
          filterString = filterString + clist[i].value + ",";
        }
        else{
          filterString = filterString + ",";
        }
      }
      if(filterString==""){
        document.getElementById("db_display").innerHTML= "";
        return;
      }
      else{
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function(){
          if(this.readyState == 4 && this.status ==200){
            document.getElementById("db_display").innerHTML = this.responseText;
          }
        };

        xmlhttp.open("POST","getItems.php?metertype="+filterString+"<?php echo $pageNum ?>",true);
        xmlhttp.send();
      }

    }
  </script>


</head>

<body>
    <!-- <input type="text" id="demo" size="50"> -->
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
      <form class="queryForm" action="browse.php" method="post" onchange="changePage()">
      <div class="filter-box">
        <div class="filter-type-name">Meter type</div>
          <input type="checkbox" class="meter-type" name="metertype[]" value="Paystation" onchange="refreshPage(this.value)">Paystation<br>
          <input type="checkbox" class="meter-type" name="metertype[]" value="EV"  onchange="refreshPage(this.value)">EV charging station<br>
        <div class="filter-type-name">Operation Hours</div><br>
          <input type="checkbox" name="ophours[]" value="6:00 AM to 6:00 PM" onclick="refreshPage(this.value)">6:00am - 6:00pm<br>
          <input type="checkbox" name="ophours[]" value="8:00 AM to 11:00 PM" onclick="refreshPage(this.value)">8:00am - 11:00pm<br>
          <input type="checkbox" name="ophours[]" value="Outside of City Hall/Library Hours" onclick="refreshPage(this.value)">City Hall/Library Hours<br>
          <input type="checkbox" name="ophours[]" value="24 Hours" onclick="refreshPage(this.value)">24 hours<br>
        <div class="filter-type-name">Operation Days</div><br>
          <input type="checkbox" name="opdays[]" value="7 Days/Week" onclick="refreshPage(this.value)">7 days a week<br>
          <input type="checkbox" name="opdays[]" value="Mon - Fri" onclick="refreshPage(this.value)">Weekdays<br>
        <div class="filter-type-name">Zone Type</div><br>
          <input type="checkbox" name="zonetype[]" value="On-Street Parking" onclick="refreshPage(this.value)">On-street<br>
          <input type="checkbox" name="zonetype[]" value="Public" onclick="refreshPage(this.value)" onclick="refreshPage(this.value)">Public<br>
          <input type="checkbox" name="zonetype[]" value="employee" onclick="refreshPage(this.value)">Employee<br>
          <input type="checkbox" name="zonetype[]" value="underground" onclick="refreshPage(this.value)">Underground<br>
          <input type="checkbox" name="zonetype[]" value="pavedoffstreet" onclick="refreshPage(this.value)">Surface Paved Off-street<br>
          <input type="checkbox" name="zonetype[]" value="Surface Gravel Off-Street" onclick="refreshPage(this.value)">Surface Gravel Off-street<br>
          <input type="checkbox" name="zonetype[]" value="fleet" onclick="refreshPage(this.value)">Fleet<br>
        <div class="filter-type-name">Payment Methods</div><br>
          <input type="checkbox" name="paymethod[]" value="Cash" onclick="refreshPage(this.value)">Cash<br>
          <input type="checkbox" name="paymethod[]" value="Credit Card" onclick="refreshPage(this.value)">Credit Card<br>
          <input type="checkbox" name="paymethod[]" value="PayByPhone" onclick="refreshPage(this.value)">Pay by Phone<br>
          <input type="checkbox" name="paymethod[]" value="Invoice" onclick="refreshPage(this.value)">Invoice
      </div>
      </form>
      <div id="db_display"></div>


      <script>
      function pagination(page){
        var clist = document.forms[0];
        var filterString = "";
        // var current_page = ","+document.getElementsByClassName("curr-page");
        page = parseInt(page);
        for(i = 0; i < clist.length; i++){
          if (clist[i].checked) {
            filterString = filterString + clist[i].value + ",";
          }
          else{
            filterString = filterString + ",";
          }
        }
        if(filterString==""){
          document.getElementById("db_display").innerHTML= "";
          return;
        }
        else{
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function(){
            if(this.readyState == 4 && this.status ==200){
              document.getElementById("db_display").innerHTML = this.responseText;
            }
          };

          xmlhttp.open("POST","getItems.php?metertype="+filterString+page,true);
          xmlhttp.send();
        }
      }
      </script>

      
    </div>





</body>
</html>
