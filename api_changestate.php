<?php
include_once 'db.php';
$state = $_GET['state'];

if($state=="off"){
$sql = "UPDATE plagiamode SET plagia_status = '0' WHERE 1";
echo $sql;
}else{
$sql = "UPDATE plagiamode SET plagia_status = '1' WHERE 1";
echo $sql;
}

connect_db();
if(mysql_query($sql)){
	$error = mysql_error();
	echo $error;
}else{
	$error = mysql_error();
	echo $error;
}
?>