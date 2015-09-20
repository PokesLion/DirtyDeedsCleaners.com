<?php

	
	
	
	
	#TODO VERIFY THE DATA IS PROPER BEFORE SAVING!
	
	include ('functions.php');
	
	$finalizeFileName = "Finalize.php";

	
	
	session_start();
	$_SESSION{'conflictingSchedule'} = NULL;
	
	
	
	if ($_SESSION{'login'} == "admin@dirtydeedscleaners.com"){
		
		$debug = 0;
		#disallows page rerouting  (enables reading of subsequent echo)
		$_SESSION{'debug'} = $debug;
		#allow echo debugs
		$_SESSION{'adminDebug'} = 1;
		
	}else{
		
		$_SESSION{'debug'} = 0;
		
	}
	
	
	#THis stops redirects when set to 1
	#	$_SESSION{'debug'} = 1;
	
	$email 		= $_SESSION{'attemptedEmail'};
	$username  	= $_SESSION{'username'};
	$bedrooms   = $_POST{'bedrooms'};
	$bathrooms  = $_POST{'bathrooms'};	
	$hours 		= $_POST{'hours'};	
	$zipCode 	= $_POST{'zipCode'};
	$startTime 	= $_POST{'request_start_time'};
	$date		= $_SESSION{'dateWorkRequest'};
	
	
	
	if (!$_SESSION{'loggedIn'}){
			
			
			$_SESSION{'AppointmentRedirected'} 	= 1; 
			$_SESSION{'attemptedEmail'}			= $_POST{'email'};	
			$_SESSION{'zipCode'}				= $_POST{'zipCode'};
			$_SESSION{'hours'}					= $_POST{'hours'};
			$_SESSION{'startTime'}				= $_POST{'request_start_time'};
			$_SESSION{'bedrooms'}				= $_POST{'bedrooms'};
			$_SESSION{'bathrooms'}				= $_POST{'bathrooms'};
			
			$email = $_SESSION{'attemptedEmail'};
			
			#echo "<br/>Email = $email";
			
			$validEmail = 0;
			
			if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$validEmail = 1;
			}
			
			
			#	$_SESSION{'dateWorkRequest'}
			
			
			if  ($_SESSION{'zipCode'} && $_SESSION{'attemptedEmail'} && $validEmail){
			
				urlAssign ('loginPage.php');
				
			}else{	
				if (!$validEmail && $email){
					
					if (preg_match("/^[a-zA-Z0-9]+\@[a-zA-Z0-9]+/" , $email )){
						?>				
						<script type="text/javascript">							
							document.getElementById('emailErr').innerHTML = "The email address entered is not valid : <? echo $email ?> <br /><br />";
						</script>			
						<?
					}
				}
			}
			
			
			
	}else{
		
		
		if ($_SESSION{'AppointmentRedirected'} ){
						
			$zipCode 			= $_SESSION{'zipCode'};
			$hours 				= $_SESSION{'hours'};
			$startTime 			= $_SESSION{'startTime'};
			$bedrooms 			= $_SESSION{'bedrooms'};
			$bathrooms     		= $_SESSION{'bathrooms'};	
			$date 				= $_SESSION{'dateWorkRequest'};
			
			if (0){
				echo "Bedrooms = " . $bedrooms  . "<br/>";			
				echo "bathrooms = " . $bathrooms	. "<br />";
				echo "hours = " . $hours 	. "<br />";
				echo "zipCode = " . $zipCode 	. "<br />";
				echo "startTime = " . $startTime	. "<br />";	
				echo "date = $date<br/>";
			}
			
		}
		if ($zipCode && $hours && $startTime && $bedrooms && $bathrooms && $date){
			
			
			$date  = substr( $date , 6 ,4 ) . substr( $date , 0 ,2 ) .  substr( $date , 3 ,2 );		
			
			$startTimeEdit = preg_replace( "/[\:]/" , "" , $startTime );		
			
			$mash =  $date .  $startTimeEdit;
			
			#	echo "Mash = " . $mash;
			
			
			connectSQL();
			
			
			if( mysql_query ("INSERT INTO quotes (Username  , ZipCode  ,StartTime , Bedrooms , Bathrooms , Hours , Date , Mash ) VALUES ('$username', '$zipCode', '$startTime', '$bedrooms', '$bathrooms', '$hours' , '$date' , '$mash'); ")){
				
				
			  #echo "Successfully Inserted";
			}else{
			  #echo "Insertion Failed";
			}
			$success = 1;		
			
		}else{
			
			#			
			
			
			#DEBUG
			if (0){
				echo "Insufficient Data<br/>";
				echo "<br />Data = <br/>";
				echo "Bedrooms = " . $bedrooms  . "<br/>";			
				echo "bathrooms = " . $bathrooms	. "<br />";
				echo "hours = " . $hours 	. "<br />";
				echo "zipCode = " . $zipCode 	. "<br />";
				echo "startTime = " . $startTime	. "<br />";	
				echo "date = $date<br/>";
			}
			#urlAssign('index.php');
			
		}
		
	}
	  
	
	#echo "<br/>Success = $success <br/>";
	if ($success){
		
		#This stops the page from getting rerouted after logging in
		$_SESSION{'AppointmentRedirected'} = 0;
		
		$sql = 'SELECT max(ID) FROM quotes WHERE Username="' . $username . '"';	
		
		$result = mysql_query($sql);		
		
		$ID = mysql_result( $result , 0 );	
		
		$_SESSION{'lastQuoteNumber'} = $ID;
		$_SESSION{'lastQuoteMash'} = $mash;		
		$_SESSION{'lastQuoteHRS'} = $hours;
		$_SESSION{'lastQuoteSTART'} = $startTime;
		
		
		
		
		#echo "LAST Quote Num  = " . $_SESSION{'lastQuoteNumber'};
		
		#Create a directory with the ID of the quote and send the user to quotes/ID/Finalize
		if ($ID){

			// Desired folder structure
			$structure = './quotes/' . $ID . '/';
			#echo "ID = $ID<br/>";
			// To create the nested structure, the $recursive parameter 
			// to mkdir() must be specified.

			if (!mkdir($structure, 0777, true)) {
				echo 'Failed to create folders...';			
			}

			// ...
			
			
			//  PUT THE DISPLAY FILES IN THE SUB FOLDER
			
			$file = "./$finalizeFileName";
			$newFile = './quotes/' . $ID . "/$finalizeFileName";			

			if (!copy($file, $newFile)) {
				echo "failed to copy $file...\n";
				
			}	
			chmod($newFile, 0755);			
			#echo 	"NewFilePerms $newFile = " . fileperms($newFile) . "<br/><br/>";
				
		}	
		# Checkout.php is currently the default - TODO , BUILD A NEW FORMAT OF CHECKOUT	
		startAppointmentCheck ();		
		
		if($_SESSION{'conflictingSchedule'}){
			
			#	echo "<br/>Deleting conflictiong entry";			
			$_SESSION{'LastQuoteDate'} = substr($_SESSION{'lastQuoteMash'}, 0 , 8);			
			$sql = "DELETE FROM quotes WHERE ID =\"" .  $_SESSION{'lastQuoteNumber'}   . "\" ; ";					
			mysql_query ($sql);			
			#	echo "<br />SQL : " . $sql; 
			
			
			
		}else{
			
			$_SESSION{'SESSIONQuotes'}  .= $_SESSION{'lastQuoteNumber'} . " ";
		}
		
		
		if (0){
			#CheckoutPage INFO??
			
			#BLANK
			
			#############################################
			$_SESSION{'zipCode'} 			= NULL;
			$_SESSION{'hours'} 				= NULL;
			$_SESSION{'startTime'} 			= NULL;
			$_SESSION{'bedrooms'} 			= NULL;
			$_SESSION{'bathrooms'} 			= NULL;
			$_SESSION{'dateWorkRequest'} 	= NULL;
			
		}
		urlAssign($structure . $finalizeFileName);
		
		
		#echo "Hours = " . $_SESSION{'lastQuoteHRS'} . "<br />";

		
		
	
		
		
		
		
		
	}
	
	
######################	FUNCTIONS	



	
	
	
  
?>


