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
    
    $id = $_GET['id'];

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
<body onload="showProbLesson('',<?php echo $id; ?>)">
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
    <div class="well well-sm"><center><h2>Basic info</h2></center></div>
    <br>
  <form action="api_create_lesson.php" method="post">
  <div class="input-group">
    <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
    <input id="lessonname" type="text" class="form-control" name="lessonname" value=<?php echo "\"".$name."\"";?>>
  </div>
  <br>
   <div class="form-group">
  <label for="sel1">SELECT ASSIGNMENT STATUS:</label>
  <select class="form-control" name="status" id="sel1">
    <option <?php if($active=="1"){echo "selected";} ?> value="1">active</option>
    <option <?php if($active=="0"){echo "selected";} ?> value="0">inactive</option>
  </select>
  </div>
  <br>
   <div class="input-group">
    <span class="input-group-addon">rank</span>
    <input id="rank" type="text" class="form-control" name="rank" value=<?php echo "\"".$rank."\"";?>>
  </div>
  <br>
</div>
<div class="col-md-1">
  </div>
  </div>

<div class="row">
  <div class="col-md-1">
  </div>
    <div class="col-md-10">
    <div class="well well-sm"><center><h2>Deadline</h2></center></div>
    <br>
    <?php
      $sql = "SELECT grp,DATE_FORMAT(deadline, '%Y-%m-%dT%H:%i') AS deadline FROM deadline WHERE lesson_id = '".$id."'";
      connect_db();
      $result = mysql_query($sql);
      while ($row = mysql_fetch_array($result)) {
      static $c = 0;
      echo "<div class=\"input-group\"><span class=\"input-group-addon\">Group ".$row['grp']."</span>"; 
      echo "<input type=\"datetime-local\" class=\"form-control\" name=\"d".$c."\" value=\"".$row['deadline']."\"></div> <br>";
      $c++;

    }
    ?>
</div>
<div class="col-md-1"></div>
</div>
<div class="row">
<div class="col-md-1"></div>
<div class="col-md-10">
  <input type="hidden" name="worktype" value="update">
  <input type="hidden" name="lessonid" value=<?php echo "\"".$id."\""?>>
  <input type="hidden" name="numdeadline" value=<?php echo $c; ?>>
   <center>
  <button type="submit" class="btn btn-success">Apply Change</button>
  </center>
</form>
</div>
<div class="col-md-1"></div>
</div>
<br>

<form>  
  <div class="row">
  
    <div class="col-md-6" >
    <div class="well well-sm"><center><h2>Add another problem</h2></center></div>
    </div>
   
    
    <div class="col-md-6" >
    <div class="well well-sm"><center><h2>Remove existing problem</h2></center></div>
  </div>
  </div>
  
  <br>

  <div class="row">
    <div class="col-md-2" >
    <label>KEYWORD</label>
      <div class="input-group">
        <input type="text" class="form-control" id="searchProb"  placeholder="Type here to search for a problem">
      </div>
    </div>
    <div class="col-md-1">
    <label>TYPE</label>
    <div class="form-group">
    <select class="form-control" name="prob_type" id="sel3">
    <option selected value="">All</option>
    <option value="exam">Exam</option>
    <option value="homework">Homework</option>
    <option value="lab">Lab</option>
    <option value="quiz">Quiz</option>
  </select>
  </div>
    </div>
    <div class="col-md-2">
    <label>DIFFICULTY</label>
    <div class="form-group">
  <select class="form-control" name="prob_difficulty" id="sel2">
  <option selected value="">All</option>
    <option value="E">Easy</option>
    <option value="N">Normal</option>
    <option value="H">Hard</option>
    <option value="EX">Extremely Hard</option>
  </select>
  </div>
    </div>
    <div class="col-md-1">
    <label>LIMIT</label>
    <div class="input-group">
       <input type="text" class="form-control" id="limit" value="10">
      </div>
    </div>
    <div class="col-md-6">
    <label>KEYWORD</label>
  <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
        <input type="text" class="form-control" id="searchProbInLesson"  placeholder="Type here to search for a problem">
      </div>
  </div>
    
  </div>
  
  <br>
  
  <div clas="row">
  
    <div class="col-md-6">
      <div id="resultProb">
      </div>
    </div>
    <div class="col-md-6">
    
      <div id="resultProbLesson">
      </div>
    </div>
    
  </div>
</form>

</body>
<script>

function showProb(str,lesid) {
  var xmlhttp;
  var str = $("#searchProb").val();
  var type = $("#sel3").val();
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
                document.getElementById("resultProb").innerHTML = this.responseText;
            }
        };

        xmlhttp.open("GET","api_mini_list_prob.php?name="+str+"&type="+type+"&diff="+diff+"&les_id="+lesid,true);
        xmlhttp.send();
    
}

function showProbLesson(str,lesid) {
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
                document.getElementById("resultProbLesson").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","api_mini_list_prob_by_lesson.php?les_id="+lesid,true);
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
                document.getElementById("resultProbLesson").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","api_mini_list_prob_by_lesson.php?name="+str+"&les_id="+lesid,true);
        xmlhttp.send();
    }
}

function addProb(probid,lesid) {
  var xmlhttp;
  var limit = $("#limit").val();
    
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");

        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              if(this.responseText!=""){
                alert(this.responseText);
              }
                
                showProbLesson($('#searchProbInLesson').val(),lesid);
            }
        };
        xmlhttp.open("GET","api_add_prob.php?prob_id="+probid+"&les_id="+lesid+"&limit="+limit,true);
        xmlhttp.send();
    
}

function removeProb(probid,lesid) {
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
                showProbLesson($('#searchProbInLesson').val(),lesid);
            }
        };
        xmlhttp.open("GET","api_remove_prob.php?prob_id="+probid+"&les_id="+lesid,true);
        xmlhttp.send();
    
}

$('#searchProb').on("change keyup paste click", function() {
  var a = $("#searchProb").val();
    //showProb(a,<?php echo $id; ?>);
    showProb(a,<?php echo "'".$id."'"; ?>);
});

$('#searchProbInLesson').on("change keyup paste click", function() {
  var a = $("#searchProbInLesson").val();
    //showProb(a,<?php echo $id; ?>);
    showProbLesson(a,<?php echo "'".$id."'"; ?>);
});

$("#sel3").on("change", function() {
  showProb();
});

$("#sel2").on("change", function() {
  showProb();
});

$( "#search" ).on("change keyup paste click", function() {
  showProb();
});

/*$('#add').click( function(){
  var a = <?php echo $row['prob_id']; ?>
  /*addProb(a,<?php echo $id;?>);
  alert(a+" "+<?php echo $id;?>);
});
*/
</script>
</html>
