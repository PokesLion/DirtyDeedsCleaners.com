<?php


	session_start();
	
	
	$_SESSION{'debug'} =0;
	
	$_SESSION['error'] 						= "";
	$_SESSION['collaborateMessage'] 		= "";
	$_SESSION['collaborateErrorMessage']	= "";
	$_SESSION['emailErrorSender'] 			= ""; 
	$_SESSION['emailErrorContact'] 			= "";
	$_SESSION['emailErrorSubject'] 			= "";
	$_SESSION['emailErrorContent'] 			= "";
	$_SESSION['emailErrorMessage'] 			= "";
	
	
	
	if (isset($_POST{'submitLogin'})){
		
		if (isset($_POST{'rememberMe'})){
						
			#Set Cookie
			if ($_POST["login"]){
				setcookie("001" , $_POST["login"] , time() + 3600);
			}
			if ($_POST["password"]){
				setcookie("002" , $_POST["password"] , time() + 3600);
			}
			$setCookie = 1;
		}	
	}
	
	
	
	####################
	
	#Redirect the user to the index if they did not login properly , OR send the user to welcome.php
	require('html.php');
	require('functions.php');
	
	

	
	connectSQL();
	
		
	#htmlHeader();
	#htmlBody();
	# end standard display
	

#####################		LOGIN	
	
	$username 	=  test_input($_POST{'login'});
	$password 	=  test_input($_POST{'password'});	
	$_SESSION{'username'} 	=  $_POST{'login'};
	
	
	
	
	
	#########################################
	
	#$sql = "INSERT INTO user (Username , Password) VALUES ('yoda' , '1')";
	 
	#@mysql_query($sql) or die ("Error : " . mysql_error());
	
	###########################################
	
	
	$sql = "SELECT * FROM user";
	$result = mysql_query($sql);	
	
	
	while($row = mysql_fetch_array($result))
	{
		
		$sqlID = $row{'ID'};
		$sqlUnm = $row{'Username'};
		$sqlPwd = $row{'Password'};
		
		
	
		
		$sqlData = array ( $sqlUnm , $sqlID ,  $sqlPwd  )  ;
		
		if (preg_match("/^$sqlUnm$/i" , $username  )){
			
			$match = 1;
	
			
			$databaseUnm = $sqlUnm;
			$databasePwd = $sqlPwd;	
			
		}
	}
	

	
	
	
##END MAIN CODE
#TEMORARY DEBUG STATEMENTS
	
	
	
	
	#THIS SETS SESSION LOGIN & PASSWORD  , IF they match the sql database SESSION LOGIN IS TRUE 
	
	
	if (isset($_POST{'submitLogin'})){
		validate();		# THIS SENDS THE USER TO THE WELCOME PAGE         | The intended source is the index 
	
	}

		#Validate Creates $_SESSION['loggedIn']
	#########################################			Direct Page
	
	
	
		
	######################
	#
	#
	#		Proceess Messages from users
	

	if (isset($_POST{'collaborate'})){
		
		$title = test_input($_POST{'title'});
		$message = test_input($_POST{'message'});
		collaborate();
			
	}
	
	if (isset($_POST{'contact'})){
		
		receiveEmail();
		
			
	}
	
	if (isset($_POST{'generateSql'})){
		
		generateSQL();
		
		
			
	}
	#########################################
	
	if ($_SESSION{'triggercolumnPlus'}){
		
		columnPlus();
		$_SESSION{'triggercolumnPlus'} = NULL;
		
	}
	
	sendUserWelcome ();
	
		
	
	
