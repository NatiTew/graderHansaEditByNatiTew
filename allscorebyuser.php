<?php

include_once 'config.php';
include_once 'db.php';
include_once 'util.php';

function getOverallScore($user_id)
{
  $user_id =$_GET['userid'];
  global $teamcount, $userlist;
  $res = mysql_query("SELECT user_info.user_id, user_info.name,  prob_info.prob_id, grd_status.grading_msg, grd_status.score
FROM `grd_status` , user_info, prob_info
WHERE prob_info.prob_id = grd_status.prob_id
AND user_info.user_id = '$user_id'
AND grd_status.user_id = user_info.user_id AND prob_info.avail='Y'
ORDER BY prob_order");
  $teamcount = mysql_num_rows($res);
  for($i=0; $i<$teamcount; $i++) {
    $userlist[$i]['user_id'] = mysql_result($res,$i,'user_id');
    $userlist[$i]['name'] = mysql_result($res,$i,'name');
    $userlist[$i]['prob_id'] = mysql_result($res,$i,'prob_id');
    $userlist[$i]['grading_msg'] = mysql_result($res,$i,'grading_msg');
	$userlist[$i]['score'] = mysql_result($res,$i,'score');
        $userlist[$i]['count']=count_submit($userlist[$i]['prob_id'],$user_id);
	
  }
}
function getOverallScoreByLesson($user_id)
{
  $user_id =$_GET['userid'];
  global $teamcount, $userlist;
  $res = mysql_query("SELECT user_info.user_id, user_info.name,p_info.lid,p_info.name,  p_info.prob_id, grd_status.grading_msg, grd_status.score
FROM `grd_status` , user_info, (SELECT  prob_info.prob_id prob_id,lessons.id lid,lessons.name,lessons.rank lrank,lesson_prob.rank prank FROM `lessons`,lesson_prob,prob_info WHERE lessons.active=1 and lessons.id=lesson_prob.lesson_id and lesson_prob.active=1 and prob_info.prob_id=lesson_prob.prob_id ) p_info
WHERE p_info.prob_id = grd_status.prob_id
AND user_info.user_id =  '$user_id'
AND grd_status.user_id = user_info.user_id 
ORDER BY p_info.lrank,p_info.prank");
  $teamcount = mysql_num_rows($res);
  for($i=0; $i<$teamcount; $i++) {
    $userlist[$i]['user_id'] = mysql_result($res,$i,'user_id');
    $userlist[$i]['name'] = mysql_result($res,$i,'name');
    $userlist[$i]['prob_id'] = mysql_result($res,$i,'prob_id');
    $userlist[$i]['grading_msg'] = mysql_result($res,$i,'grading_msg');
	$userlist[$i]['score'] = mysql_result($res,$i,'score');
        $userlist[$i]['count']=count_submit($userlist[$i]['prob_id'],$user_id);
	
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
    content="5" />
<body>
<?
if(defined('TRAINING_MODE') || isadmin()) {
getOverallScoreByLesson($userid);

echo "<table width=600 border=1>";
echo " <tr ><td colspan=5 align=center><h1>" . $userlist[0]['user_id']. " " .$userlist[0]['name']. "</h1></td></tr>";
for($i=0; $i<$teamcount; $i++) {
    echo "<tr><td>" .($i+1). " </td><td>" . $userlist[$i]['prob_id'] . " </td><td> " .  $userlist[$i]['grading_msg'] . "</td><td> " .  $userlist[$i]['score'] . "</td><td> AT(".$userlist[$i]['count'].")</td></tr>";
}
echo "</table>";
} else {
	echo "<h1 align=center><font color='red'></font></h1>";
}
?>
</body>
</html>
