<?


	session_start();

	set_include_path(dirname(__FILE__) . '/../../public_html');


/*

	find id clicked on
 <script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>

  <script type="text/javascript">
  
  </script>
  <div onclick="clicked(this);" id="test">test</div>

*/
  
	
	
	
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
		
		
	$total = 20 * $_SESSION{'lastQuoteHRS'};
		
	$_SESSION{'hoursWork'} =  $_SESSION{'lastQuoteHRS'};
	
?>

<div id="main">

	
	<?
	
		#echo "Data : " . print_r($_POST);
		
		#$bedrooms = $_POST{'bedrooms'};
		#$bathrooms = $_POST{'bathrooms'};
		$hours = $_SESSION{'lastQuoteHRS'};
		$startTime = $_SESSION{'lastQuoteSTART'};
		#$email = $_POST{'email'};
		
		
		
		if ($startTime){
			
			$startTime = preg_replace( '/:/' , '' , $startTime  );
		}
		
		
		$firstTwo = substr( $startTime , 0 , 2 );
		$nextTwo =  substr( $startTime , 2 , 2 );
		
		if ($startTime < 1200){
			$startTimeFormatted =  $firstTwo . ":" . $nextTwo . " AM";
		}else{
			$startTimeFormatted =  $firstTwo . ":" . $nextTwo . " PM";
			
		}
		$_SESSION{'dateTimeAppointment'} = $_SESSION{'dateWorkRequest'} . " @ ". $startTimeFormatted;
		
	?>

	<div id="checkoutContent">
		<center>
			<br />		
			
			
			<p><h2>Complete your booking</h2></p>		

			
			<?
			
			#echo "<br />Conflicting appointment  = " . $_SESSION{'conflictingSchedule'} . "<br/>";
			
			if ($_SESSION{'conflictingSchedule'}){
				?>
				<p class="text">Please choose a different time <br/>Due to high demand, we don't have availability at that time. Please choose a different time below. </p>
				<?
			}else{
				?>
				<p class="text">Great! We have availability at this time. A few more details and we can complete your booking.</p>
				<?
			}
			
			?>
			
			<br />				<hr>				<br />
		</center>
		
		
			
			<?
				
			if ($_SESSION{'conflictingSchedule'}){
				
				verifyAppontment3Day();
				?>
				<br><br><br>
				<?
						
			}else{
				?>
				
				<p class="text" style="text-align:left"><b>How Often?</b></p>
				<br />				
				<form action="processCheckout.php" method="post" name="form">				
					<fieldset onclick="alertRadio()">					  
					  <div class="fieldgroup">
						  <label for="once">
							<input type="radio" value="1" name="frequency" id="once"> <span>Once</span>
						  </label>
					  </div>
					  <div class="fieldgroup">
						  <label for="weekly">
							<input type="radio" value="2" name="frequency" id="weekly"> <span>Every Week</span>
						  </label>
					  </div>
						<div class="fieldgroup">
					  <label for="twoWeeks">
						<input type="radio" value="3" name="frequency" id="twoWeeks" checked> <span>Every 2 Weeks</span>
					  </label>
						</div>
						<div class="fieldgroup">
						  <label for="fourWeeks">
							<input type="radio" value="4"  name="frequency" id="fourWeeks"><span>Every 4 Weeks</span>
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
								<td><input required  class="inputPadding"  type="text" name="city" size="30" /></td><td width="20"></td><td><input   required class="inputPadding" type="text" name="state" size="20" /></td>
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
					<center><input id="sub" type="submit" name="completeOrder" value="Complete Booking"/> </center>
					</p>
				</form>	
			
			<?
			
			}
				
			?>
	</div>
	
	<?
	
	
	?>
