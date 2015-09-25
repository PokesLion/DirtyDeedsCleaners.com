<?php


session_start();

global $script;

include ('database.php');



function loginPOST(){
	
		
	$loggedIn = $_SESSION['loggedIn'];
	$username = $_SESSION['login'];
	$password = $_SESSION['password'];
	$pagesViewed = $_SESSION['allPagesSeen'];
	$error = $_SESSION['error'];
	
	if (!$error){
		
		$error = $_SESSION['collaborateErrorMessage'];
		$_SESSION['collaborateErrorMessage'] = "";
	}
	
	if (!$error){
		$error = $_SESSION['emailErrorMessage'];
		$_SESSION['emailErrorMessage'] = "";
		
		
	}
	
	
	#	  $lengthPassword = strlen($password);
	
	
	
	echo "<div id=\"account\">
		
	";
	if($loggedIn){
		
		
		echo "<h2>";
		echo "<p>Welcome</p>";
		echo "<p>Your username is : $username ";
		echo "<p><a href=\"logout.php\">Logout</a> </p>";
		echo "</h2><br><br><hr>Activity : ";
		echo "<br><hr>";
		
		
	}else{
		
		
		
		
		#displayLogin shows the username and password form input fields
		displayLogin();
		

	}
	

	#Display Error
	if ($error){
		echo "<br><br><hr><br>";
		echo "<p class=\"error\"> Error : <ol class=\"error\"><li>$error</li></ol></p>";
		echo "<br><hr>";
		
	}
	echo "    </div>";			#Div end "account"			
	
			

	$_SESSION['error'] = "";
			
	
}



function login(){
		
	global $username , $password , $signUp , $databaseUnm , $databasePwd;
	
	
	if ($_SESSION['loggedIn']){	
		
		$loggedIn = 1;	
		
	}else{	
		
		
		if ( $signUp ){
			
			
			
			
			
			if  (preg_match("/^$databaseUnm$/i"  , $username) )  {
				
				
				$loggedIn = 0;
				
				
			}elseif($username && $password){
				
				
				
				$loggedIn = 1;
				#Add email validation?
				$sql = "INSERT INTO user (Username , Password) VALUES (\"$username\"  , \"$password\")";
				@mysql_query($sql) or die ('Error : ' . mysql_error());	
				
				
			}else{
				
				
				$loggedIn = 0;
				
			}		
			
		}elseif ($username || $password){			
			
			if ( preg_match( "/$username/i"  , $databaseUnm) && $password == $databasePwd )  {	
				echo "<p>Logged in as : $username</p>";
				$loggedIn = 1;
				
				
				
				
			}else{
				
				$loggedIn = 0;
				
			}		
			
		}else{
			
			$loggedIn = 0;
			
		}
	}

	$_SESSION['loggedIn'] = $loggedIn;	

	// #important vars page TODO
	global $sidebar;
	if ($sidebar){
		
		#Run Condition to ask for a login or say welcome
		echo "<div id=\"sidebar2\">";
		
		#loginPOST();  This displays the login window if the user is not logged in.  
		
		echo "</div>";
	}
	
	
	
	
}

function pageViews(){
	
	
	
	if( isset($_SESSION['views'])){
		
		$_SESSION['views'] += 1;
		
	}else{
		
		$_SESSION['views'] = 1;
		
	}


		
	
	
}



##################		TODO	 - After this is done > Remember ME	> Sending a email

function test_input($data) {
		   $data = trim($data);
		   $data = stripslashes($data);
		   $data = htmlspecialchars($data);
		   return $data;
}
		
