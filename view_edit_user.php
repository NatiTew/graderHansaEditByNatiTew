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
    
    $username = $_GET['id'];

    $sql = "SELECT * FROM user_info WHERE user_id = '".$username."'";
    connect_db();
    $result = mysql_query($sql);
    while ($row = mysql_fetch_array($result)) {

    $id = $row['user_id'];
    $name = $row['name'];
    $password = $row['passwd'];
    $type = $row['type'];
    $group = $row['grp'];
    $scid = $row['scid'];

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
<div class="well well-sm"><center><h2>Edit User</h2></center></div>
</div>
</div>
  <div class="row">
  <div class="col-md-1">
  </div>
    <div class="col-md-10">
  <form action="api_create_user.php" method="post">
  <div class="input-group">
    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
    <input id="username" type="text" class="form-control" name="username" value=<?php echo "\"".$id."\""?> readonly  >
  </div>
  <br>
  <div class="input-group">
    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
    <input id="password" type="text" class="form-control" name="password" value=<?php echo "\"".$password."\""?>>
  </div>
  <br>
  <div class="input-group">
    <span class="input-group-addon">Full name</span>
    <input id="fullname" type="text" class="form-control" name="fullname" value=<?php echo "\"".$name."\""?>>
  </div>
  <br>
  <div class="form-group">
  <label for="sel1">SELECT ACCOUNT TYPE:</label>
  <select class="form-control" name="type" id="sel1">
    <option <?php if($type=="A"){echo "selected";} ?> >ADMIN</option>
    <option <?php if($type=="C"){echo "selected";} ?> >CONTESTANT</option>
  </select>
  </div>
  <br>
  <div class="input-group">
    <span class="input-group-addon">Group</span>
    <input id="group" type="text" class="form-control" name="group" value=<?php echo "\"".$group."\""?>>
  </div>
  <br>
  <input type="hidden" name="worktype" value="update">
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

/*function checkDup(str) {
  var xmlhttp;
    if (str == "") {
        document.getElementById("result").innerHTML = "";
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
                document.getElementById("result").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","list_student.php?name="+str,true);
        xmlhttp.send();
    }
}

$( "#search" ).on("change keyup paste click", function() {
  var a = $("#search").val();
    showUser(a);
});*/

</script>
</html>