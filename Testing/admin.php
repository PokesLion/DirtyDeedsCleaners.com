<?php	
	
	#$sidebar is a global variable that includes sidebars in the page before Main.php
	$sidebar =1;
	$admintool = 1;
	require ('main.php');	# MUST RUN FUNCTIONS BEFORE HTML.PHP!!!!!!!
	
	administrator(); 	#only the admin can stay on this page 		SET   $_SESSION['administrator']


#################################################################################################################################################################################################################################################################################
###################																										WORK SPACE																													#############################
#################################################################################################################################################################################################################################################################################
	

	?>
		<body>
		
			
			<div id="section5">
				
				<table class="admin">
					<td colspan="4"><center><div id="section">Adminstrator Panel 1</div></center></td><tr>
					<td>
						<ul>
							<li>Information							
								<ul>
									<li><a href="userInfo.php">Users </a></li>
									<li><a href="suggestionInfo.php">Suggestions </a></li>
									<li><a href="emailInfo.php">Emails </a></li>
									
								</ul>
							</li>
							<li>Tools
								<ul>
									<li><a href="testPortal.php"> Testing Portal / Version Control</a></li>					
									<li><a href="sqlTable.php">Connect to a database</a></li>
									<li><a href="sqlCommand.php">SQL Commands </a></li>
									<li><a href="recordWork.php"> Record work/ Send Invoice</a></li>
									<li><a href="viewInvoice.php">View Invoice</a></li>
									
								</ul>
							</li>	
							<li>Blank</li>
							<li>Blank</li>
						</ul>						
					
					
					
					</td><tr>
				</table>
				
				
				
				
				<?
				#		adminTool();		has been incorporated
				?>
				
		
		 </div>
		 <br />
		 
		 <div>
		 <center>
		 <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
		 <table id="listToolsUL" width="auto" cellspacing="1">
					<th>Tools</th>
					
					<tr>
						<td ><a href="testPortal.php"><div id="listToolsUL" style="height:100%;width:100%">Testing Portal / Version Control</div></a></td>
					</tr>							
					<tr>
						<td><a href="sqlTable.php"><div id="listToolsUL" style="height:100%;width:100%">Connect to a database</div></a></td>
					</tr>		
					<tr>
						<td><a  href="sqlCommand.php"><div id="listToolsUL" style="height:100%;width:100%">SQL Commands </div></a></td>
					</tr>	
					<tr>
						<td><a  href="recordWork.php"> <div id="listToolsUL" style="height:100%;width:100%">Record work/ Send Invoice</div></a></td>
					</tr>	
					<tr>
						<td><a  href="viewInvoice.php"><div id="listToolsUL" style="height:100%;width:100%">View Invoice</div></a></td>
					</tr>	
						
					</table>
					
					</center>
		 
		 </div>
	<?

	#END #MAIN
	htmlEnd(); #Closes BODY and Opens/closes FOOTER


	
	
	$_SESSION['adminCommandError'] = "";

?>
