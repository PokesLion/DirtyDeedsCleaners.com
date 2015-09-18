<?php



	require('main.php');
	
	administrator(); 	#only the admin can stay on this page 		SET   $_SESSION['administrator']
	
	
	$error = $_SESSION{'errorSQL'};
	if(0){
		$error .= $_SESSION{'dataUsed1'};
	}
	$error .= $_SESSION{'useLastSQLMessage'};
	
	
	
	$data1 = $_SESSION{'dataCollected'};
	$data2 = $_SESSION{'dataCollected2'};
	
	
	$database 			= $_SESSION{'database'} 	;
	$table 				= $_SESSION{'table'} 		;
	$databaseHost 		= $_SESSION{'db_host'}  	;
	$databaseUsername 	= $_SESSION{'db_username'};
	$databasePass		= $_SESSION{'db_pass'} 	;
	$databaseName 		= $_SESSION{'db_name'} 	;
	
	$text = "	<tr /><td>Database  : </td><td> $database </td><tr />
				<td>Table : </td><td>$table</td><tr />
				<td>DatabaseHost : </td><td>$databaseHost</td><tr />
				<td>Database Unsername: </td><td>$databaseUsername,</td><tr />
				<td>Database Password : </td><td>$databasePass</td><tr />
				";
	 			
	
	
	 	
	 		
	
	
	echo '<div id="main">
			<form method="post" action="process.php">
				<center>
					<table width="100%">
		';
	echo '<p> Data Collected 1 : ' . $data1 . " <br> Data Collected 2 : " . $data2 . "</p>";
	
	
	
	
	if ($_SESSION{'dataCollected2'}){ 
		
		?>
		  
		
			
						<th colspan="2">What would you like to do with the database? </th><tr></tr>						
						
						<td colspan="2">					
						<?php 
						
						echo "<center>" . $text . "</center>";  
						
						?>
						<tr></tr>
						<td border ="1"><h3>Make a selection</h2></td> <td border ="1"><h3>Options:</h3>  </td><tr></tr>
						<tr></tr>
						<td><label for="modifyCurrent"><input id="modifyCurrent" type="radio" name="selection" value="1" checked><span>Modify this Database</span></input></label>
						<br>
						</td>
						<td>
						<label for="viewData"><input id="viewData" type="radio" name="action" value="viewData" checked><span>View Data</span></label>
						<br>
						<label for="newTable"><input id="newTable" type="radio" name="action" value="newTable"><span>New Table</span></label>
						<br>						
						<label for="columnAdd"><input id="columnAdd" type="radio" name="action" value="columnPlus"><span>Column add</span></label>
						<br>
						<label for="insert"><input id="insert" type="radio" name="action" value="insert"><span>Insert</span></label>
						<br>											
						<label for="delete"><input id="delete" type="radio" name="action" value="delete"><span>Delete</span>
						<br>						
						<label for="sort"><input id="sort" type="radio" name="action" value="sort"><span>Sort</span></label>
						<br>											
						</td><tr></tr>
						<td><label for="connectElse"><input id="connectElse" type="radio" name="selection" value="2"><span>Connect to a different database</span></label></td><tr></tr>
						<br>
						<td colspan="2"><center><input name="generateSql" type="submit" value="Go"></input></center></td><tr></tr>
						<td><a href="resetSql1.php">Reset Connection</a></td>
						<td><a href="resetSql2.php">Reset Table</a></td>
						
						
						<!--		dbhost, dbusername, dbpassword, dbname 
						
						<td>Table:</td><td><input name ="table" type="text"></input>
						
						
						-->
						
					</table>				
			
			
		<?php	
		
		
	}else{
		if ($_SESSION{'dataCollected'}){
			
			?>
			
						<th colspan="2">SQL Database Info:</th><td></td><tr></tr>
						
						<!--<td>Database:</td><td><input name ="database" type="text" value=""></input> 	this was answered on the last page		--> 		
						<td>Table:</td><td><input name ="table" type="text" value=""></input><tr></tr>
						
						
						
						
						<td colspan="2"><input name="generateSql" type="submit" value="Go"></input></td><tr></tr>
						<td colspan="2"><a href="resetSql1.php">Reset</a></td>
						
						
						<!--		dbhost, dbusername, dbpassword, dbname 
						
						
						
						
						-->
						
					</table>				
			
			
		<?php		
			
			
			
			
		}else{	
		
		
		?>
			
						<th colspan="2">SQL Database Info:</th><td></td><tr></tr>
						
						<td>Host: </td><td><input name ="dbhost" type="text" value="localhost"></input>
						<td>Username: </td><td><input name ="dbusername" type="text" value=""></input><tr></tr>
						
						<td>Password: </td><td><input name ="dbpassword" type="text" value=""></input>
						<td>Database: </td><td><input name ="dbname" type="text" value=""></input><tr></tr>
						<td>Use last connection setting</td><td><button type="button" onclick="location.href='useLastSQL.php'">Last Connection</button></td><tr />
						
						
						<td colspan="2"><input name="generateSql" type="submit" value="Go"></input></td><tr></tr>
						<td colspan="2"><a href="resetSql1.php">Reset</a></td>
						
						
						<!--		dbhost, dbusername, dbpassword, dbname 
						
						<td>Table:</td><td><input name ="table" type="text"></input>
						
						
						-->
						
					</table>				
					
					
					
					
		<?php 
		}
	}
	if ($error){
			
		echo "<p>$error</p>";
	}
	
	$_SESSION{'errorSQL'} = NULL;
	
	echo '';

	
	echo "		</center>
		</form>		
		";	
	
	
	
		
	
	
	echo "  </div>";
	
	
	
	htmlEnd();
	
	
	$_SESSION{'useLastSQLMessage'} = "";
	
	

?>