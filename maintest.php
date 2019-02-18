<?php

include_once 'config.php';
include_once 'db.php';
include_once 'util.php';

function getproblist()
{
  global $problist, $probcount;
  $res = mysql_query('SELECT * FROM prob_info WHERE avail="Y" ORDER BY prob_order');
  $probcount = mysql_num_rows($res);
  for($i = 0; $i<$probcount; $i++) {
    $problist[$i]['prob_id'] = mysql_result($res,$i,'prob_id');
    $problist[$i]['name'] = mysql_result($res,$i,'name');
  }
}

function makeproboptions()
{
  global $problist, $probcount;

  $poption = "";
  for($i=0; $i<$probcount; $i++)
    $poption = $poption . 
               "<option value=\"" . $problist[$i]['prob_id'] . "\">" .
               $problist[$i]['name'] . "</option>";
  return $poption;
}

function displaysubinfo($id, $prob_id, $sub_num)
{
  $res = mysql_query("SELECT time, CHAR_LENGTH(code) AS len FROM submission WHERE user_id=\"$id\" " .
                     "AND prob_id=\"$prob_id\" AND sub_num=\"$sub_num\"");
  $subtime = mysql_result($res,0,'time');
  $sublen = mysql_result($res,0,'len');
  $q = "SELECT res_text, grading_msg FROM grd_status, res_desc " .
       "WHERE grd_status.user_id=\"$id\" " . 
       "AND grd_status.prob_id=\"$prob_id\" " .
       "AND grd_status.res_id=res_desc.res_id";
  $res = mysql_query($q);
  $result_text = mysql_result($res,0,'res_text');
  echo $sub_num . ' submission(s), last on ' . $subtime . ' of size ' .$sublen .' bytes ';
  if(defined('ANALYSIS_MODE')) {
       echo '(' . $result_text . ': <tt>'. 
       mysql_result($res,0,'grading_msg') .'</tt>) ';
  } else {
       echo '(' . $result_text . ')';
  }

  // compiler message
  if(defined('SHOW_COMPILER_MSG')) {
    echo "<FONT SIZE=-2>";
    echo "<a href=\"viewmsg.php?id=$id&pid=$prob_id\" ".
         "target=\"_blank\">[compiler message]</a>";
    echo "</FONT> ";
  }

  // links to source file
  if(defined('SOURCE_DOWNLOAD')) {
    echo "<FONT SIZE=-2>";
    //echo "<a href=\"viewcode.php?id=$id&pid=$prob_id&num=$sub_num\" target=\"_blank\">[source]</a>";
    echo "<a href=\"viewcode.php?id=$id&pid=$prob_id&num=$sub_num\">[source]</a>";
    echo "</FONT> ";
  }

  // analysis mode
  if(defined('ANALYSIS_MODE')) {
  echo "<FONT SIZE=-2>";
  echo "<a href=\"viewoutput.php?id=$id&pid=$prob_id&num=$sub_num\">[outputs]</a>";
  echo "</FONT>";
  }
}

function displayprobinfo($id, $prob_id)
{
  //query for recent submission
  mysql_query("LOCK TABLES submission READ, grd_status READ, res_desc READ");
  $q = "SELECT MAX(sub_num) AS sub_num FROM submission WHERE user_id=\"$id\" " .
       "AND prob_id=\"$prob_id\"";
  $res = mysql_query($q);
  if((mysql_num_rows($res)==1) && (mysql_result($res,0,'sub_num')!=NULL)) {
    $maxsub_num = mysql_result($res,0,'sub_num');
    displaysubinfo($id, $prob_id, $maxsub_num);
  } else
    echo 'not submitted';
  mysql_query("UNLOCK TABLES");
}

function listprob($id)
{
  global $problist, $probcount;
  echo "<table size=100% bgcolor=#FFFFAA border=1>";
 
  for($i=0; $i<$probcount; $i++) {
	  if(defined('TRAINING_MODE')) {
		echo "<tr>";
		echo "<td>".($i+1).".&nbsp;&nbsp;" .$problist[$i]['name'] . " [" . $problist[$i]['prob_id'] . "]</td>";
		echo "<td><a href=listproblem.php?q=".$problist[$i]['prob_id'].">Ranking</a></td></tr>";
		echo "<tr><td colspan=3 bgcolor=white>";
		displayprobinfo($id, $problist[$i]['prob_id']);
		echo "</td></tr>";
	  }else{
		echo "<tr>";
		echo "<td>".($i+1).".&nbsp;&nbsp;" .$problist[$i]['name'] . " [" . $problist[$i]['prob_id'] . "]</td></tr>";
		echo "<tr><td colspan=2 bgcolor=white>";
		displayprobinfo($id, $problist[$i]['prob_id']);
		echo "</td></tr>";
	  }
  }
  echo "</table>";
}

