<!DOCTYPE html>
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

function topScore($NT)
{
  if($NT == 0){
  $sql = "SELECT u.`user_id` , SUM( `score` ) sumScore FROM grd_status g, user_info u WHERE g.`user_id` = u.`user_id` GROUP BY u.`user_id` ORDER BY sumScore DESC LIMIT 0 , 10";
  $res = mysql_query($sql);
  $score_count = mysql_num_rows($res);
  $num_top = 0;
    echo "<table class='table table-inverse'>";
    echo "<thead><tr bgcolor='#066255'>";
    echo "<th>🏆 TOP10</th>";
    echo "<th>👥ID</th>";
    echo " <th>📒SCORE</th>";
    echo "</tr></thead>";
    echo "<tbody>";
    for($i = 0; $i<$score_count; $i++) {
    $u_id = mysql_result($res,$i,'u.user_id');
    $sum_score = mysql_result($res,$i,'sumScore');
    $num_top++;
    if($num_top == 1 ){
      echo "<tr bgcolor='#405753'>";
          echo "<th scope='row'>".$num_top."&nbsp;&nbsp;&nbsp;🥇</th>";
          echo "<td>".$u_id."</td>";
          echo "<td>".$sum_score."</td>";
          echo "</tr>";
    }elseif($num_top == 2){
      echo "<tr bgcolor='#405753'>";
          echo "<th scope='row'>".$num_top."&nbsp;&nbsp;&nbsp;🥈</th>";
          echo "<td>".$u_id."</td>";
          echo "<td>".$sum_score."</td>";
          echo "</tr>";
      }elseif($num_top == 3){
      echo "<tr bgcolor='#405753'>";
          echo "<th scope='row'>".$num_top."&nbsp;&nbsp;&nbsp;🥉</th>";
          echo "<td>".$u_id."</td>";
          echo "<td>".$sum_score."</td>";
          echo "</tr>";
      }else{
      echo "<tr bgcolor='#405753'>";
          echo "<th scope='row'>".$num_top."</th>";
          echo "<td>".$u_id."</td>";
          echo "<td>".$sum_score."</td>";
          echo "</tr>"; 
      }
    }
    
    echo "</tbody>";
  echo "</table>";
  }elseif($NT == 1){
  $sql = "SELECT u.`user_id` , SUM( `score` ) sumScore FROM grd_status g, user_info u WHERE g.`user_id` = u.`user_id` GROUP BY u.`user_id` ORDER BY sumScore DESC LIMIT 0 , 20";
  $res = mysql_query($sql);
  $score_count = mysql_num_rows($res);
  $num_top = 0;
    echo "<table class='table table-inverse'>";
    echo "<thead><tr bgcolor='#066255'>";
    echo "<th>🏆 TOP20</th>";
    echo "<th>👥ID</th>";
    echo " <th>📒SCORE</th>";
    echo "</tr></thead>";
    echo "<tbody>";
    for($i = 0; $i<$score_count; $i++) {
    $u_id = mysql_result($res,$i,'u.user_id');
    $sum_score = mysql_result($res,$i,'sumScore');
    $num_top++;
    if($num_top == 1 ){
      echo "<tr bgcolor='#405753'>";
          echo "<th scope='row'>".$num_top."&nbsp;&nbsp;&nbsp;🥇</th>";
          echo "<td>".$u_id."</td>";
          echo "<td>".$sum_score."</td>";
          echo "</tr>";
    }elseif($num_top == 2){
      echo "<tr bgcolor='#405753'>";
          echo "<th scope='row'>".$num_top."&nbsp;&nbsp;&nbsp;🥈</th>";
          echo "<td>".$u_id."</td>";
          echo "<td>".$sum_score."</td>";
          echo "</tr>";
      }elseif($num_top == 3){
      echo "<tr bgcolor='#405753'>";
          echo "<th scope='row'>".$num_top."&nbsp;&nbsp;&nbsp;🥉</th>";
          echo "<td>".$u_id."</td>";
          echo "<td>".$sum_score."</td>";
          echo "</tr>";
      }else{
      echo "<tr bgcolor='#405753'>";
          echo "<th scope='row'>".$num_top."</th>";
          echo "<td>".$u_id."</td>";
          echo "<td>".$sum_score."</td>";
          echo "</tr>"; 
      }
    }
    echo "</tbody>";
  echo "</table>";
  }elseif($NT == 2){
  $sql = "SELECT u.`user_id` , SUM( `score` ) sumScore FROM grd_status g, user_info u WHERE g.`user_id` = u.`user_id` GROUP BY u.`user_id` ORDER BY sumScore DESC";
  $res = mysql_query($sql);
  $score_count = mysql_num_rows($res);
  $num_top = 0;
    echo "<table class='table table-inverse'>";
    echo "<thead><tr bgcolor='#066255'>";
    echo "<th>🏆 All User</th>";
    echo "<th>👥ID</th>";
    echo " <th>📒SCORE</th>";
    echo "</tr></thead>";
    echo "<tbody>";
    for($i = 0; $i<$score_count; $i++) {
    $u_id = mysql_result($res,$i,'u.user_id');
    $sum_score = mysql_result($res,$i,'sumScore');
    $num_top++;
    if($num_top == 1 ){
      echo "<tr bgcolor='#405753'>";
          echo "<th scope='row'>".$num_top."&nbsp;&nbsp;&nbsp;🥇</th>";
          echo "<td>".$u_id."</td>";
          echo "<td>".$sum_score."</td>";
          echo "</tr>";
    }elseif($num_top == 2){
      echo "<tr bgcolor='#405753'>";
          echo "<th scope='row'>".$num_top."&nbsp;&nbsp;&nbsp;🥈</th>";
          echo "<td>".$u_id."</td>";
          echo "<td>".$sum_score."</td>";
          echo "</tr>";
      }elseif($num_top == 3){
      echo "<tr bgcolor='#405753'>";
          echo "<th scope='row'>".$num_top."&nbsp;&nbsp;&nbsp;🥉</th>";
          echo "<td>".$u_id."</td>";
          echo "<td>".$sum_score."</td>";
          echo "</tr>";
      }else{
      echo "<tr bgcolor='#405753'>";
          echo "<th scope='row'>".$num_top."</th>";
          echo "<td>".$u_id."</td>";
          echo "<td>".$sum_score."</td>";
          echo "</tr>"; 
      }
    }
    echo "</tbody>";
  echo "</table>";
  }
  
 
}

