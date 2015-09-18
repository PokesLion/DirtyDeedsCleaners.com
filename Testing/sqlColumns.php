<?php

	
	$sidebar = 1;
	require('main.php');
	administrator(); 	#only the admin can stay on this page 		SET   $_SESSION['administrator']
	
	
	if (!$_SESSION{'recentlyAddedSessionColumn'}){
		
		$_SESSION{'recentlyAddedSessionColumn'} = "none ";
	}
	
	$_SESSION{'triggercolumnPlus'} = 1;
	
	#TODO finish validation on this page. Also try to include a page that updates
	?>
	
	
	<div id="main">
		<form method="post" action="process.php" >
			
			
			<p align="center">
				<table>
					<th colspan="2">Columns</th><tr>
					
					<td>Name of column to add:</td><td><input required name="column" type="text" size="20" ></input> </td><tr> </tr>					
					<td>DataType: </td><td><select name="dataType" required>							
							<option></option>
							<option>CHARACTER(n)</option>
							<option>VARCHAR(n)</option>
							<option>BINARY(n)</option>
							<option>BOOLEAN</option>
							<option>VARBINARY(n)</option>
							<option>BINARY VARYING(n) </option>
							<option>INTEGER(p) </option>
							<option>SMALLINT </option>
							<option>INTEGER </option>
							<option>BIGINT </option>
							<option>DECIMAL(p,s)	 </option>
							<!--	<option>NUMERIC(p,s)	 </option>	-->
							<!--	<option>FLOAT(p) </option>			-->
							<option>REAL</option>
							<option>FLOAT</option>
							<option>DOUBLE PRECISION</option>
							<option>DATE</option>
							<option>TIME</option>
							<option>TIMESTAMP</option>
							<option>INTERVAL</option>
							<option>ARRAY</option>
							<option>MULTISET</option>
							<option>XML</option>							
						</select>
					</td><tr> </tr>
					<td>Specific Data Type: </td><td><input type="text" name="dataTypeSpecific" size="3"></input></td>	<tr></tr>
					<td>Action: </td><td> <select name="action" required> <option>columnPlus</option>  </select></td><tr></tr>
					<td colspan="2"><center><input type="submit" value="Go!"></input></center></td>
				</table>
				
				<?php 
				
					if (count ($_SESSION{'recentlyAddedSessionColumn'})){
						echo "<br><br><br><br><div align=\"center\">";
						
						echo "<p>Recently Added :</p> ";
						
						$spaceDeliminatedSessionColumn = $_SESSION{'recentlyAddedSessionColumn'};
						
						$allAddedColumns = explode (" " , $spaceDeliminatedSessionColumn);
						$i = 0;
						$maxLoop = count($allAddedColumns);
							
						while ($i <  $maxLoop){
							
							if ($allAddedColumns[$i]){
								$counter++;
								echo "<p>[ " . $counter . "  ][" . $allAddedColumns[$i]  . "]</p>";
								
							}
							
							$i++;
						}
						
						echo "<br><br><br><p>Last SQL CMD : \"" . $_SESSION{'lastSqlCmd'} . "\"</p>";
						
						
					}
					
					if ($_SESSION{'dataDump'}){
						
						echo "<br><br><br><p>Data Dump : ";
						print_r ($_SESSION{'dataDump'});
						echo "</p>";
					}
					
					echo "</div>";
					

					?>
				
			</p>
		</form>
		
		<?php
		
		
		
		
	echo "</div>";
	
	
	
	
	
	
	
	
	
	
	htmlEnd();
	
	
	
	
	
	
	

	
?>