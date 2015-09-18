<?php



#session_start();

function htmlHeader(){
	?>

	<?	
		
	global $javascript, $script , $skipAdminTool, $map, $head;

	if (!$head){
		?>

	<head>
		<link href="http://dirtydeedscleaners.com/theme.css" rel="stylesheet" type="text/css"/>
		<link rel="shortcut icon" href="ddsymbol_tnF_icon.ico" />

	
			<meta charset="utf-8" />
			<title>Homepage, Welcome to Dirty Deeds Cleaners</title><!--  This is a used for every page, Consider using javascript to change the title for SEO -->
					
			<!--  Use a global variable to Send javascript onto <script></script> if there is the variable==TRUE    <link href="theme.css" rel="stylesheet" type="text/css"/> -->		
			
			<?php
			if ($javascript){
				echo '		<script type="text/javascript">
				' . $javascript . '</script>';
				
			}
			if ($script){
				echo $script;
				
			}
			
			?>
		</head>
	<body>				
			<!-- 			Google Analyitics 			-->
		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m) 
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		  ga('create', 'UA-65632512-1', 'auto');
		  ga('send', 'pageview');

		</script>
		
		

	
		
		<div id="wrapper">
	<?
		if ($_SESSION{'administrator'}){

			?>
			<div id="adminButton" class="whitePadding">
				<a href="admin.php">administrator</a>
			</div>			
			<?
			
		}
	?>
			
			<div id="content">
		
	<?
		
			
	}
	
	?>
				<header id="primary" >
					
					<h3>
						<table width="100%" style="position:relative;" height="100%">
							<td width="25%"></td>
							<td width="40%"><b><a id="logo" href="http://dirtydeedscleaners.com/index.php"><u>Dirty Deeds Cleaners</u></a></b></td>
							<td width="5%"><span id="else">
	<?php
	#
	#	This php is used to send the proper link for login and logout
	#

	global $currentPage;
	if ($currentPage != "loginPage" && !$_SESSION['loggedIn']){

		echo '<a href="loginPage.php">Login</a>';
	}				

	if ($_SESSION['loggedIn']){

	
	
		echo "<a href=\"http://dirtydeedscleaners.com/logout.php\">Logout</a>";

	}?>
							</td>
							<td width="5%" align="right"><a id="else" href="http://dirtydeedscleaners.com/contact.php">Help</a></td>
							<td width="25%"></td>
						</table>				
					</h3>
				</header> 
				<div id="spacer"></div>  <!--  This is a black spacer with width 100%-->
			
	<?php

	# If sidebar is present Create 2 white sidebars
	global $sidebar;

	if ($sidebar){
		
		echo '<div id="sidebar">';
		
	}
		
		
	
	if ($sidebar){	
		echo "</div>
		";
	}	


	#Currently in <DIV wrapper><DIV content>  
	
}




function htmlBody(){
	/*
					
					
					
					
					<table id="menu">
						<th colspan="3">Info:</th><tr></tr>
						<td>
						<link><a href="about.php">|   Why choose us?   |</a></link>
						</td>
						<td>
							<link><a href="serviceMap.php">|   Service Map   |</a></link>
						</td>
						
						<td>			
						<link><a href="missionStatement.php">|   Mission Statement   |</a></link>
						</td><tr></tr>
						<td>
						<link><a href="references.php">|   References   |</a></link>
						</td>
						<td>
						<link><a href="contact.php">|   Contact   |</a></link>
						</td>
					</table>
				*/

	
?>

	<div id="main">

		<center>

		<table> 
			<td class="round" width="30%" height="50px" style="background-color:white;" valign="middle">
				
				<a id="appointmentLink" href="scheduleAppointment.php">
					<center><span >Make an appointment</span></center>			
				</a>
				
			</td>			
			<tr />
			<td width="30%" height="150px">View Services</td>			
		</table>

		</center>

	</div>
				
        
<?php
	



}


function htmlEnd(){	
	
		#end if div id="content"
		?>
			</div>	
			<div id="footer">	

				
				
				<?
				if ($_SESSION['administrator'] && !$skipAdminTool){			
				
					?>
					
					
					
					
					<?
				}
				#Old way of printing errors
				#$print = "Today is " . date("m/d/Y");#Time : " . date("h:i:s") . "<br>
				#
				#echo "<p>" . $_SESSION['printString']  .  "</p>";			
				
				?>	
			</div>
		</div>
	
	</body>

	
		<?
	
	
}

?>