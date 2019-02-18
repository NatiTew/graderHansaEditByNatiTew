<?php
 include_once 'db.php';
    session_start();
  if (!isset($_SESSION['type']) || !$_SESSION['type']==USERTYPE_ADMIN)
  {
    
    header('Location: login.php');
  }

  $id = $_GET['id'];
  connect_db();

  $sql = "DELETE FROM assignment WHERE lesson_id = '".$id."'";
  mysql_query($sql);

  $sql = "DELETE FROM deadline WHERE lesson_id = '".$id."'";
  mysql_query($sql);

  $sql = "DELETE FROM lessons WHERE id = '".$id."'";
  mysql_query($sql);

  $sql = "DELETE FROM lesson_prob WHERE lesson_id = '".$id."'";
  mysql_query($sql);

  echo "<script>window.location='view_list_lessons.php';</script>";
?>