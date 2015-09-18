<?php

	session_start();
	require('functions.php');

	pageViews();	
	
	$_SESSION['loggedIn'] 	= NULL;
	$_SESSION['login'] 		= NULL;
	$_SESSION['password']	= NULL;
	$_SESSION['administrator'] = NULL;
	$_SESSION['views']			= NULL;
	$_SESSION['timestamp']		= NULL;
	$_SESSION{'monthSelectedSpelled'}= NULL;
	$_SESSION{'yearSelected'}= NULL;
	$_SESSION{'monthSelectedNumeric'}= NULL;
	$_SESSION{'AppointmentRedirected'} 	= NULL; 
	
	
	$_SESSION[] = NULL;
	
	
	session_destroy();
	
	echo <<<OUT
	
		<script>
			window.location.assign('index.php');
		</script>
	
OUT;

	

?>