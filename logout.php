<?php session_start();
   if(isset($_SESSION['userid']) || isset($_SESSION['username'])) {
       session_destroy();
       session_unset();
       header("location: login.php");
   }
?>