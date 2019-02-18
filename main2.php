<?php

include_once 'config.php';
include_once 'db.php';
include_once 'util.php';
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

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<link rel='stylesheet' type='text/css' href='styles.css'>
	<script type="text/javascript" src="script.js"></script>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,400italic">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
	</head>
<body background="327622.jpg" >

<?
if(defined('TRAINING_MODE') || isadmin()) {
echo "<iframe id='myframe' src='myrank.php?user=".$id."' marginheight='0' marginwidth='0' frameborder='0' vspace='0' hspace='0' style='position:absolute;left:750px;top:15px;width:150px;height:30px;'> </iframe>";
}
?>

<?if(defined('TRAINING_MODE')  || isadmin()) { ?>
<!--a href="pwdform.php">[change password]</a-->
<?}?>

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
  
<?php
}
?>
<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="main.php">Main Tower</a>
  <a href="https://smart.cs.buu.ac.th/gdev/GraderManual.pdf">Grader Manual</a>
  <a href="https://smart.cs.buu.ac.th/gdev/exam59.pdf">Problems</a>
  <a href="login.php">logout</a>
</div>
<span style="font-size:20px;cursor:pointer" onclick="openNav()"><font color="white">&#9776; MENU</font></span>
<font color="#ccccb3">WELCOME : Atiwat Aiemluk   ACADEMY : Burapha University</font><br>
<font color="#ccccb3">Quantity Heart: </font><font color="red">&#10084; 19 </font>
<font color="#ccccb3">No ranking : 7  </font>
<font color="#ccccb3">IP Address : 223.204.249.191</font>


</body>
</html> 
<?php
//session_destroy();
close_db();
?>
