<?php

include_once 'config.php';
include_once 'util.php';
include_once 'db.php';

checkauthen();
if($_SESSION['type']!=USERTYPE_ADMIN) {
  echo 'You do not have the permission to access this script.';
  exit;
}
?>
<html>
<body>

<p id="demo"></p>


<?php

// Non edited
// Get Lesson Id.
$por_sor = ((int) date("Y") + 543) % 100;
$m = (int) date("m");
$term = (8 <= $m && $m <= 12) ? 1 : 
        ((1 <= $m && $m <= 5)  ? 2 : 3);
echo "Academic Year: ".$por_sor."<br>";
echo "Month: ".$m."<br>";
echo "Term: "."0".$term."<br>";

echo ($l_id+1); 

connect_db();
$non_q = "select max(id) from lessons";
$non_query = mysql_query($non_q);
if(!$non_query) echo "no result";
else {
  $l_id = mysql_result($non_query, 0); 
  echo "<br>Your latest lesson id: ".$l_id."<br>"; 
  echo "We are going to create a new lesson (".($l_id+1).") for you. You then must fill some info below:<br>";
  echo "<br>";
?>
 
  <form name="addBoard_form" method="POST">
  <table width="1000" border="4" cellspacing="3" cellpadding="3" bordercolor="#FFFFFF" align="center">
     <tr>
        <td> <font color="#666666"> Name (e.g., Lab 1): </font></td>
        <td><input type="text" name="Name" size="110" maxlength="100"></td>
        </tr>
     <tr>
        <td> <font color="#666666"> Rank (e.g., 1): </font></td>
        <td><input type="text" name="rank" size="110" maxlength="200"></td>
        </tr>
  </table>

  <table align="center">
        <tr>
          <td>
          <input type="Submit" name="L_Submit" value="Confirm">
          </td>
        </tr>
  </table>

</form>  
<?
}
close_db();

/*if(isset($_POST['L_Submit']))
{
     $non_q = "INSERT INTO lessons (id, name, date, active, rank) VALUES (".($l_id+1).
              ", '".$_POST['Name']."', '".date("Y")."-".$m."-".date("d")."', 1, ".$_POST['rank'].")";
     echo $non_q;

     // $non_q = "INSERT INTO chosenitems (ID, Name, Price) VALUES ('', '4-6 Days', '£75.00')";
     connect_db();
     $non_result = mysql_query($non_q);
     if(!$non_result) echo "Error: cannot insert the lesson into the db";
     else {
       header('Location: create_probs.php');
       close_db();
       exit; 
     }
     close_db();
} */

?>
  Back to <a href="main.php">main page</a>

</body>
</html>
