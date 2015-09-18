<?
	include('main.php');
	
	
	connectSQL();
	
	$frequencyMap = array ('' , 'Once' , 'Every week', 'Every two weeks', 'Every four weeks');
	$paymentMap = array('', 'Cash/Check', 'Credit Card');
	
	$frequency = $frequencyMap[$_POST{'frequency'}];
	$address = $_POST{'address'};
	$apt = $_POST{'apartment'};
	$city = $_POST{'city'};
	$state = $_POST{'state'};
	$phone = $_POST{'phone'};
	
	$cabinet = $_POST{'cabinet'};
	$fridge = $_POST{'fridge'};
	$oven = $_POST{'oven'};
	$laundry = $_POST{'laundry'};
	$window = $_POST{'window'};
	
	$sumTotalHrsWork = $cabinet * 0.5 + $fridge * 0.5 + $oven * 0.5 + $laundry * 1 + $interiorWindows * 0.5 + $_SESSION{'hoursWork'};
	 
	$paymentType = $_POST{'paymentType'};
	$ccard = $_POST{'ccard'};
	$securityCode = $_POST{'securityCode'};
	$expiration = $_POST{'expiration'};
	
	$dateTimeApt = $_SESSION{'dateTimeAppointment'};
	
	$fullAddress = $address;
	 if ($apt){
		$fullAddress .= " " . $apt;
	 }
	$fullAddress .= ", " . $city;
	$fullAddress .= ", " . $state;	
	
	$paymentSpelled = $paymentMap [$paymentType];	
	
	
	$cabinet = $_POST{'cabinet'};
	$fridge = $_POST{'fridge'};
	$oven = $_POST{'oven'};
	$laundry = $_POST{'laundry'};
	$window = $_POST{'window'};
	
	if ($cabinet){
			$extras .= "Cabinet, ";		
	}
	if ($fridge){
		$extras .= "Fridge, ";		
		
	}
	if ($oven){
		$extras .= "Oven, ";		
		
	}
	if ($laundry){
		$extras .= "Laundry, ";		
		
	}
	if ($window){
		
		$extras .= "Window";		
	}
	
	
	$sql = "INSERT INTO appointment (Username , AppointmentTime , Location , Extras , JobLengthHrs, ContactPhone , PaymentType , Ccard , Exp , Cvc ) VALUES ('' , '$dateTimeApt' , '$fullAddress' , '$extras', '$sumTotalHrsWork' , '$phone',  '$paymentSpelled' ,  '$ccard' , '$expiration' , 'securityCode');";
	
	
	$result = mysql_query($sql);
	
	if ($result){$
		$success = 1;
		
	}
	
	
	
	
	
	?>

	<div id="main">
	
			<center><h1>SUCCESS!</h1>
				Your appointment has been scheduled for  <? echo $dateTimeApt ?>
			</center>
				
			<br /><br /><br />
		
	</div>

<!--


post info [frequency] => 3 [address] =>  [apartment] => [city] => Pasadena [state] => [phone] => 8053418427 [promo] => [cabinet] => 0 [fridge] => 0 [oven] => 0 [laundry] => 0 [window] => 0 [paymentType] => 1 [ccard] => [expiration] => [completeOrder] 
-->

	<?
	
	
	htmlEnd();
	
	

?>