function displayLogin(){
		
	$errorsList = array();
	
	# Use this info to send the user to the appointment finalizing page after logging in during an attemt to schedule an appointment. 
	$redirected = $_SESSION{'AppointmentRedirected'};
	$email		= $_SESSION{'attemptedEmail'};	
	$zipCode 	= $_SESSION{'zipCode'};
	
	
	
	if (($_SESSION{'cookieRemoveCounter'} > 1) && !$_SESSION{'cookieRemoveCounterMSG'}){
		
		alert("If your username and password wont clear, your web browser has stored cookies for this website. ");
		
		$_SESSION{'cookieRemoveCounterMSG'} = 1;
	}
	
	
	if ($redirected){
		
		
		if ($_SESSION{'cookieRemove'}){
			$username ="";
			$cookiePass = "";
			
		}elseif($email){	
			
			$username = $email;		
			
			
		}else{
			
			$username = $_COOKIE{'001'};
			$cookiePass = $_COOKIE{'002'};
			$_SESSION{'cookieRemove'} =0;
			
			
		}
	}	

?>		
		
		<table class="login"  id="loginWindow" align="center" >
			<th><span style="text-align:left;font-weight:bold">Returning/New Users</span></th><tr />
			<form method="post" action="process.php"  class="login">				
				<td style="line-height:2"></td><tr />
				<td style="position:relative;left:24%;line-height:2;text-align:left">Email</td><tr></tr>
				<td style="text-align:center " ><input size="35" type="email" name="login"  class="whitePadding" placeholder="Emai address" value="<?php   echo $username   ?>">  </td><tr />
				<td style="position:relative;left:24%;line-height:2;text-align:left">Password</td><tr />
				<td style="position:relative;text-align:center"><input size="35"  type="password"  class="whitePadding" name="password" value="<?php   echo $cookiePass   ?>"></span></td><tr />
				<td style="position:relative;top:20px;text-align:left;right:10px"><input id="submitLogin" type="submit" name="submitLogin" value="Login"><tr />
				<td style="position:relative;top:40px;text-align:center">Sign up : <input type="checkbox" name="signUp" id="checkbox"> Remember me : <input type="checkbox" name="rememberMe" id="checkbox">  &nbsp<a href="remove.php"><span style="color:blue">Remove username and password.</a></td>					
			</form>			
		</table>
		<br /><br /><br />
	
		
		
<?php 
		$errorArrayLength = count ($errorList);
		
		
		#Print Error if an error exists
		if ($errorArrayLength){
			echo "<div class=\"error\">
					
			";
			echo '<table border ="2" color="red" class="error" width="100px">';
			echo "<th>Errors</th>";		
				
			for ($a = 0; $a < $errorArrayLength; $a++){
				
					echo "<tr><td>* $error</td>";
			}
			echo "</table>";
			echo "</div>";#Test DIV and TABLE for color
			
		}
		

		
}		



function allPagesVisited (){
	
	$pagesViewed = array();
	$pagesViewed{'index.php'} =  1;
	
	if(!$pagesViewed{__FILE__}){
	
		$pagesViewed{__FILE__} =  1;
	
	}
	
	foreach ($pagesViewed as $key){
		
		echo "<p>Page = $key</p>";
	}
	
	
	$_SESSION['allPagesSeen'] = array($pagesViewed);
	
}	
	
function accessAdmin(){		
		
	
	if (preg_match( "/^admin\@dirtydeedscleaners\.com$/i" , $_SESSION['login']  ) &&  $_SESSION['loggedIn']  ){
		
		#administrator access?  Should be handled in process.php
		
		$_SESSION['printString'] = "Administrator = " .  $_SESSION['administrator'] . ", from process.php. <br> Logged In = " . $_SESSION['loggedIn']  . "<br> Page views =  " . $_SESSION['views']; #Show admin info
		
		
		
	}else{
		
		$_SESSION['administrator'] = 0;
		
		#$_SESSION['printString'] = "Administrator = " .  $_SESSION['administrator'] . ", from process.php. <br> Logged In = " . $_SESSION['loggedIn']  . "<br> Page views =  " . $_SESSION['views'];
		
	}
}

	
	
function adminTool(){
	
	
	echo '<div id="marginTop">';
	echo 	'<p>
				Admin Page : <a href="admin.php">Admin </a><ul>';
				
	echo 			'<li><a href="sqlTable.php"> Create a SQL Table</a></li>										
					<li><a href="sqlCommand.php"> SQL Commands </a></li>					
					<li><a href="testPortal.php"> Testing Portal / Version Control</a></li>					
					<li><a href="recordWork.php"> Record work</a></li>
					<li><a href="viewInvoice.php">View Invoice</a></li>
					<li><a href="userInfo.php">Users </a></li>
					<li><a href="suggestionInfo.php">Suggestions </a></li>
					<li><a href="emailInfo.php">Emails </a></li>					
					
					
					
					
			</ul></p></div>';
	
}




	
	
	
	
	
function administrator(){
	
	
	
		
	if (preg_match( "/^admin$/i" , $_SESSION['login']  ) &&  $_SESSION{'loggedIn'}){

		$_SESSION['administrator'] = 1;
		$_SESSION['printString'] = "Administrator = " .  $_SESSION['administrator'] . ", from process.php. <br> Logged In = " . $_SESSION['loggedIn']  . "<br> Page views =  " . $_SESSION['views'];
		
	}else{
		
		echo <<<OUT
				<script		type="text/javascript">
					window.location.assign('index.php');
				</script>
OUT;
		
		
		
	}
	
}

