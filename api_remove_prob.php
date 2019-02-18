<?php
	session_start();
  if (!isset($_SESSION['type']) || !$_SESSION['type']==USERTYPE_ADMIN)
  {
    
    header('Location: login.php');
  }
    include_once 'db.php';
    
    $prob_id = $_GET['prob_id'];
    $les_id = $_GET['les_id'];
    $sql = "DELETE FROM lesson_prob WHERE prob_id = '".$prob_id."' AND lesson_id = '".$les_id."'";
    
    connect_db();
    $result = mysql_query($sql);
?>