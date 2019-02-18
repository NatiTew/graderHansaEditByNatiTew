<?php

function checkauthen()
{
  session_start();
  if(!isset($_SESSION['id'])) {
    // no session
    session_destroy();
    echo '<html>You have not login, please ';
    echo '<a href="login.php">login</a><br>';
    exit();
  }
}

function getname($id)
{
//  $res = mysql_query("set character set utf8");
  $res = mysql_query("SELECT name FROM user_info WHERE user_id=\"$id\"");
  if(mysql_num_rows($res)==1)
    return mysql_result($res,0,'name');
  else
    return '(none)';
}

function getschool($id)
{
//  $res = mysql_query("set character set utf8");
  $res = mysql_query("SELECT school.name name FROM user_info, school WHERE user_info.user_id=\"$id\" and user_info.scid = school.scid");
  if(mysql_num_rows($res)==1)
    return mysql_result($res,0,'name');
  else
    return '(none)';
}

function saveFile($path, $finput,$foutput) {
$filename=$path.$filename;
header('Content-type: application/text');
header('Content-Disposition: attachment; filename="'.$fileout.'"');
readfile($filename);
}
function isadmin() {
	return $_SESSION['type']==USERTYPE_ADMIN;
}
function check_lesson_session() {
  session_start();
  if(!isset($_SESSION['lesson_id'])) {
    $_SESSION['lesson_id']=0;
    $sql = "SELECT * FROM  `lessons` WHERE DATE = CURRENT_DATE( ) AND active =1 ORDER BY rank";
    $res = mysql_query($sql);
    $probcount = mysql_num_rows($res);
    if($probcount>0)
    $_SESSION['lesson_id']=mysql_result($res,0,'id');
  } else {
    if(isset($_GET['lesson_id'])) {
      $_SESSION['lesson_id']=$_GET['lesson_id'];
    }
  }

}
function count_submit($prob_id,$user_id) {
    $sql="SELECT count(*) c FROM `submission` where prob_id='$prob_id' and user_id='$user_id'";
    $res = mysql_query($sql);
    $probcount = mysql_num_rows($res);
    if($probcount>0)
        $count=mysql_result($res,0,'c');
    return $count;
}

?>
