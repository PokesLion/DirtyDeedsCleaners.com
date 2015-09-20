<?php


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