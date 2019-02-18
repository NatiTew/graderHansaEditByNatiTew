<?php
session_start();
  if (!isset($_SESSION['type']) || !$_SESSION['type']==USERTYPE_ADMIN)
  {
    
    header('Location: login.php');
  }
include_once 'db.php';
$les_id = $_POST['lesson_id'];
$limit = $_POST['random'];


$sql = "DELETE FROM assignment WHERE lesson_id = '".$les_id."'";

connect_db();
mysql_query($sql);


$sql = "SELECT user_id FROM user_info WHERE type = 'C'";
$student = array();
$result = mysql_query($sql);

if (mysql_num_rows($result) > 0){
	while ($row = mysql_fetch_array($result)) {
	 	array_push($student,$row['user_id']);
	 	
	}
} 

$sql = "SELECT prob_id FROM lesson_prob WHERE lesson_id = ".$les_id;
$prob = array();
connect_db();
$result = mysql_query($sql);

if (mysql_num_rows($result) > 0){
	while ($row = mysql_fetch_array($result)) {
	 	array_push($prob,$row['prob_id']);
	}
}

$lengthstud = sizeof($student);
$lengthprob = sizeof($prob);

if($limit==0){
	for($x = 0 ; $x < $lengthstud ; $x++){
		for($r = 0 ; $r < $lengthprob ; $r++){
			$sql = "INSERT INTO assignment(user_id,lesson_id,prob_id) VALUES('".$student[$x]."','".$les_id."','".$prob[$r]."')";
			mysql_query($sql);
			alert();
			
	}
}
}else{
	for($x = 0 ; $x < $lengthstud ; $x++){
	$numold = -1;
	$used = array();
	for($r = 0 ; $r < $limit ; $r++){
		$num = rand(0,$lengthprob-1);
		$usedlength = sizeof($used);
		$counter = checkdup($usedlength,$num,$used);
		while($counter>0){
			$num = rand(0,$lengthprob-1);
			$counter = 	checkdup($usedlength,$num,$used);
		}
		array_push($used,$num);
		$sql = "INSERT INTO assignment(user_id,lesson_id,prob_id) VALUES('".$student[$x]."','".$les_id."','".$prob[$num]."')";
		mysql_query($sql);
		alert();		
	}
}
}

function checkdup($usedlength,$num,$used){
	$counter = 0;
	for($c = 0 ;$c < $usedlength ;$c++){
			if($num==$used[$c]){
				$counter++;
				break;
			}
		}
	return $counter;
}


function alert() {
      echo "<script type='text/javascript'>window.location='view_list_lessons.php';</script>";
    }
?>