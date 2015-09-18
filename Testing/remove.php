<?php


	session_start();
	
	setcookie("001" , "", time() - 3600);
	setcookie("002" , "", time() - 3600);
	

	unset($_COOKIE['001']);
	unset($_COOKIE['002']);
	setcookie('001', null, -1, '/');
	setcookie('002', null, -1, '/');
	
	$_SESSION{'cookieRemove'} =1;
	
	$_SESSION{'cookieRemoveCounter'}++;
	

?>
	
	
	<script type="text/javascript">
		window.location.assign('loginPage.php');

	</script>