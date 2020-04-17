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
function lancement_page(categorie,type_achat,ID)
  {
    window.open("page_objet.php?categorie="+categorie+"&type_achat="+type_achat+"&id="+ID,"_self");
  } 