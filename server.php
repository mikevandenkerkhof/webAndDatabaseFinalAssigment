<?php
include_once("db.php");

if (isset($_REQUEST['mode']) && $_REQUEST['mode']=='getArtikel'){
	$art = $_REQUEST['artikel'];
	
	//Request all the information from an article
	$artikel = mysql_query("SELECT * FROM artikel WHERE art = '".$art."'");
	$afd = mysql_query("SELECT afd FROM verkart WHERE art = '".$art."'");
	$result = mysql_fetch_row($artikel);
	
	foreach ($result as $value)
		echo $value.';';
	
	while ($row = mysql_fetch_row($afd))
		echo $row[0].';';
	
}

else if (isset($_REQUEST['mode']) && $_REQUEST['mode']=='getKlant'){
	$kl = $_REQUEST['klant'];
	
	//Request all the information from an customer
	$klant = mysql_query("SELECT * FROM klant WHERE klant = '".$kl."'");
	$result = mysql_fetch_row($klant);
	
	foreach ($result as $value)
		echo $value.';';
	
}


else if(isset($_REQUEST['mode']) && $_REQUEST['mode']=='saveAankoop'){
	//Save a purchase to the database
}

?>