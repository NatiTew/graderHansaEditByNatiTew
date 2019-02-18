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

    $username = $_POST['username'];
    $fullname = $_POST['fullname'];
    $type = $_POST['type'];
    if(empty($_POST['group'])){
        $group = '0';
    }
    else{
        $group = $_POST['group'];
    }
    $scid = $_POST['scid'];

    if($_POST['worktype']!="update"){
        $sql = "INSERT INTO user_info(user_id, name, passwd, grp, type, scid, ipaddr) VALUES ('".$username."','".$fullname."','".$username."','".$group."','".$type."','".$scid."',NULL)";
    }else{
        $sql = "UPDATE user_info SET name='".$fullname."',passwd='".$username."',grp='".$group."',type='".$type."',scid='".$scid."' WHERE user_id = '".$username."'";
    }

    
    
    connect_db();
    $result = mysql_query($sql);


    if (mysql_affected_rows() > 0) {
    alert("Success!");
    }
    else {
    alert("Failed!");
    }
    
?>