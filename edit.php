<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Update Record</title>
  <link rel="stylesheet" href="css/style.css" />

  <?php
    //connection set up
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
    $query = "SELECT * from users where id='2';";
    $result = mysqli_query($con, $query) or die ( mysqli_error());
    $row = mysqli_fetch_assoc($result);
  ?>

</head>
<body>
  <div class="form">
      <h1>Update Profile</h1>
      <?php
      $status = "";
      if(isset($_POST['new']) && $_POST['new']==1)
      {
        $id=$_REQUEST['id'];
        $password = $_REQUEST['password'];
        $username =$_REQUEST['username'];
        $email =$_REQUEST['email'];
        $phonenumber = $_REQUEST["phonenumber"];
        $update="update users set username='".$username."',
        password='".$password."', email='".$email."',
        phone_number='".$phonenumber."' where ID='0';";

        mysqli_query($con, $update) or die(mysqli_error());
        $status = "Profile Updated Successfully. </br></br>
        <a href='settings.php'>View Updated Profile</a>";
        echo '<p style="color:#FF0000;">'.$status.'</p>';

      }else {
        ?>
        <div>
          <form name="form" method="post" action="">
            <input type="hidden" name="new" value="1" />
            <input name="id" type="hidden" value="<?php echo $row['ID'];?>" />
            <p><input type="text" name="username" placeholder="Enter Username"
              required value="<?php echo $row['username'];?>" /></p>
              <p><input type="text" name="password" placeholder="Enter Password"
                required value="<?php echo $row['password'];?>" /></p>
                <p><input type="text" name="email" placeholder="Enter Email"
                  required value="<?php echo $row['email'];?>" /></p>
                  <p><input type="text" name="phonenumber" placeholder="Enter Phone Number"
                    required value="<?php echo $row['phone_number'];?>" /></p>
                <p><input name="submit" type="submit" value="Update" /></p>
              </form>
            <?php } ?>
          </div>
        </div>
      </body>
      </html>
