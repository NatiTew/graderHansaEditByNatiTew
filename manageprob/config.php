<?php

define('SOURCE_DOWNLOAD',1);

define('SHOW_COMPILER_MSG',1);

//define('PRINTERNAME','\\\\manow-laptop\\hpLaserJ');
define('PRINTERNAME','\\\\192.168.0.1\\HP');

//1. ÊÍº »Ô´ËÁ´ 
//2. ÍºÃÁ à»Ô´ËÁ´ Analysis, Training
//3. ´Ù¤Ðá¹¹ à»Ô´ Analysis
define('ANALYSIS_MODE',1);
//define('CLOSESCORE',1);
define('TRAINING_MODE',1);

//this is for giving out students' outputs
function getoutputfname($user_id,$prob_id)
{
  //return "ou200406/".$user_id."-".$prob_id."-out.zip";
  return "/home/grad/grader/zip/".$user_id."-".$prob_id."-out.zip";
}
function getoutputpname($prob_id)
{
  //return "ou200406/".$user_id."-".$prob_id."-out.zip";
  return "/home/grad/grader/ev/".$prob_id.".zip";
}


//for MySQL
define("MYSQL_USER","grad");
define("MYSQL_PASSWD","GraD@2016");
define("MYSQL_DATABASE","grad2016");

//submission status
define("SUBSTATUS_UNDEFINED",0);
define("SUBSTATUS_INQUEUE",1);
define("SUBSTATUS_GRADING",2);
define("SUBSTATUS_ACCEPTED",3);
define("SUBSTATUS_REJECTED",4);

//user types
define("USERTYPE_ADMIN",'A');
define("USERTYPE_SUPERVISOR",'S');
define("USERTYPE_CONTESTANT",'C');


?>
