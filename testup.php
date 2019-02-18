 <?php
 include_once 'db.php';
 include_once 'config.php';


   $myOld = umask(0);
   $myDir = "/home/gdev/grader/problem/555/";
   mkdir($myDir, 0777);
   chmod($myDir, 0777);
   umask($myOld);
   
   $tmp_name = $_FILES['code']['tmp_name'];
   	
   $name = basename($_FILES['code']['name']);
   move_uploaded_file($tmp_name,"$myDir"."$name");
   $myDir = $myDir.$name;

   chmod($myDir,0777);

$sql = "LOAD DATA INFILE ".$myDir." INTO TABLE user_info FIELDS TERMINATED BY  ',' ENCLOSED BY ' \" ' LINES TERMINATED BY '\\n' IGNORE 1 ROWS";
   	echo $sql;
	connect_db();
	if(mysql_query($sql)){
		echo "yes";
	}
	else{
		echo "no";
	}
	close_db();
 ?>
