<?php


	session_start();
	require('functions.php');
	
	
	
	
	$_SESSION{'dataCollected2'} = NULL;
	$_SESSION{'errorSQL'} = NULL;
	$_SESSION{'database'} = NULL;
	$_SESSION{'table'} = NULL;
	
			
			
	
	urlAssign('sqlTable.php');
	

?>