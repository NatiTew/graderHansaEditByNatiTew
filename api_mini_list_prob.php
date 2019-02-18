<?php
    session_start();
  if (!isset($_SESSION['type']) || !$_SESSION['type']==USERTYPE_ADMIN)
  {
    
    header('Location: login.php');
  }
    include_once 'db.php';
    $name = $_GET['name'];
    $lesid = $_GET['les_id'];
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
            <th class=\"col-md-1\">ID</th>
            <th class=\"col-md-1\">NAME</th>  
            <th class=\"col-md-1\">OPTION</th>
          </tr>
        </thread>";

          
          
          If (mysql_num_rows($result) > 0) {
              while ($row = mysql_fetch_array($result)) {
           echo "<tr>";
           echo "<td class=\"col-md-1\">".$row['prob_id']."</td>";
           echo "<td class=\"col-md-1\">".$row['name']."</td>";
           echo "<td class=\"col-md-1\"><button type=\"button\" id=\"add\" class=\"btn btn-success\" onclick=\"addProb('".$row['prob_id']."','".$lesid."')\">Add this prob to the lesson</button></td>"; 
           echo "</tr>";
            
              }
          }

        close_db();
        
        
        echo "</table>";

?>