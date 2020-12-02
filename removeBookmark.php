<?php
  session_start();

  if(isset($_GET["removeid"]))
  {
      $data = $_GET["removeid"];
      $_SESSION["remove-id"] = $_GET["removeid"];
  }

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

  $query="DELETE FROM bookmarks WHERE bookmarks.ID_user = '";
  $query .= $_SESSION['ID']. "' ";
  $query .=" AND bookmarks.ID_paystation = '";
  $query .= $_SESSION["remove-id"]."'";
  $result = mysqli_query($connection, $query);

  header("Location: settings.php");
?>