<div id="checkoutSidebar">

	<table width="100%" cellspacing="15">
	<colgroup>
		<cols span="1" border="2"> 
		<cols style="border:2px;Background-color:red" >
	</colgroup>
	<tr >
		<td width="30px" ><p class="text" style="padding-left:10px"> <img src="/home/dirtydeeds91/public_html/images/home.png" alt="home cleaning" style="width:30px;height:30px;" /></p></td><td valign="middle">  <span class="text"> <b>Home Cleaning</b></span></td>
	</tr>
	<tr>
		<td width="30px" ><p class="text" style="padding-left:10px"><img src="/home/dirtydeeds91/public_html/images/calendar.png" alt="dayAndTime" style="width:30px;height:30px;" /></p></td><td valign="middle"><span class="text"><b><? echo $_SESSION{'dateWorkRequest'} . " @ ". $startTimeFormatted;?></b></span></td>
	</tr>
	<tr>
		<td width="30px" ><p class="text" style="padding-left:10px"><img src="/home/dirtydeeds91/public_html/images/clock.png" alt="clock" style="width:30px;height:30px;" /></p></td><td valign="middle"><span class="text"><b><span id="hoursQuote"><? echo $_SESSION{'lastQuoteHRS'} ?></span> Hours</b></span></td>
	</tr>	
	<tr>
		<td width="30px" ><p class="text" style="padding-left:10px"><img src="/home/dirtydeeds91/public_html/images/cycle.png" alt="frequency" style="width:30px;height:30px;" /></p></td><td valign="middle"><span id="changeThis" class="text" style="font-weight:bold">Every 2 Weeks</span></td>
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
<center>




</center>
 <br />
</div> 

<?

	


	htmlEnd();

	if (0)
	{
			// should clear this soon
		$_SESSION{'lastQuoteMash'} = NULL;					
		$_SESSION{'lastQuoteSTART'} = NULL;
		$_SESSION{'lastQuoteHRS'} = NULL;
		
	}



