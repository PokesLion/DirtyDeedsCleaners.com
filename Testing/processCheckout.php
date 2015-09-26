<?
	include('main.php');	
	connectSQL();
	
	if (isset($_POST)){
		
		$frequencyMap = array ('' , 'Once' , 'Every week', 'Every two weeks', 'Every four weeks');
		$paymentMap = array('', 'Cash/Check', 'Credit Card ');
		
		$login = $_SESSION{'login'};
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
		$fullAddress .= ", " . $state . ", " . $_SESSION{'CoreDATAZIP'};
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
		
		#			$_SESSION{'lastQuoteNumber'}				
		
		
		if ($_POST{'completeOrder'}){
			if ($_POST{'paymentType'} == 1){				
				
				#Skip check for payment
				if ($login && $dateTimeApt && $fullAddress && $sumTotalHrsWork && $phone && $paymentSpelled){				
					$sql = "INSERT INTO appointment (Username , AppointmentTime , Location , Extras , JobLengthHrs, ContactPhone , PaymentType ) VALUES ('$login' , '$dateTimeApt' , '$fullAddress' , '$extras', '$sumTotalHrsWork' , '$phone',  '$paymentSpelled');";								
					$result = mysql_query($sql);
					
				}else{
					
					echo "<br/>Data not provided ";
					echo "<br/>(Username , AppointmentTime , Location , Extras , JobLengthHrs, ContactPhone , PaymentType )";
					echo "<br/>$login && $dateTimeApt && $fullAddress && $extras && $sumTotalHrsWork && $phone && $paymentSpelled";
					
				}
				
						
			}elseif($_POST{'paymentType'} == 2){		
				
				#CHECK CC PAYMENT IF USING API			
				if ($login  && $dateTimeApt   &&  $fullAddress  &&  $sumTotalHrsWork  &&  $phone &&   $paymentSpelled  &&   $ccard  &&  $expiration  &&  $securityCode){
					$sql = "INSERT INTO appointment (Username , AppointmentTime , Location , Extras , JobLengthHrs, ContactPhone , PaymentType , Ccard , Exp , Cvc ) VALUES ('$login' , '$dateTimeApt' , '$fullAddress' , '$extras', '$sumTotalHrsWork' , '$phone',  '$paymentSpelled' ,  '$ccard' , '$expiration' , '$securityCode');";
					$result = mysql_query($sql);
					
				}else{
					
					echo "<br/>Data not provided ";
					echo "<br/>(Username , AppointmentTime , Location , Extras , JobLengthHrs, ContactPhone , PaymentType , Ccard , Exp , Cvc )";
					echo "<br/>($login , $dateTimeApt , $fullAddress , $extras, $sumTotalHrsWork , $phone,  $paymentSpelled ,  $ccard , $expiration , $securityCode)";
					
				}			
			}
		}			
	}
	
	urlAssign('bookings.php');
	
	htmlEnd();
	
	$_SESSION{'dateTimeAppointment'} = NULL;
	
	$_SESSION{'adminDebug'} = 0;
	

?>