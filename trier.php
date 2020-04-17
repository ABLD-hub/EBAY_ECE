<?php

	session_start();
	$bdd= "item";
	$table="categorie";
	$database="ebayece";
	$db_handle = mysqli_connect('localhost', 'root', '');
	$db_found = mysqli_select_db($db_handle, $database);
	if ($_POST["select"])
{
	if ($db_found) {
		$sql = "SELECT * FROM $bdd WHERE id_categorie=$_POST["select"]";
			$result = mysqli_query($db_handle, $sql);
			if (mysqli_num_rows($result) == 0) {
				echo 'mot de passe ou utilisateur incorrect';
					exit();
			}

				else {
						$_SESSION['email']=$mail;
						while($data = mysqli_fetch_assoc($result))
						{
							$_SESSION['nom']=$data['nom'];
							$_SESSION['prenom']=$data['prenom'];
							$_SESSION['pseudo']=$data['pseudo'];
							$_SESSION['mot_de_passe']=$data['mot_de_passe'];
							$_SESSION['type_utilisateur']=$data['type_utilisateur'];
							$_SESSION['numero_carte']=$data['numero_carte'];
							$_SESSION['mot_de_passe']=$data['mot_de_passe'];
							$_SESSION['type_carte']=$data['type_carte'];
							$_SESSION['date_expiration']=$data['date_expiration'];
						}
						echo $_SESSION['email'];
						echo $_SESSION['type_utilisateur'];
						session_write_close();
						header('Location: accueil.php');
						exit();
					 } 
	}
	else {  echo "Database not found";}
	mysqli_close();
}

?>