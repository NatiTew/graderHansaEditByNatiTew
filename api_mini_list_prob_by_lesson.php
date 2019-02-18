<?php
    session_start();
  if (!isset($_SESSION['type']) || !$_SESSION['type']==USERTYPE_ADMIN)
  {
    
    header('Location: login.php');
  }
    include_once 'db.php';
    $name = $_GET['name'];
    $lesid = $_GET['les_id'];
    if(empty($name)){
      $sql = "SELECT prob_info.prob_id, prob_info.name, lesson_prob.active FROM prob_info RIGHT JOIN lesson_prob ON lesson_prob.prob_id=prob_info.prob_id WHERE lesson_id = '".$lesid."'";
      
    }else{
      $sql = "SELECT prob_info.prob_id, prob_info.name, lesson_prob.active FROM prob_info RIGHT JOIN lesson_prob ON lesson_prob.prob_id=prob_info.prob_id WHERE lesson_id = '".$lesid."' AND prob_info.name LIKE '%".$name."%'";
      
    }
   
    connect_db();
    $result = mysql_query($sql);      

         

     echo "<table class=\"table table-striped\">
        <thread>
          <tr>
            <th>ID</th>
            <th>NAME</th>
            <th>ACTIVE</th>
            <th>OPTION</th>
          </tr>
        </thread>";

          
          
          If (mysql_num_rows($result) > 0) {
              while ($row = mysql_fetch_array($result)) {
            
           echo "<tr>";
           echo "<td>".$row['prob_id']."</td>";
           echo "<td>".$row['name']."</td>";
           echo "<td>".$row['active']."</td>";
           echo "<td><button type=\"button\" id=\"add\" class=\"btn btn-danger\" onclick=\"removeProb('".$row['prob_id']."','".$lesid."')\">remove this prob from the lesson</button></td>"; 
           echo "</tr>";
            
              }
          }

        close_db();
        
        
        echo "</table>";

?>