function getrank($id)
{
  $sql = "SELECT u.`user_id` , SUM( `score` ) sumScore FROM grd_status g, user_info u WHERE g.`user_id` = u.`user_id` GROUP BY u.`user_id` ORDER BY sumScore DESC LIMIT 0 , 10";
  $res = mysql_query($sql);
  $score_count = mysql_num_rows($res);
  $num_top = 0;
  	for($i = 0; $i<$score_count; $i++) {
		$u_id = mysql_result($res,$i,'user_id');
		$num_top++;
		if($u_id == $id){
			if($num_top == 1){
				echo "<font size ='10'>"."🥇".$num_top."</font>";
			}elseif($num_top == 2){
				echo "<font size ='10'>"."🥈".$num_top."</font>";
			}elseif($num_top == 3){
				echo "<font size ='10'>"."🥉".$num_top."</font>";
			}else{
				echo $num_top;
			}
		}
    }
  	
}
function getitem($id)
{
  $sql = "SELECT `user_id` , `Item` FROM `user_info` WHERE 1 LIMIT 0 , 30";
  $res = mysql_query($sql);
  $item_count = mysql_num_rows($res);
    for($i = 0; $i<$item_count; $i++) {
    $u_id = mysql_result($res,$i,'user_id');
    $itemH = mysql_result($res,$i,'Item');
      if($u_id == $id){
        echo "<font size ='10'>"."<font color='red'>❤</font>".$itemH."</font>";
      }
    }
}
function additem($id, $prob_id)
{
  close_db();
  connect_db();
  $sql = "SELECT u.`user_id` ,g.prob_id, g.accept FROM `user_info` u, grd_status g WHERE u.user_id = g.user_id AND u.`user_id` = '".$id."' AND prob_id = '".$prob_id."'";
  $sqlUPH = "UPDATE `user_info` SET `Item`= `Item` + 1 WHERE `user_id` ='".$id."'";
  $sqlAC = "UPDATE `grd_status` SET `accept`= '1' WHERE `user_id` =\"$id\"AND `prob_id` =\"$prob_id\"";
  $res = mysql_query($sql);
  $accept_count = mysql_num_rows($res);
  //echo "<script>console.log( 'Debug Objects: " . $res . "' );</script>";
    for($i = 0; $i<$accept_count; $i++){
        $uid = mysql_result($res,$i,'u.`user_id`');
        $pid = mysql_result($res,$i,'g.prob_id');
        $ac = mysql_result($res,$i,'g.accept');
        if($uid = $id){
          if($pid = $prob_id){
            if($ac < 1){
              mysql_query($sqlUPH);
              mysql_query($sqlAC);
            }
          }
        }

    }
}




