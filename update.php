<?php 
session_start();?>


<?php
//echo "test";
$id_utilisateur=$_SESSION["id_utilisateur"];
$mail = isset($_POST["email"])? $_POST["email"] : "";
if($mail=="")
{
	$mail=$_SESSION['email'];
}
$nom = isset($_POST["nom"])? $_POST["nom"] : "";
if($nom=="")
{
	$nom=$_SESSION['nom_utilisateur'];
}
$prenom = isset($_POST["prenom"])? $_POST["prenom"] : "";
if($prenom=="")
{
	$prenom=$_SESSION['prenom_utilisateur'];
}
$pseudo = isset($_POST["pseudo"])? $_POST["pseudo"] : "";
if($pseudo=="")
{
	$pseudo=$_SESSION['pseudo'];
}
$mdp = isset($_POST["password"])? $_POST["password"] : "";
if($mdp=="")
{
	$mdp=$_SESSION['mot_de_passe'];
}
$statut = isset($_POST["statut"])? $_POST["statut"] : "";
if($statut=="")
{
	$statut=$_SESSION['type_utilisateur'];
}
$adresse_ligne_1 = isset($_POST["adresse_ligne_1"])? $_POST["adresse_ligne_1"] : "";
if($adresse_ligne_1=="")
{
	$adresse_ligne_1=$_SESSION['adresse_ligne_1'];
}
$adresse_ligne_2 = isset($_POST["adresse_ligne_2"])? $_POST["adresse_ligne_2"] : "";
if($adresse_ligne_2=="")
{
	$adresse_ligne_2=$_SESSION['adresse_ligne_2'];
}
$adresse_ville = isset($_POST["adresse_ville"])? $_POST["adresse_ville"] : "";
if($adresse_ville=="")
{
	$adresse_ville=$_SESSION['adresse_ville'];
}
$adresse_code_postal = isset($_POST["adresse_code_postal"])? $_POST["adresse_code_postal"] : "";
if($adresse_code_postal=="")
{
	$adresse_code_postal=$_SESSION['adresse_code_postal'];
}
$adresse_pays = isset($_POST["adresse_pays"])? $_POST["adresse_pays"] : "";
if($adresse_pays=="")
{
	$adresse_pays=$_SESSION['adresse_pays'];
}
$no_telephone = isset($_POST["no_telephone"])? $_POST["no_telephone"] : "";
if($no_telephone=="")
{
	$no_telephone=$_SESSION['no_telephone'];
	if($no_telephone=="")
	{
		$no_telephone='NULL';
	}
}
$type_carte = isset($_POST["Choice"])? $_POST["Choice"] : "";
if($type_carte=="")
{
	$type_carte=$_SESSION['carte_type'];
}
$carte_numero = isset($_POST["numero_carte"])? $_POST["numero_carte"] : "";
if($carte_numero=="")
{
	$carte_numero=$_SESSION['carte_numero'];
}
$carte_nom = isset($_POST["carte_nom"])? $_POST["carte_nom"] : "";
if($carte_nom=="")
{
	$carte_nom=$_SESSION['carte_nom'];
}
$carte_date_expiration = isset($_POST["carte_date_expiration"])? $_POST["carte_date_expiration"] : "";
if($carte_date_expiration=="")
{
	$carte_date_expiration=$_SESSION['carte_date_expiration'];
	if($carte_date_expiration=="")
{
	$carte_date_expiration='NULL';
}
}
$carte_code = isset($_POST["carte_code"])? $_POST["carte_code"] : "";
if($carte_code=="")
{
		if($carte_code=="")
		{
			$carte_code='NULL';
		}
}
$database = "ebay_ece";


$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);
if ($_POST["submit"])
{
	if ($db_found) {
			$sql ="UPDATE utilisateur SET email='$mail', nom_utilisateur='$nom', prenom_utilisateur='$prenom', pseudo='$pseudo', mot_de_passe='$mdp', type_utilisateur='$statut', adresse_ligne_1='$adresse_ligne_1', adresse_ligne_2='$adresse_ligne_2', adresse_ville='$adresse_ville', adresse_pays='$adresse_pays', no_telephone=$no_telephone, carte_type='$type_carte', carte_numero='$carte_numero', carte_nom='$carte_nom', carte_date_expiration=$carte_date_expiration WHERE id_utilisateur='$id_utilisateur'";
			$result = mysqli_query($db_handle, $sql);
							$_SESSION['nom_utilisateur']=$nom;
							$_SESSION['prenom_utilisateur']=$prenom;
							$_SESSION['pseudo']=$pseudo;
							$_SESSION['email']=$mail;
							$_SESSION['mot_de_passe']=$mdp;
							$_SESSION['type_utilisateur']=$statut;
							//$_SESSION['lien_photo_utilisateur']=$data['lien_photo_utilisateur'];
							//$_SESSION['lien_photo_fond']=$data['lien_photo_fond'];
							$_SESSION['adresse_ligne_1']=$adresse_ligne_1;
							$_SESSION['adresse_ligne_2']=$adresse_ligne_2;
							$_SESSION['adresse_ville']=$adresse_ville;
							$_SESSION['adresse_code_postal']=$adresse_code_postal;
							$_SESSION['adresse_pays']=$adresse_pays;
							$_SESSION['no_telephone']=$no_telephone;
							$_SESSION['carte_type']=$type_carte;
							$_SESSION['carte_numero']=$carte_numero;
							$_SESSION['carte_nom']=$carte_nom;
							$_SESSION['carte_date_expiration']=$carte_date_expiration;
							$_SESSION['carte_code']=$carte_code;
						echo $sql;
							session_write_close();
							header('Location: accueil.php');
							exit();
		}
		
	}
	else {  echo "Database not found";}
	mysqli_close($db_handle);

		
		?>	