function dynamicSQLCommand (){
	
	
	$error = $_SESSION['adminCommandError'];
	#Enter a  SQL command admin
	echo<<<OUT
	
			<p><center>Create a MySQL command : 
			<form action="adminCommand.php" method="post">
				<input required type= "text" name="SQL" size="40">
				<select name="table">
					<option value="blank"></option>
				  <option value="user">user</option>
				  <option value="suggestions">suggestions</option>
				  <option value="email">email</option>
				</select>
				<p><input id="submitCheckout" required  type= "submit" name="run" value="Run"></p>
				
				
			</form>
			
			
			</center></p>
OUT;


	if ($error){
		echo "<span class=\"error\"> Error : $error</span>";
	}
}


function alertUser($message){
	
	
	?>
	<script type='text/javascript'>
		  alert('<? echo $message ?>'); 
	</script>
	
	<?
	
}



function timeStampLogout(){
	
	if ($_SESSION['loggedIn']){
		if(time() - $_SESSION['timestamp'] > 900) { //subtract new timestamp from the old one		
			
			alertUser('Login time of 15 minutes over. \nRedirecting the your browser to the DirtyDeedsCleaners home page.');
			
			urlAssign("http://dirtydeedscleaners.com/logout.php");
			
			die;
			
			
		} else {
			$_SESSION['queueLogout'] = 0;
			$_SESSION['timestamp'] = time(); //set new timestamp
			#alertUser("Hello!   , Timestamp :   " . time());
		}
		
		
	}
	
	
	
	
}


function urlAssign($location){

	if (!$_SESSION{'debug'}){
		echo "
			<script		type=\"text/javascript\">
				window.location.assign('" . $location . "');
			</script>
		";
	}
	
}	



function columnPlus(){
	
	$db_host  = $_SESSION['db_host'];
	$db_username = $_SESSION['db_username']; 
	$db_pass = $_SESSION['db_pass'];
	$db_name = $_SESSION['db_name'];
	#$_SESSION{'database'}
	$table = $_SESSION{'table'};
	
	#New Data  		TODO 		
	#$columns = $_SESSION{'columnsSQL'};
	#$dataTypes = $_SESSION{'dataTypes'};
	
	if (0){
		
		$column = $_POST{'column'};
		$dataType = $_POST{'dataType'};
		
	}else{
		
		$column = "Username";		
		$dataType = 'VARCHAR(30)';
	}
	
	
	if ($dataType){
		$dataType = preg_replace( '/[\(n\)]/' , "", $dataType); 
		$dataType = preg_replace( '/[\(p\)]/' , "", $dataType); 
		$dataType = preg_replace( '/[\(p\,s\)]/' , "", $dataType); 
		
	}
	
	$dataTypeSpecific = $_POST{'dataTypeSpecific'};
	
	if ($dataTypeSpecific){
		$dataTypeSpecific = "(" . $dataTypeSpecific . ")";
		
	}
	
	
	
	
	
	if ($table && $column  && $dataType ){
		
		$allRecentlyAddedSessionColumns = explode ( " " , $_SESSION{'recentlyAddedSessionColumn'});
		
		$_SESSION{'dataDump'} = $allRecentlyAddedSessionColumns;
			
		if (!$allRecentlyAddedSessionColumns[$column]){
		
			$_SESSION{'recentlyAddedSessionColumn'} .= " " . $column;
			
			$sql = "ALTER TABLE $table ADD COLLUNM ";
			
			$count = count($columns);
			
			if ($count){ # Set up mutiple colums at once
				for ($i = 0; $i < $count ; $i++){
					
					$column = $colums[$i];
					$dataType = $dataType[$i];
					$dataTypeSpecific = $dataTypeSpecific[$i];
					
					$sql .= $column . " " . $dataType . $dataTypeSpecific . ", "; 
					
				}
			}else{
				$sql .= $column . " " . $dataType . $dataTypeSpecific; 
				
			}
			
			$_SESSION{'lastSqlCmd'} = $sql;
			mysql_query($sql) or die ("Dead : " . mysql_error() );
			
			
		}else{
			
			
		}
		
		
	}else{
		
		$_SESSION{'dataReqColumn'} = 1;
		
		urlAssign('sqlColumns.php');
		
	}
	
	
	
	
	
	
}
#		TODO : 		newTable(); , columnPlus(); insertSQL(); sortSQL(); deleteSQL();
function insertSQL(){
	
	
	$db_host  = $_SESSION['db_host'];
	$db_username = $_SESSION['db_username']; 
	$db_pass = $_SESSION['db_pass'];
	$db_name = $_SESSION['db_name'];
	#$_SESSION{'database'}
	$table = $_SESSION{'table'};
	
	
	# INSERT WORKS IF THERE IS ALREADY A COLLUNM ..  $sql = "INSERT INTO user (Username , Password) VALUES (\"$username\"  , \"$password\")";
	
	#NEEDED INFO
	
	
	
	
}




