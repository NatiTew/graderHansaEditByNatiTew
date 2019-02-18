<?php
  session_start();
  if (!isset($_SESSION['type']) || !$_SESSION['type']==USERTYPE_ADMIN)
  {
    
    header('Location: login.php');
  }
?>
<html>
<head>
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
          <li><a href="view_plagiarism.php">Turn On/Off Plagiarism Validator</a></li>
        </ul>
      </li>
    </ul>
    <a href="api_logout.php"><button class="btn-danger navbar-btn navbar-right">Logout</button></a>
  </div>
</nav>
 <br><br><br><br><br><br>
 
 <div class="row">
 
 <div class="col-md-12" id="content">
 <center>
 <label>Turn Plagiarism Validator On/Off</label>
 <br>
 <?php
 include_once 'db.php';
 connect_db();
 $sql = "SELECT plagia_status FROM plagiamode";
 $result = mysql_query($sql);
 $mode = mysql_result($result,0,'plagia_status');
 if($mode=='0'){
  echo "<button type=\"button\" class=\"btn btn-primary\" id=\"on\">Turn On</button>";
 }else{
  echo "<button type=\"button\" class=\"btn btn-danger\" id=\"off\">Turn Off</button>";
 }
 ?>
 </center>
 </div>

 </div>
 
</body>
<script>

function changeState(state) {
  var xmlhttp;
  
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
         xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               location.reload();
            }
        };
        xmlhttp.open("GET","api_changestate.php?state="+state,true);
        xmlhttp.send();
    
}

$('#on').on("click", function(){
  $('#content').empty();
  //$('#content').append("<center><label>Turn Plagiarism Validator On/Off</label><br><button type=\"button\" class=\"btn btn-danger\" id=\"off\">Turn Off</button></center>");
  changeState("on");
  
  
  
});

$('#off').on("click", function(){
  $('#content').empty();
  //$('#content').append("<center><label>Turn Plagiarism Validator On/Off</label><br><button type=\"button\" class=\"btn btn-primary\" id=\"on\">Turn On</button></center>");
  changeState("off");
  
  
});

</script>
</html>
