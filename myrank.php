<?php
include_once 'config.php';
include_once 'db.php';
include_once 'util.php';
function getOverallScoreByLesson($user)
{
  $user =$_GET['user'];
  global $teamcount, $userlist;
  mysql_query("SET @a :=0;");
  $res = mysql_query("SELECT num FROM (SELECT (@a := @a +1)num, user_info.user_id, user_info.name, sum( grd_status.score ) newscore FROM `grd_status` , user_info, (SELECT  prob_info.prob_id prob_id,lessons.id lid,lessons.name,lessons.rank lrank,lesson_prob.rank prank FROM `lessons`,lesson_prob,prob_info WHERE lessons.active=1 and  lessons.id=lesson_prob.lesson_id and lesson_prob.active=1 and prob_info.prob_id=lesson_prob.prob_id ) p_info WHERE grd_status.user_id = user_info.user_id AND user_info.type = 'C' AND p_info.prob_id = grd_status.prob_id GROUP BY user_id ORDER BY `newscore` DESC )abc WHERE user_id = '$user'");
  $teamcount = mysql_num_rows($res);
  if($teamcount>0) {
	$num = mysql_result($res,0,'num');
	if($num<7) { 
		$color="#00FF00";
	} else if($num<13) {
		$color="#0000FF";
	} else if($num<19) {
		$color="#000000";				
	} else {
		$color="#FF0000";
	}
  echo "<h3 >Rank : <font style='color:".$color.";'>".$num."</font></h3>";
  }
  else {
  echo "<h3>No ranking.</h3>";
  }
}

function getOverallScore($user)
{
  $user =$_GET['user'];
  global $teamcount, $userlist;
  mysql_query("SET @a :=0;");
  $res = mysql_query("SELECT num FROM (SELECT (@a := @a +1)num, user_info.user_id, user_info.name, sum( grd_status.score ) newscore FROM `grd_status` , user_info, prob_info WHERE grd_status.user_id = user_info.user_id AND user_info.type = 'C' AND prob_info.avail = 'Y' AND prob_info.prob_id = grd_status.prob_id GROUP BY user_id ORDER BY `newscore` DESC )abc WHERE user_id = '".$user."';");
  $teamcount = mysql_num_rows($res);
  if($teamcount>0) {
	$num = mysql_result($res,0,'num');
	if($num<7) { 
		$color="#00FF00";
	} else if($num<13) {
		$color="#0000FF";
	} else if($num<19) {
		$color="#000000";				
	} else {
		$color="#FF0000";
	}
  echo "<h3 >Rank : <font style='color:".$color.";'>".$num."</font></h3>";
  }
  else {
  echo "<h3>No ranking.</h3>";
  }
}
checkauthen();
$id = $_SESSION['id'];
if(defined('TRAINING_MODE') || isadmin()) {
connect_db();
?>
<html><head><meta http-equiv="Content-Type"
    content="text/html; charset=utf-8" />
	<meta http-equiv="refresh"
    content="5" /></head><body>
<?
getOverallScoreByLesson($user);
}
?>
</body>
</html>
