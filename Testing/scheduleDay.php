<?php

session_start();



$javascript = '	
	
	function updateSpinner1(obj)
{
    var contentObj1 = document.getElementById("numberBedroom");
	var contentObj2 = document.getElementById("numberBathroom");
	var hoursRecomneded = document.getElementById("hoursCleaingExpected");
	var hoursSelected = document.getElementById("hoursSelect");
	
	
	
    var value1 = parseInt(contentObj1.value);
	var value2 = parseInt(contentObj2.value);
	
	
	
    if(obj.id == "down1") {
        if (value1 > 0){
            value1--;
        }
        
        
    } else {
        if(value1 < 10){
			value1++;
		}
    }
	
	var value3 = Math.round (1.5 + (value1 * 0.5) + (value2 * 0.3));
	
		
    contentObj1.value = value1;
	hoursSelected.selectedIndex = value3 - 1 ;
	document.getElementById("hoursCleaingExpected").innerHTML = value3;
	

	
}
function updateSpinner2(obj)
{
	var contentObj1 = document.getElementById("numberBedroom");
    var contentObj2 = document.getElementById("numberBathroom");
	var hoursRecomneded = document.getElementById("hoursCleaingExpected");
	var hoursSelected = document.getElementById("hoursSelect");
	
	
	var value1 = parseInt(contentObj1.value);
    var value2 = parseInt(contentObj2.value);
	
	
    if(obj.id == "down2") {
         
         if (value2 > 0){
            value2--;
        }
    } else {
		if(value2 < 10){
			value2++;
		}
    }
	var value3 = Math.round (1.5 + (value1 * 0.5) + (value2 * 0.3));
	
	if (!value3){
		value3 = 0;
		
	}
	
    contentObj2.value = value2;	
	hoursSelected.selectedIndex = value3 - 1;
	document.getElementById("hoursCleaingExpected").innerHTML = value3;
	
	
}

