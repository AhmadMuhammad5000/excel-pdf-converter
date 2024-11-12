<?php session_start();
   if(!isset($_SESSION['userid']) || !isset($_SESSION['username'])) {
       header("location: login.php");
   }
?>