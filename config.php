<?php

define('SOURCE_DOWNLOAD',1);

define('SHOW_COMPILER_MSG',1);

//define('PRINTERNAME','\\\\manow-laptop\\hpLaserJ');
define('PRINTERNAME','\\\\192.168.0.1\\HP');

//1. �ͺ �Դ��� 
//2. ͺ�� �Դ��� Analysis, Training
//3. �٤�ṹ �Դ Analysis
//define('ANALYSIS_MODE',1);
//define('CLOSESCORE',1);
define('TRAINING_MODE',1);

//this is for giving out students' outputs
function getoutputfname($user_id,$prob_id)
{
  //return "ou200406/".$user_id."-".$prob_id."-out.zip";
  return "/home/gdev/grader/zip/".$user_id."-".$prob_id."-out.zip";
}
function getoutputpname($prob_id)
{
  //return "ou200406/".$user_id."-".$prob_id."-out.zip";
  return "/home/gdev/grader/ev/".$prob_id.".zip";
}


//for MySQL
define("MYSQL_USER","gdev");
define("MYSQL_PASSWD","gdev@2017");
// define("MYSQL_PASSWD","Once&forall");
define("MYSQL_DATABASE","gdev");

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
