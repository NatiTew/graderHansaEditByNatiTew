<?php

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
  
            // Non edited
	    // if($problist[$i]['active']==1 && $blimit )) {
	    if($problist[$i]['active']==1 && $blimit && !strstr($problist[$i]['restxt'], "in queue")) {
	    $poption = $poption . 
		       "<option value=\"" . $problist[$i]['prob_id'] . "\">" .
		       $problist[$i]['name'] . " (" . $problist[$i]['prob_id'] . ")" . "</OPTION>";
	    }
    }
  return $poption;
}

// Non edited
// function displaysubinfo($id, $prob_id, $sub_num)
function displaysubinfo($i, $id, $prob_id, $sub_num)
{
  global $problist;

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
    if(strcmp(mysql_result($res, 0, 'grading_msg'), "[no testdata]") == 0) {
      $result_text = "Errors ";
    } else {
      $result_text = "Perfect!!! ";
    }
  } else {
    if(strcmp($result_text, "rejected") == 0) {
      $result_text = "Errors ";
    }
  }
  // Non edited
  $problist[$i]['restxt'] = $result_text;
  // echo $problist[$i]['result_text']; 

  /* // For setting deadline,
  $Non_res = mysql_query("SELECT * FROM lesson_prob WHERE 1"); 
  echo $Non_res;
  $Non_lesson_id = mysql_result($Non_res,0, 'lesson_id');
  echo $Non_lesson_id;
  $non_res = mysql_query("SELECT date FROM lessons WHERE id=\"$prob_id\"");
  echo "Hello";
  $non_date = mysql_result($non_res,0,'date');
  echo $non_date;
  echo "Hello";
  // */ 
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

