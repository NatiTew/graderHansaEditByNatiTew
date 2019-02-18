<?php
    session_start();
  if (!isset($_SESSION['type']) || !$_SESSION['type']==USERTYPE_ADMIN)
  {
    
    header('Location: login.php');
  }
    include_once 'db.php';
    
    function alert($msg) {
      echo "<script type='text/javascript'>alert('".$msg."');window.location='view_list_user.php';</script>";
    }

    $id = $_GET['id'];
    $sql = "delete from user_info WHERE user_id = '".$id."'";
    
    connect_db();
    $result = mysql_query($sql);


    if (mysql_affected_rows() > 0) {
    alert("Success!");
    }
    else {
    alert("Failed!");
    }
    
?>