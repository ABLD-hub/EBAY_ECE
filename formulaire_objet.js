
// Fonction qui définie la date au plus tôt de la fin de l'enchère
function param_input_date__enchere() {
	var now = new Date();

	var mois = ("0" + (now.getMonth() + 1)).slice(-2);	
	var jour = ("0" + (now.getDate() + 1 )).slice(-2);
	var today = now.getFullYear() + "-" + mois + "-" + jour;

	document.getElementById('date_fin_enchere').setAttribute("min", today); 
	document.getElementById('date_fin_enchere').setAttribute("value", today); 
}
	
function type_video() {
	if(document.getElementById("upload").checked)
	{
	  $('#video_yt').css('display','none');
	  $('#video_upload').css('display','');
	}
	if(document.getElementById("youtube").checked)
	{
	  $('#video_yt').css('display','');
	  $('#video_upload').css('display','none');
	}
}

function verification_type_vente(object)
{
	if(document.getElementById("enchere").checked && document.getElementById("meilleure_offre").checked)
	{
		if(object.id=="enchere")
			document.getElementById("meilleure_offre").checked=false;

		if(object.id=="meilleure_offre")
			document.getElementById("enchere").checked=false;

		alert("Votre objet ne peut être à la fois mis en vente par enchère et par meilleure offre !!!");
	}
	if(!document.getElementById("enchere").checked){
		$('#date_fin').css('display', 'none');
	}
	else {
		$('#date_fin').css('display', '');
	}
}
      
function verification_formulaire() {
	enchere=document.getElementById("enchere").checked;
	meilleure_offre=document.getElementById("meilleure_offre").checked;
	achat_immediat=document.getElementById("achat_immediat").checked;
	date=
	erreur="";
	if(!meilleure_offre && !achat_immediat && !enchere)
		erreur+="Merci de mettre un/des types d'achats pour votre objet.\n";
	if(erreur!="")
		alert(erreur);
}
	  
// Permet d'ajouter une photo	  
var i=2;
function ajout_input_image() { 
	$('#photo_'+i).css('display', '');
	$('#photo_'+i).attr('disabled', false);
	$('#a_la_ligne').css('display', '');
	$('#a_la_ligne').attr('disabled', false);
	if (i<3)
		i++;
}

// Permet de supprimer une photo
function suppression_input_image() {  
	$('#photo_'+i).css('display', 'none');
	$('#photo_'+i).attr('disabled', true);
	$('#a_la_ligne').css('display', 'none');
	$('#a_la_ligne').attr('disabled', true);
	if (i>2)
		i--;
}


