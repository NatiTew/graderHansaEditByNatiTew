<?php

include_once 'config.php';
include_once 'db.php';
include_once 'util.php';

//session_start();
$scoreP='';
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
  global $problist, $scoreP;

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
  //echo $sub_num . ' submission(s), last on ' . $subtime . ' of size ' .$sublen .' bytes ';
  if(defined('ANALYSIS_MODE') || isadmin() || defined('TRAINING_MODE')) {
      if($result_text == "Perfect!!! "){
        $scoreP = mysql_result($res,0,'grading_msg');
        echo  "<a href='#'data-toggle='tooltip' title=".$sub_num ."submission(s), last on". $subtime ."of size".$sublen ." bytes.><font color = 'green'>".'(' . $result_text . ': <tt>'. 
       mysql_result($res,0,'grading_msg') .'</tt>) '."</font></a>";
     }elseif($result_text == "Errors "){
      $scoreP = mysql_result($res,0,'grading_msg');
        echo "<a href='#' data-toggle='tooltip' title=".$sub_num ."submission(s), last on". $subtime ."of size".$sublen ." bytes.><font color = 'red'>".'(' . $result_text . ': <tt>'. 
       mysql_result($res,0,'grading_msg') .'</tt>) '."</font></a>";
     }
     else{
      $scoreP = mysql_result($res,0,'grading_msg');
      echo "<a href='#' data-toggle='tooltip' title=".$sub_num ."submission(s), last on". $subtime ."of size".$sublen ." bytes.><font color = 'yellow'>".'(' . $result_text . ': <tt>'. 
       mysql_result($res,0,'grading_msg') .'</tt>) '."</font></a>";
     }
       
  } else {
    if($result_text == "Perfect!!! "){
      $scoreP = mysql_result($res,0,'grading_msg');
      echo "<a href='#' data-toggle='tooltip' title=".$sub_num ."submission(s), last on". $subtime ."of size".$sublen ." bytes.><font color = 'green'>".'(' . $result_text . ')'."</font></a>";
    }
    elseif($result_text == "Errors "){
      $scoreP = mysql_result($res,0,'grading_msg');
      echo "<a href='#' data-toggle='tooltip' title=".$sub_num ."submission(s), last on". $subtime ."of size".$sublen ." bytes.><font color = 'red'>".'(' . $result_text . ')'."</font></a>";
    }
    else{
      $scoreP = mysql_result($res,0,'grading_msg');
      echo "<a href='#' data-toggle='tooltip' title=".$sub_num ."submission(s), last on". $subtime ."of size".$sublen ." bytes.><font color = 'yellow'>".'(' . $result_text . ')'."</font></a>";
    }
       
  }

