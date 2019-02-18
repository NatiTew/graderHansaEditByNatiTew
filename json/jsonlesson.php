<?php
	//connect db
	$objConnect = mysql_connect("localhost","grad","GraD@2016");  
	// database
	$objDB = mysql_select_db("grad2016");
	mysql_query("SET NAMES UTF8");
	//select table
	$SQLstring = "SELECT * FROM `lessons` ";

	$objQuery = mysql_query($SQLstring);
	$numRows = mysql_num_fields($objQuery);
	$resultArray = array();
	while($obResult = mysql_fetch_array($objQuery))
	{
		 $arrCol = array();
		for($i=0;$i<$numRows;$i++)
		{
			$arrCol[mysql_field_name($objQuery,$i)] = $obResult[$i];
		}
		array_push($resultArray,$arrCol);
	}
	mysql_close($objConnect);
	header ('Content-type: text/html; charset=utf-8');
	echo json_encode($resultArray);
?>