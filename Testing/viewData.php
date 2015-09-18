<?php

	
	require('main.php');
	
	administrator();
	
	connectSQL();
	
	echo "<div id=\"main\">";
	
	
	$table = $_SESSION{'table'};
	
	$result = mysql_query("SHOW COLUMNS FROM $table");	
	
	
	
	?>
	
	
		<table id="viewData" border="1" width="100%">
		<br><br>
		<th>Table Data : </th><tr />
		<td><center>SQL Table : <? echo $table ?></center></td>
		<tr />
	
	<?
	
	if (!$result) {
		echo '<td>
		Error : ' . mysql_error();
		echo "</td><tr />";
		
	}
	
	
	
	if (mysql_num_rows($result) > 0) {
		while ($row = mysql_fetch_assoc($result)) {
			$i++;
			echo "<td>  $i)  ";
			print_r($row);
			echo "</td><tr />";
			
			
			
		}
	}
	
	echo "</table>
	";
	
	echo "</div>";

	
	htmlEnd();



?>