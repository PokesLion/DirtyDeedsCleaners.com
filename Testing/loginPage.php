<?php

	$currentPage = "loginPage";
	$sidebar = 0;
	

	require ('main.php');
	
	#DEBUG
	if ($_SESSION{'AppointmentRedirected'} && 0){	
		
		
		echo "attemptedEmail = " . $_SESSION{'attemptedEmail'} . "<br />"  ;
		echo "hours = " . $_SESSION{'hours'} . "<br />"  ;		
		echo "ZipCode = " . $_SESSION{'zipCode'} . "<br />"  ;		
		echo "startTime = " . $_SESSION{'startTime'} . "<br />"  ;		
		
		
	}
	#echo "Appointmetn RD = " . $_SESSION{'AppointmentRedirected'} . "<br />" ;
	
	if (!$_SESSION{'loggedIn'}){
		
		loginPOST();			#	Display login window
		
	}else{	
		
		alertUser ("You are already logged in.  Directing to homepage. Press \"OK\" to continue.");
		urlAssign("index.php");		
		
	}
	
	
	htmlEnd(); # 	Closes BODY and Opens/closes FOOTER
	
	
	
?>