function removeError (){
	
	document.getElementById(\'emailErr\').innerHTML = "";
	
	
}


';	
	
	require('main.php');
	
echo "<div id=\"main\"><center>";

	
	
	if ($_POST{'day'} || $_SESSION{'appointmentDate'}){
		
		
		if ($_POST{'day'}){
			
				
			$_SESSION{'appointmentDate'} = $_POST{'day'};
			
				
		}
		$appointmentDate = $_SESSION{'appointmentDate'};
		
		
		#	echo "stored = " . $_SESSION{'appointmentDate'}  ."<br>";		
		
	}else{
	
		#Set error message??
		urlAssign('scheduleAppointment.php');
		
	}
	
	#0 1 2 3 4
	#1 2 3 4 5
	
	$parseYr = substr($appointmentDate , 0 , 4);
	$parseMn = substr($appointmentDate , 4 , 2);	
	$parseDy = substr($appointmentDate , 6 , 2);
	
	
	
	$parseDate =  $parseMn . "/" . $parseDy . "/" . $parseYr;
	
	$_SESSION{'dateWorkRequest'} = $parseDate;
	
	
	
	
	#info needed : 
	if (0 ){
	
		#DEBUG
		$email 		= $_SESSION{'attemptedEmail'} ;	
		$email 		= $_SESSION{'username'} ;	
		$hours 		= $_POST{'hours'};	
		$zipCode 	= $_POST{'zipCode'};
		$startTime 	= $_POST{'request_start_time'};
		$username  	=  $_SESSION{'username'};
	
	
		echo "Email redirect = $email" . "<br />";
		echo "Username = $username" . "<br />";
		echo "hours = $hours" . "<br />";
		echo "zipCode = $zipCode" . "<br />";
		echo "startTime = $startTime" . "<br />";
		echo "username = $username" . "<br />";
	
	}
	
	#	at this point all we are only missing is the address and payment, Sufficient Data for storing
	
	
	
	
	
	if ($parseYr && $parseMn && $parseDy ){
	
	?>
		<center><br /><br /><br />
		<div id="checkout" class="round">
			<br />			
			<p class="hugBelowLine"><b>Cleaning price</b>
				<br />for service in Los Angeles
			</p>
			
			
			
	<!--		#############################				NOT MY CODE   -->

			 
			<form id="myForm" action="quote.php" method="post">
				<br /><center><input required name="zipCode" type="text" size="9" placeholder="Zip code"  class="checkoutInput" /></center>
				
						
				<p  class="hugBelowLine">Tell us about your place: </p>			
			
				<table id="incrementer" border="0" align="center"  class="hugBelowLine" style="margin-top:-10px; border-collapse: collapse;">
					<td><a id="down1" href="#" onclick="updateSpinner1(this);"><div id="buttonLeft">-</div></a></td>
					<td><div id="number"><center><input id="numberBedroom" name="bedrooms" value="2" type="text" size="2" required readonly />  bedrooms</center></div></td>
					<td><a id="up1" href="#"  onclick="updateSpinner1(this);"><div id="buttonRight">+</div></a></td>														
					<tr>
					<td style="line-height:1"></td>
					<tr>
						<td><a id="down2" href="#" onclick="updateSpinner2(this);"><div id="buttonLeft">-</div></a></td>
						<td><div id="number"><input id="numberBathroom"  name="bathrooms" value="2" type="text"  size="2" readonly /> bathrooms</div></td>
						<td><a id="up2" href="#"  onclick="updateSpinner2(this);"><div id="buttonRight">+</div></a></td>
					</tr>					
				</table>
				
				<p  class="hugBelowLine" >We recommend <b><span id="hoursCleaingExpected">3</span> hours</b></p>
				
					<select id= "hoursSelect" name="hours" class="checkoutInput hugBelowLine" >
						<option value="" >None</option>
						<option value="2.0" >2 hours</option>
						
						<option value="3.0" selected="selected">3 hours</option>
						
						<option value="4.0">4 hours</option>
						
						<option value="5.0">5 hours</option>
						
						<option value="6.0">6 hours</option>
						
						<option value="7.0">7 hours</option>
						
						<option value="8.0">8 hours</option>
						
						<option value="9.0">9 hours</option>
						
						<option value="10.0">10 hours</option>
					</select>
				</p>								
				<p class="hugBelowLine">What time to show up <br />on<b> 	<?php print $parseDate; ?><b> </p>
				<select  name="request_start_time" class="checkoutInput hugBelowLine" >
					<option value="07:00">7:00 AM</option>
					<option value="07:30">7:30 AM</option>
					<option value="08:00">8:00 AM</option>
					<option value="08:30">8:30 AM</option>
					<option value="09:00">9:00 AM</option>
					<option value="09:30">9:30 AM</option>
					<option value="10:00">10:00 AM</option>
					<option value="10:30">10:30 AM</option>
					<option value="11:00">11:00 AM</option>
					<option value="11:30">11:30 AM</option>
					<option value="12:00" selected="selected">12:00 PM</option>
					<option value="12:30">12:30 PM</option>
					<option value="13:00">1:00 PM</option>
					<option value="13:30">1:30 PM</option>
					<option value="14:00">2:00 PM</option>
					<option value="14:30">2:30 PM</option>
					<option value="15:00">3:00 PM</option>
					<option value="15:30">3:30 PM</option>
					<option value="16:00">4:00 PM</option>
					<option value="16:30">4:30 PM</option>
					<option value="17:00">5:00 PM</option>
					<option value="17:30">5:30 PM</option>
					<option value="18:00">6:00 PM</option>
					<option value="18:30">6:30 PM</option>
					<option value="19:00">7:00 PM</option>
					<option value="19:30">7:30 PM</option>
					<option value="20:00">8:00 PM</option>
					<option value="20:30">8:30 PM</option>
					<option value="21:00">9:00 PM</option>
				</select><br />
				<?	
				if (!$_SESSION{'loggedIn'}){
							?>  
							<p style="line-height:.5"></p>
							<span id="emailErr" class="error"></span>
							<input required name="email" type="email" class="checkoutInput hugBelowLine" size="30" placeholder="Email address" onclick="removeError();" />
							<?		
				}					
				?>				
				<br /><br /><br />	
				<input id="sub" value="Get a Quote" type="submit" />
			</form>
	 
		<span id="result"></span>
		<!--Include Jquery Library and enable same page SQL storing -->
		<script src="js/jquery-1.11.3.min.js" type="text/javascript"></script>
		<script src="my_script.js" type="text/javascript"></script>


		<br/>
		<br/>
		<span id="result"></span>
	</div>
	</center>
	
	
	
	<?php
	
	}
	
	?>
	</div>
	
	
	<?
	htmlEnd();
	
?>









