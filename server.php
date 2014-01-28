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
	$klant = $_REQUEST['klant'];
	$art = $_REQUEST['art'];
	$hoeveel = $_REQUEST['hoeveel'];
	$afd = $_REQUEST['afd'];
	$aanbet = $_REQUEST['aanbet'];
	$bedrag = $_REQUEST['bedrag'];
	$beschr = $_REQUEST['beschr'];
	$naam = $_REQUEST['naam'];

	$getsql = mysql_query("SELECT MAX(verk) FROM verkoop");
	$verk = mysql_fetch_row($getsql);
	$verk_new = $verk[0] + 1;
	
	if($aanbet == "")
		$aanbet = 0;

	$IN_verkoop = mysql_query(	'INSERT INTO verkoop (verk, art, afd, hoeveelheid, bedrag, klant, datum, aanbet)
								VALUES (	'.$verk_new.',
											'.$art.',
											'.$afd.',
											'.$hoeveel.',
											'.$bedrag.',
											'.$klant.',
											CURDATE(),
											'.$aanbet.' )' );
	
	//Update the itemstock
	$getsql = mysql_query("SELECT voorraad FROM artikel WHERE art = '".$art."'");
	$voorraad = mysql_fetch_row($getsql);
	$voorraad_new = $voorraad[0] - $hoeveel;
	$UPD_artikel = mysql_query( "UPDATE artikel
								SET voorraad = ".$voorraad_new."
								WHERE art = '".$art."'");
	
	//Update the customer debt
	if( $aanbet != 0 )
	{
		$getsql = mysql_query("SELECT schuld FROM klant WHERE klant = '".$klant."'");
		$schuld = mysql_fetch_row($getsql);
		$schuld_new = $schuld[0] + ($bedrag - $aanbet);
		$UPD_artikel = mysql_query( "UPDATE klant
									SET schuld = ".$schuld_new."
									WHERE klant = '".$klant."'");
	}
	
	echo "a".$art." - ".$beschr." - ".$naam;
}

?>