function getrankdetail($id)
{
  $sql = "SELECT u.`user_id` , SUM( `score` ) sumScore FROM grd_status g, user_info u WHERE g.`user_id` = u.`user_id` GROUP BY u.`user_id` ORDER BY sumScore DESC LIMIT 0 , 10";
  $res = mysql_query($sql);
  $score_count = mysql_num_rows($res);
  $num_top = 0;
  	for($i = 0; $i<$score_count; $i++) {
		$u_id = mysql_result($res,$i,'user_id');
		$sum_score = mysql_result($res,$i,'sumScore');
		$num_top++;
		if($u_id == $id){
			echo $sum_score;

		}
    }
  	
}

function makelesson()
{
  $sql = "SELECT * FROM `lessons` where active=1 order by rank";
  $res = mysql_query($sql);
  $lesson_count = mysql_num_rows($res);
  for($i = 0; $i<$lesson_count; $i++) {
	$lesson_id = mysql_result($res,$i,'id');
    $style="style='color:gray'";
        if($lesson_id==$_SESSION['lesson_id']) {
          $style="style='font-size:16pt;font-weight:bold;color:green'";
        }
  	echo "<a $style href='main.php?lesson_id=$lesson_id#section41' class='list-group-item list-group-item-action'>".mysql_result($res,$i,'name')."</a>";
  }
  
  $style="style='color:gray'";
  if(0==$_SESSION['lesson_id']) {
     $style="style='font-size:16pt;font-weight:bold;color:green'";
  }
  echo "<a $style href='main.php?lesson_id=0#section41' class='list-group-item list-group-item-action'>All</a>";
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
  	echo "<a $style href='main.php?lesson_id=$lesson_id' class='list-group-item list-group-item-action'>".mysql_result($res,$i,'name')."</a> |";
  }
  
  $style="style='color:gray'";
  if(0==$_SESSION['lesson_id']) {
     $style="style='font-size:16pt;font-weight:bold;color:green'";
  }
  echo "<a $style href='main.php?lesson_id=0' class='list-group-item list-group-item-action'>All</a> |";
}
function getproblist_by_lesson($lesson_id=0,$isadmin=0)
{
  global $problist, $probcount;
  $w="";
  $sql = "SELECT grp FROM user_info WHERE user_id = '".$_SESSION['id']."'";
  $result = mysql_query($sql);
  $result = mysql_result($result,0,'grp');
  if($lesson_id>0) {
    /*$w=" and lessons.id='".$lesson_id."'";*/
    $x= "SELECT DISTINCT lesson_prob.limit limit1, lessons.active, assignment.lesson_id, assignment.prob_id, prob_info.name, description";
    $w=" assignment.lesson_id = '".$lesson_id."'";
    $z=" and user_id='".$_SESSION['id']."'";
    $y=" AND assignment.prob_id = lesson_prob.prob_id AND grp = '".$result."' AND deadline.lesson_id = '".$lesson_id."' AND (SELECT now()) < deadline.deadline AND lessons.active != '0'";
  }else{
    $x="SELECT DISTINCT lesson_prob.limit limit1, lessons.active, assignment.lesson_id, assignment.prob_id, prob_info.name, description";
    $w="";
    $z=" user_id='".$_SESSION['id']."'";
    $y=" AND assignment.prob_id = lesson_prob.prob_id AND assignment.lesson_id = lessons.id AND assignment.lesson_id = deadline.lesson_id AND grp = '".$result."' AND (SELECT now()) < deadline.deadline AND lessons.active != '0'";
  }
  
  
  if($isadmin==0) {
  /*$sql = "SELECT  lesson_prob.limit limit1,lesson_prob.active,lessons.id lesson_id,prob_info.prob_id prob_id, lesson_prob.rank, prob_info.name name, prob_info.description description FROM `lessons`,lesson_prob,prob_info WHERE lessons.active=1 and lessons.id=lesson_prob.lesson_id $w and lesson_prob.active<>0 and prob_info.prob_id=lesson_prob.prob_id order by lessons.rank,lesson_prob.rank, prob_info.name";*/
  /*$sql = "SELECT assignment.lesson_id,assignment.prob_id,name,description FROM  assignment,prob_info WHERE $w $z AND assignment.prob_id = prob_info.prob_id";*/
  
  $sql = "$x FROM assignment,lessons,prob_info,lesson_prob,deadline WHERE $w $z AND assignment.prob_id = prob_info.prob_id AND assignment.lesson_id = lesson_prob.lesson_id $y";
    echo "<script>console.log( 'Debug Objects: " . $sql . "' );</script>";
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


function makeproboptionsUPone($prob_id)
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
        if($prob_id = $problist[$i]['prob_id']){
          $poption = $poption . 
           "<option value=\"" . $problist[$i]['prob_id'] . "\">" .
           $problist[$i]['name'] . " (" . $problist[$i]['prob_id'] . ")" . "</OPTION>";
        }
      
      }
    }
  return $poption;
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
    echo "<div class='col-lg-3 col-md-6'>";
        echo "<div class='panel panel-primary'>";
            echo "<div class='panel-heading'>";
                echo "<div class='row'>";
                    echo "<div class='col-xs-3'>";
                        echo "<i class='fa fa-comments fa-5x'></i>";
                    echo "</div>";
                    echo "<div class='col-xs-9 text-right'>";
                        echo "<div class='huge'>".$problist[$i]['name']."[" . $problist[$i]['prob_id'] . "].".$diflimit."</div>";
                              displayprobinfo($i, $id, $problist[$i]['prob_id']);
                           //<div>New Comments!</div>
                          //</div>
                    //</div>
                //</div>
                //<a href="#">
                    //<div class="panel-footer">
                        //<span class="pull-left">View Details</span>
                        //echo "<span class='pull-right'><i class='fa fa-arrow-circle-right'></i></span>";
                        echo "<div class='clearfix'></div>";
                    echo "</div>";
                echo "</a>";
            echo "</div>";
        echo "</div>";
    
    
    
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
  
  if(defined('ANALYSIS_MODE') || isadmin() || defined('TRAINING_MODE')) {
    $scoreP = mysql_result($res,0,'grading_msg');
       echo "<div>".'(' . $result_text . ': <tt>'. 
       mysql_result($res,0,'grading_msg') .'</tt>)'."</div>";
       	echo "</div>";
  		echo "</div>";
  		echo "</div>";
  } else {
    $scoreP = mysql_result($res,0,'grading_msg');
       echo "<div>".'(' . $result_text . ')'."</div>";
       	echo "</div>";
  		echo "</div>";
  		echo "</div>";
  }
  	
  	echo "<a href='#section41'>";
 	echo "<div class='panel-footer' >";
	echo "<span class='pull-left'>".$sub_num . ' submission(s), last on ' . $subtime . ' of size ' .$sublen .' bytes'."</span>";
  	echo "<br>";
  	echo "<span class='pull-left'>";	
  // compiler message
  if(defined('SHOW_COMPILER_MSG')) {
    //echo "<a href=\"Testset _Exchange.php?id=$id&pid=$prob_id\"><img src='Image/icon/Testset.gif'></a>";
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
  echo "</span>";
  if($result_text == "Perfect!!! "){
    additem($id, $prob_id);
    echo "<FONT SIZE=-2><a href=main.php?q=".$problist[$i]['prob_id'].">[fixNoData]</a></font>";
      echo "<br>";
  		echo "<span class='pull-left'><a href=facbookShare.php?q=".$problist[$i]['prob_id']."&s=".$scoreP."&v=".$id."&le=".$problist[$i]['lesson_id']."><img src='Image/icon/facebook20.gif'></a><a href=listproblem.php?q=".$problist[$i]['prob_id']."&le=".$problist[$i]['lesson_id']."><img src='Image/icon/Ranking20.gif'></a></span>";
      echo "<span class='pull-right'><font color ='#00a300' size ='10'>✔</font></span>";
  	}elseif($result_text == "Errors "){
      //additem($id);
      echo "<FONT SIZE=-2><a href=main.php?q=".$problist[$i]['prob_id'].">[fixNoData]</a></font>";
      echo "<br>";
      echo "<span class='pull-left'><a href=facbookShare.php?q=".$problist[$i]['prob_id']."&s=".$scoreP."&v=".$id."&le=".$problist[$i]['lesson_id']."><img src='Image/icon/facebook20.gif'></a><a href=listproblem.php?q=".$problist[$i]['prob_id']."><img src='Image/icon/Ranking20.gif'></a><a href=\"Testset _Exchange.php?id=$id&pid=$prob_id&gmsg=$scoreP\"><img src='Image/icon/Testset.gif'></a></span>";
  		echo "<span class='pull-right'><a href='#section41' data-toggle='modal' data-target='#myModal'><font color ='#d17600' size ='10'>⚠</font></a></span>";
  	}else{
      //additem($id);
      //echo "<FONT SIZE=-2><a href=main.php?q=".$problist[$i]['prob_id'].">[fixNoData]</a></font>";
		  echo "<span class='pull-right'><font color ='#0275d8' size ='10'>↺</font></span>";
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
  } else{
    echo "<div>".'not submitted'."</div>";
    echo "</div></div></div><a href='#section41' data-toggle='modal' data-target='#myModal'><div class='panel-footer'><span class='pull-left'>Upload File</span>";
    echo "<span class='pull-right'><i class='fa fa-arrow-circle-right'></i></span>";
  	mysql_query("UNLOCK TABLES");
	}
	
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
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
  	<script src="bootstrap/js/bootstrap.js"></script>
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  	<style>
  		body {
      position: relative; 
  }
  .affix {
      top:0;
      width: 100%;
      z-index: 9999 !important;
  }
  .navbar {
      margin-bottom: 0px;
  }

  .affix ~ .container-fluid {
     position: relative;
     top: 50px;
  }
  		#section1 {padding-top:50px;height:cover;color: #fff; background: url(Image/bg/pgdh17.jpg) no-repeat center center fixed; -webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;}
  		#section2 {padding-top:50px;height:cover;color: #fff; background: url(Image/bg/pgdh12.jpg) no-repeat center center fixed; -webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;}
  		#section3 {padding-top:50px;height:cover;color: #fff; background: url(Image/bg/pgdh13.jpg) no-repeat center center fixed; -webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;}
  		#section41 {padding-top:50px;height:cover;color: black; background: url(Image/bg/pgdh14.jpg) no-repeat center center fixed; -webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;}
  		#section42 {padding-top:50px;height:cover;color: #fff; background: url(Image/bg/pgdh18.jpg) no-repeat center center fixed; -webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;}
      #mySidenav a {
        position: absolute;
        left: -80px;
        transition: 0.3s;
        padding: 15px;
        width: 100px;
        text-decoration: none;
        font-size: 20px;
        color: white;
        border-radius: 0 5px 5px 0;
      }
      #mySidenav a:hover {left: 0;}
      #projects {top: 80px;background-color: #f44336;}
  	</style>
	<title>Main Tower</title>
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="50">
<!--<div class="container-fluid" style="background-color:#F44336;color:#fff;height:100%;">
  <center><h1>Welcome <?php echo getname($id); ?> to Grader Hansa</h1>
  <h3>Computer The Cyber Tower : <?php echo getschool($id);?></h3></center>
