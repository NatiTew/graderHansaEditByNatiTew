﻿<?php

include_once 'config.php';
include_once 'db.php';
include_once 'util.php';

//session_start();
function getproblist()
{
  global $problist, $probcount;
  $res = mysql_query('SELECT * FROM prob_info WHERE avail="Y" ORDER BY prob_order');
  $probcount = mysql_num_rows($res);
  for($i = 0; $i<$probcount; $i++) {
    $problist[$i]['prob_id'] = mysql_result($res,$i,'prob_id');
    $problist[$i]['name'] = mysql_result($res,$i,'name');
    $problist[$i]['description'] = mysql_result($res,$i,'description');
  }
}
function makelesson()
{
  $sql = "SELECT * FROM `lessons` where active=1 order by rank";
  $res = mysql_query($sql);
  $lesson_count = mysql_num_rows($res);
  echo "| ";
  for($i = 0; $i<$lesson_count; $i++) {
	$lesson_id = mysql_result($res,$i,'id');
        $style="style='color:gray'";
        if($lesson_id==$_SESSION['lesson_id']) {
          $style="style='font-size:16pt;font-weight:bold;color:green'";
        }
  	echo "<a $style href='main.php?lesson_id=$lesson_id'>".mysql_result($res,$i,'name')."</a> |";
  }
  
  $style="style='color:gray'";
  if(0==$_SESSION['lesson_id']) {
     $style="style='font-size:16pt;font-weight:bold;color:green'";
  }
  echo "<a $style href='main.php?lesson_id=0'>All</a> |";
}

function makelesson_admin()
{
  $sql = "SELECT * FROM `lessons` where (active=1 or active=2) order by rank";
  $res = mysql_query($sql);
  $lesson_count = mysql_num_rows($res);
  echo "| ";
  for($i = 0; $i<$lesson_count; $i++) {
	$lesson_id = mysql_result($res,$i,'id');
        $style="style='color:gray'";
        if($lesson_id==$_SESSION['lesson_id']) {
          $style="style='font-size:16pt;font-weight:bold;color:green'";
        }
  	echo "<a $style href='main.php?lesson_id=$lesson_id'>".mysql_result($res,$i,'name')."</a> |";
  }
  
  $style="style='color:gray'";
  if(0==$_SESSION['lesson_id']) {
     $style="style='font-size:16pt;font-weight:bold;color:green'";
  }
  echo "<a $style href='main.php?lesson_id=0'>All</a> |";
}
function getproblist_by_lesson($lesson_id=0,$isadmin=0)
{
  global $problist, $probcount;
  $w="";
  if($lesson_id>0) {
    $w=" and lessons.id=".$lesson_id ;
  }
  if($isadmin==0) {
  $sql = "SELECT  lesson_prob.limit limit1,lesson_prob.active,lessons.id lesson_id,prob_info.prob_id prob_id, lesson_prob.rank, prob_info.name name, prob_info.description description FROM `lessons`,lesson_prob,prob_info WHERE lessons.active=1 and lessons.id=lesson_prob.lesson_id $w and lesson_prob.active<>0 and prob_info.prob_id=lesson_prob.prob_id order by lessons.rank,lesson_prob.rank, prob_info.name";
  } else {
  $sql = "SELECT  lesson_prob.limit limit1,lesson_prob.active,lessons.id lesson_id,prob_info.prob_id prob_id, lesson_prob.rank, prob_info.name name, prob_info.description description FROM `lessons`,lesson_prob,prob_info WHERE lessons.active<>0 and lessons.id=lesson_prob.lesson_id $w and lesson_prob.active<>0 and prob_info.prob_id=lesson_prob.prob_id order by lessons.rank,lesson_prob.rank, prob_info.name";
 
  }
  $res = mysql_query($sql);
  $probcount = mysql_num_rows($res);
  for($i = 0; $i<$probcount; $i++) {
    $problist[$i]['lesson_id']= mysql_result($res,$i,'lesson_id');
    $problist[$i]['prob_id'] = mysql_result($res,$i,'prob_id');
    $problist[$i]['name'] = mysql_result($res,$i,'name');
    $problist[$i]['description'] = mysql_result($res,$i,'description');
    $problist[$i]['active'] = mysql_result($res,$i,'active');
    $problist[$i]['limit'] = mysql_result($res,$i,'limit1');
    $problist[$i]['climit'] = count_submit($problist[$i]['prob_id'],$_SESSION['id']);
//    echo "l".$problist[$i]['limit']."c".$problist[$i]['climit']."|";
  }
}


