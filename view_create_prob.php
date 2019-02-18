<?php

  session_start();
  if (!isset($_SESSION['type']) || !$_SESSION['type']==USERTYPE_ADMIN)
  {
    header('Location: login.php');
  }

include_once 'db.php';
    

    $sql = "SELECT max(prob_order) maxorder FROM `prob_info`";
    connect_db();
    $result = mysql_query($sql);
    while ($row = mysql_fetch_array($result)) {
      $maxorder = $row['maxorder'];
      $maxorder = $maxorder+1;
    }
    close_db();

    $sql = "SELECT desc_msg FROM prob_desc ORDER BY desc_timestamp DESC LIMIT 1";
    connect_db();
    $result = mysql_query($sql);
    while ($row = mysql_fetch_array($result)){
      $desc_msg = $row['desc_msg'];
    }
    close_db();

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
<div class="well well-sm"><center><h2>Add A New Problem</h2></center></div>
</div>
</div>

  <div class="row">
  <div class="col-md-1">
  </div>
  
    <div class="col-md-10">
    <form action="api_create_prob.php" method="post" enctype="multipart/form-data">
    <label> Fill Problem Info </label>
  <div class="input-group">
    <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
    <input id="probid" type="text" class="form-control" name="prob_id" placeholder="problem id">
  </div>

  <br>
  <div class="input-group">
    <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
    <input id="probname" type="text" class="form-control" name="prob_name" placeholder="problem name">
  </div>
  <br>
   <div class="form-group">
  <label for="sel1">Problem Type</label>
  <select class="form-control" name="prob_type" id="sel1">
    <option value="exam">Exam</option>
    <option value="homework">Homework</option>
    <option selected value="lab">Lab</option>
    <option value="quiz">Quiz</option>
  </select>
  </div>
  
  <div class="form-group">
  <label for="sel2">Problem Difficulty</label>
  <select class="form-control" name="prob_difficulty" id="sel2">
    <option value="E">Easy</option>
    <option selected value="N">Normal</option>
    <option value="H">Hard</option>
    <option value="EX">Extremely Hard</option>
  </select>
  </div>
  
  <div class="input-group">
    <span class="input-group-addon">Plagiarism Rate</span>
    <input id="plagiarism" type="text" class="form-control" name="plagiarism" value="30">
  </div>
  <br>

  <div class="form-group">
  <label for="sel3">Problem Availability</label>
  <select class="form-control" name="prob_avail" id="sel3">
    <option value="1">Yes</option>
    <option value="N">No</option>
  </select>
  </div>
  
   <div class="input-group">
    <span class="input-group-addon">Problem Order</span>
    <input id="prob_order" type="text" class="form-control" name="prob_order" value=<?php echo "\"".$maxorder."\"";?>>
  </div>
  <br>
  <div class="input-group">
    <span class="input-group-addon">Problem Description</span>
    <input id="prob_desc" type="text" class="form-control" name="prob_desc" value=<?php echo "\"".$desc_msg."\""?>>
  </div>
  <br>
  <!--<div class="input-group">
    <span class="input-group-addon">Score</span>
    <input id="prob_score" type="text" class="form-control" name="prob_score" placeholder="problem score">
  </div>
  <br>-->
  <input type="hidden" name="prob_attempt" value="0">
  <input type="hidden" name="prob_success" value="0">
  
  Select Files: <input type="file" name="upload[]" multiple>
  <center><div id="button"><button type="submit" id="submit" class="btn btn-success">Submit</button></div></center>
</form>
</div>
 <div class="col-md-1">
    <br>
    <div id="error">
    </div>
  </div> 
  
</div>


</body>
<script>
function checkDup(str) {
  var xmlhttp;
    if (str == "") {
        document.getElementById("error").innerHTML = "";
        return;
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
                if(this.responseText=="yes"){
                  document.getElementById("error").innerHTML = "<b><font color=\"red\">The prob_id you provide is not available</font></b>";
                }else{
                  document.getElementById("error").innerHTML = "<b><font color=\"green\">The prob_id you provide is available</font></b>";
                }
            }
        };
        xmlhttp.open("GET","api_check_prob_id.php?prob_id="+str,true);
        xmlhttp.send();
    }
}


  $( "#probid" ).on("change keyup paste", function() {
  var a = $("#probid").val();
  checkDup(a);

  if(a.length>11){
      alert('prob_id should not exceed 11 character long');
      a = a.substring(0, 11);
      $("#probid").val(a);
  }
});

  $( "#sel2" ).on("change", function() {
  var a = $("#sel2").val();
  if(a=="E"){
    $("#plagiarism").val("0");
  }else if(a=="N"){
    $("#plagiarism").val("30");
  }else if(a=="H"){
    $("#plagiarism").val("50");
  }else{
    $("#plagiarism").val("70");
  }


});
</script>
</html>
