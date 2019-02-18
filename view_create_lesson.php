<?php
  
  include_once "db.php";
  session_start();
  if (!isset($_SESSION['type']) || !$_SESSION['type']==USERTYPE_ADMIN)
  {
    header('Location: login.php');
  }

    
    $sql = "SELECT max(rank) rank from lessons";
    
    connect_db();
    $result = mysql_query($sql);
    If (mysql_num_rows($result) > 0) {
              while ($row = mysql_fetch_array($result)) {
               $rank = $row['rank'];
              }
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
<div class="col-md-1"></div>
<div class="col-md-10">
<div class="well well-sm"><center><h2>Create A New Assignment</h2></center></div>
</div>
</div>

  <div class="row">
  <div class="col-md-1">
  </div>
    <div class="col-md-10">
  <form action="api_create_lesson.php" method="post">
  <div class="input-group">
    <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
    <input id="lessonname" type="text" class="form-control" name="lessonname" placeholder="assignment name">
  </div>
  <br>
   <div class="form-group">
  <label for="sel1">SELECT ASSIGNMENT STATUS:</label>
  <select class="form-control" name="status" id="sel1">
    <option value="1">active</option>
    <option value="0">inactive</option>
  </select>
  </div>
  <br>
   <div class="input-group">
    <span class="input-group-addon">rank</span>
    <input id="rank" type="text" class="form-control" name="rank" value=<?php echo $rank+1; ?>>
  </div>
  <br>
  <div class="input-group">
    <span class="input-group-addon">available period (day)</span>
    <input id="deadline" type="text" class="form-control" name="deadline" value="7">
  </div>
  <br>

  <!--<div class="form-group">
  <label for="sel2">Select Deadline for each group</label>
  <select class="form-control" name="deadline" id="sel2">
    <?php If (mysql_num_rows($result) > 0) {
              while ($row = mysql_fetch_array($result)) {
              echo "<option value=\"".$row['grp']."\">".$row['grp']."</option>";
              }
          }
    ?>
  </select>
  </div>-->

  <br>
  <center>
  <button type="submit" class="btn btn-success">Submit</button>
  </center>
</form>
</div>
 <div class="col-md-1">
  </div> 
</div>




</body>
<script>
  function addelement(){
    var div = $("<div></div>");
  $("#box").append(div);
  }
  
</script>
</html>
