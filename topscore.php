<?php

include_once 'config.php';
include_once 'db.php';
include_once 'util.php';

function getOverallScore()
{
  global $teamcount, $userlist;
  $res = mysql_query("SELECT user_info.user_id, user_info.name, user_info.grp, sum( grd_status.score ) newscore
FROM `grd_status` , user_info, prob_info 
WHERE grd_status.user_id = user_info.user_id and user_info.type='C' AND prob_info.avail='Y' AND prob_info.prob_id = grd_status.prob_id
GROUP BY user_id
ORDER BY `newscore` DESC");
  $teamcount = mysql_num_rows($res);
  for($i=0; $i<$teamcount; $i++) {
    $userlist[$i]['user_id'] = mysql_result($res,$i,'user_id');
    $userlist[$i]['name'] = mysql_result($res,$i,'name');
	$userlist[$i]['grp'] = mysql_result($res,$i,'grp');
	$userlist[$i]['newscore'] = mysql_result($res,$i,'newscore');
  }
}
function getOverallScoreByLesson()
{
  global $teamcount, $userlist;
  $res = mysql_query("SELECT user_info.user_id, user_info.name,user_info.grp, sum(grd_status.score) newscore,lasttime.maxtime AS maxtime ,submitcount.countsub  FROM `grd_status` , user_info, (SELECT  prob_info.prob_id prob_id FROM `lessons`,lesson_prob,prob_info WHERE lessons.active=1 and  lessons.id=lesson_prob.lesson_id and lesson_prob.active=1 and prob_info.prob_id=lesson_prob.prob_id ) p_info,(SELECT user_id, max( time ) AS maxtime FROM submission GROUP BY user_id) lasttime,(SELECT count( submission.prob_id ) countsub, user_id FROM submission, ( SELECT prob_info.prob_id prob_id FROM `lessons` , lesson_prob, prob_info WHERE lessons.active =1
AND lessons.id = lesson_prob.lesson_id AND lesson_prob.active =1 AND prob_info.prob_id = lesson_prob.prob_id )p_info WHERE submission.prob_id = p_info.prob_id GROUP BY submission.user_id) submitcount WHERE submitcount.user_id= user_info.user_id and lasttime.user_id=grd_status.user_id  and grd_status.user_id = user_info.user_id and user_info.type='C' AND p_info.prob_id = grd_status.prob_id GROUP BY user_id ORDER BY `newscore` DESC, submitcount.countsub ASC, lasttime.maxtime ASC");
  $teamcount = mysql_num_rows($res);
  mysql_error(); 
  for($i=0; $i<$teamcount; $i++) {
    $userlist[$i]['user_id'] = mysql_result($res,$i,'user_id');
    $userlist[$i]['name'] = mysql_result($res,$i,'name');
	$userlist[$i]['grp'] = mysql_result($res,$i,'grp');
	$userlist[$i]['newscore'] = mysql_result($res,$i,'newscore');
	$userlist[$i]['maxtime'] = mysql_result($res,$i,'maxtime');
	$userlist[$i]['countsub'] = mysql_result($res,$i,'countsub');
  }
}

checkauthen();
$id = $_SESSION['id'];
connect_db();
?>
<html><head><meta http-equiv="Content-Type"
    content="text/html; charset=utf-8" /></head>
<meta http-equiv="Content-Type"
    content="text/html; charset=utf-8" />
	<meta http-equiv="refresh"
    content="50">
	<body>
<?
if(defined('TRAINING_MODE')  || isadmin()) {
	getOverallScoreByLesson($q);
	$sumscore = 0;
	$avgscore = 0;
	$stunumber = 0;
	for($i=0; $i<$teamcount; $i++) {
		$sumscore=$sumscore+$userlist[$i]['newscore'];
		$stunumber = $stunumber + 1;
	}
	if($stunumber>0)
	$avgscore = round($sumscore/$stunumber);
	//echo "<a href='topscorep.php'>Print version</a><br>";
        echo "<a href='main.php'>&lt;&lt;Go to MainPage</a>";
	echo "<table width=1000 border=1>";
	echo " <tr ><td colspan=8 align=center><h1>Overall Score</h1></td></tr>";
	echo "<tr><td colspan=8><font size=4>Avg score : ".$avgscore."</font></td></tr>";
    echo "<tr><th>seq</th><th>id</th><th>name</th><th>group</th><th>school</th><th>score</th><th>submission count</th><th>last submission</th></tr>";
	$j=0;
	$score=0;
	$topscore_color="";
	for($i=0; $i<$teamcount; $i++) {
		if($score!=$userlist[$i]['newscore']) {
			$j=$i+1;
			$score=$userlist[$i]['newscore'];
		}
		if($j<=3) {
			$topscore_color=" bgcolor=#FFFFAA ";
		} 
		$count++ ;
		echo "<tr".$topscore_color."><td>" .($count). " </td><td>" . $userlist[$i]['user_id'] . " </td><td> " .$userlist[$i]['name'] . " </td><td>".$userlist[$i]['grp']. " </td><td>".getschool($userlist[$i]['user_id'])."</td>"."<td> <b><a href=allscorebyuser.php?userid=".$userlist[$i]['user_id'].">" .  $userlist[$i]['newscore'] . "</a></b></td>"."<td> <b>" .  $userlist[$i]['countsub'] . "</b></td>"."<td> <b>" .  $userlist[$i]['maxtime'] . "</b></td>"."</tr>";
		$topscore_color="";
	}

	echo "</table>";
} else {
	echo "<h1 align=center><font color='red'></font></h1>";
}
?>
</body>
</html>
