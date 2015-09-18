<?php


	require('main.php');	
	
	administrator();	
	
	
	
	$url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];

	if (preg_match("/testing/i" , $url )){
		$match =1;	
		
	}
	
	?>
	<br />
	<div id="main">
		<p width="50%" style="text-align:center;font-size:20;color:green; Background-color:white;font-weight:bold"> Status 
			
			<?
			if ($match ){
				
				
				?>		
					
				<span style="color:blue">Testing</span>	
				<?
				
			}else{
				
				?>
				<span style="color:red">Live</span>	
				<?
			}
			?>
			
			<table>
				<th>Switcher Supreme</th>
				<tr>
					<td>Switch to </td><td><a href="/testing/testPortal.php">Testing</a></td>
				</tr>
				<tr>
					<td>Switch to </td><td><a href="/../testPortal.php">Live</a></td>
				</tr>
			</table>
			
			
			
			


		</p>
	</div>
	<?
	
	
	htmlEnd();
	
	
	
	
?>
