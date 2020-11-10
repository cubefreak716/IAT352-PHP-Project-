<?php
   session_start();
   session_start();
   unset($_SESSION["log_username"]);
   unset($_SESSION["ID"]);

      header("Location: login.php");

?>
