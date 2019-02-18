<?php
  session_start();
  if (!isset($_SESSION['type']) || !$_SESSION['type']==USERTYPE_ADMIN)
  {
    header('Location: login.php');
  }
  $prob_id = $_GET['prob_id'];
?>
<!DOCTYPE html>
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
<div class="well well-sm"><center><h2>Upload Testset</h2></center></div>
</div>
</div>
 <div class="row">
 <div class="col-md-4"></div>
 <div class="col-md-4">
 <center>

 <?
 $directory = '/home/gdev/grader/ev/'.$prob_id.'/';
 $scanned_directory = array_diff(scandir($directory), array('..', '.'));
 $size = sizeof($scanned_directory);
 ?>
<form method="post" action="api_upload_file.php" enctype="multipart/form-data">
  Select Files: <input type="file" name="upload[]" multiple><br>
  <input type="hidden" name="prob_id" value=<?php echo $prob_id;?>>
  <?php if($size<=0){
    echo "Number of Cases: <input type=\"text\" class=\"form-control\" name=\"cases\"><br>";
  }else{
    $size = ($size-1)/2;
    echo "Number of Cases: <input type=\"text\" class=\"form-control\" name=\"cases\" value=\"".$size."\"><br>";
  }
  ?>
  Timelimit(in second): <input type="text" class="form-control" name="timelimit" value="1"><br>
  <input type="submit" class="btn-success">
</form>
</center>
</div>
<div class="col-md-4"></div>
</div>
</body>
<script>

</script>
</html>
