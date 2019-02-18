<?php
    include_once 'db.php';
    session_start();
  if (!isset($_SESSION['type']) || !$_SESSION['type']==USERTYPE_ADMIN)
  {
    
    header('Location: login.php');
  }
    
    function alert($msg,$id,$type) {
        if($type=="update"){
            echo "<script type='text/javascript'>alert('".$msg."');window.location='view_edit_lesson_prob.php?lesson_id=".$id."';</script>";
        }else{
            echo "<script type='text/javascript'>alert('".$msg."');window.location='view_edit_lesson.php?id=".$id."';</script>";
        }
      
    }

    $lessonname = $_POST['lessonname'];
    $status = $_POST['status'];
    $rank = $_POST['rank'];
    $expire = $_POST['expire'];
    $worktype = $_POST['worktype'];
    $id = $_POST['lessonid'];
    $limit = 2;
    $dead = $_POST['deadline'];
    if($_POST['worktype']!="update"){
        $sql = "INSERT INTO lessons(`name`,`date`,`active`,`rank`) VALUES('".$lessonname."',(SELECT CURDATE()),'".$status."','".$rank."')";
         connect_db();
        $result = mysql_query($sql);


    if (mysql_affected_rows() > 0) {
        
        $sql = "SELECT DISTINCT grp FROM user_info WHERE type= 'C'";
        connect_db();
        $result = mysql_query($sql);

        If (mysql_num_rows($result) > 0) {
            $sql = "SELECT max(id) id FROM lessons";
            $lesson_id = mysql_query($sql);
                while($row = mysql_fetch_array($lesson_id)){
                    $les_id = $row['id'];
                }

              while ($row = mysql_fetch_array($result)) {
              if(empty($id)){
                $sql = "INSERT INTO deadline(lesson_id,grp,deadline) VALUES('".$les_id."','".$row['grp']."',(SELECT NOW() + INTERVAL ".$dead." DAY))";
                echo $sql."<br>";
                
              }else{
                
              }
              
              connect_db();
              mysql_query($sql);
              
              $sql = "SELECT deadline FROM deadline WHERE `lesson_id`= '".$les_id."' AND `grp`= '".$row['grp']."'";  
              $resultdeadline = mysql_query($sql);
              $deadline = mysql_result ($resultdeadline,0,'deadline');
              $sqlupdate = "UPDATE `deadline` SET `deadline`= CONCAT(DATE('".$deadline."'), ' 23:59:59') WHERE `lesson_id`= '".$les_id."' AND `grp`= '".$row['grp']."'";
              echo $sqlupdate."<br>";

              mysql_query($sqlupdate);

              }
          }


    alert("Success! deadline is set to next ".$dead." day from current date, you can change it later on edit assignment page",$les_id,"create");
    }
    else {
    alert("Failed!");
    }

        
    }else{
            $sql = "UPDATE lessons SET name='".$lessonname."',date=(SELECT CURDATE()),active='".$status."',rank='".$rank."' WHERE id = '".$id."'";
            connect_db();
            if(mysql_query($sql)){

            $sql = "SELECT grp FROM deadline WHERE lesson_id = ".$id."";
            connect_db();
            $result = mysql_query($sql);

            while ($row = mysql_fetch_array($result)) {
            static $x = 0;
            $sql = "UPDATE deadline SET deadline = "."(SELECT DATE_FORMAT('".$_POST['d'.$x++]."','%Y-%m-%d %H:%i:%s')) WHERE grp = '".$row['grp']."' AND lesson_id = '".$id."'";
            connect_db();
            mysql_query($sql);
            }
            
            alert("Success!",$id,"update");
            }
            else {
            alert("Failed!");
            }

   } 
    //SELECT DATE_FORMAT('$_POST['d'.$x]','%Y-%m-%d %H:%i:%s')
?>