<?php 
session_start();
  if (!isset($_SESSION['type']) || !$_SESSION['type']==USERTYPE_ADMIN)
  {
    
    header('Location: login.php');
  }
readfile("/home/gdev/grader/ev/002test/1.in");
?>
