function cacher(id,ID)
{
	//document.write("Jean Michel1");
	if(ID=="")
	{
		document.getElementById(id).style.visibility ="hidden";
	}
	else
    {
      document.getElementById(id).style.visibility="visible";
    }
    //return true;
	//}
}
function Recherche(categorie,type_achat)
  {
    window.open("Recherche.php?categorie="+categorie+"&type_achat="+type_achat+"","_self");
  }
function lancement_page(categorie,type_achat,ID)
  {
    window.open("page_objet.php?categorie="+categorie+"&type_achat="+type_achat+"&id="+ID,"_self");
  } 
var num_categorie_max=0;
      function verification_type_vente(object)
      {
          if(document.getElementById("enchere").checked && document.getElementById("meilleure_offre").checked)
          {
            if(object.id=="enchere")
            {
                document.getElementById("meilleure_offre").checked=false;
            }
            if(object.id=="meilleure_offre")
            {
                document.getElementById("enchere").checked=false;
            }
            alert("Votre objet ne peut être à la fois mis en vente par enchère et par meilleure offre !!!");
          }
          if(!document.getElementById("enchere").checked)
          {
            $('#date_fin').css('display', 'none');
          }
          else
          {
            $('#date_fin').css('display', '');
          }
      }

      /*******************************************************************/
     function verification_formulaire()
      {
        nom=document.getElementById("nom").value;
        description=document.getElementById("description").value;
        prix=document.getElementById("prix").value;
        enchere=document.getElementById("enchere").checked;
        meilleure_offre=document.getElementById("meilleure_offre").checked;
        achat_immediat=document.getElementById("achat_immediat").checked;
        var erreur="";
        var categorie="";
        for(var i=0;i<num_categorie_max;i++)
        {
          if(document.getElementById('categorie_'+i).checked)
          {
            categorie=document.getElementById('categorie_'+i).value;
          }
        }
        if(nom=="")
        {
          erreur+="Merci de remplir le champ nom.\n";
        }
        if(description=="")
        {
          erreur+="Merci de remplir la description de l'objet.\n";
        }
        if(prix=="")
        {
          erreur+="Merci de remplir la description de l'objet.\n";
        }
        if(categorie=="")
        {
          erreur+="Merci de mettre une catégorie pour votre objet.\n";
        }
        if(!meilleure_offre && !achat_immediat && !enchere)
        {
          erreur+="Merci de mettre un/des types d'achats pour votre objet.\n";
        }
        if(erreur=="")
        {   alert(categorie);
            window.open("Sauvegarde_objet.php?nom="+nom+"&description="+description+"&prix="+prix+"&categorie="+categorie+"&meilleure_offre="+meilleure_offre+"&achat_immediat="+achat_immediat+"&enchere="+enchere,"_self");
        }
        else
        {
          alert(erreur);
        }
      }
      function set_num_categorie_max(max)
      {
          num_categorie_max=max;
      }