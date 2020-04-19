function cacher(id)
{
    document.getElementById(id).style.display ="none";
}
function afficher(id)
{
      document.getElementById(id).style.visibility="visible";
}
function Recherche_nav_bar()
{
	recherche=document.getElementById('search').value;
	Recherche(null,null,recherche);
}
function Recherche(categorie,type_achat,recherche)
  {
    window.open("Recherche.php?categorie="+categorie+"&type_achat="+type_achat+"&recherche="+recherche,"_self");
  }
function RechercheUtilisateur(type_utilisateur)
  {
    window.open("Recherche_utilisateur.php?type_utilisateur="+type_utilisateur+"","_self");
  }
function lancement_page(ID)
  {
    window.open("page_objet.php?id_objet="+ID,"_self");
  } 
function lancement_suppr(ID)
  {
    window.open("page_utilisateur.php?id="+ID,"_self");
  } 