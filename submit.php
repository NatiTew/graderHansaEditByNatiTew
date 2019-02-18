<?php

include_once 'config.php';
include_once 'db.php';
include_once 'util.php';

function getsubstatus($id, $probid)
{
  $res = mysql_query("SELECT * FROM grd_status WHERE user_id=\"$id\" AND ".
                     "prob_id=\"$probid\"");
  if(mysql_num_rows($res)==1) {
    $status = mysql_result($res,0,'res_id');
    settype($status,'integer');
    return $status;
  } else
    return SUBSTATUS_UNDEFINED;
}

function setsubstatus($id, $probid, $status)
{
  $res = mysql_query("SELECT * FROM grd_status WHERE user_id=\"$id\" AND ".
                     "prob_id=\"$probid\"");
  //  echo "HELLO";
  if(mysql_num_rows($res)==1) {
    $q = "UPDATE grd_status SET res_id=$status WHERE user_id=\"$id\" AND ".
      "prob_id=\"$probid\"";
  } else {
    $q = "INSERT INTO grd_status (user_id, prob_id, res_id) VALUES ".
      "(\"$id\",\"$probid\",$status)";
  }
  $res = mysql_query($q);
  if($res!=TRUE)
    echo "ERROR: " . mysql_error() . "<br>";
  return $res;
}

function putinqueue($id, $probid, $sub_num)
{
  $res = mysql_query("SELECT q_id FROM grd_queue WHERE user_id=\"$id\" AND ".
                     "prob_id=\"$probid\"");
  if(mysql_num_rows($res)==1) {
    $res = mysql_query("UPDATE grd_queue SET sub_num=$sub_num WHERE user_id=\"$id\" AND ".
                       "prob_id=\"$probid\"");
  } else {
    $res = mysql_query("INSERT INTO grd_queue (user_id, prob_id, sub_num) VALUES ".
                       "(\"$id\",\"$probid\",$sub_num)");
  }
  return $res;
}

function getsubcount($id,$probid)
{
  $query = mysql_query("select * from submission where user_id=\"$id\" and prob_id=\"$probid\"");
  return mysql_num_rows($query);
}

function builddate()
{
  return date("Y-m-d H:i:s");
}

function savesubmission($id, $probid, $content)
{
  $msg = NULL;
  
  mysql_query("LOCK TABLE submission WRITE, grd_queue WRITE, " .
              "grd_status WRITE");
  
  // savesubmission: savefile, set status, add submission to queue
  
  $status = getsubstatus($id, $probid);
  //  echo "status = " . $status . "<br>";
  if($status!=SUBSTATUS_GRADING) {
    // savefile
    $subcount = getsubcount($id, $probid);
    $timestamp = builddate();
    $query = "insert into submission (user_id,prob_id,sub_num,time,code) values " .
      "(\"$id\",\"$probid\"," . ($subcount+1) . ",now(), ".
      "\"" . mysql_real_escape_string($content) . "\");";
    //    echo htmlspecialchars($query);
    $res = mysql_query($query);
    if($res!=TRUE)
      $msg = "ERROR: Database problem (insertion error)";
    else {
      if(setsubstatus($id, $probid, SUBSTATUS_INQUEUE)!=TRUE)
        $msg = "ERROR: Database problem (grd_status)";
      else {
        if(putinqueue($id, $probid, $subcount+1)!=TRUE)
          $msg = "ERROR: Database problem (grd_queue)";
      }
    }
  } else {
    $msg = "ERROR: Grading old submission, please wait.";
  }
  mysql_query("UNLOCK TABLES");

  return $msg;
}

// Non edited
function my_unlink($wild_card) {
  foreach (glob($wild_card) as $filename) {
    echo "$filename size " . filesize($filename) . "\n";
    unlink($filename);
  }
}

