<!DOCTYPE HTML>
<?php
session_start();
 ?>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title> IAT352 PHP Project </title>

  <meta name="viewport" content="width=device-width, initial=scale=1.0">

  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/main.php">
  <!-- <link rel="stylesheet" href="css/main.css"> -->
  <link rel="stylesheet" href="css/fonts.css">


</head>

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

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $currusername = $_POST['log_username'] ?? '';
    $currpassword = $_POST['log_password'] ?? '';


     $sql = "SELECT ID FROM users WHERE username = '$currusername' and password = '".sha1($currpassword)."'";
     $result = mysqli_query($connection,$sql);
     $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
     $id=$row['ID'];

     $count = mysqli_num_rows($result);

     // If result matched $myusername and $mypassword, table row must be 1 row

     if($count == 1) {
        //session_register("myusername");
        unset($_SESSION["log_username"]);
        unset($_SESSION["ID"]);
        $_SESSION['log_username'] = $currusername;
        $_SESSION['ID']=$id;
        echo $_SESSION['log_username'];
        header("location: settings.php");
     }else {
        $error = "Your Login Name or Password is invalid";
     }



    // header("localhost/matildac/IAT352-PHP-Project-/index.php");
  }

?>

<body>
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

  <!-- log in form -->
  <div class="signup-form">
    <h2>Log In</h2>

    <form class="signupform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"method="post">
      <label for="Uname">Username: </label><br><input type="text" name="log_username">
      <span style="color:red;"></span>
      <br>

      <label for="Pword">Password: </label><br><input type="text" name="log_password">
      <span style="color:red;"></span>
      <br>

      <br><br><br>

      <input type="submit" name="submit" value="Submit">
      <br><br>
      <a class="link" href="signup.php">Sign up </a>

    </form>
  </div>

  <?php
   mysqli_close($connection);
   ?>


</body>

</html>