function displayprobinfo($i, $id, $prob_id)
{
  //query for recent submission
  mysql_query("LOCK TABLES submission READ, grd_status READ, res_desc READ");
  $q = "SELECT MAX(sub_num) AS sub_num FROM submission WHERE user_id=\"$id\" " .
       "AND prob_id=\"$prob_id\"";
  $res = mysql_query($q);
  if((mysql_num_rows($res)==1) && (mysql_result($res,0,'sub_num')!=NULL)) {
    $maxsub_num = mysql_result($res,0,'sub_num');
    // Non edited 
    // displaysubinfo($id, $prob_id, $maxsub_num);
    displaysubinfo($i, $id, $prob_id, $maxsub_num);
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
		// Non edited
                echo "<td><form action=\"main.php\"><input type=\"submit\" name=\"fix\" value=\"fixNoData (".$problist[$i]['prob_id'].")\" /></form></td>";
		echo "<td><a href=listproblem.php?q=".$problist[$i]['prob_id'].">Ranking</a></td>";
                echo "</tr>";
		echo "<tr><td colspan=3 bgcolor=white>";
	        // Non edited	
                // displayprobinfo($id, $problist[$i]['prob_id']);
		displayprobinfo($i, $id, $problist[$i]['prob_id']);
		echo "</td></tr>";
	  }else if(defined('ANALYSIS_MODE')) {
		echo "<tr>";
//		echo "<td><a href=listproblem.php?q=".$problist[$i]['prob_id'].">Ranking</a></td></tr>";
		echo "<td>".$lastlesson_id.".".$k.".&nbsp;&nbsp;" .$problist[$i]['name'] . " [" . $problist[$i]['prob_id'] . "]</td>";
//		echo "<td><a href='resultoutput.php?pid=".$problist[$i]['prob_id']."'>Testset</a></td></tr>";
		echo "<tr><td colspan=3 bgcolor=white>";
		// Non edited
                // displayprobinfo($id, $problist[$i]['prob_id']);
		displayprobinfo($i, $id, $problist[$i]['prob_id']);
		echo "</td></tr>";
	  } else if(isadmin()) {
		echo "<tr>";
		echo "<td>".($i+1).".&nbsp;&nbsp;" .$problist[$i]['name'] . " [" . $problist[$i]['prob_id'] . "]</td>";
		// Non edited
		// echo "<td><a href='resultoutput.php?pid=".$problist[$i]['prob_id']."'>Testset</a> | <a href=listproblem.php?q=".$problist[$i]['prob_id'].">Ranking</a></td>";
		echo "<td><a href='resultoutput.php?pid=".$problist[$i]['prob_id']."'>Testset</a> | <a href=listproblem.php?q=".$problist[$i]['prob_id'].">Ranking</a></td></tr>";
		echo "<tr><td colspan=3 bgcolor=white>";
		// Non edited
                // displayprobinfo($id, $problist[$i]['prob_id']);
		displayprobinfo($i, $id, $problist[$i]['prob_id']);
		echo "</td></tr>";

	  } else {
		echo "<tr>";
		echo "<td>".($i+1).".&nbsp;&nbsp;" .$problist[$i]['name'] . " [" . $problist[$i]['prob_id'] . "]</td></tr>";
		echo "<tr><td colspan=2 bgcolor=white>";
		// Non edited
                // displayprobinfo($id, $problist[$i]['prob_id']);
		displayprobinfo($i, $id, $problist[$i]['prob_id']);
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
  echo '<a href="create_assignment.php">[create new assignment]</a> ';
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
// Non edited
// $proboption = makeproboptions();

// Non edited
if($_GET) {
  if(isset($_GET['fix'])) fixNoData();
}

function fixNoData() {
  $my_startIndex = stripos($_GET['fix'], '(');
  $my_lastIndex  = stripos($_GET['fix'], ')');
  $my_probId     = substr($_GET['fix'], 11, $lastIndex - $startIndex-1);
  $my_Id         = $_SESSION['id'];

  $my_sql = "DELETE FROM grd_status " .
            "WHERE user_id='" . $my_Id . "' AND " .
                  "prob_id='" . $my_probId . "' AND " .
                  "grading_msg='[no testdata]'";

  // echo $my_sql;
 
  $res    = mysql_query($my_sql); 
  // echo $res;
}


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
<!--a href="pwdform.php">[change password]</a-->
<?}?>
<a href="login.php">[logout]</a>
</td></tr>
</table><br>

<!-- Non edited -->
<td align="left">
<b>IP Address: <?php echo $_SERVER["REMOTE_ADDR"]; ?></b> 
<br><br>
<h2>Download:</h2>
<h2><a href="./GraderManual.pdf" target="_blank">Grader Manual</a></h2>
<h2><a href="./exam59.pdf" target="_blank">Problems</a></h2>
<!--h3><a href="./codes">Download Codes</a></h3-->

</td>


<hr>

<?if(defined('TRAINING_MODE')  || isadmin()) { ?>
<!-- Non edited -->
<!-- <h3><a href=topscore.php>Overall Score</a></h3>-->
<!-- <h3><a href=alllabscorebyuser.php>Overall Score by Labs</a></h3>-->
<!--<h3><a href=grader_steps.htm>How to submit a file to grader</a></h3>-->
<!--h3><a href=getQuiz.php>Get Quizzes</a></h3-->
<?}?>
<!--h3><a href=http://grader.cs.buu.ac.th/downloads/eclipse3.4.rar>Eclipse 3.4</a></h3-->

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

  // Non edited
  $proboption = makeproboptions();

?>

<hr>
<?php

if(($_SESSION['type']==USERTYPE_ADMIN) || 
   ($_SESSION['type']==USERTYPE_CONTESTANT)||($_SESSION['type']==USERTYPE_SUPERVISOR)) {
if(!defined('ANALYSIS_MODE')) {
?>
  <!-- Non edited --!>
  <div class="MySubmit" id="MySubmit">
    <form action="submit.php" method="post" enctype="multipart/form-data">
    <div class="my_id" id="my_id">
      <input type="hidden" name="id" value="<?php echo $id; ?>">
    </div>
    
    <div class="MyProb" id="MyProb">
      <p> <br> Step 1. Choose the problem set: <br> </p>
      <div>
        <select name="probid">
        <?php echo $proboption; ?>
        </select>
        <br>
      </div>
    </div>

    <div class="MyMain" id="MyMain">
      <p> <br>Step 2. Upload main file: <br></p>
      <div>
        <input type="file" name="code" size="20">
        <br>
      </div>
    </div>

    <!-- Non edited --!>
    <div class="MyMain" id="MyMain">
      <p> <br><br>Step 3. Upload other files: <br></p>
      <div>
        <input type='file' name='f_input[]' multiple>
        <br><br>
        <br><br>
      </div>
    </div>
   
    <div>
        <input type="submit" name="submit" id="MySubmitButton" formmethod="POST" value="Submit" style="height:40px; width:90px; font-size:20px; font-weight:bold;"/>
    </div> 
    <!-- Non edited --!>

    </form>
  </div>

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