function processsubmission()
{
 
  $id = $_SESSION['id'];
  
  $myOld = umask(0);
  $myDir = "/home/gdev/public_html/fileuploads/";
  mkdir($myDir, 0777);
  $myDir = "/home/gdev/public_html/fileuploads/".$_POST['probid']."/";
  mkdir($myDir, 0777);
  $myDir = "/home/gdev/public_html/fileuploads/".$_POST['probid']."/".$_POST['id']."/";
  mkdir($myDir, 0777);
  chmod($myDir, 0777);
  umask($myOld);
  
  $result = "JPlag/".$_POST['id']."/".$_POST['probid']."/";
  $subdir = "fileuploads/".$_POST['probid']."/";
  $htmlurl = "JPlag/".$_POST['id']."/".$_POST['probid']."/index.html";
  
  $ftmp_name = $_FILES['code']['tmp_name'];
  
  $fcontent = file_get_contents($ftmp_name);
  
  $fname = basename($_FILES['code']['name']);
  
  $fsize = $_FILES['code']['size'];
  
  $idd = $_POST['id'];
  
  $probidd = $_POST['probid'];
  
  $fpath = $_FILES['code']['name'];
  $extension = pathinfo($fpath, PATHINFO_EXTENSION);
  $extension = strtolower($extension);
  $plagia = 0;
  
  // echo 'id = ' . $id;
  if(($fsize>0) && ($fsize<=100000)) {
    connect_db();
	
	$sqld = "SELECT * FROM prob_info WHERE prob_id =\"$probidd\"";
	$resd = mysql_query($sqld);
	
	$sqlserver = "SELECT * FROM plagiamode;";
	$resserver = mysql_query($sqlserver);
	
	while ($row = mysql_fetch_array($resd)){
		$diff = $row['difficulty'];
		$diffp = $row['plagiarism_rate'];
	}
	
	while ($row = mysql_fetch_array($resserver)){
		$servermode = $row['plagia_status'];
	}
	
	if(move_uploaded_file($ftmp_name,"$myDir"."$_POST[probid]"."."."$extension")){
	   
	   
	$output = shell_exec("rm -r '".$result."'");
	
	
	
	if($diff!="E" && strlen($diff)>=1 && $servermode!=0){
	
	if($extension == "c"){
		
		$output = shell_exec("java -jar jplag.jar -l c/c++ -m '".$diffp."'% -r '".$result."' -s '".$subdir."'");
		
	}else if($extension =="java"){
		
		$output = shell_exec("java -jar jplag.jar -l java17 -m '".$diffp."'% -r '".$result."' -s '".$subdir."'");
	}
	
	//echo "\"".$diff."\"";
	//echo "<br>";
	//echo "<pre>$output</pre>";
	
	//$output = shell_exec("java -jar jplag.jar -l java17 -m 80% -r '".$result."' -s '".$subdir."'");
	
	
	$contents = file_get_contents($htmlurl);
	
	$search = array('@<script[^>]*?>.*?</script>@si',  	// Strip out javascript
           '@<head>.*?</head>@siU',            			// Lose the head section
           '@<style[^>]*?>.*?</style>@siU',    			// Strip style tags properly
           '@<![\s\S]*?--[ \t\n\r]*>@'         			// Strip multi-line comments including CDATA
					);
					
	$contents = preg_replace($search, '', $contents);
	
	$result = str_word_count(strip_tags($contents),1, '1234567890');
	//print_r($result);
	for ($i = 0; $i <= count($result); $i++) {
		
	if (strpos($result[$i], $_POST['id']) !== false) {
		$percentage = $result[$i+1];
		$sql = "INSERT INTO plagia_record (user_id, prob_id, status)
				VALUES ('$idd', '$probidd', 'YES')";
						
		$res = mysql_query($sql);
		echo "<h2><center><font color = Red>Upload rejected</center></font></h2>";
		echo "<h2><center><font color = Red>ไฟล์งาน '".$probidd."' ของคุณเหมือนกับของเพือนมากเกินไป</center></font></h2>";
		echo "<h1><center><font color = Red>กรุณาส่งใหม่</center></font></h1>";
		$plagia = 1;
		break;
		}
	}
	
	}
	
   }else{
	   echo "<h1><center><font color = Red>อัพโหลดผิดพลาด</center></font></h1>";
   }
  } else {
    $_SESSION['msg']='ERROR: File too large';
	echo "<h1><center><font color = Red>Upload Unsuccesful</center></font></h1>";
  }
  
  
  if($plagia==0){
	  
	$sql = "INSERT INTO plagia_record (user_id, prob_id, status)
			VALUES ('$idd', '$probidd', 'NO')";
	$res = mysql_query($sql);
	
	$res = savesubmission($_POST['id'], $_POST['probid'], 
                          $fcontent);
	echo "<h2><center><font color = Green>Upload successful</center></font></h2>";
						  
    close_db();
    if($res != NULL) {
      $_SESSION['msg']=$res;
    }
	
   }
  
  
  
  
  
  
  
  
  

   // Non edited
   // **** user namei - l /full/path/to/save/directory to check
   // ****    whether it is 0755 all the way through (the last
   // ****    directory has to be 777

   $myOld = umask(0);
   $myDir = "/home/gdev/grader/test-res/".$id."/";
   mkdir($myDir, 0777);
   $myDir = "/home/gdev/grader/test-res/".$id."/".$_POST['probid']."/";
   mkdir($myDir, 0777);
   umask($myOld);
   // $myDir = getcwd()."/"; 
   // $myMe = get_current_user();
   // $groupid   = posix_getegid();
   // $groupinfo = posix_getgrgid($groupid);
   // echo $myMe."<br>"; 
   // print_r($groupinfo);
   // if(!chmod($myDir, 0777)) {
   //  echo "not 0777";
   // } 

   $files = glob($myDir."*"); //get all file names
   foreach($files as $file){
      if(is_file($file))
          unlink($file); //delete file
   } 

   foreach ($_FILES['f_input']['error'] as $key => $error) {
     if($error == UPLOAD_ERR_OK) {
       
       $myFSize = $_FILES['f_input']['size'][$key];
       if(($myFSize > 0) && ($myFSize <= 100000)) {
         $tmp_name = $_FILES['f_input']['tmp_name'][$key];
          //echo "<br>".$tmp_name;
         // echo "<br>".file_get_contents($tmp_name);
         $name = basename($_FILES['f_input']['name'][$key]); 
         // echo "<br>-------";
         // echo "<br>"."$myDir"."$name";
         if(move_uploaded_file($tmp_name,"$myDir"."$name")) {
           //echo "<br>done";
         } else {
           //echo "<br>can't be done";
         }
       }
 
     }
   }
}
checkauthen();
processsubmission();

?>

<html>
<META http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

<center><form action="main.php#section41" method="get" enctype="multipart/form-data"></center>
	<center><input type="submit" name="submit" id="MySubmitButton" formmethod="get" value="BACK" style="height:40px; width:90px; font-size:20px; font-weight:bold;"/></center>
		</form>
</html>
