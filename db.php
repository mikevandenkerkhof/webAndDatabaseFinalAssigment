<?php


	$mysqlhost = "sql.ewi.tudelft.nl"; 
	$user = "username";
	$passwd = "passwd";
	
	
	$mysql = mysql_connect($mysqlhost, $user, $passwd);
	if (!$mysql) {
		die('Could not connect: ' . mysql_error());
	}

	mysql_select_db('NAME');


?>