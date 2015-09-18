<?php

	$sidebar = 1;
	require('main.php');
	administrator();
	
	
	connectSQLDynamic();
	
	
	$sql = "SELECT * FROM INFORMATION_SCHEMA.TABLES ";	#SELECT * FROM INFORMATION_SCHEMA.TABLES 
	
	
	$result = mysql_query($sql);
	
	
	echo "<div id=\"main\">";
	
	$i=0;
	while ($row = mysql_fetch_row($result)){
		
		echo "<p> row [$i] = " . $row[$i] . "</p>";
		
		$i++;
		
	}

	echo "</div>";
	
	

?>