echo "<br>";
  // compiler message
  if(defined('SHOW_COMPILER_MSG')) {
    echo "<a href=\"viewmsg.php?id=$id&pid=$prob_id\" ".
         "target=\"_blank\" data-toggle='tooltip' title='Compiler Message'><img src='Image/icon/Cmsg20.gif'></a>";
  }

  // links to source file
  if(defined('SOURCE_DOWNLOAD')) {
    //echo "<a href=\"viewcode.php?id=$id&pid=$prob_id&num=$sub_num\" target=\"_blank\">[source]</a>";
    echo "<a href=\"viewcode.php?id=$id&pid=$prob_id&num=$sub_num\" data-toggle='tooltip' title='Source'><img src='Image/icon/source20.gif'></a>";
  }

  // analysis mode
  if(defined('ANALYSIS_MODE') || isadmin()) {
  echo "<a href=\"viewoutput.php?id=$id&pid=$prob_id&num=$sub_num\" data-toggle='tooltip' title='Outputs'><img src='Image/icon/output20.gif'></a>";
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
    echo "<br>";
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

function listprobtest($id)
{
  global $problist, $probcount, $scoreP;
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
    
    echo  "<div class = 'flex-item'>"." ".$lastlesson_id.".".$k."<br>".$problist[$i]['name'] ."<br>". " [" . $problist[$i]['prob_id'] . "]". " " . $diflimit."<br>";
    displayprobinfo($i, $id, $problist[$i]['prob_id']);
    //echo "<form action=\"lesson.php\"><input type=\"submit\" name=\"fix\" value=\"fixNoData (".$problist[$i]['prob_id'].")\" /></form>";
    echo "<a href=lesson.php?q=".$problist[$i]['prob_id']."><img src='Image/icon/fixNoData20.gif'></a>";
    echo "<a href=listproblem.php?q=".$problist[$i]['prob_id']."><img src='Image/icon/Ranking20.gif'></a>";
    echo "<a href=facbookShare.php?q=".$problist[$i]['prob_id']."&s=".$scoreP."&v=".$id."><img src='Image/icon/facebook20.gif'></a>";
    echo " "."</div>";
//    echo "<td><a href='resultoutput.php?pid=".$problist[$i]['prob_id']."'>Testset</a> | <a href=listproblem.php?q=".$problist[$i]['prob_id'].">Ranking</a></td></tr>";
    // Non edited
                
    }else if(defined('ANALYSIS_MODE')) {
    echo "<tr>";
//    echo "<td><a href=listproblem.php?q=".$problist[$i]['prob_id'].">Ranking</a></td></tr>";
    echo "<td>".$lastlesson_id.".".$k.".&nbsp;&nbsp;" .$problist[$i]['name'] . " [" . $problist[$i]['prob_id'] . "]</td>";
//    echo "<td><a href='resultoutput.php?pid=".$problist[$i]['prob_id']."'>Testset</a></td></tr>";
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
  <link rel='stylesheet' type='text/css' href='css/lessonStyles.css'>
  <script type="text/javascript" src="js/lessonScript.js"></script>
  <!--link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,400italic"-->
  <script src="./jquery.min.js"></script>
  <link rel="stylesheet" href=".//bootstrap.min.css">
  <script src="./jquery.min.js"></script>
  <script src="./bootstrap.min.js"></script>
  <style>
/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    -webkit-animation-name: fadeIn; /* Fade in the background */
    -webkit-animation-duration: 0.4s;
    animation-name: fadeIn;
    animation-duration: 0.4s
}

/* Modal Content */
.modal-content {
    position: fixed;
    bottom: 0;
    background-color: #fefefe;
    width: 100%;
    -webkit-animation-name: slideIn;
    -webkit-animation-duration: 0.4s;
    animation-name: slideIn;
    animation-duration: 0.4s
}

/* The Close Button */
.close {
    color: white;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}

.modal-header {
    padding: 2px 16px;
    background-color: #5cb85c;
    color: white;
}

.modal-body {padding: 2px 16px;}

.modal-footer {
    padding: 2px 16px;
    background-color: #5cb85c;
    color: white;
}

/* Add Animation */
@-webkit-keyframes slideIn {
    from {bottom: -300px; opacity: 0} 
    to {bottom: 0; opacity: 1}
}

@keyframes slideIn {
    from {bottom: -300px; opacity: 0}
    to {bottom: 0; opacity: 1}
}

@-webkit-keyframes fadeIn {
    from {opacity: 0} 
    to {opacity: 1}
}

@keyframes fadeIn {
    from {opacity: 0} 
    to {opacity: 1}
}
</style>
  <title>Tower Floor</title>
  </head>

<body background="Image/bg/pgdh6.jpg">

<!--<audio autoplay>
  <source src="sound/Time Warp Sound Effect_cut1.mp3" type="audio/mpeg">
</audio>
<audio autoplay loop>
  <source src="sound/Sound Adventures - Magnificent Journey.mp3" type="audio/mpeg">
</audio>-->

<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="main.php">Main Tower</a>
  <a href="mainOld.php">Old System</a>
  <a href="profile.php">Profile</a>
  <a href="https://smart.cs.buu.ac.th/gdev/GraderManual.pdf">Grader Manual</a>
  <a href="https://smart.cs.buu.ac.th/gdev/exam59.pdf">Problems</a>
  <a href="login.php">logout</a>
</div>
&nbsp;<span style="font-size:20px;cursor:pointer" onclick="openNav()"><font color="white">&#9776; MENU :: GAME GRADER HANSA COMPUTER CYBER TOWER </font></span><br>
  &nbsp;<font color="#ccccb3">WELCOME : </font><font color="#f28e00"><?php echo getname($id); ?></font><font color="#ccccb3"> ACADEMY : </font><font color="#f28e00"><?php echo getschool($id);?></font><font color="#ccccb3">&nbsp; IP Address : </font><font color="#f28e00"><?php echo $_SERVER["REMOTE_ADDR"]; ?></font><br>
  &nbsp;<font color="#ccccb3">No ranking : </font><font color="#f28e00">7 &nbsp;</font>
  &nbsp;<font color="#ccccb3">Quantity Heart: </font><font color="red">&#10084; 19&nbsp;</font><br>
  
<center>
    <!-- Trigger/Open The Modal -->
    <button id="myBtn">Upload file</button>
</center> 
<br><br>
</div>
<div align="center">
  <div class="flexcontainer">        
    <?php listprobtest($id); ?>
  </div>
</div>
<?php
    listteam($_SESSION['group']);
    // Non edited
    $proboption = makeproboptions();
?>
<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="MySubmit" id="MySubmit">
      <form action="submit.php" method="post" enctype="multipart/form-data">
        <div class="my_id" id="my_id">
          <input type="hidden" name="id" value="<?php echo $id; ?>">
        </div>
        <div class="modal-header">
          <span class="close">&times;</span>
          <center><h2>Step 1. Choose the problem set </h2></center>
        </div>
        <div class="modal-body">
        <div class="MyProb" id="MyProb">
          <div>
            <br>
            <center>
            <select name="probid">
              <?php echo $proboption; ?>
            </select>
            </center>
            <br>
          </div>
        </div>
      </div>
    <div class="modal-header">
      <center><h2>Step 2. Upload main file and Upload other files  </h2></center>
    </div>
    <div class="modal-body">
      <div class="MyMain" id="MyMain">
        <div>
          <br>
          <center><input type="file" name="code" size="20"></center>
          <br>
        </div>
      </div>
      <div>
        <center><input type='file' name='f_input[]' multiple></center>
          <br>
      </div>
    </div>
      <div class="modal-footer">
        <div>
          <center><input type="submit" class="fsSubmitButton" name="submit" id="MySubmitButton" formmethod="POST" value="Submit"/></center>
        </div>
      </div>
      </form>
    </div>
  </div> 
 <script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>


</body>
</html>

<?php
//session_destroy();
close_db();
?>
