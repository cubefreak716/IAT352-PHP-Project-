<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Update Record</title>
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/main.php">
  <!-- <link rel="stylesheet" href="css/main.css"> -->
  <link rel="stylesheet" href="css/louiscss.php">
  <link rel="stylesheet" href="css/fonts.css">

  <?php
    //connection set up
    session_start();
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "louis_fourie";
    $con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    //testing connection
    if(mysqli_connect_errno()){
      die("Database connection failed: " . mysqli_connect_error() .
      " (" . mysqli_connect_errno() . ")"
      );
    }
    else{

    }
    $query = "SELECT * from users where id='{$_SESSION["ID"]}';";
    $result = mysqli_query($con, $query) or die ( mysqli_error());
    $row = mysqli_fetch_assoc($result);
  ?>

</head>
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
  $checkP=0;
  if(isset($_POST["fileToUpload"])) {
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
      $checkP=1;
      // if everything is ok, try to upload file
    } else {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
        $check++;
      } else {
        echo "Sorry, there was an error uploading your file.";
        $checkP=1;
      }
    }
   ?>

  <div class="form">
      <h1 class="itempage-heading">Update Profile</h1>
      <?php
      $status = "";
      if(isset($_POST['new']) && $_POST['new']==1 && $checkP==0)
      {
        $id=$_REQUEST['id'];
        $password = $_REQUEST['password'];
        $username =$_REQUEST['username'];
        $email =$_REQUEST['email'];
        $phonenumber = $_REQUEST["phonenumber"];
        $update="UPDATE users SET username='".$username."',
        password='".sha1($password)."', email='".$email."',
        phone_number='".$phonenumber."'";
        
        $update.= " WHERE BINARY username='".$_SESSION['log_username']."'";

        mysqli_query($con, $update) or die(mysqli_error());
        $status = "Profile Updated Successfully. </br></br>
        <a href='settings.php'>View Updated Profile</a>";
        echo '<p style="color:#FF0000;">'.$status.'</p>';

      }else {
      ?>
        <div class="profile-box">
          <form name="form" method="post" action="">
            <input type="hidden" name="new" value="1" />
            <input name="id" type="hidden" value="<?php echo $row['ID'];?>" />
            <p><input type="text" name="username" placeholder="Enter Username"
              required value="<?php echo $row['username'];?>" /></p>
            <p><input type="text" name="password" placeholder="Enter Password"
              required value="<?php echo "NewPassword";?>" /></p>
            <p><input type="text" name="email" placeholder="Enter Email"
              required value="<?php echo $row['email'];?>" /></p>
            <p><input type="text" name="phonenumber" placeholder="Enter Phone Number"
              required value="<?php echo $row['phone_number'];?>" /></p>
              <label for="Propicture">Profile Picture</label>
              <input type="file" name="fileToUpload" id="fileToUpload">
            <p><input name="submit" type="submit" value="Update" /></p>
          </form>
            <?php } ?>
        </div>
    </div>
</body>
</html>
