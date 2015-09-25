<?


	session_start();
	
	#		$_SESSION{'3dayDateStart'} = substr ($_SESSION{'lastQuoteMash'} , 0 , 8);
	
	
	$day = date ("d"); 
	
	
	
	$dayPlusOne = $day +1;
	$tomorrowsDate = date ("Ym") . $dayPlusOne;
	
	
	if ($_SESSION{'3dayDateStart'} !=  $tomorrowsDate){
		
			$_SESSION{'dayOfMonthModify'} -=3;
	}
	
	
	
	
	
	
	
	#		$_SESSION{'monthSelectedNumeric'}		- 2 digit representation of the month to show
	#		$_SESSION{'monthSelectedSpelled'} 		= date('F');
	#		$_SESSION{'yearSelected'}				- 4 digit representation of the year to show
	#		$_SESSION{'dayOfMonthStart'} 			= $tomorrow;	

	$location = "quotes/" . $_SESSION{'lastQuoteNumber'} . "/Finalize.php";
	
	if ($_SESSION{'adminDebug'}){
		echo "<script type=\"text/javascript\">   window.location.assign('" .  $location  . "');   </script>";
	}else{
		echo "<script type=\"text/javascript\">   window.location.assign('" .  $location  . "');   </script>";		
	}
	
	
#################		FUNCTIONS
	
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