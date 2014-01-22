window.onload = function(){
	$("submit").observe('click', saveAankoop);
	$("searchArt").observe('keyup', updateListArtikel);
	$("searchBeschrijving").observe('keyup', updateListArtikel);	
	$("searchKlant").observe('keyup', updateListKlant);
	$("searchNaam").observe('keyup', updateListKlant);	
	$("searchWoonplaats").observe('keyup', updateListKlant);
	$("hoeveelheid").observe('keyup', updateBedrag);
	
	
	lis = $$("#artikelen > ul > li");
	for(var i=0; i<lis.length; i++)
	{
		lis[i].observe("click",function(){artSelect(this)});
	}
	lis = $$("#klanten > ul > li");
	for(var i=0; i<lis.length; i++)
	{
		lis[i].observe("click",function(){klantSelect(this)});
	}
}



var selectedArt = null;
var selectedKlant = null;

/*This functie is called when an artikel is selected in the list*/
function artSelect(art){
	//highlight the selected list element
	if (selectedArt != null)
	{
		selectedArt.className = null;
	}
	selectedArt = art;
	selectedArt.className = "selected";
	
	//perform an Ajax request
	string = art.innerHTML;
	art = string.trim().substring(1).split(" - ");
	updateFieldsArtikel(ajax("mode=getArtikel&artikel="+art[0]));

	
	
	
}

/*This  functieis ois called when a 'klant' is selected in the list*/
function klantSelect(klant){
	//highlight the selected list element
	if (selectedKlant != null)
	{
		selectedKlant.className = null;
	}
	selectedKlant = klant;
	selectedKlant.className = "selected";
	
	//perform an Ajax request
}

/*This functie should be called to update the artikel fields*/
function updateFieldsArtikel(ajax) {

	//call transformIntoArray and update all information fields on the right to display all artikel information
	array = transformIntoArray(ajax);
	
	$("beschrijving").value = array[1];
	$("kleur").value = array[2];
	$("voorraad").value = array[3];
	$("prijs").value = array[4];
	$("srtc").value = array[5];
	$("hoeveelheid").value = 1;
	
	//Create new options for every afdeling	 
	node = $("afd");
	
	while (node.hasChildNodes()) 
	{
		node.removeChild(node.lastChild);
	}
	
	for (i = 6; i < array.length; i++)
	{
		if (array[i]>0)
		{
			var newOption = document.createElement("option");
			newOption.innerHTML = array[i];
			node.appendChild(newOption);
		}		
	}

	updateBedrag();
	 
}

/*Deze functie vult daadwerkelijk de klant velden in*/
function updateFieldsKlant(ajax) {
	//call transformIntoArray and update all information fields on the right to display all klant information
}

/*The bedrag (=hoeveelheid * artikel.prijs) is calculated and displayed in this function*/
function updateBedrag(event){
	$("bedrag").update(parseFloat($("hoeveelheid").value) * parseFloat($("prijs").value));
}

/*This function is called when an artikel is searched using the search fields */
function updateListArtikel(event){


}

/*This function is called when a klant is searched using the search fields*/
function updateListKlant(event){

}


/*
This function performs a Ajax request that connects with server.php where a sale is added
*/
function saveAankoop(){
	
}

/*When a sale is done, update the list of 'verkopen', using Scriptaculous!!!*/
function updateVerkopen(ajax){

}

function transformIntoArray(accessoriesString) {
    return accessoriesString.strip().split(";");
}


function ajax(string) 
{
	//IE6 and prior IE versions use Microsoft.XMLHTTP instead
	var ajax = new XMLHttpRequest();

	//retrieve data from URL (file) of interest
	//false parameter: synchronous request
	ajax.open('GET', 'server.php?'+string, false);
	ajax.send(null);

	//response data in ajax.responseText
	return ajax.responseText;
}

function ajaxFailure(ajax, exception) {
	alert("Error making Ajax request:" + 
		"\n\nServer status:\n" + ajax.status + " " + ajax.statusText + 
		"\n\nServer response text:\n" + ajax.responseText);
	if (exception) {
		throw exception;
	}
}
