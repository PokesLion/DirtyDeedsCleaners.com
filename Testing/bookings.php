<?

	include('main.php');
	
	connectSQL();
	
	
	
	$sql= "SELECT * FROM appointment WHERE Username=\"" .$_SESSION{'login'} . "\"";
	
	$result = mysql_query ($sql);
	
	if (!$_SESSION{'login'}){
		
		urlAssign('index.php');
	}
	
	?>
	<div id="main">	
		<div id="bookings">
		<?
		
		if (mysql_num_rows($result) == 0) { 
		
			echo "<br/><center>You do not have any appointments scheduled.</center>";
			
		}else{			
			?>		
			<table width="100%" align="center" border="ridge 2px purple;" cellspacing="0">
				<th colspan="6" style="text-align:center;line-height:4;"><u>Appointments:</u></th><tr/>
			<?
			$keysToAppointment = array ('ID', 'Username' ,'Location' ,'AppointmentTime' ,'PaymentType' ,'Ccard' ,'Extras' ,'JobLengthHrs' ,'ContactPhone');
			$_SESSION{'exhausetedTH'} = 0;
			while ($row = mysql_fetch_array( $result)  ){
				
				#echo "<br/>Data : " . print_r ($row);
				if (!$_SESSION{'exhausetedTH'}){
					foreach ($keysToAppointment as $key){				
					
						$value = $row{$key};
						if ($value == $lastValue ){
							$value = NULL;
						}
						if ($key ){
							
							if ($key != "ID" && $key != "Username" && $key != "Ccard" ) {
								?>
								<td style="font-weight:bold"><? echo $key ?></td>
								<?
							}
						}
						$lastValue = $value;
					}
				}
				$_SESSION{'exhausetedTH'} = 1;
				echo "<tr/>";
				foreach ($keysToAppointment as $key){
					$value = $row{$key};
					if ($value == $lastValue ){
						$value = NULL;
					}	
					
					if ($key){
						if ($key != "ID" && $key != "Username" && $key != "Ccard" && $key != "PaymentType") {
							?>
							<td><span style="display:inline-block;"> <? echo $value ?></span></td>
							<?
						}elseif($key == "Ccard"){																	
							?>
							<td><span style="display:inline-block;"> <? echo $lastValue  . "<br/>" . $value ?></span></td>
							<?
						
						}elseif($key == "Ccard" && $lastValue == "Credit Card"){
							
							
							$printString .= "<br/>KEY = " . $key;
							
							$printString .= "<br/>Last Value = " . $lastValue;
							#$valueEdit 		= substr($value, -4 , 4);
							$printString .= "<br/>Last 4 = " . $valueEdit . "";
							
							echo "<td> Key = $key , Value = $value</td>";
							
							if (0){
								if ($lastValue == "Credit Card"){
									?>
									<td class="cont" style="max-width:100px;"> <? echo $lastValue  . "<br/>" . $valueEdit ?></td>
									<?
								}else{								
								
									?>
									<td  class="cont"> <? echo $value ?></span></td>
									<?
									
								}
								
							}
							
							
						}
					}
					$lastValue = $value;
					
				}
				echo "<tr/>";
				
				
				
				/*
				 $row{'ID'}
				 $row{'Username'} 
				 $row{'Location'} 
				 $row{'AppointmentTime'} 
				 $row{'PaymentType'} 
				 $row{'Ccard'} 
				 $row{'Exp'} 
				 $row{'Cvc'} 
				 $row{'Extras'} 
				 $row{'JobLengthHrs'} 
				 $row{'ContactPhone'} 
				*/	
				
			}
			?>
			</table>
			<?
			
			if ($printString){
				echo $printString;
			}
			
		}

		
		?>
	
		</div>
	</div>
	<?
	
	
	htmlEnd();


?>