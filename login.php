<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login | Computer The Cyber Tower</title>
         
        <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
        <script src="bootstrap/js/bootstrap.js"></script>
         
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <script type="text/javascript" src="js\jquery-2.1.1\jquery.min.js"></script>
        <script type="text/javascript" src="js\script.js"></script>

        <meta property="og:url"           content="https://smart.cs.buu.ac.th/gdev/" />
        <meta property="og:type"          content="website" />
        <meta property="og:title"         content="Game Grader Hansa" />
        <meta property="og:description"   content="Game Grader Hansa : Computer The Cyber Tower" />
        <meta property="og:image"         content="https://smart.cs.buu.ac.th/gdev/Image/bg/pgdh3.jpg" />
         
    </head>
<body style="background: url(Image/bg/pgdh10.jpg) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;">
<!--<div class="jumbotron text-center">
  <h1>Computer The Cyber Tower</h1>
  <p>Grader Hansa : Burapha University</p> 
</div>-->
  
<div class="container" style="margin-left:auto;margin-right:auto;display:block;margin-top:10%;margin-bottom:0%">
    <div align="left" class="login">
    <h3 class="login-heading">
        <strong><font color="white">Welcome.</font></strong><font color="white"> Please login.</font></h3>
        <form method="post" action="authen.php">
            <div class="form-group">
                <label for="email"><font color="white">Username:</font></label>
                <input type="text" class="form-control" name="id" size="35" placeholder="Enter Username" required="required" >
            </div>
            <div class="form-group">
                <label for="pwd"><font color="white">Password:</font></label>
                <input type="password" name="pass" size="35" class="form-control" placeholder="Enter password" required="required" >
            </div>
            <a href="#" class="lnk">
              <span class="pull-left"></span> 
              <span class="pull-right"><font color="white">Get Password grader.informatics.buu.ac.th</font></span> 
            </a>
            <button type="submit" class="btn btn-default" VALUE=" Login ">Sign in</button>
        </form>
    </div>
</div>
<script src="js/indexLogin.js"></script>

<!--form method="post" action="getpass.php">

<center><b>
</b></center>

         <CENTER>
         <h4 align=center><br><br>Get Password grader.informatics.buu.ac.th</h4>
         <TABLE BORDER="0" WIDTH="300" ALIGN=CENTER CLASS=bold>
          <TR>
                <TD> Username : </TD>
                <TD> <INPUT  TYPE="text" NAME="id"> </TD>
          </TR>
          <TR ALIGN=center>
            <TD COLSPAN=2> <INPUT TYPE=submit VALUE=" Get Password "> </TD>
          </TR>
        </TABLE>

</form-->

</body>
</html>
