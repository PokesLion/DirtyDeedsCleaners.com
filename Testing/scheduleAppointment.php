<?php
		
		
	$javascript = '
	
	function changeText(id) { 
		id.innerHTML = "";
	}';
	
		
		
	require('main.php');
	
	

	
	?>
	
	
	
	<div id="main">
		<div id="calendarContent">
			<form action="scheduleDay.php" method="POST">
				<?
				$table = '
				<table height="70%" cols="7" border="0" cellspacing="15">
				
				<td colspan="7"  id="appointmentHeader"><center><span  style="color:white" size="13"><font size="12">Appointment on day</font></center></td>
				';		
				
				$table .= showCalendar();
				$table .= '
				</table>';
				echo $table;
				
				?>
			</form>
			<form action="scheduleAppointment.php" method="POST">
				<center><input id="resetCalendar" type="submit" value="Reset" name="resetMonths" /> </center>
			</form>
		</div>	
	</div>	
	<a id="buttonMonthPlus" href="moreMonths.php">			
			>>>			
	</a>
	<?
	
	
	
	if ($_SESSION{'selectionDate'} > $_SESSION{'fullDate'}){		
		?>
		
		<a id="buttonMonthMinus" href="lessMonths.php">
			<<<			
		</a>
		<?
		
	}else{
		?>
		
		<span id="buttonMonthMinus" >
			<<<			
		</span>
		<?
		
		
	}
	
	?>
	
	<h3 id="help"  onclick="changeText(this)">
		<div id="instruction">
			Hint:<br /> Click a day to schedule your appointment. Days after today are available for scheduling. To view a different month please click the arrow buttons. 			
		</div>
	</h3>
	
	<?	
	
	htmlEnd();
	
#############################################	#############################################	#############################################	#############################################	#############################################	

