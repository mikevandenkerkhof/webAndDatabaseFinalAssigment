<?php


	$mysqlhost = "sql.ewi.tudelft.nl"; 
	$user = "johnnywang3";
	$passwd = "aap1992JW";
	
	
	$mysql = mysql_connect($mysqlhost, $user, $passwd);
	if (!$mysql) {
		die('Could not connect: ' . mysql_error());
	}

	mysql_select_db('ti1505_MvdK_JW_3');


?>