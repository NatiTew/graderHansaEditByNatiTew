<!DOCTYPE html>
<?php

include_once 'db.php';
include_once 'util.php';

function addReqTestset($id,$pid){
  $sql = "SELECT `user_id`,`prob_id`,`accept_testset` ,`req_testset` FROM `grd_status` WHERE `user_id` = '".$id."'";
  $sqlSetAC = "UPDATE `grd_status` SET `accept_testset` = 1 WHERE user_id=\"$id\" " .
                     "AND prob_id=\"$pid\"";
  //connect_db();
  $res = mysql_query($sql);
  //close_db();
  $ts_count = mysql_num_rows($res);
  for($i = 0; $i<$ts_count; $i++) {
    $u_id = mysql_result($res,$i,'user_id');
    $p_id = mysql_result($res,$i,'prob_id');
    $ac = mysql_result($res,$i,'accept_testset');
    $req_t = mysql_result($res,$i,'req_testset');
    if($u_id == $id){
      if($p_id == $pid){
        if($ac < 1){
            $directory = '/home/gdev/grader/ev/'.$pid.'/';
          if (glob($directory . '*.in') != false){
            $requestTestset = count(glob($directory . '*.in'));
            $requestTestset = intval($requestTestset*(30/100));
            $sqlSetReqt = "UPDATE `grd_status` SET `req_testset`= \"$requestTestset\" WHERE user_id=\"$id\" " .
                     "AND prob_id=\"$pid\"";
            //connect_db();
            mysql_query($sqlSetReqt);
            mysql_query($sqlSetAC);
            //close_db();
          }
        }
      }
    }
  }
  //close_db();
}
function checkHeart($id,$pid,$gmsg)
{
$sql = "SELECT `user_id` , `Item` FROM `user_info` WHERE 1 LIMIT 0 , 30";
  //connect_db();
  $res = mysql_query($sql);
  //close_db();
  $item_count = mysql_num_rows($res);

    for($i = 0; $i<$item_count; $i++) {
    $u_id = mysql_result($res,$i,'user_id');
    $itemH = mysql_result($res,$i,'Item');
      if($u_id == $id){
        if($itemH > 0){
          addReqTestset($id,$pid);
          getTestset($id,$pid,$gmsg);
        }else{
          //echo "Heart insufficient 1";
          echo '<script type="text/javascript">'; 
          echo 'alert("❤ หัวใจไม่เพียงพอต่อการร้องขอชุดข้อมูลทดสอบ");';
          echo 'window.location= "main.php#section41";';
          echo '</script>';
        }
      }
    }
}


