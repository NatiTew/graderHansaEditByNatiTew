<?php
function update($user_id, $user_name, $passwd, $type, $group)
{
  echo $user_id . " - " . $user_name . " (" . $type . " / " . $group . ") ";
  $query = mysql_query("select * from user_info where user_id=\"$user_id\"");
  if(mysql_num_rows($query)!=0) {
    $q = "update user_info set name=\"$user_name\", passwd=\"$passwd\"," .
         " type='$type', grp='$group' " .
         " where user_id=\"$user_id\""; 
    //    echo " cmd: " . $q;
    echo "[updated] <br>";
    mysql_query($q);
  } else {
    $q = "insert into user_info (user_id, name, passwd, type, grp) values " .
         "(\"$user_id\",\"$user_name\",\"$passwd\",\"$type\",\"$group\")";
    //    echo " cmd: " . $q;
    mysql_query($q);
    echo "[added] <br>";
  }
}

function uploadfromfile($fname)
{
  $linelist = file($fname);
  for($i = 0; $i<count($linelist); $i++) {
    $uinfo = explode(':',trim($linelist[$i]));
    if(count($uinfo)==5) {
      update($uinfo[0], $uinfo[1], $uinfo[2], $uinfo[3], $uinfo[4]);
    }
  }
}
?>
<html>
<body>
<?php
if($_POST['send']!=null) {
  echo "<b>uploaded new user info :</b> <hr>";
  if(($_FILES['stdfile']['size']>0) && ($_FILES['stdfile']['size']<=100000)) {
    $myserv = mysql_connect("localhost","jittat","");
    mysql_select_db('ioi'); 
    uploadfromfile($_FILES['stdfile']['tmp_name']);
    mysql_close($myserv);
  }
  echo "<hr>";
} 
?>
  <form method="post" enctype="multipart/form-data">
  User info: <input type="file" name="stdfile" size="20"><br>
  <input type="submit" name="send" value="send">
  </form>
</body>
</html>
