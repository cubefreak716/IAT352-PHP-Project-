<!DOCTYPE HTML>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title> IAT352 PHP Project </title>

  <meta name="viewport" content="width=device-width, initial=scale=1.0"> <!-- -->

  <link rel="stylesheet" href="css/normalize.css">
  <!-- <link rel="stylesheet" href="css/main.php"> -->
  <link rel="stylesheet" href="css/main.css">
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

?>

<body>
  <nav class="box">
    <div class="nav-title">Paystation Finder </div>
    <a href="index.php"><div class="nav-button">  Home  </div></a>
    <a href="browse.php"><div class="nav-button"> Browse </div></a>
    <a href="settings.php"> <div class="nav-button"> Settings  </div></a>
    <a href="signup.php"><div class="signup-button">  Sign up </div></a>
  </nav>


  <?php


    $username = $password = $password2 = $email= $phone = $notification = "";
    $nameErr = $passwordErr = $passwordErr2 = $emailErr = $phoneErr = "";
    $check = 0;

    if($_SERVER["REQUEST_METHOD"] == "POST"){
      //Username
      if(empty($_POST["username"])){
        $nameErr = "Username is required";
      } else{
        $username = test_input($_POST["username"]);
        if(!preg_match(("/^[a-zA-Z0-9]{4,9}$/"), $username)){
          $nameErr = "Letters and Numbers Only max 9 char";
        }
        else{
          //good Input
          $query = "SELECT * FROM users ";
          $query.= "WHERE BINARY";
          $query.= " users.username LIKE '" .$username. "' ";
          $result = mysqli_query($connection, $query);
          echo $username;
          if($result){
            //no previous entry all good for registration
            $check++;
          }
          else{
            $nameErr = "username already exists";
          }
        }
      }
      //password
      if(empty($_POST["password"])){
        $passwordErr = "Password is Required";
      } else{
        $password = test_input($_POST["password"]);
        if(!preg_match(("/^[\w@.()#&+-]*$/"), $password)){
          $passwordErr = "a-z A-Z 0-9 _ @ . ( ) \ # & + -";
        }
        else{   //now check if password has been confirmed twice
          if(empty($_POST["password2"])){
            $passwordErr2 = "Please confirm your password";
          } else{
            $password2 = test_input($_POST["password2"]);
            if(strcmp($password,$password2)==0){
              //good Input
              $check++;
            }
            else{
              $passwordErr2 = "passwords are not the same";
            }
          }
        }
      }
      //Email
      if(empty($_POST["email"])){
        $emailErr = "Email is Required";
      } else{
        $email = test_input($_POST["email"]);
        if(!preg_match(("/([\w\-]+\@[\w\-+\.[\w\-]+)/"), $email)){
          $emailErr = "Invalid email";
        }
        else{
          //good Input
          $check++;
        }
      }
      //phone number
      if(empty($_POST["phone"])){
        $phoneErr = "Phone number is Required";
      } else{
        $phone = test_input($_POST["phone"]);
        if(!preg_match(("/^[0-9]*$/"), $phone)){
          $phoneErr = "Numbers only";
        }
        else{
          //good Input
          $check++;
        }
      }
      //Notification
      if(empty($_POST["notification"])){
        //nothing was selected
      }else{
        $notification = test_input($_POST["notification"]);
      }
    }// end of server if

    function test_input($data) {
       $data = trim($data);
       $data = stripslashes($data);
       $data = htmlspecialchars($data);
       return $data;
    }
   ?>

  <!-- registration form -->
  <div class="signup-form">
    <h2>Sign up</h2>
    <!-- allows for form entry on same page -->
    <form class="signupform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
      <label for="Uname">Username: </label><br>
      <input type="text" name="username" value="<?php echo $username;?>">
      <span style="color:red;"><?php echo $nameErr;?></span>
      <br>

      <label for="Pword">Password: </label><br>
      <input type="text" name="password" value="<?php echo $password;?>">
      <span style="color:red;"><?php echo $passwordErr;?></span>
      <br>

      <label for="Pword2">Confirm Password: </label><br>
      <input type="text" name="password2">
      <span style="color:red;"><?php echo $passwordErr2;?></span>
      <br>

      <label for="Email">Email: </label> <br>
      <input type="text" name="email" value="<?php echo $email;?>">
      <span style="color:red;"><?php echo $emailErr;?></span>
      <br>

      <label for="Pnumber">Phone Number: </label> <br><input type="text" name="phone"><br>

      <label for="Notif">Notification Preference: </label><br>
      <input type="radio" name="notification" value="sms">sms
      <input type="radio" name="notification" value="mail">email <br><br>

      <label for="Propicture">Profile Picture</label>
      <input type="submit" name="upload" value="Upload">

      <br><br><br>

      <input type="submit" name="submit" value="Submit">

      <br><br>
      <a class="link" href="login.php">Already a member? Log in! </a>

    </form>
  </div>

<?php
// if sign up was sucessfull
if($check==4){
  $query  = "INSERT INTO users (";
  $query .= "  username, password, phone_number, email";
  $query .= ") VALUES (";
  $query .= " '{$username}', '{$password}', '{$phone}', '{$email}'";
  $query .= ")";

  $result = mysqli_query($connection, $query);

  if ($result) {
    // Success
    // redirect_to("successpage.php");
    echo "Success!";
  } else {
    // Failure
    // $message = "Subject creation failed";
    die("Database query failed. " . mysqli_error($connection));
  }
}
 // echo "Username: ".$username."";
 // echo "<br />";
 // echo "Email:  ".$email."";
 // echo "<br />";
 // echo "Welcome! ";
 // echo "<br />";

 mysqli_close($connection);
 ?>


</body>

</html>
