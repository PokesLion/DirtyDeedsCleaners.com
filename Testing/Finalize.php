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
		$_SESSION{'dateTimeAppointment'} = $_SESSION{'dateWorkRequest'} . " @ ". $startTimeFormatted
		
	?>

	<div id="checkoutContent">
		<center>
			<br />		
			
			
			<p><h2>Complete your booking</h2></p>		

			
			<?
			
			echo "<br />Conflicting appointment  = " . $_SESSION{'conflictingSchedule'} . "<br/>";
			
			if ($_SESSION{'conflictingSchedule'}){
				?>
				<p class="text">A few more details and we can complete your booking. </p>
				<?
			}else{
				?>
				<p class="text">Great! We have availability at this time. A few more details and we can complete your booking.</p>
				<?
			}
			
			
			
			?>
			
		</center>
		<br />
		<hr>
		<br />
		<p class="text" style="text-align:left"><b>How Often?</b></p>
		<br />
		
		<form action="processCheckout.php" method="post" name="form">
			<!--
			<button type="button" class="cleanButton" id="frequency1" ><div class="selectButton">Every Week</div></button>
			<button type="button" class="cleanButton" id="frequency2" value="2" ><div class="selectButton">Every 2 Weeks</div></button>
			<button type="button" class="cleanButton" id="frequency3" ><div class="selectButton">Every 4 Weeks</div></button>
			
			-->
			
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
		
			
			<?
				
			if ($_SESSION{'conflictingSchedule'}){

				?>
				<br /><br />
				<div id="sizeOverlay">
					<div id="coverUpTransparrently"></div>
				<?
			}
			?>
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
				</table>
				
				
				
				<br />
				
				
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
			
			
			<?
			if ($_SESSION{'conflictingSchedule'}){

				?>
					
				</div>
				<?
			}
			?>
		</form>	
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


?>

 