function startAppointmentCheck (){
	
	
	if ($_SESSION{'adminDebug'}){
		
		
		
		
		echo "<br/>FUNC-  START APPOINTMENT CHECK";
		
		echo "<br/>Set admin debug";
		
 	}
	
	
	
	connectSQL();

	$day = date ("d") +1; 
		
	if ($day < 10 ){
		
		$day = "0" . $day;
	}
	
	#echo "Day = $day";
	
	
	#0000 indicates The time of day 
	$tomorrowsDateMash  =  date ("Ym") . $day. "0000";
	
	
	$sql = "SELECT Mash, Hours, ID FROM quotes WHERE Mash > $tomorrowsDateMash";
	
	
	#201509170000    versus
	#201509171200
	$result = mysql_query ($sql);
	$futureAppointments = array();

	
	if (0){
		
		#DEBUG
		echo "Quote Number =  " . 	$_SESSION{'lastQuoteNumber'};
		echo "Quote Details = " . $_SESSION{'lastQuoteMash'};
		echo "Quote hrs = " . $_SESSION{'lastQuoteHRS'} . "<br/>";
		
		
		

	}
	
		
	
	
	
	$counter = 0;
	while ($row = mysql_fetch_array ($result) ){	
		
		$mash = $row{'Mash'};
		$hours = $row{'Hours'};			
		$ID = $row{'ID'};	
		
										
		if ($_SESSION{'adminDebug'} && !$_SESSION{'conflictingSchedule'}){
			
			echo "<br/>Conflicting Schedule = " . $_SESSION{'conflictingSchedule'};
			
			echo "<br/>Prior mash = "  . $mash ;
			echo "   HOURS  = "  . $hours;
			echo "   ID = "  . $ID . "<br/><br/>";
		
			
		}
		
		verifyAppontment($mash , $hours , $ID);		
		#echo "Org  -> Mash : $mash , Hours : $hours , ID : $ID<br />";		DEBUG
		
		$counter++;
		
		if ($_SESSION{'conflictingSchedule'}){
			break;
			
		}
	}
	
	
		
}

function verifyAppontment($startTime , $hours , $ID) {	


	
	if ($_SESSION{'adminDebug'}){
		echo "<br/>Confl Found = " . $_SESSION{'conflictingSchedule'};
	}
	#	$_SESSION{'lastQuoteNumber'}
	#	$_SESSION{'lastQuoteMash'}						
	#	$_SESSION{'lastQuoteHRS'}
	
	global $currentQuoteShown;
	
	if (!$_SESSION{'conflictingSchedule'}){
		
		
		$currentAppointmentDate = substr($_SESSION{'lastQuoteMash'}, 0 , 8);
		$currentAppointmentTime = substr($_SESSION{'lastQuoteMash'}, 8 , 4);
		$currentAppointmentEnds =  $currentAppointmentDate . ( $currentAppointmentTime + 100 * $_SESSION{'lastQuoteHRS'} ) ;
		
		if (!$currentQuoteShown ){
			
			
			
			if ($_SESSION{'adminDebug'}){
				echo "<br />Current : <br />
				Date : $currentAppointmentDate <br/>
				Time : $currentAppointmentTime <br/>
				Ends : $currentAppointmentEnds <br/>
				";
			}
			
			$currentQuoteShown = 1;
		}
		
			
		if ($_SESSION{'lastQuoteNumber'} != $ID){
			
			$priorApptStartDate = substr($startTime, 0 , 8);
			$priorApptStartTime = substr($startTime, 8 , 4);
			$priorApptStartEnds =  $currentAppointmentDate . ( $currentAppointmentTime + 100 * $_SESSION{'lastQuoteHRS'} ) ;
						
			$mashRange = $priorApptStartDate . ($priorApptStartTime + 100 * $hours);	#	$_SESSION{'lastQuoteMash'}	
			
			
			
			#	Start time 	vs start time 
			if (($_SESSION{'lastQuoteMash'} >= $startTime  && $_SESSION{'lastQuoteMash'} <= $mashRange) ||  ($currentAppointmentEnds >= $startTime  && $currentAppointmentEnds <= $mashRange)){
				if ($_SESSION{'adminDebug'}){
					echo "<br/>Schedule Conflicts <br/>Prior appointment : StartTime = $startTime  , End time : $mashRange <br />";
					
					echo "<br />Current : <br />
					Date : $currentAppointmentDate <br/>
					Time : $currentAppointmentTime <br/>
					Ends : $currentAppointmentEnds <br/>
					";

				}
				
				$_SESSION{'conflictingSchedule'} = 1;
				
			}
			
			
		}
	}
	
	
}


