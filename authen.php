<?php
include_once 'db.php';
include_once 'config.php';

function checkpassword($id, $pass, &$user_type, &$user_group)
{
  $res = mysql_query("select * from user_info where user_id=\"$id\"");
  if(mysql_num_rows($res)==1) {
    if($pass==mysql_result($res,0,"passwd")) {
      $user_type = mysql_result($res,0,"type");
      $user_group = mysql_result($res,0,"grp");
      return TRUE;
    } else
      return FALSE;    
  } else {
    return FALSE;
  }
} 
/*
function checkpassword($id, $pass, &$user_type, &$user_group)
{
  $res = mysql_query("select * from user_info where user_id=\"$id\"");
  if(mysql_num_rows($res)==1) {
    if($pass==mysql_result($res,0,"passwd")) {
      $user_type = mysql_result($res,0,"type");
      $user_group = mysql_result($res,0,"grp");
      $user_ip = mysql_result($res, 0, "ipaddr");
      $server_ip = $_SERVER["REMOTE_ADDR"];
      if($user_ip == NULL) {
           // add $_SERVER["REMOTE_ADDR"] in DB
           $q = "UPDATE user_info SET ipaddr=\"$server_ip\" WHERE user_id=\"$id\"";
           $res = mysql_query($q);
      }  else {
         if($user_ip != $server_ip) {
            echo "The system allows only one machine to access.";
            die;
            return FALSE;
         }
      } 
      return TRUE;
    } else
      return FALSE;    
  } else {
    return FALSE;
  }
} 
*/
session_start();
$p_id = $_POST['id'];
$p_pass = $_POST['pass'];

connect_db();
$check = checkpassword($p_id,$p_pass,$user_type, $user_group);
close_db();

if($check) {
  $_SESSION['id']=$p_id;
  $_SESSION['type']=$user_type;
  $_SESSION['group']=$user_group;
  if($user_type==USERTYPE_ADMIN){
  echo '<html>';
  echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=mainadmin.php">';
  echo '</html>'; 
  }else{
  echo '<html>';
  echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=main.php">';
  echo '</html>'; 
  }
 
} else {
  session_destroy();
  echo '<html>';
  echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=login.php?error=1">';
  echo '</html>';
}
?>

