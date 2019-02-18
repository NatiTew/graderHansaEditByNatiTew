<?php
$q=$_GET['q'];
$s=$_GET['s'];
$v=$_GET['v'];
$le=$_GET['le'];
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<?php echo "<META HTTP-EQUIV='Refresh' 		CONTENT='0;URL=main.php?lesson_id=".$le."#section41'>"?>
		<meta property="og:url"         content="" />
        <meta property="og:type"        content="education" />
        <?php echo "<meta property='og:title'  content='Assignment : ".$q."'; />" ?>
        <?php echo "<meta property='og:description'   content='UESR : ".$v." Score : ".$s."'/>"?>
        <meta property="og:image"       content="https://smart.cs.buu.ac.th/gdev/Image/bg/pgdh8.jpg" />
		<link rel='stylesheet' type='text/css' href='css/listproblemStyle.css'>
		<script>
			window.onload = function(){
  				document.getElementById("autoid").click();
			}
		</script>

	</head>
<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v2.9&appId=627357637388880";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<?php echo "<div class='fb-share-button' data-href='https://smart.cs.buu.ac.th/gdev/facbookShare.php?q=".$q."&amp;s=".$s."&amp;v=".$v." data-layout='button' data-size='small' data-mobile-iframe='true'><a class='fb-xfbml-parse-ignore' id='autoid' target='_blank' href='https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fsmart.cs.buu.ac.th%2Fgrad%2FfacbookShare.php%3Fq%3D".$q."%26s%3D".$s."%26v%3D".$v."&amp;src=sdkpreparse'>share</a></div>"?>

</body>
</html>
