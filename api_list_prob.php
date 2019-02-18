<?php
    session_start();
  if (!isset($_SESSION['type']) || !$_SESSION['type']==USERTYPE_ADMIN)
  {
    
    header('Location: login.php');
  }
    include_once 'db.php';
    $name = $_GET['name'];
    $type = $_GET['type'];
    $difficulty = $_GET['diff'];

    if(empty($name)){
      if(empty($type) && empty($difficulty)){
        $sql = "SELECT * FROM prob_info";
      }else{
        if(empty($type)){
        $sql = "SELECT * FROM prob_info WHERE difficulty = '".$difficulty."'"; 
        }elseif(empty($difficulty)){
        $sql = "SELECT * FROM prob_info WHERE type = '".$type."'";
        }else{
        $sql = "SELECT * FROM prob_info WHERE difficulty = '".$difficulty."' AND type = '".$type."'";  
        }
      }
    }else{
      if(empty($type) && empty($difficulty)){
        $sql = "SELECT * FROM prob_info WHERE name LIKE '%".$name."%'";
      }else{
        if(empty($type)){
          $sql = "SELECT * FROM prob_info WHERE name LIKE '%".$name."%' AND difficulty = '".$difficulty."'";
        }elseif(empty($difficulty)){
          $sql = "SELECT * FROM prob_info WHERE name LIKE '%".$name."%' AND type = '".$type."'";
        }else{
          $sql = "SELECT * FROM prob_info WHERE name LIKE '%".$name."%' AND type = '".$type."' AND difficulty ='".$difficulty."'";
        }
      }
      
    }
    

    connect_db();
    $result = mysql_query($sql);     

     echo "<table class=\"table table-striped\">
        <thread>
          <tr>
            <th>ID</th>
            <th>NAME</th>
            <th>TYPE</th>
            <th>DIFFICULTY</th>
            <th>OPTION</th>
          </tr>
        </thread>";

          
          
          If (mysql_num_rows($result) > 0) {
              while ($row = mysql_fetch_array($result)) {
            
           echo "<tr>";
           echo "<td>".$row['prob_id']."</td>";
           echo "<td>".$row['name']."</td>";
           echo "<td>".$row['type']."</td>";
           echo "<td>".$row['difficulty']."</td>";
           echo "<td><a href=\"view_upload_testset.php?prob_id=".$row['prob_id']."\"><button type=\"button\" class=\"btn btn-default\">Upload Testset</button></a> &nbsp;<a href=\"view_edit_prob.php?id=".$row['prob_id']."\"><button type=\"button\" class=\"btn btn-warning\">Edit</button></a> &nbsp; <a href=\"api_delete_prob.php?id=".$row['prob_id']."\"><button type=\"button\" class=\"btn btn-danger\">Delete</button></a></td>"; 
           echo "</tr>";
            
              }
          }

        close_db();
        
        
        echo "</table>";

?>