</div>-->

<nav class="navbar navbar-inverse" data-spy="affix" data-offset-top="197">
  <div class="container-fluid">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">USER : <?php echo getname($id); ?></a>
    </div>
    <div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
          <li><a href="#section1">Home</a></li>
          <li><a href="#section2">Scoreboard</a></li>
          <li><a href="#section3">Lesson</a></li>
          <li><a href="#section41">Problem Info</a></li>
          <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Document<span class="caret"></span></a>
            <ul class="dropdown-menu">
              
              <!--<li><a href="#section42">Section 4-2</a></li>-->
              <li><a href="https://smart.cs.buu.ac.th/gdev/GraderManual/GraderManual.pdf">Grader Manual</a></li>
              <li><a href="https://smart.cs.buu.ac.th/gdev/exam59.pdf">Problems(PDF)</a></li>
            </ul>
          </li>
          
          <li><a href="login.php">logout</a></li>
        </ul>
      </div>
    </div>
  </div>
</nav>    

<div id="section1" class="container-fluid">
  <br><br><br><br><br><br><br><br><br><br><br><br>
  <br><br><br><br><br><br><br><br><br>
  <!--<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>-->
</div>
<div id="section2" class="container-fluid">
  <center><h1>Score Board</h1></center>
  <br><br>
  <!-- /.row -->
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php getrank($id); ?></div>
                                        <div>Your Rank!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">YOUR SCORE</span>
                                    <span class="pull-right"><?php getrankdetail($id); ?></span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-tasks fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php getitem($id); ?></div>
                                        <div>ITEM</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                
                <button type="button" onclick="myFunction(0)" class="btn btn-success">TOP10</button>
                <button type="button" onclick="myFunction(1)" class="btn btn-success">TOP20</button>
                <button type="button" onclick="myFunction(2)" class="btn btn-success">All User</button>
                <br><br>
                <p id="demo"></p>
               <script>
                    function myFunction(Listu) {
                      document.getElementById("demo").innerHTML = "";
                      
                      if(Listu == 0){
                        document.getElementById("demo").innerHTML = "<?php topScore(0); ?>";
                      }else if(Listu == 1){
                        document.getElementById("demo").innerHTML = "<?php topScore(1); ?>";
                      }else if(Listu == 2){
                        document.getElementById("demo").innerHTML = "<?php topScore(2); ?>";
                      }
                          
                    }
                </script>
                
                
                <!--<div><?php topScore(); ?></div>-->
                <br><br><br><br><br><br><br><br>
