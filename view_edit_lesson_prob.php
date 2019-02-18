<?php

  session_start();
  if (!isset($_SESSION['type']) || !$_SESSION['type']==USERTYPE_ADMIN)
  {
    header('Location: login.php');
  }

include_once 'db.php';
    
    function alert($msg) {
      echo "<script type='text/javascript'>alert('".$msg."');window.location='main.html';</script>";
    }
    
    $id = $_GET['lesson_id'];

    $sql = "SELECT * FROM lessons WHERE id = '".$id."'";
    connect_db();
    $result = mysql_query($sql);
    while ($row = mysql_fetch_array($result)) {

    $id = $row['id'];
    $name = $row['name'];
    $date = $row['date'];
    $active = $row['active'];
    $rank = $row['rank'];
   

  }
?>
<html>
<head>
<META http-equiv="Content-Type" content="text/html; charset=UTF-8">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="./bootstrap.min.css">

<!-- jQuery library -->
<script src="./jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="./bootstrap.min.js"></script>

</head>
<body>
  <nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="mainadmin.php">Home</a>
    </div>
    <ul class="nav navbar-nav">
      
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">USER MANAGEMENT
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="view_list_user.php">List all user</a></li>
          <li><a href="view_create_user.php">Add a new user</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">ASSIGNMENT MANAGEMENT
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="view_list_lessons.php">List all assignment</a></li>
          <li><a href="view_create_lesson.php">Add a new assignment</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">PROBLEM MANAGEMENT
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="view_list_prob.php">List all problem</a></li>
          <li><a href="view_create_prob.php">Add a new problem</a></li>
        </ul>
      </li>
	  <li class="dropdown">

        <a class="dropdown-toggle" data-toggle="dropdown" href="#">PLAGIARISM RECORD

        <span class="caret"></span></a>

        <ul class="dropdown-menu">
          <li><a href="view_plagiarism.php">List all plagiarism</a></li>
          <li><a href="view_changestate.php">Turn On/Off Plagiarism Validator</a></li>
        </ul>

      </li>
    </ul>
  <a href="api_logout.php"><button class="btn-danger navbar-btn navbar-right">Logout</button></a>
  </div>
</nav>
 <br><br><br><br>
  
  <div class="row">
  <div class="col-md-1">
  </div>
    <div class="col-md-10">
  <form method="POST" action="api_random_prob.php">
  <div class="form-group">
  <div class="well well-sm"><center><h2>Random Problem</h2></center></div>
  <label for="sel2">Number of random problem:</label>
  <select class="form-control" name="random" id="sel2">
    <?php
    $sql = "SELECT COUNT(prob_id) count FROM lesson_prob WHERE lesson_id = \"".$id."\"";
    echo $sql;
    connect_db();
      $result = mysql_query($sql);
      while ($row = mysql_fetch_array($result)) {
        $count = $row['count'];
      }
      for($x = 0;$x<$count;$x++){
        if($x==0){
        echo "<option value=\"".$x."\">ทำทุกข้อ</option>";
        }else{
        echo "<option value=\"".$x."\">สุ่ม ".$x." ข้อ</option>";  
        }
        
      }
    ?>
  </select>
  *Be careful! If you apply the change all of your previous work will be overrided.
  <input type="hidden" name="lesson_id" value =<?php echo "\"".$id."\""; ?>>
  </div>
  </div>
  </div>
  
  
  <br>
</div>
<div class="row">
  <div class="col-md-1">
  </div>
<div class="col-md-10">
   <center>
  <button type="submit" class="btn btn-success">Apply Change</button>
 
</form>
<a href="https://smart.cs.buu.ac.th/gdev/view_list_lessons.php"><button class="btn btn-warning">Discard Change</button></a> 
</center>
</div>
<div class="col-md-1"></div>
<br>

</body>
</html>
