<?php


	session_start();
	require('functions.php');
	
	
	
	$_SESSION{'dataCollected'} = NULL;
	$_SESSION{'dataCollected2'} = NULL;
	$_SESSION{'errorSQL'} = NULL;
	$_SESSION{'db_host'}	= NULL;
	$_SESSION{'db_username'}	= NULL;
	$_SESSION{'db_pass'}	= NULL;
	$_SESSION{'db_name'}	= NULL;	
	
	$_SESSION{'database'} = NULL;
	$_SESSION{'table'} = NULL;
	
			
			
	
	urlAssign('sqlTable.php');
	

?>