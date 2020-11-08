<?php
  ob_start();

  session_start();

  define("PRIVATE_PATH", dirname(__FILE__));
  define("PROJECT_PATH", dirname(PRIVATE_PATH));
  define("PUBLIC_PATH", PROJECT_PATH . '/');
  define("SHARED_PATH", PRIVATE_PATH . '/shared');

  



 ?>
