function cacher(id)
{
    document.getElementById(id).style.display ="none";
}
function afficher(id)
{
      document.getElementById(id).style.visibility="visible";
}

function Recherche(categorie,type_achat)
  {
    window.open("Recherche.php?categorie="+categorie+"&type_achat="+type_achat+"","_self");
  }
 function RechercheUtilisateur(type_utilisateur)
  {
    window.open("Recherche_utilisateur.php?type_utilisateur="+type_utilisateur+"","_self");
  }
function lancement_page(categorie,type_achat,ID)
  {
    window.open("page_objet.php?categorie="+categorie+"&type_achat="+type_achat+"&id="+ID,"_self");
  }
 function lancement_suppr(ID)
  {
    window.open("page_utilisateur.php?id="+ID,"_self");
  } 
