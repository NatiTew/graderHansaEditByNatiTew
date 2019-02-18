<?php
include_once 'config.php';
include_once 'db.php';
include_once 'util.php';

function checkpassword($id, $pass, &$user_type, &$user_group)
{
  $res = mysql_query("select * from user_info where user_id=\"$id\"");
  if(mysql_num_rows($res)==1) {
    if($pass==mysql_result($res,0,"passwd")) {
      return TRUE;
    } else
      return FALSE;    
  } else {
    return FALSE;
  }
}
function chgpassword($id,$pass) {
  $res = mysql_query("update  user_info set passwd='$pass' where user_id=\"$id\"");
}
session_start();
if(!isadmin() && !defined('TRAINING_MODE')) {
  echo '<html>';
  echo '<META HTTP-EQUIV="Refresh" CONTENT="3; URL=main.php?error=1">';
  echo '<body>';
  echo 'Unable to access this page.';
  echo '</body>';
  echo '</html>';

} else {

$p_id = $_POST['id'];
$p_pass = $_POST['password'];
$np_pass = $_POST['newpassword1'];
$np_pass2 = $_POST['newpassword2'];

connect_db();
$check = checkpassword($p_id,$p_pass,$user_type, $user_group);
if(!$check) {
   close_db();
  echo '<html>';
  echo '<META HTTP-EQUIV="Refresh" CONTENT="3; URL=pwdform.php">';
  echo '<body>Password is not correct.</body>';
  echo '</html>';


} else {
if($np_pass!=$np_pass2) {
  close_db();
  echo '<html>';
  echo '<META HTTP-EQUIV="Refresh" CONTENT="3; URL=pwdform.php">';
  echo '<body>Password1 != Password2.</body>';
  echo '</html>';

}else{
  chgpassword($p_id,$np_pass);
  close_db();
  echo '<html>';
  echo '<META HTTP-EQUIV="Refresh" CONTENT="3; URL=main.php">';
  echo '<body>Change password completed. Redirect to <a href=\'main.php\'>main</a></body>';
  echo '</html>'; 
} 
}
}
?>