function makeproboptions()
{
  global $problist, $probcount;
  $poption = "";
  for($i=0; $i<$probcount; $i++) {
	    $blimit=false;
	    if($problist[$i]['limit']==0) {
		$blimit=true;
	    } else {
	     if($problist[$i]['climit']<$problist[$i]['limit']) {
		$blimit=true;
	     }  
	    }
	    if($problist[$i]['active']==1 && $blimit ) {
	    $poption = $poption . 
		       "<option value=\"" . $problist[$i]['prob_id'] . "\">" .
		       $problist[$i]['name'] . " (" . $problist[$i]['prob_id'] . ")" . "</option>";
	    }
    }
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
  
  // Non edited
  if(strcmp($result_text, "accepted") == 0) {
    $result_text = "PERFECT";
  } else {
    if(strcmp($result_text, "rejected") == 0) {
      $result_text = "IMPERFECT";
    }
  } 
  
  echo $sub_num . ' submission(s), last on ' . $subtime . ' of size ' .$sublen .' bytes ';
  if(defined('ANALYSIS_MODE') || isadmin() || defined('TRAINING_MODE')) {
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
  if(defined('ANALYSIS_MODE') || isadmin()) {
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
  $k=0;
  $lastlesson_id=-1;
  for($i=0; $i<$probcount; $i++) {

  $diflimit="";
  if($problist[$i]['limit']>0) {
     if($problist[$i]['limit']>$problist[$i]['climit']) {
       $diflimit="<b>limit</b> : (".$problist[$i]['climit']."/".$problist[$i]['limit'].")";
     }
  }


          $lesson_id = $problist[$i]['lesson_id'];
	  if($lastlesson_id!=$lesson_id) {
             $lastlesson_id=$lesson_id;
             $k=0;
          }
          $k++;
	  if(defined('TRAINING_MODE')) {
		echo "<tr>";
		echo "<td>".$lastlesson_id.".".$k.".&nbsp;&nbsp;" .$problist[$i]['name'] . " [" . $problist[$i]['prob_id'] . "]". " " . $diflimit ;

		if ($problist[$i]['description'] != "" && $problist[$i]['description'] != NULL) {
			echo "(" . $problist[$i]['description'] . ")</td>";
		} else {
			echo "</td>";
		}
//		echo "<td><a href='resultoutput.php?pid=".$problist[$i]['prob_id']."'>Testset</a> | <a href=listproblem.php?q=".$problist[$i]['prob_id'].">Ranking</a></td></tr>";
		echo "<td><a href=listproblem.php?q=".$problist[$i]['prob_id'].">Ranking</a></td></tr>";
		echo "<tr><td colspan=3 bgcolor=white>";
		displayprobinfo($id, $problist[$i]['prob_id']);
		echo "</td></tr>";
	  }else if(defined('ANALYSIS_MODE')) {
		echo "<tr>";
//		echo "<td><a href=listproblem.php?q=".$problist[$i]['prob_id'].">Ranking</a></td></tr>";
		echo "<td>".$lastlesson_id.".".$k.".&nbsp;&nbsp;" .$problist[$i]['name'] . " [" . $problist[$i]['prob_id'] . "]</td>";
//		echo "<td><a href='resultoutput.php?pid=".$problist[$i]['prob_id']."'>Testset</a></td></tr>";
		echo "<tr><td colspan=3 bgcolor=white>";
		displayprobinfo($id, $problist[$i]['prob_id']);
		echo "</td></tr>";
	  } else if(isadmin()) {
		echo "<tr>";
		echo "<td>".($i+1).".&nbsp;&nbsp;" .$problist[$i]['name'] . " [" . $problist[$i]['prob_id'] . "]</td>";
		echo "<td><a href='resultoutput.php?pid=".$problist[$i]['prob_id']."'>Testset</a> | <a href=listproblem.php?q=".$problist[$i]['prob_id'].">Ranking</a></td></tr>";
		echo "<tr><td colspan=3 bgcolor=white>";
		displayprobinfo($id, $problist[$i]['prob_id']);
		echo "</td></tr>";

	  } else {
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
//getproblist();
check_lesson_session();

if($_SESSION['type']==USERTYPE_ADMIN){
	getproblist_by_lesson($_SESSION['lesson_id'],1);
} else {
	getproblist_by_lesson($_SESSION['lesson_id'],0);
}


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
if(defined('TRAINING_MODE') || isadmin()) {
echo "<iframe id='myframe' src='myrank.php?user=".$id."' marginheight='0' marginwidth='0' frameborder='0' vspace='0' hspace='0' style='position:absolute;left:750px;top:15px;width:150px;height:30px;'> </iframe>";
}
?>
<!--a href='Page.htm' align=right>Friend List</a-->
<table width="100%">
<tr><td align="left">
<b>Welcome:</b> <?php echo getname($id); ?> <b>School:</b> <?php echo getschool($id);?>
</td><td align="right">

<?if(defined('TRAINING_MODE')  || isadmin()) { ?>
<a href="pwdform.php">[change password]</a>
<?}?>
<a href="login.php">[logout]</a>
</td></tr>
</table><br>


<hr>

<?if(defined('TRAINING_MODE')  || isadmin()) { ?>
<h3><a href=topscore.php>Overall Score</a></h3>
<?}?>
<?php
if($_SESSION['type']==USERTYPE_ADMIN)
  listadmintools();
?>
<!--a href="problems/ISBN_INPUT.html" target="prob">ตัวอย่างข้อมูลนำเข้าข้อ ISBN</a>
<a href="problems/dice.doc" target="prob">โจทย์ข้อ ลูกเต๋า</a>
<a href="problems/structure.odt" target="prob">structure</a>
<hr-->
<?php
if($_SESSION['type']==USERTYPE_ADMIN)
  makelesson_admin();
else
  makelesson();
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
if(!defined('ANALYSIS_MODE')) {
?>
  <form action="submit.php" method="post" enctype="multipart/form-data">
  <input type="hidden" name="id" value="<?php echo $id; ?>">
  <select name="probid">
  <?php echo $proboption; ?>
  </select>
  <input type="file" name="code" size="20"><br />
  <input type="submit" name="submit" value="submit">
  </form>
<?
		}
?>
<!--<hr>
<b>Printing</b>

  <form action="print.php" method="post" enctype="multipart/form-data">
  <input type="hidden" name="id" value="<?php echo $id; ?>">
  <input type="file" name="code" size="20">
  <input type="submit" name="print" value="print">
  </form>

-->
<?php
}
?>
</body>
</html>

<?php
//session_destroy();
close_db();
?>
