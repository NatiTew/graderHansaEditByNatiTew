<?php
    session_start();
  if (!isset($_SESSION['type']) || !$_SESSION['type']==USERTYPE_ADMIN)
  {
    
    header('Location: login.php');
  }
    include_once 'db.php';
    
    $prob_id = $_GET['prob_id'];
    $sql = "SELECT prob_id FROM prob_info WHERE prob_id = '".$prob_id."'";
    
    connect_db();
    $result = mysql_query($sql);
    if(mysql_num_rows($result) > 0) {
      echo "yes";
    }else{
      echo "no";
    }
    close_db();
?>