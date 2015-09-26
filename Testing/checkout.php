<?


	session_start();

	set_include_path(dirname(__FILE__) . '/../../public_html');	
	
	$script = '
	
	<script type="text/javascript">
	
	
		
		         
	var radio1 = document.getElementById (\'once\');
	var radio2 = document.getElementById (\'weekly\');
	var radio3 = document.getElementById (\'twoWeeks\');
	var radio4 = document.getElementById (\'fourWeeks\');	
	
	
	

	function alertRadio(){
		
		//how to check what is the selected radio input
		
		var selectedRadio = getCheckedRadioValue("frequency");		
		var changeText = document.getElementById ("changeThis");
		
		
		var frequencySpelled = new Array("", "Once", "Every week" , "Every 2 weeks" , "Every 4 weeks");

		
		
		changeText.textContent = frequencySpelled[selectedRadio];
		
		
		
		
	}	 
	
	

	function getCheckedRadioValue(name) {
		var elements = document.getElementsByName(name);

		for (var i=0, len=elements.length; i<len; ++i)
			if (elements[i].checked) return elements[i].value;
	}

	function onOffID (item){
		
		var  cabinet = document.getElementById("cabinet").getAttribute("class") ;		
		var  fridge = document.getElementById("fridge").getAttribute("class") ;
		var  oven  = document.getElementById("oven").getAttribute("class") ;
		var  laundry = document.getElementById("laundry").getAttribute("class") ;
		var  interiorWindows = document.getElementById("interiorWindows").getAttribute("class") ;
		
			
		 
		var compare = (item.id);		
		var divCompare = document.getElementById(compare);		
		var backgroundColor = "#66A3FF";
		var highlightColor = "#B280B2";
		var sumTotal = 0;
		
		
		if (compare == "cabinet"){		
		
			if (cabinet > 0){			
				divCompare.removeAttribute("class");
				divCompare.setAttribute("class", "0");
				divCompare.style.background = backgroundColor;

			}else{					
	
				divCompare.removeAttribute("class");
				divCompare.setAttribute("class", "1")
				divCompare.style.background = highlightColor;			
				
			}
				
		}else if (compare == "fridge"){
			
			if (fridge > 0){			
				divCompare.removeAttribute("class");
				divCompare.setAttribute("class", "0");
				divCompare.style.background = backgroundColor;

			}else{					
	
				divCompare.removeAttribute("class");
				divCompare.setAttribute("class", "1")
				divCompare.style.background = highlightColor;
				
			}
			
		}else if (compare == "oven"){

			if (oven > 0){			
				divCompare.removeAttribute("class");
				divCompare.setAttribute("class", "0");
				divCompare.style.background = backgroundColor;
				

			}else{					
	
				divCompare.removeAttribute("class");
				divCompare.setAttribute("class", "1")
				divCompare.style.background = highlightColor;			
				
			}
			
		}else if (compare == "laundry"){
			

			if (laundry > 0){			
				divCompare.removeAttribute("class");
				divCompare.setAttribute("class", "0");
				divCompare.style.background = backgroundColor;				

			}else{					
	
				divCompare.removeAttribute("class");
				divCompare.setAttribute("class", "1")
				divCompare.style.background = highlightColor;			
				
			}
			
		}else if (compare == "interiorWindows"){
			
			if (interiorWindows > 0){			
				divCompare.removeAttribute("class");
				divCompare.setAttribute("class", "0");
				divCompare.style.background = backgroundColor;

			}else{					
	
				divCompare.removeAttribute("class");
				divCompare.setAttribute("class", "1")
				divCompare.style.background = highlightColor;			
				
			}
			
		}
		
		var post = ' . $_SESSION{'lastQuoteHRS'} .  ';
		
		
		cabinet = document.getElementById("cabinet").getAttribute("class") ;		
		fridge = document.getElementById("fridge").getAttribute("class") ;
		oven  = document.getElementById("oven").getAttribute("class") ;
		laundry = document.getElementById("laundry").getAttribute("class") ;
		interiorWindows = document.getElementById("interiorWindows").getAttribute("class") ;
		
		sumTotal = cabinet * 0.5 + fridge * 0.5 + oven * 0.5 + laundry * 1 + interiorWindows * 0.5;
		
		var totalHours = post + sumTotal;		
		var updateThis = document.getElementById(\'jobQuote\');
		var updateThis2 = document.getElementById("hoursQuote");
		
		updateThis.textContent =  totalHours * 20;
		updateThis2.textContent =  totalHours;
		
		cabinetInput = document.getElementById("cabinetInput");
		fridgeInput = document.getElementById("fridgeInput");
		ovenInput  = document.getElementById("ovenInput");
		laundryInput = document.getElementById("laundryInput");
		interiorWindowsInput = document.getElementById("interiorWindowsInput");
		
		cabinetInput.value = cabinet;
		fridgeInput.value = fridge;
		ovenInput.value  = oven
		laundryInput.value = laundry
		interiorWindowsInput.value = interiorWindows;
		
		
		
		
		
	}
	
	function showHideCCPayment(){
		
		var selectedRadioValue = getCheckedRadioValue("paymentType");
		var paymentCCTable = document.getElementById("toggleRemove");		
		
		
		
		if (selectedRadioValue == 1){		
		
			paymentCCTable.removeAttribute("class");
			paymentCCTable.setAttribute("class", "remove");
			
			document.getElementById("reqHidden1").required = false;
			document.getElementById("reqHidden2").required = false;
			document.getElementById("reqHidden3").required = false;
			
			
		}else{
			
			paymentCCTable.removeAttribute("class");
			paymentCCTable.setAttribute("class", ".fade");
			
			document.getElementById("reqHidden1").required = true;
			document.getElementById("reqHidden2").required = true;
			document.getElementById("reqHidden3").required = true;
			
		}	
		
		
		
	}
		
	
	
	
	</script>
	';
	
	
	include('/home/dirtydeeds91/public_html/main.php');
		
	?>
	<script src="runPHP.js" type="text/javascript"></script>
	<?
	$total = 20 * $_SESSION{'lastQuoteHRS'};
		
	$_SESSION{'hoursWork'} =  $_SESSION{'lastQuoteHRS'};
	
?>

<div id="main">

	
	<?

	#echo "Data : " . print_r($_POST);
	
	#$bedrooms = $_POST{'bedrooms'};
	#$bathrooms = $_POST{'bathrooms'};
	$hours = $_SESSION{'lastQuoteHRS'};
	
	#$email = $_POST{'email'};
	
	
	
	
	
	
	if ($_SESSION{'lastRevisedDate'}){
		
		################################	Appintment Date and time
		$appointmentDate 	= substr( $_SESSION{'lastRevisedDate'} , 0 , 8 );
		$startTime 			= substr ( $_SESSION{'lastRevisedDate'} , 8 , 4 );
		
		################################	FORMAT
		#Parse Date
		$parseYr 			= substr( $appointmentDate , 0 , 4);
		$parseMn 			= substr( $appointmentDate , 4 , 2);	
		$parseDy 			= substr( $appointmentDate , 6 , 2);		
		$parseDate 			= $parseMn . "/" . $parseDy . "/" . $parseYr;
		#Parse Time
		$firstTwo 			= substr ( $startTime , 0 , 2 );
		$nextTwo 			= substr ( $startTime , 2 , 2 );
		#FormatTime
		if ($startTime > 1200){			
			$firstTwo = $firstTwo-12;
			if (strlen($firstTwo) < 2){
				#Make both entries identical format
				$firstTwo = "0" . $firstTwo;
			}			
			$startTimeFormatted =  $firstTwo . ":" . $nextTwo . " PM";			
		}else{		
			$startTimeFormatted =  $firstTwo . ":" . $nextTwo . " AM";			
		}
		
		$_SESSION{'dateTimeAppointment'} = $parseDate . " @ " . $startTimeFormatted;		
	}else{
		$startTime = $_SESSION{'lastQuoteSTART'};
		
		if ($startTime){
			$startTime = preg_replace( '/:/' , '' , $startTime  );
		}
		
		$firstTwo = substr( $startTime , 0 , 2 );
		$nextTwo =  substr( $startTime , 2 , 2 );

		if ($startTime > 1200){
			$firstTwo = $firstTwo-12;
			$startTimeFormatted =  $firstTwo . ":" . $nextTwo . " PM";
		}else{		
			$startTimeFormatted =  $firstTwo . ":" . $nextTwo . " AM";		
		}
		
		$_SESSION{'dateTimeAppointment'} = $_SESSION{'dateWorkRequest'} . " @ ". $startTimeFormatted;
		
	}
	
	if ($_SESSION{'conflictingSchedule'}){
	
		?>
		<div id="checkoutConflict">
		<?
		
	}else{
		?>
		<div id="checkoutContent">		
		<?
	}
	?>
			<center>
			<br />		
			<p><h2>Complete your booking</h2></p>							
			<?								
			if ($_SESSION{'conflictingSchedule'}){
				?>
				<p class="text">Please choose a different time <br/>Due to high demand, we don't have availability at that time. Please choose a different time below. </p>
				<?
			}else{
				?>
				<p class="error">The following page is under development... Thank you for your patience </p>		
				<p class="text">Great! We have availability at this time. A few more details and we can complete your booking.</p>
				<?
			}			
			?>			
			</center>			
			<?				
			if ($_SESSION{'conflictingSchedule'}){			
			
				$zipCode 			= $_SESSION{'CoreDATAZIP'};
				$hours 				= $_SESSION{'CoreDATAHRS'};
				$bedrooms 			= $_SESSION{'CoreDATABEDR'};
				$bathrooms     		= $_SESSION{'CoreDATABATHR'};
				
				if ($_SESSION{'adminDebug'}){
					
					echo "<br/>Day/time Revised = " . $_SESSION{'lastRevisedDate'} ;
						
					if (1){
						echo "<br/>Bedrooms = " . $bedrooms  . "<br/>";			
						echo "bathrooms = " . $bathrooms	. "<br />";
						echo "hours = " . $hours 	. "<br />";
						echo "zipCode = " . $zipCode 	. "<br />";
						
					}
				}
				verifyAppontment3Day();
						
			}else{			
				
				?>
				<br />				<hr>				<br />
				<p class="text" style="text-align:left"><b>How Often?</b></p>
				<br />				
				<form action="../../processCheckout.php" method="post" name="form">
					<fieldset onclick="alertRadio()">					  
					  <div class="fieldgroup">
						  <label for="once">
							<input type="radio" value="1" name="frequency" id="once" /> <span>Once</span>
						  </label>
					  </div>
					  <div class="fieldgroup">
						  <label for="weekly">
							<input type="radio" value="2" name="frequency" id="weekly" /> <span>Every Week</span>
						  </label>
					  </div>
						<div class="fieldgroup">
					  <label for="twoWeeks">
						<input type="radio" value="3" name="frequency" id="twoWeeks" checked /> <span>Every 2 Weeks</span>
					  </label>
						</div>
						<div class="fieldgroup">
						  <label for="fourWeeks">
							<input type="radio" value="4"  name="frequency" id="fourWeeks" /><span>Every 4 Weeks</span>
						  </label>
					  </div>
					</fieldset>
					<br />
					<br />
					<hr>
					<br />
					
					<p class="text" style="text-align:left"><b>Address</b></p>
					<p class="text">
						<table cellspacing="5">
							<tr>
								<td>Street Address</td><td></td><td>Apt #</td>
							</tr>
							<tr>
								<td><input required class="inputPadding" type="text" name="address" size="30" /></td><td width="20"></td><td><input class="inputPadding"  type="text" name="apartment" size="20" /><td>
							</tr>
							<tr>
								<td>City</td><td></td><td>State</td>
							</tr>
							<tr>
								<td><input required  class="inputPadding"  type="text" name="city" size="30" /></td><td width="20"></td><td><input required class="inputPadding" type="text" name="state" size="20" /></td>
							</tr>
							<tr>
								<td>Phone</td><td></td>
							</tr>
							<tr>
								<td><input required  class="inputPadding"  type="tel" name="phone" size="30" /></td>
							</tr>
							<tr>	
								<td>Promo Code</td><td></td>
							</tr>	
							<tr>
								<td><input class="inputPadding"  type="text" name="promo" size="30" /></td>
							</tr>
						</table><br />					
					</p>
					<br />
					<hr>
					<p class="text">
						<br />
						<b>Extras</b>
						<br />
						<table id="checkoutExtras" width="100%">
						<td height="100">
							<input id="cabinetInput" name="cabinet" type="hidden" value="0" /> 
							<div onclick="onOffID(this)" class="0" id="cabinet" style="width:100%;height:100%;background-color:#66A3FF">
								<div class="whiteBackgroundCircle"><br /><br />Inside <br />cabinets
								</div>
							</div>
						</td>
						<td height="100">
							<input id="fridgeInput" name="fridge" type="hidden" value="0" /> 
							<div onclick="onOffID(this)" class="0"  id="fridge" style="width:100%;height:100%;background-color:#66A3FF">
								<div class="whiteBackgroundCircle"><br /><br />Inside <br />fridge
								</div></div>
						</td>
						<td height="100">
							<input id="ovenInput" name="oven" type="hidden" value="0" /> 
							<div onclick="onOffID(this)" class="0"  id="oven" style="width:100%;height:100%;background-color:#66A3FF">
								<div class="whiteBackgroundCircle"><br /><br />Inside <br />oven
								</div></div>
						</td>
						<td height="100">
							<input id="laundryInput" name="laundry" type="hidden" value="0" /> 
							<div onclick="onOffID(this)" class="0"  id="laundry" style="width:100%;height:100%;background-color:#66A3FF">
								<div class="whiteBackgroundCircle"><br /><br />Laundry <br />wash & dry
								</div>
							</div>
						</td>
						<td height="100">
							<input id="interiorWindowsInput" name="window" type="hidden" value="0" /> 
							<div onclick="onOffID(this)" class="0"  id="interiorWindows" style="width:100%;height:100%;background-color:#66A3FF">
								<div class="whiteBackgroundCircle"><br /><br />Interior <br />windows
								</div>
							</div>
						</td>
						</table>
					</p>
					<br />
					<hr>
					<br />	
				
					<p class="text">
						<b>Payment</b>
						<table onclick="showHideCCPayment()" cellspacing="5">
							<tr>
								<td><label for="pmtCash"><input id="pmtCash"type="radio" name="paymentType" value="1" required /><span>Cash/Check</span></label></td>
							</tr>
							<tr>
								<td><label for="pmtCC"><input id="pmtCC" type="radio" name="paymentType" value="2"  required /><span>Credit Card</span></label></td>
							</tr>
						</table>
						<table id="toggleRemove" class="remove">							
							<td>Credit Card Number</td>
							<tr />					
							<td><input id="reqHidden1" class="inputPadding"  type="text" name="ccard" size="30" /></td><td width="20"></td>					
							<tr />
							<td>Expiration</td><td></td><td>Security Code</td>					
							<tr />
							<td><input id="reqHidden2"  class="inputPadding" type="text" name="expiration" size="5" placeholder="MM/YY"/></td>
							<td width="20"></td>
							<td><input id="reqHidden3"  class="inputPadding"  type="text" name="securityCode" size="20" placeholder="CVC" /></td>
						</table>
					</p>
					<br />			<hr>						<br />
					<p class="text">
						<center>By clicking the link below, I accept DirtyDeedsCleaners.com Terms of use.</center></p>			
					<p class="text">
					<center><input id="sub" type="submit" name="completeOrder" value="Complete Booking"/></center>
					</p>
				</form>	
			</div>
			<div id="checkoutSidebar">		
					
				<table width="100%" cellspacing="15">
					<colgroup>
						<cols span="1" border="2"> 
						<cols style="border:2px;Background-color:red" >
					</colgroup>
					<tr >
						<td width="30px" ><p class="text" style="padding-left:10px"> <img src="/images/home.png" alt="home cleaning" style="width:30px;height:30px;" /></p></td><td valign="middle"  style="position:relative;left:20px;"> <span class="text"> <b>Home Cleaning</b></span></td>
					</tr>
					<tr>
						<td width="30px" ><p class="text" style="padding-left:10px"><img src="/images/calendar.png" alt="dayAndTime" style="width:30px;height:30px;" /></p></td><td valign="middle"  style="position:relative;left:20px;margin-right:10px;"><div class="text" ><b><? echo $_SESSION{'dateWorkRequest'} . " @ ". $startTimeFormatted;?></b></div></td>
					</tr>
					<tr>
						<td width="30px" ><p class="text" style="padding-left:10px"><img src="/images/clock.png" alt="clock" style="width:30px;height:30px;" /></p></td><td valign="middle"  style="position:relative;left:20px;"><span class="text" ><b><span id="hoursQuote" ><? echo $_SESSION{'lastQuoteHRS'} ?></span> Hours</b></span></td>
					</tr>	
					<tr>
						<td width="30px" ><p class="text" style="padding-left:10px"><img src="/images/cycle.png" alt="frequency" style="width:30px;height:30px;" /></p></td><td valign="middle" style="position:relative;left:20px"><span id="changeThis" class="text" style="font-weight:bold;">Every 2 Weeks</span></td>
					</tr>	
				</table>
				<hr>
				<table width="100%" cellspacing="15">		
					<tr>
						<td valign="middle" >						
							<p class="text"><b>Total <b></p>
						</td>
						<td valign="middle" align="right"><p id="jobQuoteColor" class="text">$<span id="jobQuote"> <?   echo $total ?></span></p>
						</td>
					</tr>
				</table>
			</div>		
			<?			
		}
	?>
		<br />
	</div> <!--  END MAIN 	--> 

<?
	htmlEnd();

########################################################################################################################################################################################################
#	
#								FUNCTIONS
#
########################################################################################################################################################################################################

function showAvailableAppointmentTimes() {	
	
	connectSQL();
	$day = date ("d") + 1; 		
	if ($day < 10 ){
		
		$day = "0" . $day;
	}	
	#echo "Day = $day";	
	#0000 indicates The time of day 	
	$tomorrowsDateMash  =  date ("Ym") . $day. "0000";
	$sql = "SELECT Mash, Hours, ID FROM quotes WHERE Mash > $tomorrowsDateMash";	
	#201509170000    versus
	#201509171200	
	$futureAppointments = array();	
	$counter = 0;	
	$sql = "SELECT Mash, Hours, ID FROM quotes WHERE Mash > $tomorrowsDateMash";	
	$result = mysql_query ($sql);
	
	
	while ($row = mysql_fetch_array ($result) ){	// Look at every prior appointment
		
		$mash = $row{'Mash'};
		$hours = $row{'Hours'};			
		$ID = $row{'ID'};
		
		$counter++;
		
	}
	
}


function verifyAppontment3Day() {	


	$months = array('' , 'January' , 'February' , 'March', 'April', 'May'  ,'June' , 'July', 'August',  'September', 'October', 'November', 'December');
	
	$debug = 0;
	#	$_SESSION{'lastQuoteNumber'}
	#	$_SESSION{'lastQuoteMash'}						
	#	$_SESSION{'lastQuoteHRS'}
	
	
	
	
	
	#Todays (MASH)
	
	
	$day = date ("d"); 
	
	$dayPlusOne = $day +1;
	
	
	
	if (!$_SESSION{'3dayDateStart'} ){
		
		
		// Set the date for starting to the date of the appointment desireds
		$_SESSION{'3dayDateStart'} = substr ($_SESSION{'lastQuoteMash'} , 0 , 8);
		
		
		
	}
	
	
	/// START TO EVALUATE THE DATE TO START ON
	if (1){		
		
		# the values for $calcedDate are inserted as follows 
		# $dataset = array ($selection{'year'} , $selection{'month'} , $selection{'day'});
		$calcedDate = calcCalendar();
		
		
		$yearOne				= $calcedDate[0];
		$monthOne				= $calcedDate[1];
		$dayPlusOne				= $calcedDate[2];		
		$yearTwo				= $calcedDate[3];
		$monthTwo				= $calcedDate[4];
		$dayPlusTwo				= $calcedDate[5];			
		$yearThree				= $calcedDate[6];
		$monthThree				= $calcedDate[7];
		$dayPlusThree			= $calcedDate[8];
		
		
		
		#echo "Data Dump = " . print_r ($calcedDate);
		#Day format
		if (strlen($dayPlusOne) < 2){
			
			$dayPlusOne = "0" . $dayPlusOne;
		}
		if (strlen($dayPlusTwo)  < 2){
			
			$dayPlusTwo = "0" . $dayPlusTwo;
		}
		if (strlen($dayPlusThree)  < 2){
			
			$dayPlusThree = "0" . $dayPlusThree;
		}
		#monthFormat
		if (strlen($monthOne) < 2){
			
			$monthOne = "0" . $monthOne;
		}
		if (strlen($monthTwo) < 2){
			
			$monthTwo = "0" . $monthTwo;
		}
		if (strlen($monthThree) < 2){
			
			$monthThree = "0" . $monthThree;
		}
	}
	$startDate = $_SESSION{'3dayDateStart'};
	
	###################		SET THE CUSTOM START YEAR MONTH AND Day$dayPlusOne				= $calcedDate[0];
	#
	#
	#		$dayPlusOne
	#		$yearOne	
	#		$monthOne	
	#		$dayPlusTwo	
	#		$yearTwo	
	#		$monthTwo	
	#		$dayPlusThree
	#		$yearThree	
	#		$monthThree
	#
	#
	#This handles Different days , soon it will handle different months and year
	$tomorrowDateMash  =  $yearOne . $monthOne . $dayPlusOne . "0000";
	$secondDateMash  =  $yearTwo . $monthTwo . $dayPlusTwo . "0000";
	$thirdDateMash  =  $yearThree . $monthThree . $dayPlusThree . "0000";
			
	$threeDayMash = array ($tomorrowDateMash , $secondDateMash , $thirdDateMash);  // Iterates each day after calculating the calendar	
	
	$windows =  array  ("0700" , "1000","1300","1600","1900");		// Sets 3 hour windows to check for on each given day
	
	?>
	<form action="../../quote.php" method="POST">
		<div style="position:relative;height:350;justify-content: center;display: flex;">
			<table height="100%" align="middle" style="position:relative;right:10px;">
				<td height="100%" width="auto" valign="middle" style="position:relative;float:left;font-size:20;top:25px;"><center><a href="../../minus3day.php" onclick="return pastDays();"><div style="height:100%;width:100%;font-size:30"><span style="font-size:50;color:#B2B2B2;position:relative;right:20px"> < </span></div></a></center></td>
				<td>
	<?
		
		foreach ($threeDayMash as $dayMash){
			
			
			#Start Table for Days
			$day = substr ($dayMash , 0 , 8);
			#echo "<br />Day mash = " . $dayMash;
			$dayFormatted = substr($day  , 4 ,2 ) . "/" . substr($day  , 6 ,2 ) . "/" . substr($day  , 0 , 4 );
			

			if ($dayMash == $tomorrowDateMash){				
				
				echo '<table width="150px" style="float:left;position:relative;text-align:center;" cellspacing="0">
				';
				echo '	<td width="100%" height="50px" ><span style="font-size:15;font-weight:bold;text-align:center;">' . $dayFormatted  . '</span></td><tr/>
				';
				
			}elseif($dayMash == $secondDateMash){			
			
				echo '<table width="150px" style="float:left;position:relative;text-align:center;left:10px;"  cellspacing="0">
				';
				#echo '<table style="float:left;position:relative;left:33%">';
				echo '	<td width="100%" height="50px"><span style="font-size:15;font-weight:bold;text-align:center">' . $dayFormatted  . '</span></td><tr/>
				';
				
			}elseif($dayMash == $thirdDateMash){			
			
				echo '<table width="150px" style="float:left;position:relative;text-align:center;left:20px;"  cellspacing="0">
				';
				#echo '<table style="float:left;position:relative;left:33%">';
				echo '	<td width="100%" height="50px"><span style="font-size:15;font-weight:bold;text-align:center">' . $dayFormatted  . '</span></td><tr/>
				';
				
			}
			
			#Connect to sql to check for appointments on that day
			
			connectSQL();		
			#echo "Day = $day";	
			#0000 indicates The time of day 			
			$sql = "SELECT Mash, Hours, ID FROM quotes WHERE Date = '$day'";
			
			#echo "<br/>SQL = $sql";
			#201509170000    versus
			#201509171200
			$counter = 0;	
			$result = mysql_query ($sql);
			
			$counterWindow = 0;
			foreach ($windows as $time ){
				
				
				$windowOpenBool = 1;
				//Sets the window that we want to see availability of 
				$appointmentWindowTime = $day . $time; 
				$appointmentWindowEnds = $day . ($time + 300);			
				
				if (mysql_num_rows($result)==0) {
					
					#	echo "NUM ROWS is ZERO";
					
				}else{			
					mysql_data_seek($result, 0);
					while ($row = mysql_fetch_array ($result) ){	// Look at every prior appointment
					
						$mash = $row{'Mash'};
						$hours = $row{'Hours'};
						$ID = $row{'ID'};

						#echo "<br/>RAW DATA 2: Mash : $mash , Hours : $hours , ID : $ID";
						
						//Sets the variables of data from the SQL database
						
						$priorApptMash 		= $mash;				 
						$priorApptStartDate = substr($mash, 0 , 8);				
						$priorApptStartTime = substr($mash, 8 , 4);
						$priorApptmashRange = $priorApptStartDate . ($priorApptStartTime + 100 * $hours);
						
						
						#DEBUG THIS 
						if ($_SESSION{'adminDebug'} && $debug){
						
							echo "<br/>MATH : 
								This Window : ($appointmentWindowTime - $appointmentWindowEnds )<br/>
								Prior Apt   : ($priorApptMash - $priorApptmashRange)<br/>";
						}
						
						if (($appointmentWindowTime >= $priorApptMash  && $appointmentWindowTime <= ($priorApptmashRange -1)) ||  (($appointmentWindowEnds) >= $priorApptMash  && ($appointmentWindowEnds) <= $priorApptmashRange)){
						
							$windowOpenBool = 0;
							if ($_SESSION{'adminDebug'} && $debug){
								#echo "<br/>Unavailable <br/>Prior appointment : StartTime = $priorApptMash  , End time : $priorApptmashRange <br />";
								if ($_SESSION{'adminDebug'} && $debug){
									echo "<p style=\"border:1px solid red\">Unavailable <p style=\"border:1px solid red\">Window Opening /Close: <br />
										Date : $day <br/>
										Time : $appointmentWindowTime <br/>
										Ends : " . ( $appointmentWindowEnds -1) . "<br/></p>
										<p style=\"border:1px solid red\">Prior Appointment: <br />
										Date : $day <br/>
										Time : $priorApptMash <br/>
										Ends : $priorApptmashRange <br/></p></p>						
									";
								}

							}				
						}else{
							if ($_SESSION{'adminDebug'} && $debug){
								echo "<p style=\"border:1px solid black\">Available<p style=\"border:1px solid black\">Window Opening /Close: <br />
										Date : $day <br/>
										Time : $appointmentWindowTime <br/>
										Ends : $appointmentWindowEnds <br/></p>
										<p style=\"border:1px solid black\">Prior Appointment: <br />
										Date : $day <br/>
										Time : $priorApptMash <br/>
										Ends : $priorApptmashRange <br/></p></p>						
									";
							}
							
						}
					}
					
					
					
					$counter++;
					
				}
				
				preg_replace( "/:/" , "" , $time);
				if ($time < 1200){
					$suffix = " AM";
				}else{
					
					$time = substr($time , 0 , 2) - 12;
					$suffix = " PM";
					
				}		
				
				$timeOfDay = substr ($time , 0 , 2) *1 . $suffix;
				
				if ($windowOpenBool){
					
						if (!$counterWindow) {
							
							$class = "borderTop";
							$id = "availableAppt";
							$style = "border:solid green 1px;overflow:hidden;margin:0;";							//
							//		$day   			included in loop
							//		$time 			included in loop				
							$counterWindow++;						
							
						}elseif ($counterWindow > 3){
							
							$class = "borderBottom";
							$id = "availableAppt";
							$style = "border:solid green 1px;border-top:0px;overflow:hidden;margin:0;";			//
							//		$day   			included in loop
							//		$time 			included in loop				
							$counterWindow = 0;	
								
							

						}else{
							$class = "";
							$id = "availableAppt";
							$style = "border:solid green 1px;border-top:0px;overflow:hidden;margin:0;";			//
							$counterWindow++;
							
						}
						
						$dayAndTime = $day . $time;	
						
						echo '<td id="' . $id . '" class="' . $class . '" width="100%" height="50px" style="' . $style .  '">';
						################################										
						
						
						
						
						?>
						
								
						<button class="buttonSaveDayTime" value="<? echo $appointmentWindowTime ?>" name="dayAndTimeRevised" type="submit">
							<div style="height:100%;width:100%;border:0;margin:0;">
								<span style="font-size:15;font-weight:bold;text-align:center"><br/><? echo $timeOfDay  ?></span>
							</div>
						</button>
					</td><tr/>
							
							
						<?	
						
					}else{
						if (!$counterWindow) {
							echo '	<td width="100%" class="borderTop" height="50px" style="border:solid grey 1px;"><span style="color:grey;background-color:white;font-size:15;font-weight:bold;text-align:center"> Unavailable</span></td><tr/>
							';
							$counterWindow++;
						}elseif($counterWindow > 3){
							echo '	<td width="100%" class="borderBottom"  height="50px" style="border:solid grey 1px;border-top:0px;"><span style="color:grey;background-color:white;font-size:15;font-weight:bold;text-align:center"> Unavailable</span></td><tr/>
							';					
							$counterWindow++;
							
							
						}else{
							echo '	<td width="100%" height="50px" style="border:solid grey 1px;border-top:0px;"><span style="color:grey;background-color:white;font-size:15;font-weight:bold;text-align:center;"> Unavailable</span></td><tr/>
							';					
							
							$counterWindow++;
							
						}
					}
			
				
			}
			echo "</table>";
			
			
		}
		
		?>			
			</td>
			<td height="100%" width="auto" valign="middle" style="position:relative;left:20px;float:left;font-size:20;top:25px;"><center><a href="../../plus3day.php" onclick="return futureDays();"><div style="height:100%;width:100%;font-size:30"><span style="font-size:50;color:#B2B2B2;position:relative;left:20px"> > </span></div></a></center></td>
			</table>
		</div>
	</form>
	
	
	<?
	
	
}



function calcCalendar(){
	
	$monthsSpelled = array('' , 'January' , 'February' , 'March', 'April', 'May'  ,'June' , 'July', 'August',  'September', 'October', 'November', 'December');
	
	$day = date ("d") + 1; 		
	if ($day < 10 ){
		
		$tomorrow = "0" . $day;
	}	
	

	#############
	#
	#		VARS USED 
	/*
	
			$_SESSION{'3dayDateStart'}
			
	
	*/
	 
	$selection = array();
	
	if ($_SESSION{'3dayDateStart'}){
		
		#PRELIMINARY VARS
		$debugMSG .="<br/>Date ORIGIN : " . $_SESSION{'3dayDateStart'} . "<br/>";
		
		$selection{'year'} 			= substr ($_SESSION{'3dayDateStart'} , 0 , 4);
		$selection{'month'} 		= substr ($_SESSION{'3dayDateStart'} , 4 , 2);	
		$selection{'day'}			= substr ($_SESSION{'3dayDateStart'} , 6 , 2);
		
		
		$selection{'monthName'} = monthNameFromNumber ($selection{'month'});
		$debugMSG .="<br/>SET MONTH NAME 1st Section ," . $selection{'monthName'}; 
		
		#$selection{'monthName'} 	= $monthsSpelled{($selection{'month'} *1)};
		
		##################################################################################################
		
		$selection{'day'} = (substr ($_SESSION{'3dayDateStart'} , 6 , 2) + $_SESSION{'dayOfMonthModify'}); 
		$_SESSION{'dayOfMonthModify'} = 0;
		$max = monthRestrictionsByYear($selection{'month'} , $selection{'year'});	
		$debugMSG .="<br/>MAX = $max";
		
		if ($selection{'day'} > $max ){
			$selection{'day'} = $selection{'day'} - $max;
			if ($selection{'month'} < 12){
				$selection{'month'}++;
				
			}else{
				$selection{'month'} = "01";
				$selection{'year'}++;
				
			}
			
			
		}
		if ($selection{'day'} < 1){
			
			
			
			if ($selection{'month'} == 1){
				
				$selection{'month'} = "12";
				$selection{'year'}--;
				
			}else{
				$selection{'month'}--;
				
			}
			$max = monthRestrictionsByYear($selection{'month'} , $selection{'year'});	
			
			$selection{'day'} = $max + $selection{'day'};
			
			
		}
		#THIS BELONGS IN THIS SECTION ONLY BECAUSE IT IS THE FIRST DATE THAT IS CALCULATED (FORMAT THIS)
		if (strlen($selection{'day'}) < 2){
			
			$selection{'day'} = "0" . $selection{'day'};
		}
		if (strlen($selection{'month'}) < 2){
			
			$selection{'month'} = "0" . $selection{'month'};
		}
		$_SESSION{'3dayDateStart'} = $selection{'year'} . $selection{'month'} . $selection{'day'};
		
		
	}else{
		
		#$_SESSION{'3dayDateStart'}
		$selection{'year'} 			= substr ($_SESSION{'3dayDateStart'} , 0 , 4);
		$selection{'month'} 		= substr ($_SESSION{'3dayDateStart'} , 4 , 2);	
		$selection{'day'}			= substr ($_SESSION{'3dayDateStart'} , 6 , 2);

		$selection{'monthName'} 	= monthNameFromNumber ($selection{'month'});
		$debugMSG .="<br/>SET MONTH NAME 2nd Section ," . $selection{'monthName'}; 
	}
	
	
	
	#Day of month start gets modified in the other files	
	$debugMSG .="<br/>REQUIRED DATA =  <br/>";
	$debugMSG .="<br/>Month = " . $selection{'month'} ;
	$debugMSG .="<br/>Year = " . $selection{'year'} ;
	$debugMSG .="<br/>Month Name = " . $selection{'monthName'};
	$debugMSG .="<br/>Day Start = " . $selection{'day'}  . "<br /><br />";
	$debugMSG .="<br/>Day Modify Amount = " . $_SESSION{'dayOfMonthModify'}  . "<br /><br />";
			
	
	#	Create an array for storing completed calendar dates
	$dataset = array();		
	##########################
	#	MAX is the calculated max number of days for the current month
	$max = monthRestrictionsByYear($selection{'month'}, $selection{'year'});	
	#Checking for strlen is required because math will be done and the date will turn out funky otherwise
	if (strlen($selection{'day'}) < 2){
		
		$selection{'day'} = "0" . $selection{'day'};
	}
	if (strlen($selection{'month'}) < 2){
		
		$selection{'month'} = "0" . $selection{'month'};
	}
	#
	$seletionDate = $selection{'year'} .  $selection{'month'} . $selection{'day'};
	
	$selectionDateMaxCompare = $selection{'year'} .  $selection{'month'} . $max;
	$selectionDateMinCompare = $selection{'year'} .  $selection{'month'} . "01";
	$debugMSG .="<br/>Selection Date :   $seletionDate ,  Selection Compare to max :  $selectionDateMaxCompare , Selection Compare to min :  $selectionDateMinCompare <br/>";	
	
	if ( $seletionDate > $selectionDateMaxCompare ||  $seletionDate < $selectionDateMinCompare){		
		
		$debugMSG .="<br/>Inside First";
		#	$debugMSG .="<br/><br/>(1st) Modify month with data " . print_r($selection) . " Because max : " . $max . " && selected day" .  $selection{'day'}; 
		if ($selection{'day'} > $max){
			
			if ($selection{'month'} > 12){
				$selection{'month'} = "01";
				$selection{'year'}++;
			}else{
				$selection{'month'}++;
				
			}
			$selection{'day'} = $selection{'day'} - $max;			
			
			#reset $_SESSION
			
			$selection{'monthName'} 			= monthNameFromNumber ($selection{'month'});
			
		}
		if ($selection{'day'} < 1){
			if ($selection{'month'} < 2){
				$selection{'month'} = "12";
				$selection{'year'}--;
				
			}else{
				$selection{'month'}--;			
			}
			$debugMSG .="<br>Set new Month maximum day restrictions : ";				
			$selection{'monthName'} 			= monthNameFromNumber ($selection{'month'});
			
			
			
			$selection{'day'} =  $max + ($selection{'day'});
			
		}
		
		#	$debugMSG .="<br/>(1st) Modify to " . print_r( $selection );
		
		$dataset = array ($selection{'year'} , $selection{'month'} , $selection{'day'});
		
	} else{
		#	$debugMSG .="<br/><br/>(1st) Set Dataset " . print_r($selection);
		
		$dataset = array ($selection{'year'} , $selection{'month'} , $selection{'day'});
	}
	#############################################################   		DO MATH WITH SELECTION DATE 			#############################################################   		
	
	
	#Add to day and turn it back into a date and also reset the $max
	$selection{'day'}++;
	if (strlen($selection{'day'}) < 2){
		
		$selection{'day'} = "0" . $selection{'day'};
	}
	if (strlen($selection{'month'}) < 2){
		
		$selection{'month'} = "0" . $selection{'month'};
	}
	
	$seletionDate = $selection{'year'} .  $selection{'month'} . $selection{'day'};
	$max = monthRestrictionsByYear($selection{'month'}, $selection{'year'});
	$selectionDateMaxCompare = $selection{'year'} .  $selection{'month'} . $max;
	$selectionDateMinCompare = $selection{'year'} .  $selection{'month'} . "01";
	$debugMSG .="<br/>Selection Date :   $seletionDate ,  Selection Compare to max :  $selectionDateMaxCompare , Selection Compare to min :  $selectionDateMinCompare <br/>";	
	
	#########################################################
	#	Now use array_push to save data to dataset
	#########################################################	
	
	
	if ( $seletionDate > $selectionDateMaxCompare ||  $seletionDate < $selectionDateMinCompare){
		
		$debugMSG .="<br/>Inside Second";
		#	$debugMSG .="<br/><br/>(2nd) Modify month with data " . print_r($selection); 
		if ($selection{'day'} > $max){
			
			if ($selection{'month'} > 12){
				$selection{'month'} = "01";
				$selection{'year'}++;
			}else{
				$selection{'month'}++;
				
			}
			$selection{'day'} = $selection{'day'} - $max;
			
			$selection{'monthName'} 			= monthNameFromNumber ($selection{'month'});
			
		
		}
		if ($selection{'day'} < 1){
			if ($selection{'month'} < 2){
				$selection{'month'} = "12";
				$selection{'year'}--;
			}else{
				$selection{'month'}--;
				
			}
			$debugMSG .="<br>Set new Month maximum day restrictions : ";			
			
			$selection{'monthName'} 			= monthNameFromNumber ($selection{'month'});
			
			
			
			
			$debugMSG .="<br>New Max = $max";
			$selection{'day'} =  $max + ($selection{'day'});
			
		}
		
		#	$debugMSG .="<br/>(2nd) Modify to " . print_r($selection);
		
		array_push ($dataset , $selection{'year'} , $selection{'month'} , $selection{'day'});
		
	} else{
		#	$debugMSG .="<br/><br/>(2nd) Set Dataset " . print_r($selection);
		
		array_push ($dataset , $selection{'year'} , $selection{'month'} , $selection{'day'});
	}
#############################################################   		DO MATH WITH SELECTION DATE 			#############################################################   		
	
	
	#Add to day and turn it back into a date and also reset the $max
	$selection{'day'}++;
	if (strlen($selection{'day'}) < 2){
		
		$selection{'day'} = "0" . $selection{'day'};
	}
	if (strlen($selection{'month'}) < 2){
		
		$selection{'month'} = "0" . $selection{'month'};
	}
	$seletionDate = $selection{'year'} .  $selection{'month'} . $selection{'day'};
	$max = monthRestrictionsByYear($selection{'month'}, $selection{'year'});
	
	
	$selectionDateMaxCompare = $selection{'year'} .  $selection{'month'} . $max;
	$selectionDateMinCompare = $selection{'year'} .  $selection{'month'} . "01";
	$debugMSG .="<br/>Selection Date :   $seletionDate ,  Selection Compare to max :  $selectionDateMaxCompare <br/>";
	#########################################################
	#	Now use array_push to save data to dataset
	#########################################################	
	#USE DATE INSTEAD OF DAY
	if ( $seletionDate > $selectionDateMaxCompare ||  $seletionDate < $selectionDateMinCompare){
		$debugMSG .="<br/>Inside Third";
		#$debugMSG .="<br/><br/>(3rd) Modify month with data " . print_r($selection); 
		if ($selection{'day'} > $max){
			
			if ($selection{'month'} > 12){
				$selection{'month'} = "01";
				$selection{'year'}++;
			}else{
				$selection{'month'}++;
				
			}
			$selection{'day'} = $selection{'day'} - $max;
			
			
			$selection{'monthName'} 			= monthNameFromNumber ($selection{'month'});
			
		
		}
		if ($selection{'day'} < 1){
			if ($selection{'month'} < 2){
				$selection{'month'} = "12";
				$selection{'year'}--;
			}else{
				$selection{'month'}--;
				
			}
			$debugMSG .="<br>Set new Month maximum day restrictions : ";
			
			$selection{'monthName'} 			= monthNameFromNumber ($selection{'month'});	
			
			
			$debugMSG .="<br>New Max = $max";
			$selection{'day'} =  $max + ($selection{'day'});
						
		}
		
		#	$debugMSG .="<br/>(3rd) Modify to " . print_r($selection);
		
		array_push ($dataset , $selection{'year'} , $selection{'month'} , $selection{'day'});
		
	} else{
		#	$debugMSG .="<br/><br/>(3rd) Set Dataset " . print_r($selection);
		
		array_push ($dataset , $selection{'year'} , $selection{'month'} , $selection{'day'});
	}	
	
	if ($debug && $_SESSION{'adminDebug'}){
		
		echo $debugMSG;
	}
	
	 
	return $dataset; 
	
}

function monthRestrictionsByYear($month , $year){
	
	
	$monthsSpelled = array('' , 'January' , 'February' , 'March', 'April', 'May'  ,'June' , 'July', 'August',  'September', 'October', 'November', 'December');
	
	$monthNumeric = $month * 1 ;
	$monthSpelledOut = $monthsSpelled{$monthNumeric};
	#	$year included
	
	#when made dynamic this becomes  $month = $_SESSION{'monthSelectedSpelled'};
	
	
	$dateRestrictions = array();
	$dateRestrictions{'January'} = 31;
	
	$dateYearDivide = $_SESSION{'year'}/4;
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
	
	$limit = $dateRestrictions{$monthSpelledOut};
	
	#echo "Limit = $limit <br>Month = $month<br>";
	
	
	return ($limit);

}

function monthNameFromNumber($monthNumeric){
	
	
	$monthsSpelled = array('' , 'January' , 'February' , 'March', 'April', 'May'  ,'June' , 'July', 'August',  'September', 'October', 'November', 'December');
	$i = 0;
	foreach ($monthsSpelled as $month){
		
		if ($i == $monthNumeric){
			
			return $month; 
			break;
			
		}
		$i++;
		
	}
	
	
	
}
?>

 