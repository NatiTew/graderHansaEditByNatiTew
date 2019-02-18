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
<body onload="showUser('')">
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

<form>	
<div class="row">
<div class="col-md-1"></div>
<div class="col-md-10">
<div class="well well-sm"><center><h2>All User</h2></center></div>
</div>
</div>
	<div class="row">
	<div class="col-md-3">
	</div>
  	<div class="col-md-5" id="content">
  		<div class="input-group">
  			<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
			<input type="text" class="form-control" id="search"  placeholder="Type here to search">
  		</div>
  	</div>
  	<div class="col-md-2">
  		<a href="view_create_user.php"><button type="button" class="btn btn-success">ADD A NEW USER</button></a>
  	</div>
</div>
<br>
<div class="row">
    <div class="col-md-4">
    </div>
    <div class="col-md-3">
    <label>Search by</label> &nbsp;
    <input type="radio" name="mode" value="id" checked> UserID &nbsp;&nbsp; <input type="radio" name="mode" value="name"> Name &nbsp;&nbsp; <input type="radio" name="mode" value="group"> Group
    </div>  
</div>
<br>
<div class="row">
	
  	<div class="col-md-12">
  	
  		<div  id="result">

  		</div>
  	
  	</div> 	
</div>
</form>


</body>
<script>
function showUser(str,mode) {
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
        xmlhttp.open("GET","api_list_user.php?",true);
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
        xmlhttp.open("GET","api_list_user.php?name="+str+"&mode="+mode,true);
        xmlhttp.send();
    }
}

$( "#search" ).on("change keyup paste click", function() {
	var a = $("#search").val();
  var mode = $("input:radio:checked").val();
  showUser(a,mode);
});

$("input:radio").on("change", function() {
  var a = $("#search").val();
  var mode = $("input:radio:checked").val();
  showUser(a,mode);
});
</script>
</html>
