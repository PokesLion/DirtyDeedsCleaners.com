<?php


	require('main.php');
	
	
	connectSQLDynamic();		#Access Database
	
	administrator(); 	#only the admin can stay on this page 		SET   $_SESSION['administrator'] or boot
	
	echo "<div id=\"main\">";
	
	runCommand ();
	
	echo "</div>";
		
	htmlEnd(); # 	Closes BODY and Opens/closes FOOTER
	
	

function runCommand (){
		
		echo "<div class=\"center\">";
		
		
			
		#Reset Range for each new search criteria
		$_SESSION['min'] = "1";
		$_SESSION['max']	 = "10";	
		
			
		$sql = "SELECT * FROM email";
		$table = "email";
		
		$_SESSION['sqlQuery'] = $sql;
		$_SESSION['sqlTable'] = $table;			
		
			
			
		
		
		
		#Collect SQL Command from admin.php
		
		$min 		= $_SESSION['min'];
		$max 		= $_SESSION['max'];
		
		
		echo "<p>SQL = $sql</p>";
		echo "<p>TABLE = $table</p>";
		
		
		if (!$sql || !$table ){
				
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
				
			
			
			
			
			#	Run SQL Database Search
			echo "<table class=\"middle\">
							<th colspan=\"8\"> <center><u>Data</u> </center></th><tr><tr>";
			while ($row = mysql_fetch_row($result)){				
				$counter++;
				
				if($counter + 1 > $min && $counter < $max + 1 ){
					echo "<td>$counter ) </td><td>Email:  </td><td>" . $row[1] . "</td><td>Subject:  </td><td>" . $row[2]  . "</td><td>Message:  </td><td>" . $row[3]. "</td><td>ID : " . $row[0] . "</td><tr> ";
					
					
				}					
			}
			echo "</table>";
			#End Display SQL Data
			
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


?>