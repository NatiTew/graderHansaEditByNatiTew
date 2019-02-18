<?php
  session_start();
  if (!isset($_SESSION['type']) || !$_SESSION['type']==USERTYPE_ADMIN)
  {
    header('Location: login.php');
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
<body onload="showProb()">
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
<div class="well well-sm"><center><h2>All Problem</h2></center></div>
</div>
</div>

<form>	
	<div class="row">
	<div class="col-md-2">
	</div>
  	<div class="col-md-6" id="content">
  		<div class="input-group">
  			<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
			<input type="text" class="form-control" id="search"  placeholder="Type here to search">
  		</div>
  	</div>
  	<div class="col-md-2">
  		<a href="view_create_prob.php"><button type="button" class="btn btn-success">ADD A NEW PROBLEM</button></a>
  	</div>
</div>
<br>
<div class="row">
    <div class="col-md-3">
    </div>
    <div class="col-md-2">
    <div class="form-group">
    <label for="sel1">SELECT TYPE</label>
    <select class="form-control" name="prob_type" id="sel1">
    <option selected value="">All</option>
    <option value="exam">Exam</option>
    <option value="homework">Homework</option>
    <option value="lab">Lab</option>
    <option value="quiz">Quiz</option>
  </select>
  </div>
  </div>
  <div class="col-md-2">
  <div class="form-group">
  <label for="sel2">SELECT DIFFICULTY</label>
  <select class="form-control" name="prob_difficulty" id="sel2">
  <option selected value="">All</option>
    <option value="E">Easy</option>
    <option value="N">Normal</option>
    <option value="H">Hard</option>
    <option value="EX">Extremely Hard</option>
  </select>
  </div>  
</div>
</div>
<br>
<div class="row">
	
  	<div class="col-md-12">	
  		<div id="result">
  		</div>
  	</div> 
    
</div>
</form>


</body>
<script>
function showProb() {
	var xmlhttp;
  var str = $("#search").val();
  var type = $("#sel1").val();
  var diff = $("#sel2").val();


    
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("result").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","api_list_prob.php?name="+str+"&type="+type+"&diff="+diff,true);
        xmlhttp.send();
    
}

$("#sel1").on("change", function() {
  showProb();
});

$("#sel2").on("change", function() {
  showProb();
});

$( "#search" ).on("change keyup paste click", function() {
  showProb();
});
</script>
</html>
