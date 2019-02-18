 <?php
   session_start();
  if (!isset($_SESSION['type']) || !$_SESSION['type']==USERTYPE_ADMIN)
  {
    
    header('Location: login.php');
  }
 include_once 'db.php';
 include_once 'config.php';

   $prob_id = $_POST['prob_id'];
   $myOld = umask(0);
   $myDir = "/home/gdev/public_html/problemcollection/555/";
   mkdir($myDir, 0777);
   chmod($myDir, 0777);
   umask($myOld);
   
   $tmp_name = $_FILES['code']['tmp_name'];
   $name = $_FILES['code']['name'];
   $ext = end((explode(".", $name)));
   $name = $prob_id.".".$ext;
   move_uploaded_file($tmp_name,"$myDir"."$name");
   $myDir = $myDir.$name;
   chmod($myDir,0777);
   $ext = end((explode("public_html", $myDir)));
  


 ?>
