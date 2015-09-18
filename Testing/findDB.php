<?php


	require ('main.php');
	
	
	
	connectSQLDynamic();
	
	$sqlDatabase = "SELECT DB_NAME()";
	
	$result = mysql_query ($sqlDatabase);
	
	echo '<div id="main">';
		echo "<p>" . [$result] . "</p>";
	echo '</div>';
	
	
	
	htmlEnd();;
	

	
?>