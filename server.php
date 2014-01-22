<?php
include_once("db.php");

if (isset($_REQUEST['mode']) && $_REQUEST['mode']=='getArtikel'){
	$art = $_REQUEST['artikel'];
	//Request all the information from an article
	
	
}

else if (isset($_REQUEST['mode']) && $_REQUEST['mode']=='getKlant'){
	//Request all the information from an customer
}


else if(isset($_REQUEST['mode']) && $_REQUEST['mode']=='saveAankoop'){
	//Save a purchase to the database
}

?>