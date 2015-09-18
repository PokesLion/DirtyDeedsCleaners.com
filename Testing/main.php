<?php
	
	global $javascript, $sessionStartUsed;
	
	session_start();
	
	
	
	require ('/home/dirtydeeds91/public_html/functions.php');	# Run in this order 
	require ('/home/dirtydeeds91/public_html/html.php');		# The code in this is ran using  ---->    htmlHeader();     htmlBody();	  and htmlEnd();

#################################################################################################################################################################################################################################################################################
###################																										WORK SPACE																													#############################
#################################################################################################################################################################################################################################################################################
	
	
	
	standard();


##########################		FUNCTIONS
#
#
#
#
#
#
#



	function standard(){					#MAIN CODE - GENERATE HTML & LOGIN & PROJECTS		
		
	
		timeStampLogout(); 	#	logout the user using $_session timestamp after 15 minutes
		$_SESSION['timestamp'] = time();
	
		#Special Variables 
		clearSession ();	# 	Remove information for users who are not logged in
		
		pageViews();  	#	Count page views this session.
			
		accessAdmin ();  	#   Build printString SESSION VARIABLE
		
		#	Main Website Data
		
		htmlHeader();		#	Displays , header , Left side bar,  body
		
		
			
		login();			#	Display login window
		
		
		
		if ( $_SESSION['fail1'] ){ 	 #	Display when someone tries to view admin.php without admin access. 
				
			echo "<span><font color=\"blue\">Admin access denied!</font></span>";
			
			echo "login = " . $_SESSION['login'];
			
			$_SESSION['fail1']  = 0;
			
			#	TODO : Create a log of this error
			
		}
	
	}
	#########################################################################################################################################
	###		END MAIN CODE 
	
	
	
	
	
	
	function clearSession (){
		
		
		if (!$_SESSION['loggedIn']){
			
			$_SESSION['loggedIn'] 		= NULL;
			$_SESSION['login'] 			= NULL;
			$_SESSION['password']		= NULL;
			$_SESSION['administrator'] 	= NULL;
			$_SESSION['printString']	= NULL;			
			
		}
		
	}
	


?>