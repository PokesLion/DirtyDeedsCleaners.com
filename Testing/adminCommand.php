<?php	
	
	
	require ('main.php');	# MUST RUN FUNCTIONS BEFORE HTML.PHP!!!!!!!
	
	connectSQL();		#Access Database
	
	administrator(); 	#only the admin can stay on this page 		SET   $_SESSION['administrator'] or boot
	

###################################################################################################################################################################################################################################################
###################################################################################################################################################################################################################################################
#	MAIN CODE - GENERATE HTML & LOGIN & PROJECTS
###################################################################################################################################################################################################################################################
###################################################################################################################################################################################################################################################


	
	
	
	
	
	
	echo '
		<body>
			<div id="main">
		';
	
		
		#Ask SQL COMMAND
		command ();
		
		echo "</div>";	#END #MAIN
		
		htmlEnd(); #Closes BODY and Opens/closes FOOTER
	
	
# END CODE
###################################################################################################################################################################################################################################################
###################################################################################################################################################################################################################################################



	
	
	
	
	
	function command (){
		
		echo "<div class=\"center\">";
		
		if (isset($_POST{'run'})){
			#Reset Range for each new search criteria
			$_SESSION['min'] = "1";
			$_SESSION['max']	 = "10";	
			
			
			$sql = $_POST{'SQL'};
			$table = $_POST{'table'};
			
			$_SESSION['sqlQuery'] = $sql;
			$_SESSION['sqlTable'] = $table;			
			
			
			
			
			
		}elseif($_SESSION['sqlQuery'] || $_SESSION['sqlTable']){
			
			
			$sql = $_SESSION['sqlQuery'];
			$table = $_SESSION['sqlTable'];
			
		}
		
		
		#Collect SQL Command from admin.php
		
		$min 		= $_SESSION['min'];
		$max 		= $_SESSION['max'];
		
		
		echo "<p>SQL = $sql</p>";
		echo "<p>TABLE = $table</p>";
		
		
		if ($sql && $table ){
			
			
			
		}else{
			
			$_SESSION{'adminCommandError'} = "Your command was not found. ";
			echo "<script type=\"text/javascript\"> window.location.assign(\'admin.php\')</script>";
			
			
		}
		
		
		
		 
		
		if ($sql && $table){			
			
			$result = mysql_query($sql) or die ("<p>result not found " . mysql_error() . "</p>");			
			
			if (!$min){
				
				$min = 1;
				
			}
			if (!$max){
				
				$max = 10;
				
			}
				
			$current = $min;
			
			
			if (preg_match("/^SELECT/" , $sql)){
				
				if ($table == 'user'){
					
					if ('SELECT * FROM user'  == $sql ){ 		##Standard Select all
								
						#	Run SQL Database Search
								
						
						echo "<table class=\"middle\">
									<th colspan=\"9\"> <center><u>Data</u> </center></th><tr><tr>
										<td></td><td> ID: </td><td> User: </td><td>Password: </td><td>PageViews: </td><tr>";
										
						while ($row = mysql_fetch_row($result)){
							$counter++;
							
							if($counter + 1 > $min && $counter < $max + 1 ){			
							
							
								$pass = $row[2];
								$passLength = strlen($pass);				
								$passReplace = 0;
								$sensored = "";
								
								while ($passReplace < $passLength){
									 
									$sensored .= "*" ;
									
									$passReplace++;
									
								}
								
								
								echo "<td>$counter ) </td><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $sensored . " </td><td>" . $row[3]  . " </td> <tr>";
								
							}
								
							
						}
						echo "</table>";
						
					
						#End Display SQL Data
					
				}else{
					
					
					#Data Dump
								
					#	Run SQL Database Search
							
					
					echo "<table class=\"middle\">
								<th colspan=\"9\"> <center><u>Data</u> </center></th><tr><tr>
									<td></td><td> row[0] </td><td> row[1] </td><td>row[2]</td><td>row[3] </td><tr>";
									
					while ($row = mysql_fetch_row($result)){
						$counter++;
						
						if($counter + 1 > $min && $counter < $max + 1 ){					
							
							echo "<td>$counter ) </td><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . " </td><td>" . $row[3]  . " </td> <tr>";
							
						}						
					}
					echo "</table>"; #End Display SQL Data
					
				}# END USER PRINT
			}
				
				
				
			if ($table == 'suggestions'){ 		#Map out table for displaying.
					echo "<table class=\"middle\">
							<th colspan=\"6\"> <center><u>Data</u> </center></th><tr><tr>";
					while ($row = mysql_fetch_row($result)){
						
						$counter++;
					
						if($counter + 1 > $min && $counter < $max + 1 ){			
							echo "<td>$counter ) </td></td><td>Title: </td><td>" . $row[1] . "</td><td>Message: </td><td>" . $row[2] . "</td><td>ID: " . $row[0] . "</td><tr>";
							
						}					
					}
					echo "</table>";
			}
				
				
			if ($table == 'email'){ 		#Map out table for displaying.
					#	Run SQL Database Search
					echo "<table class=\"middle\">
							<th colspan=\"8\"> <center><u>Data</u> </center></th><tr><tr>";
					while ($row = mysql_fetch_row($result)){				
						$counter++;
					
						if($counter + 1 > $min && $counter < $max + 1 ){
							echo "<td>$counter ) </td><td>Email:  </td><td>" . $row[1] . "</td><td>Subject:  </td><td>" . $row[2]  . "</td><td>Message:  </td><td>" . $row[3]. "</td><td>ID : " . $row[0] . "</td><tr>";
							
							
						}					
					}
					echo "</table>";
					#End Display SQL Data
				}
				
			}else{
				
				
				mysql_query($sql) or die ("<p>Err: " . mysql_error() . "</p>");
				
				echo "<p>Ran command, " . $sql . "</p>";
				
				
				
				
				
			}
			
			
			
			$_SESSION['counter'] = $counter;
				
			# Map additional SQL databases?  Contact, Projects				
			echo "<p><br>  <label>";
			
			if( ($min - 10) > 0 ){
					echo "<a href=\"less.php\"><<< Less</a>";	
				
			}else{
				
				echo "<<< Less ";
				
			}
			echo "</label>";
			
			
			
						
			  echo "( $min -  $max  ... $counter)
			  <label> ";
			  
			  if ( $max < $counter ){
				echo"<a href=\"more.php\">More >>> </a> ";  
				  
			  } else{
				  
				  echo "More >>>";
			  }
			  
			  
			  echo "</label></p>";
			  
			  
			
			$_SESSION['min'] = $min;
			$_SESSION['max'] = $max;
			
			
			echo <<<OUT
				<form action="admin.php" method="post">
					<input type="Submit" value = "Back">
					
					</p>
				</form>
OUT;
			
			
			
			
		}
		
		echo "</div>";
		
	}
	
	$_SESSION{'adminCommandError'} = "";
	
	
function userPrint(){
		
	global $sql, $table , $result ;

	
		
	

}	

?>