#####################################################################							FUNCTIONS
	
	$errorExistingLoginLog = array();
	function validate(){	
		
		global $username , $password ,  $databaseUnm , $databasePwd;
			
		if (isset($_POST{'submitLogin'})){
			
			if ($_SESSION['loggedIn']){	
				
				$loggedIn = 1;
				$_SESSION['timestamp'] = time();
				 
				if (preg_match( "/^admin\@dirtydeedscleaners\.com$/i" , $username)){	#Send admin
					
					$_SESSION['administrator'] = 1;
				}
				
				
				$_SESSION['error'] .= "<p>You are already logged in</p>";
				
			}else{		
				
				if ( isset($_POST['signUp']) ){
					
					
					
					
					if  (preg_match("/^$databaseUnm$/i"  , $username) )  {
						
						$_SESSION['error'] .= "<p>The username you entered is taken. ($username)</p>";
						$loggedIn = 0;
						
						if (0){
							$errorExistingLoginLog{$username} = 1;
							$_SESSION['errorLoginLog'] .=  " $username";
							
							
						}
						
						
						
					}elseif($username && $password){
						
						
						$loggedIn = 1;
						$_SESSION['timestamp'] = time();
						#Add email validation?
						
						#$sql = "CREATE TABLE user (Username VARCHAR(30), Password VARCHAR(30))";
						#@mysql_query($sql) or die ('Error : ' . mysql_error());	
						
						#$sql = "ALTER TABLE user ADD (Username VARCHAR(40), Password VARCHAR(40))";
						#@mysql_query($sql) or die ('Error : ' . mysql_error());	
						
						
						
						$sql = "INSERT INTO user (Username , Password) VALUES (\"$username\"  , \"$password\")";
						@mysql_query($sql) or die ('Error : ' . mysql_error());	
						
						
					}else{
						
						$_SESSION['error'] .= "<p >There was a problem signing in.  Please re-enter your or password to sign up.</p>";
						
						$loggedIn = 0;
						
					}
					
				}elseif ($username || $password){
					
					
					if ( preg_match( "/^$username$/i"  , $databaseUnm) && $password == $databasePwd ){		#If there is a match for logging in. 
						
						$loggedIn = 1;
						$_SESSION['timestamp'] = time();
						
						if ((preg_match( "/^admin$/i" , $username)) || ($_SESSION['administrator'])){#Send admin
							
							$_SESSION['administrator'] = 1;
						
							/*            send the user -> admin to the admin page # Then they cannot use process.php without being sent to the admin page.  make a condition to do this for a login?        */
							
							urlAssign('admin.php');

						}
						
					}else{
						
						$_SESSION['error'] .= "<p >There was a problem signing in.  Please re-enter your username or password to sign in.</p>";
						
						$loggedIn = 0;
						
					}
					
				}else{
					
					if (!$_SESSION['loggedIn']){
					
						$_SESSION['error'] .= "<p >Please provide login details.</p>";				
						$loggedIn = 0;
					
					}
				}
			}
			
			
			
		
			
		}else{
			
			if ($_SESSION['loggedIn']){
				
				$loggedIn = 1;
				
				
			}
			
		}
		
	
		$_SESSION['loggedIn'] = $loggedIn;
		
		if ($loggedIn){
			
			$_SESSION['login'] = $databaseUnm;
			$_SESSION['password'] = $databasePwd;			
				
		}
		
		
		if ( !(isset($_POST{'submitLogin'})) ){
			$_SESSION['error'] = NULL;
			
		}
		
		
		
		if ($_SESSION{'AppointmentRedirected'} && $loggedIn){			
		
		
		
			#	$_SESSION{'AppointmentRedirected'} = 0;						
			#	$_SESSION{'attemptedEmail'} . "<br />"  ;
			#	$_SESSION{'zipCode'} . "<br />"  ;
			#	$_SESSION{'dateWorkRequest'} . "<br />" ;

			urlAssign('quote.php');
			
			
			
			
			
		}
		
		
		if ($_SESSION['error'] || (isset ($_POST{'submitLogin'} ) && !$loggedIn)){
			
			urlAssign('loginPage.php');
			
		}
		
		
		
}
function sendUserWelcome (){
	
		if (1){	#Turn on to redirect the user, Turn off to read the error statements.
			
			echo "<div cass=\"main\">";
			
				
			urlAssign('index.php');
			
				

			echo "</div>";

		}else{
			
			
			echo "<p id=\"main\" >Error = " . $_SESSION{'errorSQL'} . "</p>";
			
		}
		
		
		
	
}


function pOut($print){
	
	echo "<p> $print </p>";
	
	
}


function collaborate(){
	
	
	#################################INSERT DATA INTO TABLE : suggestions
	global $title, $message;
	
	$_SESSION['dataUsed'] = "Title : $title     | 	 Message : $message";
	 
	#database name  justinha_users
	#table name 	user			- stores (Username , Password)
	#table name 	suggestions		- stores (Username , Password)
	
	if ($_SESSION['loggedIn']){	
			
			$unm = " " . $_SESSION['login'];
			
		
		
	}else{
		
		$unm = "";
	
	}
	
	
	if ($title && $message){
		/*
		
		$sql = "CREATE TABLE suggestions (
								id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
								Title VARCHAR(30) NOT NULL,
								Message VARCHAR(1000) NOT NULL,
								User VARCHAR(25),
								reg_date TIMESTAMP
							)";
		*/ 
		#@mysql_query($sql) or die ("Error : " . mysql_error());

		$sql = "INSERT INTO suggestions (Title , Message , User) VALUES ( '$title' , '$message'   , '$unm'   )";
		
		@mysql_query($sql) or die ("Error : " . mysql_error());

		$_SESSION['collaborateMessage'] = "Thank you$unm! I will review your suggestion, and let you know if there is an update regarding your request. ";
		
		urlAssign('webTools.php');
		

	}else{
		
		$_SESSION['collaborateErrorMessage'] = "Incompelete Information. Please enter a Title and Message. ";
		
		urlAssign('webTools.php');
		
		
		
	}

	
}	



