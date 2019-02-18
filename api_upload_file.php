<?php
   session_start();
  if (!isset($_SESSION['type']) || !$_SESSION['type']==USERTYPE_ADMIN)
  {
    
    header('Location: login.php');
  }

   $myFile = $_FILES['upload'];
   $fileCount = count($myFile["name"]);
   $prob_id = $_POST['prob_id'];

   for($i = 0;$i<$fileCount;$i++){
   $myDir = "/home/gdev/grader/ev/".$prob_id."/";
   mkdir($myDir, 0777);
   chmod($myDir, 0777);
   umask($myOld);
  
   $tmp_name = $_FILES['upload']['tmp_name'][$i];
   $name = $_FILES['upload']['name'][$i];
   echo $i." ".$tmp_name." ".$name;
   move_uploaded_file($tmp_name,"$myDir"."$name");
   $myDir = $myDir.$name;
   chmod($myDir,0777);
   }

  $cases = $_POST['cases'];
  $timelimit = $_POST['timelimit']*1000000;
  $myDir = "/home/gdev/grader/ev/".$prob_id."/conf";
  $myfile = fopen($myDir,w);
  $txt = "cases: ".$cases."\n";
  fwrite($myfile,$txt);
  $txt = "evaluator: ../scomp\n";
  fwrite($myfile,$txt);
  $txt = "timelimit: ".$timelimit."\n";
  fwrite($myfile,$txt);
  fclose();
  
  echo "<script>window.location='view_list_prob.php';</script>";
   

?>
