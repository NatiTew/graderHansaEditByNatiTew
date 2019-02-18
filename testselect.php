<?php
include_once 'db.php';
include_once 'config.php';
include_once 'util.php';

checkauthen();
if($_SESSION['type']!=USERTYPE_ADMIN) {
  echo 'You do not have the permission to access this script.';
  exit;
}


echo '<center><table border=1>';
  echo '<tr><td width="20%"><b>prob_id</b></td>';
  echo '<td width="40%"><b>Problem</b></td><td><b>Difficulty</b></td></tr>';
  connect_db();
  $res = mysql_query("set character set utf8");
  $res = mysql_query("SELECT * FROM `prob_info` order by difficulty asc");
  $row=mysql_num_rows($res);
  for($i=0; $i<$row; $i++) {
    echo '<tr><td>' . mysql_result($res,$i,'prob_id') . '</td>';
    echo '<td>' . mysql_result($res,$i,'name') . '</td>';
	echo '<td>' . mysql_result($res,$i,'difficulty') . "</td></tr>\n";
  }
  close_db();
  echo '</table></center>';






?>