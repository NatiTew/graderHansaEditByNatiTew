<?php
    session_start();
  if (!isset($_SESSION['type']) || !$_SESSION['type']==USERTYPE_ADMIN)
  {
    
    header('Location: login.php');
  }
    include_once 'db.php';
    include_once 'config.php';

    $prob_id = $_POST['prob_id'];
    $prob_name = $_POST['prob_name'];
    $prob_type = $_POST['prob_type'];
    $prob_difficulty = $_POST['prob_difficulty'];
    $prob_plagiarism = $_POST['plagiarism'];
    $prob_avail = $_POST['prob_avail'];
    $prob_order = $_POST['prob_order'];
    $prob_desc = $_POST['prob_desc'];
    $prob_score = $_POST['prob_score'];
    $prob_attempt = $_POST['prob_attempt'];
    $prob_success = $_POST['prob_success'];

   $myFile = $_FILES['upload'];
   $fileCount = count($myFile["name"]);

   for($i = 0;$i<$fileCount;$i++){
   
   $myDir = "/home/gdev/public_html/problemcollection/".$prob_id."/";
   mkdir($myDir, 0777);
   chmod($myDir, 0777);
   
   $tmp_name = $_FILES['upload']['tmp_name'][$i];
   $name = $_FILES['upload']['name'][$i];
   $ext = end((explode(".", $name)));
   $name = $prob_id.".".$ext;
   echo $name."<br>";
   move_uploaded_file($tmp_name,"$myDir"."$name");
   chmod($myDir.$name,0777);
   
 }
 $ext = end((explode("public_html/", $myDir)));

    if($_POST['worktype']!="update"){
        $sql = "INSERT INTO prob_info(`prob_id`,`name`,`type`,`difficulty`,`plagiarism_rate`,`path`,`avail`,`prob_order`,`description`,`score`,`attempt`,`success`) VALUES('".$prob_id."','".$prob_name."','".$prob_type."','".$prob_difficulty."','".$prob_plagiarism."','".$ext."','".$prob_avail."','".$prob_order."','".$prob_desc."','".$prob_score."','".$prob_attempt."','".$prob_success."')";
        
    }else{
        $sql = "UPDATE prob_info SET prob_id='".$prob_id."',name='".$prob_name."',type='".$prob_type."',difficulty='".$prob_difficulty."',plagiarism_rate='".$prob_plagiarism."',path='".$ext."',avail='".$prob_avail."',prob_order='".$prob_order."',description='".$prob_desc."',score='".$prob_score."',attempt='".$prob_attempt."',success='".$prob_success."' WHERE prob_id = '".$prob_id."'";
    }


   
    connect_db();
    $result = mysql_query($sql);
    close_db();

    $sql = "SELECT * FROM prob_desc WHERE desc_msg = '".$prob_desc."'";
     
    connect_db();
    $result = mysql_query($sql);
    if(mysql_num_rows($result) > 0) {
        $sql = "UPDATE `prob_desc` SET `desc_timestamp`=(SELECT now()) WHERE desc_msg = '".$prob_desc."'"; 
        mysql_query($sql);
    }else{
       $sql = "INSERT INTO `prob_desc`(`desc_msg`, `desc_timestamp`) VALUES ('".$prob_desc."',(SELECT now()))";
        mysql_query($sql);
    }
    
    echo "<script>window.location='view_list_prob.php';</script>";
?>
