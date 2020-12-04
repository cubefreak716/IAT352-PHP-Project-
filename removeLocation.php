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

  if(isset($_GET["removeOccupy"]))
  {
      $_SESSION["remove-id"] = $_GET["removeOccupy"];
      $query="DELETE FROM occupy WHERE occupy.ID_user = '";
      $query .= $_SESSION['ID']. "' ";
      $query .=" AND occupy.ID_paystation = '";
      $query .= $_SESSION["remove-id"]."'";
      $result = mysqli_query($connection, $query);
  }
  if(isset($_GET["removeBookmark"]))
  {
      $_SESSION["remove-id"] = $_GET["removeBookmark"];
      $query="DELETE FROM bookmarks WHERE bookmarks.ID_user = '";
      $query .= $_SESSION['ID']. "' ";
      $query .=" AND bookmarks.ID_paystation = '";
      $query .= $_SESSION["remove-id"]."'";
      $result = mysqli_query($connection, $query);
  }
  header("Location: settings.php");
?>
