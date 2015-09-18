<?php



	session_start();
	
	
	$dataStore = array();
	
	$db_host  = $_SESSION['db_host'];
	$db_username = $_SESSION['db_username']; 
	$db_pass = $_SESSION['db_pass'];
	$db_name = $_SESSION['db_name'];
	
	$_SESSION{'useLastSQLMessage'} = "<p>";
	
	require ('functions.php');
	require ('html.php');
	htmlHeader();
	
	
	
	## CHECK FOR A SESSION VAR
	
	if (($db_host  && $db_username  && $db_pass  && $db_name ) || $_SESSION{'dataCollected'} ) {
		
		$_SESSION{'dataCollected'} = 1;
		
		$_SESSION{'useLastSQLMessage'} .= "Data Collected<br />";
		
	}else{
		
		if (0){
			
			
			#Create a table
			
			connectSQL();		
			
			
			$sql = "Create Table sqlConnection (ID INT(6) AUTO_INCREMENT PRIMARY KEY , Host Varchar(30) , Username Varchar(30) , Password Varchar(30));";		
			
			$result = mysql_query ($sql);
			
			if ($result){
				$_SESSION{'useLastSQLMessage'} .= "Success Created table <br />";
				
			}else{
				$_SESSION{'useLastSQLMessage'} .= "Failed to create table , " . mysql_error() . "<br />";
				
			}
			
			
			
			
		}else{
			
			#Query Database
			
			connectSQL();
			
			
			/*
			if (!$_SESSION{'madeEntry'}){
				$sql = "INSERT INTO sqlConnection (Host , Username , Password , Dbname ) Values ('localhost','dirtydee_justin','sailing6650' , 'dirtydee_preliminary');";
				#UPDATE sqlConnection Dbname=dirtydee_preliminary
				$result = mysql_query ($sql) or die (mysql_error());
				
				
				$_SESSION{'madeEntry'} = 1;
				
			}
			
			*/
			
			$sql = "SELECT * FROM sqlConnection WHERE ID=1";
			
			$result = mysql_query ($sql);		
						
			#	$_SESSION{'useLastSQLMessage'} .= "Made entry =  " . $_SESSION{'madeEntry'} . "<br />"  ;
			
			
			if ($result){
				
				$_SESSION{'useLastSQLMessage'} .=  "Success <br /> ";
				
				while($row = mysql_fetch_assoc($result)){
					foreach($row as $cname => $cvalue){
						
						$dataStore[$cname] = $cvalue;					
						
						#Set session vars
						$_SESSION{'useLastSQLMessage'} .= "Set SESSION of Field DataStore[$cname] and value $cvalue<br />";
						
						
						/* 	NEED
						
						$table 				= $_SESSION{'table'} 		;
						$databaseHost 		= $_SESSION{'db_host'}  	;
						$databaseUsername 	= $_SESSION{'db_username'};
						$databasePass		= $_SESSION{'db_pass'} 	;
						$databaseName 		= $_SESSION{'db_name'} 	;
						
						
						SET 
						Set SESSION of Field [ID] and value 1
						Set SESSION of Field [Host] and value localhost
						Set SESSION of Field [Username] and value dirtydee_justin
						Set SESSION of Field [Password] and value sailing6650
						Set SESSION of Field [Dbname] and value dirtydee_preliminary
						
						*/
						
						
						
						
					}
					
				}
				
				$_SESSION{'db_host'} 		=  $dataStore['Host'];
				$_SESSION{'db_username'} 	=  $dataStore['Username'];
				$_SESSION{'db_pass'} 		=  $dataStore['Password'];
				$_SESSION{'db_name'} 		=  $dataStore['Dbname'];
				
				
				$_SESSION{'dataCollected'} = 1;
				
			}else{
				
				
				$_SESSION{'useLastSQLMessage'} .=  "Failed to query data , " . mysql_error() . "<br />";
				
				
			}
			
			
			
		}
		
	}
	
		
	
	
	
	
	
	urlAssign('sqlTable.php');
	
	
	
	
?>