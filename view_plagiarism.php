<?php

include_once 'config.php';
include_once 'db.php';
include_once 'util.php';

checkauthen();

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
<body onload="showPlagia('')">
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
 <br><br><br><br><br><br>
<center><h3><u>&nbsp;Plagiarism Lists&nbsp;</u></h3></center>
<form>	
	<div class="row">
	<div class="col-md-2">
	</div>
  	<div class="col-md-7" id="content">
  		<div class="input-group">
  			<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
			<input type="text" class="form-control" id="search"  placeholder="Type here to search">
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
function showPlagia(str) {
	var xmlhttp;
    if (str == "") {
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
        xmlhttp.open("GET","api_list_plagia.php?",true);
        xmlhttp.send();
    } else { 
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
        xmlhttp.open("GET","api_list_plagia.php?name="+str,true);
        xmlhttp.send();
    }
}

$( "#search" ).on("change keyup paste click", function() {
	var a = $("#search").val();
  showPlagia(a);
});

</script>
</html>
