<?php
	
	
	
/*######################################################################################################### 		NOTES 		###########################################################################################################################

#$sql = "CREATE TABLE $table (ID int,Name varchar(255),Email varchar(255))";
#$sql = "DROP TABLE $table";			
#@mysql_query ($sql) or die ("Error : " . mysql_error());
#$sql = "CREATE TABLE $table (
				ID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
				Username varchar(255),
				Password varchar(255))";
			
@mysql_query ($sql) or die ("Error : " . mysql_error());
#$sql = "ALTER TABLE user ADD COLUMN PageViews int";
#@mysql_query ($sql) or die ("Error : " . mysql_error());
			
			
########################################################################################################### 		NOTES 		###########################################################################################################################
*/


##########################################SUBROUTINE

function connectSQL($table){
		
		$db_host = "localhost";
		$db_username = "justinha_manager";
		$db_pass = "sailing6650";
		$db_name = "justinha_users";

		
		if (!mysql_connect($db_host, $db_username, $db_pass)) die("Can't connect to database");

		if (!mysql_select_db($db_name)) die("Can't select database");	
		
		
		
}
	
	


?>