<br><br><br>

                <!-- /.row -->
</div>
<div id="section3" class="container-fluid">
  	 <center>
    <h1>Lessons</h1>
<br>
    <div class="list-group" style="width: 600px;height: 500px;overflow-y: auto;">
      <a href="#" class="list-group-item active">Select lessons :</a>
      <?php makelesson() ?>
  </div>
  </center>
  <br><br><br><br><br><br><br><br>
</div>
<div id="section41" class="container-fluid">
  	<center>
    <h1><font color="white">Problem Info</font></h1>
    <div id="mySidenav" class="sidenav">
        <a href="#" data-toggle='modal' data-target='#myModal'id="projects">Upload File</a>
    </div>
    <div><font color="white">[ ✔ : Perfect!!! ]&nbsp;[ ⚠ : Errors ]&nbsp;[ <img src="Image/icon/facebook20.gif"> : Share to facebook ]&nbsp;[ <img src="Image/icon/Ranking20.gif"> : Ranking]&nbsp;[ <img src='Image/icon/Testset.gif'> : Testset ]&nbsp;[ ↺ : in queue ]</font></div>
    </center>
     
    <br><br>

    <?php
      listteam($_SESSION['group']);
      $proboption = makeproboptions();
    ?>
    <!--<?php $proboptionOne = makeproboptionsUPone($prob_id); ?>-->
    <div class="row">
        <?php listprobtest($id); ?>
    </div>
    <br><br> <br><br> <br><br> <br><br> <br><br> <br><br> <br><br> 
    <!-- Modal Testset -->
  <div class="modal fade" id="myModalTestset" tabindex="-1" role="dialog" aria-labelledby="TestsetModalLabel" aria-hidden="true" style="position:fixed;top:10%;">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Testset Exchange</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Hi!
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">OK</button>
        </div>
      </div>
    </div>
  </div>
    <!--upload file by Modal --> 
    <div class="modal fade" id="myModal" role="dialog" style="position:fixed;top:10%;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      <div class="MySubmit" id="MySubmit">
      <form action="submit.php" method="post" enctype="multipart/form-data">
        <div class="my_id" id="my_id">
          <input type="hidden" name="id" value="<?php echo $id; ?>">
        </div>
        <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h2><font color="black">Step 1. Choose the problem set </font></h2>
        </div>
        <div class="modal-body">
        <div class="MyProb" id="MyProb">
          <div>
            <br>
            
            <select name="probid">
              <?php echo $proboption; ?>
              <!--<?php echo $proboptionOne; ?>-->
            </select>
            <br>
          </div>
        </div>
      </div>
    <div class="modal-header">
      <h2><font color="black">Step 2. Upload main file and Upload other files</font></h2>
    </div>
    <div class="modal-body">
      <div class="MyMain" id="MyMain">
        <div>
          <br>
          <input type="file" name="code" size="20">
          <br>
        </div>
      </div>
      <div>
        <input type='file' name='f_input[]' multiple>
          <br>
      </div>
    </div>
      <div class="modal-footer">
        <div>
          <input type="submit" class="fsSubmitButton" name="submit" id="MySubmitButton" formmethod="POST" value="Submit"/>
        </div>
      </div>
 </form>
    </div>
      </div>
    </div>
  </div> 
</div>

<div id="section42" class="container-fluid">
  <center>
    <h2>ENHANCEMENT OF THE GRADER SYSTEM</h2>
    <h3>FOR COMPUTER PROGRAMMING COURSE</h3>
    <br><br>
      <p>Team Project : Atiwat Aiemluk : Jirawat Sena : Parinya Thonghan</p>
  </center>
  <br><br><br><br><br><br><br><br><br><br>
</div>
	
</body>
</html>

<?php
//session_destroy();
close_db();
?>