function getTestset($id,$pid,$gmsg)
{ 
  $P = array(); 
  $sql = "SELECT `user_id`,`prob_id`,`accept_testset` ,`req_testset` FROM `grd_status` WHERE `user_id` = '".$id."'";
  $sqlSetDelReqt = "UPDATE `grd_status` SET `req_testset`= `req_testset` - 1 WHERE user_id=\"$id\" " .
                     "AND prob_id=\"$pid\"";
  $sqlUPH = "UPDATE `user_info` SET `Item`= `Item` - 1 WHERE `user_id` = '".$id."'";
  $res = mysql_query($sql);
  if($gmsg != "compile error"){
    if($gmsg != "[no testdata]"){
     for($i = 0; $i<strlen($gmsg); $i++) {
        if(substr($gmsg, $i,1) == "P"){
          $P[$i] = $i+1;
        } 
      }
    }
  }
  $ts_count = mysql_num_rows($res);
  for($i = 0; $i<$ts_count; $i++) {
    $u_id = mysql_result($res,$i,'user_id');
    $p_id = mysql_result($res,$i,'prob_id');
    $ac = mysql_result($res,$i,'accept_testset');
    $req_t = mysql_result($res,$i,'req_testset');
    if($u_id == $id){
      if($p_id == $pid){
        if($req_t > 0){
          $directory = '/home/gdev/grader/ev/'.$pid.'/';
          if (glob($directory . '*.in') != false){
            $filecount = count(glob($directory . '*.in'));
            $requestTestset = count(glob($directory . '*.in'));
            echo "<center><form>";
            echo "<div class='card text-center' style='width:50%;'>";
            echo "<div class='card-header' style='background-color: #f7f7f9;'><br><h3>Problem : ".$pid."<h3>";
            echo "<h5 class='card-title'>All Testset : ".$filecount."</h5>";
            echo "<h5 class='card-title'>Testset can be requested : ".$filecount = intval($filecount*(30/100))." [30%]</h5>";
            echo "<h5 class='card-title'>Message status grader : ".$gmsg."</h5>";
            echo "<br></div>";
            echo "<div class='card-block'>";
            //echo "<h4 class='card-title'>Problem : ".$pid."</h4>";
            //echo "<h5 class='card-title'>Message status grader : ".$gmsg."</h5>";
            //echo "<h5 class='card-title'>All Testset : ".$filecount."</h5>";
            //echo "<h5 class='card-title'>Testset can be requested : ".$filecount = intval($filecount*(30/100))." [30%]</h5>";
            while (true) {
              $random = rand(1,$requestTestset);
                if(in_array($random,$P) != true){
                  echo "<h5 class='card-title'>P index : ".$random."</h5>";
                  echo "<p class='card-text'>";
                  echo "Input : ";
                  $input = readfile("/home/gdev/grader/ev/".$pid."/".$random.".in");
                  echo "</p>";
                  echo "<p class='card-text'>";
                  echo "Output : ";
                  $output = readfile("/home/gdev/grader/ev/".$pid."/".$random.".sol");
                  echo "</p>";
                  mysql_query($sqlSetDelReqt);
                  mysql_query($sqlUPH);
                  break;
                }
              }
                //------------------------------------------------------------------------------------------------------
            
            echo "</div>";
            echo "<div class='card-footer text-muted' style='background-color: #f7f7f9;'>";
            echo "<br><a href='main.php#section41' class='btn btn-primary'>BACK</a><br><br>";
            echo "</div>";
            echo "</div>";
            echo "</center></form>";
            /*echo "Problem : ".$pid."<br>";
            echo "Message status grader : ".$gmsg."<br>";
            echo "=================================================================<br>";
            echo "All Testset : ".$filecount;
            echo "<br>";
            echo "Testset can be requested : ".$filecount = intval($filecount*(30/100))." [30%]<br>";
            while (true) {
              $random = rand(1,$requestTestset);
                if(in_array($random,$P) != true){
                  //-------------------------------------------------------------------
                  echo "P index : ".$random;
                  echo "<br>";
                  echo "=================================================================<br>";
                  echo "Input : ";
                  readfile("/home/gdev/grader/ev/".$pid."/".$random.".in");
                  echo "<br>";
                  echo "=================================================================<br>";
                  echo "Output : ";
                  readfile("/home/gdev/grader/ev/".$pid."/".$random.".sol");
                  mysql_query($sqlSetDelReqt);
                  mysql_query($sqlUPH);
                  break;
                }
            }*/
          }
        }else{
          //echo "Over limit 1";
          echo '<script type="text/javascript">';
          echo 'alert("ร้องขอชุดข้อมูลทดสอบเกิน 30% แล้ว");';
          echo 'window.location= "main.php#section41";';
          echo '</script>';
        } 
      } 
    }
   } 
         
}

$u = $_GET['id'];
$pid = $_GET['pid'];
$gmsg = $_GET['gmsg'];
checkauthen();
connect_db();
?>
<html>
<head>
  <title>Testset</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <script src="bootstrap/js/bootstrap.js"></script>
    <link rel="stylesheet" href="./bootstrap.min.css">
    <script src="./jquery.min.js"></script>
    <script src="./bootstrap.min.js"></script>
</head>
<body>
<?php
  checkHeart($u,$pid,$gmsg);
?>
</body>
</html>


<?php
close_db();
?>
