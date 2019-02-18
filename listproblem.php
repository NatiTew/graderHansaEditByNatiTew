<?php

include_once 'config.php';
include_once 'db.php';
include_once 'util.php';


function getuserlistproblemsuccess($problem)
{
  global $teamcount, $userlist;
  //$res = mysql_query("SELECT * FROM `grd_status`, user_info where prob_id='$problem' and //grd_status.user_id = user_info.user_id and score>0 order by `score` desc");
  /*$res = mysql_query("SELECT user_info.name name,user_info.user_id user_id,grd_status.prob_id prob_id, grd_status.grading_msg  grading_msg, maxtime.time time FROM `grd_status`, user_info, (SELECT user_id, prob_id, max( time ) time FROM `submission` GROUP BY submission.user_id , submission.prob_id order by time) maxtime  where grd_status.prob_id=maxtime.prob_id  and  user_info.user_id = maxtime.user_id and grd_status.prob_id='$problem'  and grd_status.user_id = user_info.user_id and score>0 order by `score` desc, time  asc");*/
$res = mysql_query("  (SELECT user_info.user_id, user_info.name, user_info.type, prob_user_grd.*,maxtime.time FROM (SELECT prob_info.prob_id, prob_info.name, grd_status.user_id, grd_status.grading_msg, grd_status.score FROM `grd_status` , prob_info WHERE  grd_status.prob_id = prob_info.prob_id AND prob_info.prob_id='$problem' ) prob_user_grd RIGHT JOIN user_info ON prob_user_grd.user_id = user_info.user_id LEFT JOIN (SELECT user_id, prob_id, max( time ) time FROM `submission` where submission.prob_id='$problem' GROUP BY submission.user_id , submission.prob_id order by time) maxtime ON maxtime.user_id=user_info.user_id WHERE user_info.type = 'C' ORDER BY prob_user_grd.score DESC, time ASC) ");
  $teamcount = mysql_num_rows($res);
  for($i=0; $i<$teamcount; $i++) {
    $userlist[$i]['user_id'] = mysql_result($res,$i,'user_id');
    $userlist[$i]['grading_msg'] = mysql_result($res,$i,'grading_msg');
    $userlist[$i]['grd_score']= mysql_result($res,$i,'score');
	$userlist[$i]['name'] = mysql_result($res,$i,'name');
	$userlist[$i]['time'] = mysql_result($res,$i,'time');
    $userlist[$i]['count']=count_submit($problem,$userlist[$i]['user_id']);
  }
}
$q=$_GET['q'];
$le=$_GET['le'];
checkauthen();
$id = $_SESSION['id'];
connect_db();
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="refresh" content="5" />
		<link rel='stylesheet' type='text/css' href='css/listproblemStyle.css'>
	</head>
<body background="Image/bg/pgdh7.jpg">
<?
if(defined('TRAINING_MODE') || isadmin()) {
	getuserlistproblemsuccess($q);
	echo " <center><h1><font color='white'>Top Rank Question</font></h1><h4><font color='white'>Lesson by $q</font></h4></center>";
	echo "<table>";
	for($i=0; $i<$teamcount; $i++) {

		if(is_null($userlist[$i]['grading_msg'])) {
			$msgg = "<td colspan=2 align='center' color='white'><b>!!!!No submission!!!!</b></td>";		
		} else {
			$msgg = "<td> " .  $userlist[$i]['grading_msg'] . "[".  $userlist[$i]['grd_score'] ."]</td><td> " .  $userlist[$i]['time'] . "</td>";
		}
		echo "<tr><td>" . $userlist[$i]['user_id'] . " </td><td> " .$userlist[$i]['name'] . " </td>"."<td width=200>".getschool($userlist[$i]['user_id'])."</td>".$msgg."<td> AT(".$userlist[$i]['count'].")</td></tr>";
	}
	echo "</table>";
} else {
	echo "<h1 align=center><font color='red'></font></h1>";
}
?>
<?php echo "<center><h4><a href='main.php?lesson_id=".$le."#section41'><img src='Image/icon/iconBack48.gif'></a><h4></center>"?>
</body>
</html>