/*

<p hidden>
	
		This php code easily transers to javascript
		$phpArray = array(
				  0 => "Mon", 
				  1 => "Tue", 
				  2 => "Wed", 
				  3 => "Thu",
				  4 => "Fri", 
				  5 => "Sat",
				  6 => "Sun",

			)

		<h2><p>using php's json_encode()* function</p></h2>		<br />
		<br />		Other Stuff:
		<?
			if ($_POST){
				
				
				$bathrooms = $_POST{'bathroom'};
				$bedrooms = $_POST{'bedroom'};
				$hoursCleaning = $_POST{'hours'};
				$startTime = $_POST{'request_start_time'};
				
				
				
				#var value3 = Math.round (1.5 + (value1 * 0.5) + (value2 * 0.3));
					
				print_r ($_POST);
				
			}
			
			

		?>


	</p>
	
	
	
	#Javascript
	
	$phpArray = array(
	
          0 => "Mon", 
          1 => "Tue", 
          2 => "Wed", 
          3 => "Thu",
          4 => "Fri", 
          5 => "Sat",
          6 => "Sun",
		  7 => "Mon",

    );
	

<script type="text/javascript">

    var jArray= <?php echo json_encode($phpArray ); ?>;

    for(var i=0;i<7;i++){
        alert(jArray[i]);
    }
	
</script>	
	
	
*/
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


	
	#	$_SESSION{'lastQuoteNumber'}
	#	$_SESSION{'lastQuoteMash'}						
	#	$_SESSION{'lastQuoteHRS'}
	
	global $currentQuoteShown;
	
	#Todays (MASH)
	$day = date ("d"); 
	
	$dayPlusOne = $day +1;
	
	if ($dayPlusOne < 10 ){
		
		$dayPlusOne = "0" . $dayPlusOne;
	}
	
	$dayPlusTwo = $day +2;
	if ($dayPlusTwo < 10 ){
		
		$dayPlusTwo = "0" . $dayPlusTwo;
	}
	
	$dayPlusThree = $day +3;
	if ($dayPlusThree < 10 ){
		
		$dayPlusThree = "0" . $dayPlusThree;
	}
	
	#echo "Day = $day";
	#0000 indicates The time of day 
	
	$tomorrowDateMash  =  date ("Ym") . $dayPlusOne. "0000";
	$secondDateMash  =  date ("Ym") . $dayPlusTwo. "0000";
	$thirdDateMash  =  date ("Ym") . $dayPlusThree. "0000";
	
	$threeDayMash = array ($tomorrowDateMash , $secondDateMash , $thirdDateMash);  // Iterates each day
	
	
	// Now for each day check the availability for every 3 hour window
	$windows =  array  ("0700" , "1000","1300","1600","1900");
	
	
	?>			
	<div style="position:relative;float:center;width:auto;height:400;left:50px">
		<table height="100%" align="middle">
			<td height="100%" width="10px" valign="middle" style="position:relative;float:left;font-size:20;top:25px;"><center><a href="" ><div style="height:100%;width:100%;font-size:30"> < </div></a></center></td>
			<td>
	<?
	
	foreach ($threeDayMash as $dayMash){
		
		
		#Start Table for Days
		$day = substr ($dayMash , 0 , 8);
		#echo "<br />Day mash = " . $dayMash;
		$dayFormatted = substr($day  , 4 ,2 ) . "/" . substr($day  , 6 ,2 ) . "/" . substr($day  , 0 , 4 );
		

		if ($dayMash == $tomorrowDateMash){				
			
			echo '<table width="150px" style="float:left;position:relative;text-align:center;" >
			';
			echo '	<td width="100%" height="50px" ><span style="font-size:15;font-weight:bold;text-align:center">' . $dayFormatted  . '</span></td><tr/>
			';
			
		}elseif($dayMash == $secondDateMash){			
		
			echo '<table width="150px" style="float:left;position:relative;text-align:center;left:10px" >
			';
			#echo '<table style="float:left;position:relative;left:33%">';
			echo '	<td width="100%" height="50px"><span style="font-size:15;font-weight:bold;text-align:center">' . $dayFormatted  . '</span></td><tr/>
			';
			
		}elseif($dayMash == $thirdDateMash){			
		
			echo '<table width="150px" style="float:left;position:relative;text-align:center;left:20px" >
			';
			#echo '<table style="float:left;position:relative;left:33%">';
			echo '	<td width="100%" height="50px"><span style="font-size:15;font-weight:bold;text-align:center">' . $dayFormatted  . '</span></td><tr/>
			';
			
		}
		
		
		$dayStore = $dayMash;	
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
		
		#CHECK FOR RESULT
		if (!$result){
			
			echo "Nothing to show for  : $dayMash ";
			
		}	
		
		foreach ($windows as $time ){
			
			
			$windowOpenBool = 1;
			//Sets the window that we want to see availabiliy of 
			$appointmentWindowTime = $day . $time; 
			$appointmentWindowEnds = $day . ($time + 300);			
			
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
				if ($_SESSION{'adminDebug'}){
				
					echo "<br/>MATH : 
						This Window : ($appointmentWindowTime - $appointmentWindowEnds )<br/>
						Prior Apt   : ($priorApptMash - $priorApptmashRange)<br/>";
				}
				if (($appointmentWindowTime > $priorApptMash  && $appointmentWindowTime < $priorApptmashRange) ||  ($appointmentWindowEnds > $priorApptMash  && $appointmentWindowEnds < $priorApptmashRange)){
				
					$windowOpenBool = 0;
					if ($_SESSION{'adminDebug'}){
						#echo "<br/>Unavailable <br/>Prior appointment : StartTime = $priorApptMash  , End time : $priorApptmashRange <br />";
						if ($_SESSION{'adminDebug'}){
							echo "<p style=\"border:1px solid red\">Unavailable <p style=\"border:1px solid red\">Window Opening /Close: <br />
								Date : $day <br/>
								Time : $appointmentWindowTime <br/>
								Ends : $appointmentWindowEnds <br/></p>
								<p style=\"border:1px solid red\">Prior Appointment: <br />
								Date : $day <br/>
								Time : $priorApptMash <br/>
								Ends : $priorApptmashRange <br/></p></p>						
							";
						}

					}				
				}else{
					if ($_SESSION{'adminDebug'}){
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
				echo '	<td id="availableAppt"  width="100%" height="50px" style="border:solid green 1px;border-radius:5px;"><span style="font-size:15;font-weight:bold;text-align:center">' .  $timeOfDay . '</span></td><tr/>
				
				';
				
			}else{
				echo '	<td width="100%" height="50px" style="border:solid grey 1px;border-radius:5px;"><span style="color:grey;background-color:white;font-size:15;font-weight:bold;text-align:center"> Unavailable</span></td><tr/>
				';
				
			}
		
			
		}
		echo "</table>";
		
		
	}
	
	?>			
		</td>
		<td height="100%" width="10px" valign="middle" style="position:relative;left:20px;float:left;font-size:20;top:25px;"><center><a href="" ><div style="height:100%;width:100%;font-size:30"> > </div></a></center></td>
		</table>
	</div>
	
	
	<?
	
	
}


?>

 