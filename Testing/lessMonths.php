<?php

	$months = array('' , 'January' , 'February' , 'March', 'April', 'May'  ,'June' , 'July', 'August',  'September', 'October', 'November', 'December');
	
	
	
session_start();


	$monthCurrent = $_SESSION{'monthSelectedNumeric'};
	$monthSelected =  $monthCurrent - 1;
	
	if ($monthSelected < 1){	
		
		$monthSelected = 12;	
		$_SESSION{'yearSelected'}--;
		
	}

	$_SESSION{'monthSelectedNumeric'} =  $monthSelected;

	
	#TODO
	 $_SESSION{'monthSelectedSpelled'} = $months[$monthSelected];
	 # 	$_SESSION{'yearSelected'}

	#Create Limit for # of results

	

	echo "<script type=\"text/javascript\">   window.location.assign('scheduleAppointment.php');   </script>";



?>