function displaymessage()
{
  if(!empty($_SESSION['msg'])) {
    echo "<b>" . $_SESSION['msg'] . "</b>";
    echo "<hr>";
    unset($_SESSION['msg']);
  }
}

function getteamlist($user_group)
{
  global $teamcount, $teamlist;
  $res = mysql_query("SELECT * FROM user_info " .
                     "WHERE grp=\"$user_group\" AND " .
                     "type='" . USERTYPE_CONTESTANT . "'");
  $teamcount = mysql_num_rows($res);
  for($i=0; $i<$teamcount; $i++) {
    $teamlist[$i]['user_id'] = mysql_result($res,$i,'user_id');
    $teamlist[$i]['name'] = mysql_result($res,$i,'name');
  }
}

function listteam($user_group)
{
  global $teamcount, $teamlist;

  for($i=0; $i<$teamcount; $i++) {
    echo "<font size=+2><b>";
    echo $teamlist[$i]['user_id']. " : ";
    echo $teamlist[$i]['name'];
    echo "</b></font><br>\n";
    listprob($teamlist[$i]['user_id']);
  }
}

function listadmintools()
{
  echo '<a href="upload_std_info.php">[upload student info]</a> ';
  echo '<a href="list_password.php">[list user passwords]</a> ';
  echo '<a href="random_user_password.php">[random user passwords]</a> ';
  echo "<hr>\n";
}

checkauthen();
$id = $_SESSION['id'];
connect_db();
getproblist();
if($_SESSION['type']==USERTYPE_SUPERVISOR)
  getteamlist($_SESSION['group']);
$proboption = makeproboptions();
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
</head>

<body>
<?
if(defined('TRAINING_MODE')) {
echo "<iframe id='myframe' src='myrank.php?user=".$id."' marginheight='0' marginwidth='0' frameborder='0' vspace='0' hspace='0' style='position:absolute;left:750px;top:15px;width:150px;height:30px;'> </iframe>";
}
?>
<a href='Page.htm'>รายชื่อเพื่อนร่วมชะตากรรม</a>
<table width="100%">
<tr><td align="left">
<b>Welcome:</b> <?php echo getname($id); ?> <b>School:</b> <?php echo getschool($id);?>
</td><td align="right">
<a href="login.php">[log out]</a>
</td></tr>
</table>
<hr>
<?if(defined('TRAINING_MODE')) { ?>
<h3><a href=topscore.php>Overall score</a></h3>
<?}?>
<?php
if($_SESSION['type']==USERTYPE_ADMIN)
  listadmintools();
?>
<?php
displaymessage();
?>

<?php
if(($_SESSION['type']==USERTYPE_ADMIN) || 
   ($_SESSION['type']==USERTYPE_CONTESTANT))
  listprob($id);
else
  listteam($_SESSION['group']);
?>
<hr>
<?php
if(($_SESSION['type']==USERTYPE_ADMIN) || 
   ($_SESSION['type']==USERTYPE_CONTESTANT)||($_SESSION['type']==USERTYPE_SUPERVISOR)) {
?>

  <form action="submit.php" method="post" enctype="multipart/form-data">
  <input type="hidden" name="id" value="<?php echo $id; ?>">
  <select name="probid">
  <?php echo $proboption; ?>
  </select>
  <input type="file" name="code" size="20"><br />
  <input type="submit" name="submit" value="submit">
  </form>

<hr>
<b>Printing</b>

  <form action="print.php" method="post" enctype="multipart/form-data">
  <input type="hidden" name="id" value="<?php echo $id; ?>">
  <input type="file" name="code" size="20">
  <input type="submit" name="print" value="print">
  </form>

<?php
}
?>
</body>
</html>

<?php
close_db();
?>