function verifyAddress(){	
	
		#WORKING
	
	
	$address = "255 W State St";
	$address2 = "";
	$city = "Pasadena";
	$state = "CA";
	$urbanCode = "";
	$postalCode = "";
	$zipCode = "91105";
	
	
	#
	$badAddressIdentify = "/The address you provided/";
	$address = preg_replace( "/[\s]+/" , "+" , $address);
	$address2 = preg_replace( "/[\s]+/" , "+" , $address2);
	$city = preg_replace( "/[\s]+/" , "+" , $city);	

	$ct = curl_init("https://tools.usps.com/go/ZipLookupResultsAction!input.action?resultMode=1&companyName=&address1=$address&address2=$address2&city=$city&state=$state&urbanCode=$urbanCode&postalCode=$postalCode&zip=$zip");
	
	curl_setopt($ct, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ct, CURLOPT_BINARYTRANSFER, true);
	$content = curl_exec($ct);
	curl_close($ct);
	
	if (preg_match( $badAddressIdentify  , $content  )){
		
		echo "Error verifying address";
		
	}else{
		
		echo "Address found <br />";
	

		#echo $content;
		
		$i = 0;
		
		$separator = "\r\n";
		$line = strtok($content, $separator);
		$informationCt =0;
		
		$storedHTML = array();
		while ($line !== false) {
			# do something with $line
			$line = strtok( $separator );
			
			if (preg_match("/\<div class=\"data\"\>/" , $line) || $i){
				
				if ($i < 14){
					
					
					
					if ($line){
						
						$informationCt++;
						#echo "<p>Result = " . htmlentities($line) . "    ,    Information CT = $informationCt</p><br/>";
						
						
						array_push ($storedHTML , $line );
						
						if (preg_match( "<span class=\"address1 range\">" , $line)){
							
							echo "<br/>Found address line";
							
						}
						
					}
					
					$i++;
					
				}
				
			}			
				
		}
		
		$addressLine = $storedHTML['7'];
		$addressInfo = $storedHTML['10'];
		
		#echo "<br/>Address Line = (" . htmlentities( $addressLine) . ")<br>";
		#echo "<br/>Address Info = " . htmlentities( $addressInfo) . "<br>";
		
		preg_match( "/>(.+)</" ,$addressLine , $matches);
		
		#echo "<br/>Address line matches = " . htmlentities( print_r($matches));
		
		
		

		$addressInfoArray  = explode( "</span>" , $addressInfo );
		
		#echo "Explode : " . htmlentities( print_r ($addressInfoArray)) . "<br/><br/><br/>";
		
		
		$addressLine = preg_replace ( "/<\/span><br \/>/" , "", $addressLine);
		$addressLine = preg_replace ( "/<.+>/" , "", $addressLine);
		$cityFound   = preg_replace ( "/<.+>/" , "", $addressInfoArray[0]);
		$stateFound  = preg_replace ( "/<.+>/" , "",  $addressInfoArray[1]);
		$zipFound    = preg_replace ( "/<.+>/" , "",  $addressInfoArray[2]);
		$hyphen   	 = preg_replace ( "//" , "",  $addressInfoArray[3]);
		$zipExtras   = preg_replace ( "/<.+>/" , "",  $addressInfoArray[4]);
		
		if ($zipExtras){
			$zipFound .= "-"  .  $zipExtras;
			
		}
		
		
		echo "<br/>Street found = " . (htmlentities($addressLine)) . "<br/>";
		echo "<br/>City found = " . (htmlentities($cityFound)) . "<br/>";
		echo "<br/>State Found = " . (htmlentities($stateFound)) . "<br/>";
		echo "<br/>Zip Found = " . (htmlentities($zipFound)) ;
		
		
		
		
		
		
		#echo "<br/><br/>DUMP " . print_r($storedHTML) . "<br/>";
		
		$addressfound = 1;
		
		
		
		
	}
	
	return $addressFound;
	
}
	



?>
