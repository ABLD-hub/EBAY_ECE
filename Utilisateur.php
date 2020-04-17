<?php 
session_start();?>
<?php

$mail = isset($_POST["email"])? $_POST["email"] : "";
$mdp = isset($_POST["password"])? $_POST["password"] : "";

$database = "ebay_ece";


$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);
if ($_POST["submit"])
{
	if ($db_found) 
	{
		$sql = "SELECT * FROM utilisateur WHERE email LIKE '$mail' AND mot_de_passe LIKE '$mdp'";
			$result = mysqli_query($db_handle, $sql);
			if (mysqli_num_rows($result) == 0) 
			{
				$sql.= "SELECT * FROM utilisateur WHERE pseudo LIKE '$mail' AND mot_de_passe LIKE '$mdp'";
				$result = mysqli_query($db_handle, $sql);
				if (mysqli_num_rows($result) == 0)
				{
					echo 'identifiant incorrect';
					exit();
				}

				else
				{
					$_SESSION['email']=$mail;
						while($data = mysqli_fetch_assoc($result))
						{
							$_SESSION['id_utilisateur']=$data['id_utilisateur'];
							$_SESSION['nom_utilisateur']=$data['nom_utilisateur'];
							$_SESSION['prenom_utilisateur']=$data['prenom_utilisateur'];
							$_SESSION['pseudo']=$data['pseudo'];
							$_SESSION['email']=$data['email'];
							$_SESSION['mot_de_passe']=$data['mot_de_passe'];
							$_SESSION['type_utilisateur']=$data['type_utilisateur'];
							$_SESSION['lien_photo_utilisateur']=$data['lien_photo_utilisateur'];
							$_SESSION['lien_photo_fond']=$data['lien_photo_fond'];
							$_SESSION['adresse_ligne_1']=$data['adresse_ligne_1'];
							$_SESSION['adresse_ligne_2']=$data['adresse_ligne_2'];
							$_SESSION['adresse_ville']=$data['adresse_ville'];
							$_SESSION['adresse_code_postal']=$data['adresse_code_postal'];
							$_SESSION['adresse_pays']=$data['adresse_pays'];
							$_SESSION['no_telephone']=$data['no_telephone'];
							$_SESSION['carte_type']=$data['carte_type'];
							$_SESSION['carte_numero']=$data['carte_numero'];
							$_SESSION['carte_nom']=$data['carte_nom'];
							$_SESSION['carte_date_expiration']=$data['carte_date_expiration'];
							$_SESSION['carte_code']=$data['carte_code'];
						}
						echo $_SESSION['id_utilisateur']."/";
						echo $_SESSION['nom_utilisateur']."/";
						echo $_SESSION['prenom_utilisateur']."/";
						echo $_SESSION['pseudo']."/";
						echo $_SESSION['email']."/";
						echo $_SESSION['mot_de_passe']."/";
						echo $_SESSION['type_utilisateur']."/";
						echo $_SESSION['carte_date_expiration'];
						session_write_close();
						header('Location: accueil.php');
						exit();
				} 		
			}

				else {
						$_SESSION['email']=$mail;
						while($data = mysqli_fetch_assoc($result))
						{
							$_SESSION['id_utilisateur']=$data['id_utilisateur'];
							$_SESSION['nom_utilisateur']=$data['nom_utilisateur'];
							$_SESSION['prenom_utilisateur']=$data['prenom_utilisateur'];
							$_SESSION['pseudo']=$data['pseudo'];
							$_SESSION['email']=$data['email'];
							$_SESSION['mot_de_passe']=$data['mot_de_passe'];
							$_SESSION['type_utilisateur']=$data['type_utilisateur'];
							$_SESSION['lien_photo_utilisateur']=$data['lien_photo_utilisateur'];
							$_SESSION['lien_photo_fond']=$data['lien_photo_fond'];
							$_SESSION['adresse_ligne_1']=$data['adresse_ligne_1'];
							$_SESSION['adresse_ligne_2']=$data['adresse_ligne_2'];
							$_SESSION['adresse_ville']=$data['adresse_ville'];
							$_SESSION['adresse_code_postal']=$data['adresse_code_postal'];
							$_SESSION['adresse_pays']=$data['adresse_pays'];
							$_SESSION['no_telephone']=$data['no_telephone'];
							$_SESSION['carte_type']=$data['carte_type'];
							$_SESSION['carte_numero']=$data['carte_numero'];
							$_SESSION['carte_nom']=$data['carte_nom'];
							$_SESSION['carte_date_expiration']=$data['carte_date_expiration'];
							$_SESSION['carte_code']=$data['carte_code'];
						}
						echo $_SESSION['id_utilisateur']."/";
						echo $_SESSION['nom_utilisateur']."/";
						echo $_SESSION['prenom_utilisateur']."/";
						echo $_SESSION['pseudo']."/";
						echo $_SESSION['email']."/";
						echo $_SESSION['mot_de_passe']."/";
						echo $_SESSION['type_utilisateur']."/";
						echo $_SESSION['carte_date_expiration'];
						session_write_close();
						header('Location: accueil.php');
						exit();
					 } 
	}
	else {  echo "Database not found";}
	mysqli_close($db_handle);
}

		?>	