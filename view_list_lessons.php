<?php

  session_start();
  if (!isset($_SESSION['type']) || !$_SESSION['type']==USERTYPE_ADMIN)
  {
    header('Location: login.php');
  }

    include_once 'db.php';
    $sql = "SELECT * FROM  lessons ORDER BY id DESC";
    connect_db();
    $result = mysql_query($sql);      

   /*       
     echo "<html>
          <head>
          <link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css\">
          <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js\"></script>
          <script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js\"></script>
          </head>
          <body>
          <nav class=\"navbar navbar-inverse navbar-fixed-top\">
          <div class=\"container-fluid\">
          <div class=\"navbar-header\">
           <a class=\"navbar-brand\" href=\"mainadmin.php\">Home</a>
          </div>
          <ul class=\"nav navbar-nav\">
          <li class=\"dropdown\">
          <a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\">USER MANAGEMENT
          <span class=\"caret\"></span></a>
          <ul class=\"dropdown-menu\">
          <li><a href=\"view_list_user.php\">List all user</a></li>
          <li><a href=\"view_create_user.php\">Add a new user</a></li>
          </ul>
          </li>
          <li class=\"dropdown\">
          <a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\">ASSIGNMENT MANAGEMENT
          <span class=\"caret\"></span></a>
          <ul class=\"dropdown-menu\">
          <li><a href=\"view_list_lessons.php\">List all assignment</a></li>
          <li><a href=\"view_create_lesson.php\">Add a new assignment</a></li>
          </ul>
          </li>
          <li class=\"dropdown\">
          <a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\">PROBLEM MANAGEMENT
          <span class=\"caret\"></span></a>
          <ul class=\"dropdown-menu\">
          <li><a href=\"view_list_prob.php\">List all problem</a></li>
          <li><a href=\"view_create_prob.php\">Add a new problem</a></li>
          </ul>
          </li>
		      <li class=\"dropdown\">
		      <a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\">PLAGIARISM RECORD
		      <span class=\"caret\"></span></a>
		      <ul class=\"dropdown-menu\">
		      <li><a href=\"view_plagiarism.php\">List all plagiarism</a></li>
		      </ul>
		      </li>
          </ul>
          </div>
          </nav>
          <br><br><br><br><br><br>
          <div class=\"row\"><div class=\"col-md-4\"></div><div class=\"col-md-4\">
          <a href=\"view_create_lesson.php\"><button type=\"button\" class=\"btn btn-success btn-lg btn-block\">Create A New Assignment</button></a><br>";
          If (mysql_num_rows($result) > 0) {
              while ($row = mysql_fetch_array($result)) {
           echo "<a href=\"view_edit_lesson.php?id=".$row['id']."\"><button type=\"button\" class=\"btn btn-default btn-lg btn-block\">".$row['name']."</button></a><br>";
              }
          }
        
        close_db();
        
        echo "</div><div class=\"col-md-4\"></div></div></body></html>";
*/
?>
<html>
  <head>
  <META http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <link rel="stylesheet" href="./bootstrap.min.css">
  <script src="./jquery.min.js"></script>
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
<div class="col-md-2"></div>
<div class="col-md-8">
<div class="well well-sm"><center><h2>All Assignment</h2></center></div>
</div>
</div>
      <div class="row"><div class="col-md-2"></div><div class="col-md-8">
      <a href="view_create_lesson.php"><button type="button" class="btn btn-success btn-lg btn-block">ADD A NEW ASSIGNMENT</button></a><br></div>
      <div class="col-md-2"></div>
      </div>
      <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-6">
      <?php
          If (mysql_num_rows($result) > 0) {
              while ($row = mysql_fetch_array($result)) {
                if(!$row['active']==0){
                   echo "<a href=\"view_edit_lesson.php?id=".$row['id']."\"><button type=\"button\" class=\"btn btn-default btn-lg btn-block\">".$row['name']."</button></a><br>";
                }else{
                  echo "<a href=\"view_edit_lesson.php?id=".$row['id']."\"><button type=\"button\" class=\"btn btn-warning btn-lg btn-block\">".$row['name']."</button></a><br>";
                }
          
              }
          }
      ?>
      </div>
      <div class="col-md-2">
      <?php
      $sql = "SELECT * FROM  lessons ORDER BY id DESC";
      $result = mysql_query($sql);    
          If (mysql_num_rows($result) > 0) {
              while ($row = mysql_fetch_array($result)) {
               echo "<a href=\"api_delete_lesson.php?id=".$row['id']."\"><button type=\"button\" class=\"btn btn-danger btn-lg btn-block\">Delete</button></a><br>";
                }
          
              }
      ?>  
      </div>
      </div>
      </body>
      </html>
