<?php



	require ('main.php');	# MUST RUN FUNCTIONS BEFORE HTML.PHP!!!!!!!
	

	############################				SIDEBAR
	#		Display 	$_SESSION['collaborateMessage'] 			within div sidebar2
	
	$message = $_SESSION['emailMessage'];
	$error = $_SESSION['emailErrorMessage'];
	$data = $_SESSION['dataused1'];
	
	############################				END SIDEBAR
	
	$emailSender = $_SESSION['emailErrorSender'];
	$emailSenderContact = $_SESSION['emailErrorContact'];
	$emailSubject = $_SESSION['emailErrorSubject'];
	$emailContent = $_SESSION['emailErrorContent'];
	
	?>
	
	
		<div id="main" class="center">
			<div id="emailWrapper">
			<p><center><h2>Email me</h2></center></p>
			
			<form action="process.php" method="post">
				<table align="center" id="emailTable" cellspacing="10">				
					<tr>
						<td id="emailStuff" class="whitePadding">Name</td>
						<td ><input type="text" name="emailSenderName"  class="whitePadding" value="<? $emailSender ?>"></td>
					</tr>
					<tr>
						<td id="emailStuff" class="whitePadding">Sender email</td>
						<td><input type="text" name="emailSenderContact"  class="whitePadding" value="<? $emailSenderContact ?>"></td>
					</tr>
					<tr>
						<td id="emailStuff" class="whitePadding">Subject</td>
						<td><input type="text" name="emailSubject"  class="whitePadding" value="<? $emailSubject ?>"></td>
					</tr>	
					<tr>
						<td id="emailStuff" class="whitePadding">Message</td>
						<td><textarea name="emailContent" rows="10" cols="70"  class="whitePadding" value="<? print_r($_SESSION['emailErrorContent']) ?>"></textarea></td>
					</tr>
					<tr>
						<td colspan="2"><input type="Submit" name ="contact" value = "Email" align="right"></td>
					</tr>
					


				
				</table>
			</form>	
			<div id="programming">
	<?
	
	if ($_SESSION['dataused1']){
		echo "		<p>Data = </p>" . $_SESSION['dataused1'];			# 			Displays the data collected
	}
	?>
			</div>		
			<form action="index.php" method="post">
				<p>
					<input type="Submit" value = "Back">
				</p>
			</form>		
			</div>	
		</div>
		
<?

	accessAdmin();		#Creates PrintString 
	
	htmlEnd();
	
	$_SESSION['emailMessage'] = "";
	$_SESSION['emailErrorMessage'] = "";
	$_SESSION['dataused1']			= "";
	
	
	
	
	
?>