<?php

include_once './config.php';
include_once './db.php';
include_once './util.php';

function getOverallLabScoreByLesson()
{
  $user_id =$_GET['userid'];
  global $teamcount, $userlist;
  global $problem_list_temp,$problem_list,$problem_score;
  global $stu_list_temp,$stu_list,$stu_name, $stu_grp;

  $res = mysql_query("SELECT user_info.user_id, user_info.name, user_info.grp,  p_info.lid, p_info.name AS pname,
							 p_info.prob_id, grd_status.grading_msg, grd_status.score FROM `grd_status` , 
							 user_info, 
							 (SELECT  prob_info.prob_id prob_id,lessons.id lid,lessons.name,lessons.rank lrank,lesson_prob.rank prank 
							  FROM `lessons`,lesson_prob,prob_info 
							  WHERE lessons.id=lesson_prob.lesson_id
							        and prob_info.prob_id=lesson_prob.prob_id ) p_info
						WHERE p_info.prob_id = grd_status.prob_id
						AND grd_status.user_id = user_info.user_id
						ORDER BY user_id, p_info.prob_id");

  $teamcount = mysql_num_rows($res);
  for($i=0; $i<$teamcount; $i++) {
    $userlist[$i]['user_id'] = mysql_result($res,$i,'user_id');
    $userlist[$i]['name'] = mysql_result($res,$i,'name');
    $userlist[$i]['prob_name'] = mysql_result($res,$i,'pname');
    $userlist[$i]['prob_id'] = mysql_result($res,$i,'prob_id');
    $userlist[$i]['grp'] = mysql_result($res,$i,'grp');
    $userlist[$i]['grading_msg'] = mysql_result($res,$i,'grading_msg');
    $userlist[$i]['score'] = mysql_result($res,$i,'score');
    $userlist[$i]['count']=count_submit($userlist[$i]['prob_id'],$user_id);
    
    $stu_list_temp[$userlist[$i]['user_id']] = 1;
    $problem_list_temp[$userlist[$i]['prob_id']] = 1;
    $stu_name[$userlist[$i]['user_id']] = $userlist[$i]['name'];
    $stu_grp[$userlist[$i]['user_id']] = $userlist[$i]['grp'];
	$problem_score[$userlist[$i]['user_id']][$userlist[$i]['prob_id']] = $userlist[$i]['score'];
  }
  
  foreach($problem_list_temp as $key => $val)
	$problem_list[] = $key;

  foreach($stu_list_temp as $key => $val)
	$stu_list[] = $key;

 // foreach($stu_list_temp as $key => $val)
//	$stu_grp[] = $key;
  
}

checkauthen();
$id = $_SESSION['id'];
connect_db();
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head>

<body>
<?
if(defined('TRAINING_MODE') || isadmin()) {
	getOverallLabScoreByLesson();
	
	sort($problem_list);
	
	echo "<table width=600 border=1>";
		echo "<tr>
				<td>no</td>
				<td>user_id</td>
				<td>name</td>
				<td>group</td>";
			 foreach($problem_list as $value)
				echo "<td>$value</td>";
		echo "</tr>";
		
		$i=1;
		foreach($stu_list as $val) {
			echo "<tr>
					<td>" .($i++). " </td>
					<td> " . $val . "</td>
					<td> " . $stu_name[$val] . "</td>
					<td> " . $stu_grp[$val] . "</td>";
			 foreach($problem_list as $value){
				 $score = $problem_score[$val][$value];
				 echo "<td>$score</td>";
			 }
			echo "</tr>";
		}
		
	echo "</table>";
/*
echo "<table width=600 border=1>";
		echo "<tr>
				<td>" . "no" . " </td>
				<td> " . "user_id" . "</td>
				<td> " . "name" . "</td>
				<td> " . "prob_name" . "</td>
				<td> " . "prob_id" . "</td>
				<td> " . "grading_msg" . "</td>
				<td> " . "score" . "</td>
				<td> AT("."count".")</td>
			</tr>";
	for($i=0; $i<$teamcount; $i++) {
		echo "<tr>
				<td>" .($i+1). " </td>
				<td> " . $userlist[$i]['user_id'] . "</td>
				<td> " . $userlist[$i]['name'] . "</td>
				<td> " . $userlist[$i]['prob_name'] . "</td>
				<td> " . $userlist[$i]['prob_id'] . "</td>
				<td> " .  $userlist[$i]['grading_msg'] . "</td>
				<td> " .  $userlist[$i]['score'] . "</td>
				<td> AT(".$userlist[$i]['count'].")</td>
			</tr>";
	}
echo "</table>";
*/

} else {
	echo "<h1 align=center><font color='red'></font></h1>";
}
?>
</body>
</html>
