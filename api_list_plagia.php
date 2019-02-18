<?php
session_start();
  if (!isset($_SESSION['type']) || !$_SESSION['type']==USERTYPE_ADMIN)
  {
    
    header('Location: login.php');
  }
    include_once 'db.php';
    $name = $_GET['name'];
	
	if(empty($name)){
    $sql = "SELECT P1.* FROM plagia_record P1 
			INNER JOIN 
			(  SELECT max(date) MaxPostDate, user_id
				FROM plagia_record
				GROUP BY user_id ) P2
			on P1.user_id = P2.user_id
			AND P1.date = P2.MaxPostDate
			AND P1.status = 'YES'
			ORDER by P1.date desc";
	}else{
	$sql = "SELECT P1.* FROM plagia_record P1 
			INNER JOIN 
			(  SELECT max(date) MaxPostDate, user_id
				FROM plagia_record
				GROUP BY user_id ) P2
			on P1.user_id = P2.user_id
			AND P1.date = P2.MaxPostDate
			AND P1.status = 'YES'
			AND P1.user_id  LIKE '%".$name."%'
			ORDER by P1.date desc";
	}
    connect_db();
    $result = mysql_query($sql);      

         

     echo "<table class=\"table table-striped\">
        <thread>
          <tr>
            <th>USER_ID</th>
            <th>Problem</th>
            <th>Status</th>
			       <th>Date</th>
             <th>Option</th>
          </tr>
        </thread>";

          
          
          If (mysql_num_rows($result) > 0) {
              while ($row = mysql_fetch_array($result)) {
            
           echo "<tr>";
           echo "<td>".$row['user_id']."</td>";
           echo "<td>".$row['prob_id']."</td>";
           echo "<td>".$row['status']."</td>";
           echo "<td>".$row['date']."</td>";
		   echo "<td><a href=\"JPlag/".$row['user_id']."/".$row['prob_id']."\"   target=\"_blank\"\"><button type=\"button\" class=\"btn btn-warning\">Open</button></a></td>";
           echo "</tr>";  
              }
          }
        close_db();
  
        echo "</table>";

?>