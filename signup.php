<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8">
<title> IAT352 PHP Project </title>

<meta name="viewport" content="width=device-width, initial=scale=1.0"> <!-- -->

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


  <?php

  $user_id = "";
  $username = $password = $password2 = $email= $phone = $notification = "";
  $nameErr = $passwordErr = $passwordErr2 = $emailErr = $phoneErr = "";
  $check = 0;

  if($_SERVER["REQUEST_METHOD"] == "POST"){
    $query = "SELECT * FROM users ";
    $result = mysqli_query($connection, $query);
    $user_id = mysqli_num_rows($result) + 1;
    // echo "number of row: ". $user_id . "";

    //Username
    if(empty($_POST["username"])){
      $nameErr = "Username is required";
    } else{
      $username = test_input($_POST["username"]);
      if(!preg_match(("/^[a-zA-Z0-9]{4,9}$/"), $username)){
        $nameErr = "Letters and Numbers Only min 4 max 9 char";
      }
      else{
        //good Input
        $query = "SELECT * FROM users ";
        $query.= "WHERE BINARY";
        $query.= " users.username = '" .$username. "' ";
        $result = mysqli_query($connection, $query);
        if($result && mysqli_num_rows($result)!=0){
          //no previous entry all good for registration
          $nameErr = "username already exists";
        }
        else{
          $nameErr = "username all good";
          $check++;
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
    ?>
    <?php
    if($check==4){
      if(""!==($_FILES["fileToUpload"]["name"])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
          $checkimg = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
          if($checkimg !== false) {
            echo "File is an image - " . $checkimg["mime"] . ".";
            $uploadOk = 1;
          } else {
            echo "File is not an image.";
            $uploadOk = 0;
          }
        }

        // Check if file already exists
        if (file_exists($target_file)) {
          echo "Sorry, file already exists.";
          $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
          echo "Sorry, your file is too large.";
          $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
          echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
          $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
          echo "Sorry, your file was not uploaded.";
          // if everything is ok, try to upload file
        } else {
          if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
            $check++;
          } else {
            echo "Sorry, there was an error uploading your file.";
          }
        }
       }else{
         $check++;
       }
    }
    //after all entries are checked
    //
    if($check==5){
      $query  = "INSERT INTO users (";
        $query .= "  ID, username, password, phone_number, email, photo";
        $query .= ") VALUES (";
          $query .= " '{$user_id}', '{$username}',";
          $query.=  "'".sha1($password)."'";
          $query.=  ", '{$phone}', '{$email}'";
          if(""!==($_FILES["fileToUpload"]["name"])) {
            $query.=", '{$target_file}'";
          }else{
            $query.=", 'uploads/charging.png'";
          }
          $query .= ")";

          $result = mysqli_query($connection, $query);

          if ($result) {
            // Success
            session_start();
            $_SESSION['log_username'] = $username;
            $_SESSION['ID']=$user_id;
            echo $_SESSION['log_username'];
            header("location: settings.php");
            $check  = 0;
          } else {
            // Failure
            $check = 0;
            die("Database query failed. " . mysqli_error($connection));
          }
        }
        else{
          //reset and redo
          $check = 0;
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
        <form class="signupform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data" method="post">
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

          <label for="Propicture">Profile Picture</label>
          <input type="file" name="fileToUpload" id="fileToUpload">

          <br><br><br>

          <input type="submit" name="submit" value="Submit">

          <br><br>
          <a class="link" href="login.php">Already a member? Log in! </a>

        </form>
      </div>

      <?php
        mysqli_close($connection);
      ?>
</body>
</html>
