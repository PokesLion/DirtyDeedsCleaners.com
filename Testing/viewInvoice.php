<?php


	require('main.php');
	connectSQL();
	
	
	
	echo "<div id=\"main\">
			<center>
	";
	
	if ($selectedParty){
		
		
		
	}else{
		
		?>
		
		<table width="100%" cols="6">
		
			<th colspan="6">Invoices Created </th><tr />
			<td colspan="2">Individual Invoice</td><td colspan="2">Grouped Invoices</td><td colspan="2">Search Invoices</td><tr />
			<td colspan="6"><hr></td><tr />
			<form action="viewInvoice.php" method="post">
			<?php
			invoiceList();
			?>
			<td><input type="submit" name="invoiceSelect" value="Submit"></td><td><input type="checkbox" value="1" name="viewAll">View All Results</input></td><tr />
			<td colspan="6"><center><button type="button" onclick="location.href='recordWork.php'">Add new</button></center></td>
			
			
			
			
			</form>
		</table>
		
		
		
		<?php
	}
	
	
	
	
	
	
	echo "</center>
	</div>";
	
	
	htmlEnd();
	
########################################################################################################################################################################################################################################################################################
########################################################################################################################################################################################################################################################################################

	
function invoiceList(){
		
	connectSQL();
	
	$sql = "SELECT * FROM invoice";
	
	$result = mysql_query($sql);
	
	$counter = 0;
	$invoiceInfo = array ();
	
	
	if ($result){
		
		while ($row = mysql_fetch_row($result)){				
			
			#Using array instances, access array of information
			#$invoiceInfo{'ID'} = $row[0];
			#$invoiceInfo{'EmployerID'} = $row[1];
			#$invoiceInfo{'Date'} = $row[2];
			#$invoiceInfo{'Amount'} = $row[3];
			#
			#	ID   EmployerID Date Amount
			
			$id = $row[0];
			$employerID = $row[1];
			$date = $row[2];
			$amount = $row[3];
			
			
			
			if ($id && $employerID && $date){
			
				$length = count ($invoiceInfo);
				
				if ($_POST{'viewAll'}){
					
					echo '<td><input type="radio" name="invoiceChoice" value="' . ($id) . '"></input></td>' . "<td>ID) " . $row[0] .  "</td><td>Owner) " . $row[1] .  "</td><td>Date) " . $row[2] .  "</td><td>Amount) " . $row[3] . "<tr />";					
					
				}else{
				
				
					$matchFound = 0; 
				
					for ($i = 0; $i < $length ; $i++){
						
						if ($invoiceInfo[$i][1] == $row[1] && $invoiceInfo[$i][2] ==  $row[2] && $invoiceInfo[$i][3] == $row[3]){
							
							#	matchFound & skipped
							$matchFound = 1; 
							
						}
						
					}
					
					
					
					#To view all search results : 
					
					if (!$matchFound){
							
						#	match Not Found
						
						
						$invoiceInfo[$counter] = array($row[0] , $row[1] , $row[2] , $row[3]);
						echo '<td><input type="radio" name="invoiceChoice" value="' . ($id) . '"></input></td>' . "<td>ID) " . $row[0] .  "</td><td>Owner) " . $row[1] .  "</td><td>Date) " . $row[2] .  "</td><td>Amount) " . $row[3] . "<tr />";
						
						#	echo "<td>DEBUG ||   \$invoiceInfo[$i][1] = " . $invoiceInfo[$i][1] . "    ||||| \$row[1] = " . $name . "<br> \$invoiceInfo[$i][3] = " . $invoiceInfo[$i][3] . "|||||   \$row[3] = " . $phone . "</td><tr />"; 
						
						$counter++;
						
					}
				
				}

			}	
			
		}
		
	
	}else{
		echo "<td>" . mysql_error() . "</td><tr />";
		
	}
	
		
		
}



?>