<?php

include_once 'db.php';
include_once 'util.php';

function checkpermission($id)
{
  if($_SESSION['type']==USERTYPE_ADMIN) {
    return TRUE;
  } else if($_SESSION['type']==USERTYPE_SUPERVISOR) {
    $res = mysql_query("SELECT * FROM user_info WHERE user_id=\"$id\"");
    if((mysql_num_rows($res)==1) && 
       (mysql_result($res,0,'grp')==$_SESSION['group']))
      return TRUE;
    else
      return FALSE;
  } else
    return ($id==$_SESSION['id']);
}

function outputfromfile($fname,$outfilename)
{
  header("Content-Type: application/force-download");
  header("Content-Type: text/plain");
  header("Content-Type: application/download");
  header("Content-Disposition: attachment; filename=".$outfilename.";");
  $fp = fopen($fname,'r');
  fpassthru($fp);
}

$pid=$_GET['pid'];

outputfromfile(getoutputpname($pid),
                   $pid.".zip");


?>
