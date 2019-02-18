<?php
include_once 'db.php';

function getpassword($id)
{
  $res = mysql_query("select * from user_info where user_id=\"$id\"");
  if(mysql_num_rows($res)==1) {
      $pass = mysql_result($res,0,"passwd");
      $user_ip = mysql_result($res, 0, "ipaddr");
      $server_ip = $_SERVER["REMOTE_ADDR"];
      if($user_ip == NULL) {
           // add $_SERVER["REMOTE_ADDR"] in DB
           $q = "UPDATE user_info SET ipaddr=\"$server_ip\" WHERE user_id=\"$id\"";
           $res = mysql_query($q);
           return $pass;
      }  else {
         if($user_ip != $server_ip) {
            echo "The system allows only one machine to access.";
            die;
         }
         return FALSE;
      }
      return TRUE;
  } else {
    return FALSE;
  }
}

session_start();
$p_id = $_POST['id'];

connect_db();
$pass = getpassword($p_id);
close_db();

if($pass) {
  echo '<html>';
  echo  "user id: ".$p_id."<br>";
  echo  "password: ".$pass; 
  echo '</html>'; 
} else {
  echo '<html>';
  echo "You alread got your password"; 
  echo '</html>';
}

echo '<html>';
echo "<br><h1><center><a href=\"https://smart.cs.buu.ac.th/gdev/login.php\">LOGIN</a></center></h1>";

session_destroy();
?>

