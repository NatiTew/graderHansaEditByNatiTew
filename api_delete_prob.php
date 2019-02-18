<?php
	session_start();
  if (!isset($_SESSION['type']) || !$_SESSION['type']==USERTYPE_ADMIN)
  {
    
    header('Location: login.php');
  }
    include_once 'db.php';
    
   

    $id = $_GET['id'];
    $sql = "delete from prob_info WHERE prob_id = '".$id."'";
    
    connect_db();
    $result = mysql_query($sql);
    echo "<script>window.location='view_list_prob.php';</script>";
?>