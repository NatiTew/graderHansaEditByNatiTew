<?php
    session_start();
  if (!isset($_SESSION['type']) || !$_SESSION['type']==USERTYPE_ADMIN)
  {
    
    header('Location: login.php');
  }
    include_once 'db.php';
    $param = $_GET['name'];
    $mode = $_GET['mode'];
    
    if(empty($param)){
      $sql = "SELECT * FROM user_info";
    }else{
      if($mode=="id"){
        $sql = "SELECT * FROM user_info WHERE user_id LIKE '%".$param."%'";
      }elseif($mode=="name"){
        $sql = "SELECT * FROM user_info WHERE name LIKE '%".$param."%'";
      }else{
        $sql = "SELECT * FROM user_info WHERE grp = '".$param."'";
      }
      
    }
     
    connect_db();
    $result = mysql_query($sql);      

         

     

          
          
          if(mysql_num_rows($result) > 0) {
            echo "<table class=\"table table-striped\">
            <thread>
            <tr>
            <th>ID</th>
            <th>NAME</th>
            <th>OPTION</th>
            </tr>
            </thread>";
              while ($row = mysql_fetch_array($result)) {
           echo "<tr>";
           echo "<td>".$row['user_id']."</td>";
           echo "<td>".$row['name']."</td>";
           echo "<td><a href=\"view_edit_user.php?id=".$row['user_id']."\"><button type=\"button\" class=\"btn btn-warning\">Edit</button></a> &nbsp; <a href=\"api_delete_user.php?id=".$row['user_id']."\"><button type=\"button\" class=\"btn btn-danger\">Delete</button></a></td>"; 
           echo "</tr>";
            
              }
          }else{
            
            echo "<center>No results were found!</center>";
            
          }

        close_db();
        
        
        echo "</table>";

?>