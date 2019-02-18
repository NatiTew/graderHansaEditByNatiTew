<?php
	session_start();
  if (!isset($_SESSION['type']) || !$_SESSION['type']==USERTYPE_ADMIN)
  {
    
    header('Location: login.php');
  }
    include_once 'db.php';
    
    $prob_id = $_GET['prob_id'];
    $les_id = $_GET['les_id'];
    $limit = $_GET['limit'];
    $sql = "INSERT INTO lesson_prob(`lesson_id`,`prob_id`,`active`,`rank`,`limit`) VALUES('".$les_id."','".$prob_id."','1','1','".$limit."')";
    
    connect_db();
    $result = mysql_query($sql);


    if (mysql_affected_rows() < 1) {
    echo "Failed! This ".$prob_id." is already exists in this assignment.";
    }
    
    
?>