function receiveEmail(){
	
	
	
	
	$emailSender		 	= ($_POST{'emailSenderName'});
	$emailSenderContact 	= ($_POST{'emailSenderContact'});
	$emailSubject 			= ($_POST['emailSubject']);
	$emailContent 			= ($_POST['emailContent']);
	$_SESSION['dataUsed1']	= "<p>| Sender : $emailSender    |<p>|   Contact : $emailSenderContact    |<p>|   Subject :  $emailSubject     |<p>|   Content  : $emailContent  |" ; 
	
	if ($_SESSION['loggedIn']){
			
			$unm = " " . $_SESSION['login'];	
		
	}else{
		
		$unm = "";

	}
	
	if (preg_match("/^[a-zA-Z0-9\.]+\@[a-zA-Z1-9]+\.com$/i" , $emailSenderContact)){
		$validEmail = 1;
	
	}
	
	
	if(	$emailSender && $emailSenderContact   && $emailSubject  && $emailContent && $validEmail ){	
		
			
		if (0){
				/*
				
			$sql = "CREATE TABLE email (
								id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
								SenderName VARCHAR(30) NOT NULL,
								SenderEmail VARCHAR(50) NOT NULL,
								Subject VARCHAR(25),
								Content VARCHAR(1000),
								User VARCHAR(25),
								reg_date TIMESTAMP
							)";
							
							
		
				Data FROM  : 
			
				emailSenderName
				emailSenderContact
				emailSubject
				emailContent
				
				
			
			
			
			@mysql_query($sql) or die ("Error : " . mysql_error());
			
			*/
			
			$_SESSION['done'] = 1;
			
		}
		
		
		$sql = "INSERT INTO email ( SenderName , SenderEmail, Subject , Content , User) VALUES ( '$emailSender' , '$emailSenderContact'   , '$emailSubject'  , '$emailContent' , '$unm' )";
		
		@mysql_query($sql) or die ("Error : " . mysql_error());

		$_SESSION['emailMessage'] = "Thank you$unm! I will review your email, and let you know if there is an update regarding your request.";
		
		
		urlAssign('contact.php');


	} else{
			if (!$validEmail){
				
				$_SESSION['emailErrorMessage'] = "Please fix your email ($emailSenderContact). ";
				
			}else{
				
				$_SESSION['emailErrorMessage'] = "Your email was not complete. Please review your email.";
				
			}	
			
			$_SESSION['emailErrorSender'] = $emailSender;
			$_SESSION['emailErrorContact'] = $emailSenderContact;
			$_SESSION['emailErrorSubject'] = $emailSubject;
			$_SESSION['emailErrorContent'] = $emailContent;
			
			
						
			urlAssign('contact.php');
		
	}
		
	
	
}


function generateSQL(){
	
	
	
	
	
	
	
	
	#  	step1 
	$databaseHost 		= $_POST['dbhost'];
	$databaseUsername 	= $_POST['dbusername'];
	$databasePassword 	= $_POST['dbpassword'];
	$databaseName 		= $_POST['dbname'];
	
	
	#step 2
	$database = $_SESSION{'db_name'}; #Repeat Data
	$table = $_POST{'table'};
	
	
	
	
	#step 3
	
	$action 		= $_POST['action'];
	
	
	if ($_SESSION{'dataCollected'}){
		
		if ( !$_SESSION{'dataCollected2'}){
			if ( $table){
				
				$_SESSION{'dataCollected2'} = 1;				
				
				$_SESSION{'database'} = $database;
				$_SESSION{'table'} = $table;
				
			}
			
		}	
		
		if ($_SESSION{'dataCollected2'} && $action){ 
			
			
			if ($action == "newTable"){							
				 
				 urlAssign('resetSql2.php');
				 
				
				
			}elseif($action == "columnPlus"){
				
				columnPlus();
				
				
			}
			elseif($action == "insert"){
				
				insertSQL();
				
				
			}elseif($action == "sort"){
				
				sortSQL();
				
			}elseif($action == "delete"){
				
				deleteSQL();
				
			}elseif($action == 'viewData'){
				
				urlAssign('viewData.php');				
				
				
			}
			
				 
			
		}


			
		
		
	}else{
		if ($databaseHost && $databaseUsername && $databasePassword && $databaseName ){
			
		
			$_SESSION{'db_host'}  = $_POST['dbhost'];
			$_SESSION{'db_username'} = $_POST['dbusername']; 
			$_SESSION{'db_pass'} = $_POST['dbpassword'];
			$_SESSION{'db_name'} = $_POST['dbname'];
		
			
			$_SESSION{'dataCollected'} = 1;
			
			
			
		}
		
		
		
	}
	
	
	urlAssign('sqlTable.php');
}


?>