function showCalendar(){
	
	
	$fullDate = date ('Ymd');
	$_SESSION{'fullDate'} = $fullDate;
	
	#SELECTION  = SHOWING a certain month
	 
	$selection = array();
	
	
	if (isset($_POST{'resetMonths'})){
	
		$selection{'month'} = date('m');
		$selection{'monthName'} = date('F');
		$selection{'year'} = date('Y');
		
		$_SESSION{'monthSelectedNumeric'} = date('m');
		$_SESSION{'monthSelectedSpelled'} = date('F');
		$_SESSION{'yearSelected'} = date('Y');
		
	}elseif ($_SESSION{'monthSelectedNumeric'}){
		$selection{'month'} = $_SESSION{'monthSelectedNumeric'};
		
		
		$stringLength = strlen($selection{'month'});
		if ($stringLength < 2){
			
			$selection{'month'} = "0" . $selection{'month'};
		}
		
		$selection{'monthName'} = $_SESSION{'monthSelectedSpelled'};
		
		if (!$_SESSION{'yearSelected'}){
			
			$_SESSION{'yearSelected'} = date('Y');
		}
		$selection{'year'} = $_SESSION{'yearSelected'};
		
	}else{
		$selection{'month'} = date('m');
		$selection{'monthName'} = date('F');
		$selection{'year'} = date('Y');
		
	}
	
	$tableFunc = "</tr>
		  <tr >
		  
			<td colspan=\"7\" id=\"monthHeader\" ><center><b>" . $selection{'monthName'} . " " . $selection{'year'}  . "</b></center></td>";
	
	
	$tableFunc .= "			
	</tr>
	";	
	 
	 
	$julianMonth = $selection{'month'};
	$julianDay	 = date('d');
	$julianYear	 = $selection{'year'};
	
	$dayOfWeek = array();	
	
	#Find the day of the week that can be used to find when the of the first day of the month is
	$dayOfWeek[1] = getDayOfWeek($julianMonth , '01' , $julianYear);
	$firstOfMonth = $dayOfWeek[1];
	
	
	
	
	
	#echo "First of the month = " . $firstOfMonth . "<br>";	
	#Find todays date
	$dayOfWeek[2] = getDayOfWeek($julianMonth , $julianDay , $julianYear);
	
	 $tableFunc .=  "<tr  id=\"daysHeader\">";
	 
	 $daysOfWeek = array ('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
	 
	 $numDays =  count ($daysOfWeek);
	 
	 for ($i = 0; $i < $numDays ; $i++){
		 
			$tableFunc .= "<td id=\"daysRow\"height=\"15px\"><center>" . $daysOfWeek[$i] .  "</center></td>";
		 
	 }
	 
	 $tableFunc .= "
	 </tr>
	 
	 <tr>
	 ";		
	 
	 

	$min = 0;		 
	
	$max = monthRestrictionsByYear();
			
	$cellCounter = 0;
	$maxDays = 8;
	$_SESSION{'selectionDate'} =  NULL;
	
	 
	 while ($min < $max ){
		 $min++;			 
		 $cellCounter++;
		 
		 
		 if (($min + $offset) > $firstOfMonth){
			 
			 if ($cellCounter < $maxDays){				 
				
				 if ($min < 10){
					 $min = "0" . $min;
					 
				 }
				 
				 $selection{'date'} = $selection{'year'} .  $selection{'month'} . $min;
				 
				 if(!$_SESSION{'selectionDate'}){					 
					 
						$_SESSION{'selectionDate'} =  $selection{'date'};
				 }
				 
				 
				 
				 
				 if ($selection{'date'} > $fullDate){				
					
					$tableFunc .= "			
					<td  width=\"7.14%\">
						 <button value = \""  . $selection{'date'} .  "\" name=\"day\" id=\"mySubmitButton\" type=\"submit\" >  
							<div style=\"height:100%;width:100%\">
								<span id=\"calendarDay\" align=\"right\">" . $min  . "</span>
							</div>
						</button>						
					</td>";
					
			
				}else{
					$tableFunc .= "			
					<td  width=\"7.14%\">
						<button type=\"button\" id=\"closedsubmitbutton\">				
							<div style=\"height:100%;width:100%\">
								<span id=\"calendarDay\" align=\"right\">" . $min  . "</span>
							</div>
						</button>
					</td>";
					
				}
			
				
			 }else{
				 
				 $cellCounter= 1;
				 
				 if ($min < 10){
					 $min = "0" . $min;
					 
				 }
				 
				 $tableFunc .= "
				 </tr>				 
				 <tr> 
				 ";
				 
				$selection{'date'} = $selection{'year'} .  $selection{'month'} . $min;
			 
				if ($selection{'date'} > $fullDate){				
					
					$tableFunc .= "			
					<td  width=\"7.14%\">
						 <button value = \""  . $selection{'date'} .  "\" name=\"day\" id=\"mySubmitButton\" type=\"submit\" >  
							<div style=\"height:100%;width:100%\">					
								<span id=\"calendarDay\" align=\"right\">" . $min  . "</span>
							</div>
						</button>						
					</td>";
					
			
				}else{
					$tableFunc .= "			
					<td  width=\"7.14%\">
						<button type=\"button\" id=\"closedsubmitbutton\">				
							<div style=\"height:100%;width:100%\">
								<span id=\"calendarDay\" align=\"right\">" . $min  . "</span>
							</div>
						</button>
					</td>";
					
				}
				 
				 
			 }
		}else{
			
			
			#Last Month Days
			$tableFunc .= "			<td  width=\"7.14%\"><p id=\"mySubmitButton\"></p></td>"; 
			$offset++;
			$min --;
			
			
		} 
	 }
	 $tableFunc .= "</tr>";
	 
	 
	 
	 return $tableFunc;
	 
	 
	
	
}


function getDayOfWeek($julianMonth , $julianDay , $julianYear){
	
	
	
	 $reference = array ();		 
	 $reference['20150723'] = "Thursday";
	 
	 $refMonth = "07";
	 $refDay = "23";
	 $refYear = "2015";
	 
	 $today = date ('d');
	 $fullDate = date ('Ymd');
	 
 
	 $gregorianDate = gregoriantojd ( $julianMonth , $julianDay , $julianYear );
	
	if ($debug){
		 echo "Gregoriana Date = " . $gregorianDate;
		 echo "<br>";
	}
	 $gregorianDateReference =  gregoriantojd ( $refMonth , $refDay , $refYear );
	 
	if ($debug){ 
	 
	 
		echo "Gregoriana Date Reference= " . $gregorianDateReference;		 
		echo "<br>";
	}
		
	  
	 $dateDifference = $gregorianDateReference - $gregorianDate;
	 if ($debug){
		echo "Greg Day Difference= " . $dateDifference;		 

		echo "<br>";
	 }
	 
	 if ($dateDifference == 0 || $dateDifference > 0){
		 
		 
		 while ($dateDifference > 6){
			 $dateDifference -= 7;
			 
			 
		 }
		 
		 
	 }elseif($dateDifference < 0){
		while ($dateDifference < -6){
			 $dateDifference += 7;
		 } 
		 
	 }
	 if ($debug){
		echo "Edited Day Difference= " . $dateDifference;		 
		echo "<br>";
	 }
	 
	 
	 
	 $daysOfWeek = array ('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
	 
	 for ($i = 0 ; $i < 6 ; $i++){
			 
		 if ($daysOfWeek[$i] == $reference['20150723']) {
			 $dayNumber = $i;
			 
		 }
		 
	 }
	 $daysPast1st = 1 - $julianDay;
	 
	 if ($debug){
		 echo "DaysPast 1st = " .  $daysPast1st;
		 echo "<br>";
	 }
	 
	 $updatedDayNumber = $dayNumber - $dateDifference;	 
		 
	 
	 
	 if ($debug){
		 echo "Day Number = $updatedDayNumber";
		 echo "<br>";
		 echo "Todays Day = " . $daysOfWeek[$updatedDayNumber];
		 echo "<br>";
		 
	 }
	 $daySpelled  = $daysOfWeek[$updatedDayNumber];
	 
	 if ($updatedDayNumber > 7){
		 $updatedDayNumber -=7 ;
		 
	 }
	 
	 return ($updatedDayNumber);
	
}



function monthRestrictionsByYear(){
	
	
	
	
	
	if (!$_SESSION{'monthSelectedSpelled'}){
		
		
		$_SESSION{'monthSelectedSpelled'} = Date ('F');
		$_SESSION{'monthSelectedNumeric'} = Date('m');
	}
	
	if (!$_SESSION{'yearSelected'}){
		$_SESSION{'yearSelected'} = date('Y');
		
	}
	
	#when made dynamic this becomes  $month = $_SESSION{'monthSelectedSpelled'};
	$month = $_SESSION{'monthSelectedSpelled'};
	$dateYear = $_SESSION{'yearSelected'};
	
	$dateRestrictions = array();
	$dateRestrictions{'January'} = 31;
	
	
	
	
	$dateYearDivide = $dateYear/4;
	$dateYearInt = round($dateYearDivide, 0 , PHP_ROUND_HALF_DOWN);
	
	if ($dateYearDivide == $dateYearInt){
		
		$dateRestrictions{'February'} = 29;
		
	}else{
		
		$dateRestrictions{'February'} = 28;
	}
	$dateRestrictions{'March'} = 31;
	$dateRestrictions{'April'} = 30;
	$dateRestrictions{'May'} = 31;
	$dateRestrictions{'June'} = 30;
	$dateRestrictions{'July'} = 31;
	$dateRestrictions{'August'} = 31;
	$dateRestrictions{'September'} = 30;
	$dateRestrictions{'October'} = 31;
	$dateRestrictions{'November'} = 30;
	$dateRestrictions{'December'} = 31;
	
	$limit = $dateRestrictions{$month};
	
	#echo "Limit = $limit <br>Month = $month<br>";
	
	
	return ($limit);

}


?>
