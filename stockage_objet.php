<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
<title>Ajout objet</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>

<body>
	<?php include 'navbar.html';?>
	<?php
		/********************************************Récupération des données******************************************************/
		///On récupère les données du formulaire 
		$nom_objet=isset($_POST["nom"])? $_POST["nom"]:"";
		$description=utf8_decode(isset($_POST["description"])? $_POST["description"]:"");
		$prix_initial=isset($_POST["prix_initial"])? $_POST["prix_initial"]:"";
		$categorie=isset($_POST["categorie"])? $_POST["categorie"]:"";
		$nom_categorie=isset($_POST["nom_categorie"])? $_POST["nom_categorie"]:"";
		$enchere=isset($_POST["enchere"])? $_POST["enchere"]:0;
		$achat_immediat=isset($_POST["achat_immediat"])? $_POST["achat_immediat"]:0;
		$meilleure_offre=isset($_POST["meilleure_offre"])? $_POST["meilleure_offre"]:0;
		$date_fin_enchere=isset($_POST["date_fin_enchere"])? $_POST["date_fin_enchere"]:0;
		//echo $date_fin_enchere;
		
		$id_vendeur=$_SESSION['id_utilisateur'];
		///la check box envoie une donnée 'on' ou rien, on transforme donc cela en booléen
		if($enchere)
		  $enchere=1;
		if($achat_immediat)
		  $achat_immediat=1;
		if($meilleure_offre)
		  $meilleure_offre=1;

		/***************************************************Sauvegarde de 3 images max************************************************************/
		for ($i=1; $i < 4; $i++) 
		{  
			// On verifie les erreurs 
			if(isset($_FILES["photo_".$i]) && $_FILES["photo_".$i]["error"] == 0)
			{
				$allowedExts = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
				$filename = $_FILES["photo_".$i]["name"];
				$filesize = $_FILES["photo_".$i]["size"];
				$fileExt = pathinfo($filename, PATHINFO_EXTENSION);

				// on verifie si l'extension du fichier est bien celle d'une image et la taille du fichier <50Mo
				$maxsize = 50 * 1024 * 1024;
				if(!array_key_exists($fileExt, $allowedExts) or $filesize > $maxsize) {
					exit("Erreur: Veuillez sélectionner un fichier image valide ou bien d'une taille inférieure.");
				}
				else{	
					// préparation du nom du fichier avec utilisation d'un timestamp pour éviter les doublons
					$nom_fichier_image[$i] = "photo". $i . "_" . $id_vendeur . "_" . time() . "." . $fileExt;
					///on transfert le fichier dans le dossier upload
					move_uploaded_file($_FILES["photo_".$i]["tmp_name"], "upload/" . $nom_fichier_image[$i]);
				}			
			}
			else {
				$nom_fichier_image[$i] = NULL;
			}
		}		
		
		
		/***************************************************Sauvegarde de la video ************************************************************/	
		// On verifie si il y a des erreurs 
		if(isset($_FILES["video_upload"]) && $_FILES["video_upload"]["error"] == 0)
		{
			$allowedExts = array("mp4" => "video/mp4");
			$filename = $_FILES["video_upload"]["name"];
			$filesize = $_FILES["video_upload"]["size"];
			$fileExt = pathinfo($filename, PATHINFO_EXTENSION);

			// on verifie si l'extension du fichier est bien celle d'une video et la taille du fichier (<50Mo)
			$maxsize = 50 * 1024 * 1024;
			if(!array_key_exists($fileExt, $allowedExts) or $filesize > $maxsize) {
				exit("Erreur: Veuillez sélectionner un fichier video valide ou bien d'une taille inférieure.");
			}
			else{	
				///on transfert le fichier dans le dossier upload
				$nom_fichier_video = "video_" . "_" . $id_vendeur . "_" . time() . "." . $fileExt;				
				move_uploaded_file($_FILES["video_upload"]["tmp_name"], "upload/" . $nom_fichier_video);			
			}		 
		}
		else { 
			$nom_fichier_video = NULL;
		}
				
		//$output="";
		$error="";
		//$data_requete_item="";
		$already_exist=0;
		/************************************************Ouverture BDD***********************************************************/
		$database="ebay_ece";
		$db_handle = mysqli_connect('localhost','root','');
		$db_found = mysqli_select_db($db_handle,$database);

		if($db_found)
		{ 
			/*********************************vérification existence dans la BDD*************************************************/
			$sql = "SELECT DISTINCT * FROM objet WHERE nom_objet LIKE '$nom_objet' AND id_categorie LIKE '$categorie' AND description_objet LIKE '$description' AND prix_initial_objet LIKE '$prix_initial';";
			$result = mysqli_query($db_handle, $sql);
			if(mysqli_num_rows($result)!=0)
			{
				$error.= "Erreur: l'objet existe déjà !<br>Aucune donnéee n'a été ajoutée.<br>";
				$already_exist=1;
			}
			else
			{
			  /******************************Envoi de la requete de création de l'objet dans la bdd*************************/
			  ///création de la requête de sql
			  $sql = "INSERT INTO objet(id_objet,id_utilisateur,nom_objet,id_categorie,description_objet,photo_1,photo_2,photo_3,lien_video,prix_initial_objet,prix_propose,vente_par_enchere,date_fin_enchere,vente_immediat,vente_par_meilleure_offre,statut_vente) VALUES (NULL,'$id_vendeur','$nom_objet','$categorie','$description','$nom_fichier_image[1]','$nom_fichier_image[2]','$nom_fichier_image[3]','$nom_fichier_video','$prix_initial',NULL,'$enchere','$date_fin_enchere',$achat_immediat,$meilleure_offre,'en_vente');";
			  ///récupère le resultat de la requête
			  $result = mysqli_query($db_handle, $sql);
			}
			///on affiche le resultat de la requete
			$output = ' <p style="font-size: 40px" align="center">Mise en vente d\'un objet</p>
						<table align="center">';
			$output.=  '<tr><td align="left">Nom de l\'objet : ' .$nom_objet. '</td></tr>';
			$output.=  '<tr><td align="left">Description : ' .utf8_encode($description). '</td></tr>';
			$output.=  '<tr><td align="left">Prix : ' .$prix_initial. ' euros</td></tr>';
			$output.=  '<tr><td align="left">Catégorie : ' .$nom_categorie. '</td></tr>';
			$output.=  '<tr><td align="left">Type de vente :<ul>';
			if($achat_immediat==1)
				$output.="<li> Achat immédiat </li>";
			if($enchere==1)
				$output.="<li> Enchère </li>";	
			if($meilleure_offre==1)
				$output.="<li> Meilleure offre </li>";
			$output.= '</ul></td></tr>
					   <tr><td align="left">Photos et vidéo :<br>
					   <tr></table><table style="padding: 60px;" align="center">';
			for ($i=1; $i < 4; $i++) 
			{
				if ($nom_fichier_image[$i] != NULL)
					$output.= "<td><img style='height:200px;'src='upload/".$nom_fichier_image[$i]."'></td>";		// affichage de l'image			
			}			
			$output.= '</tr></table></table><table style="padding: 60px;" align="center">';
			if ($nom_fichier_video != NULL){
				$output.= '<tr><td>
						   <video width="400" height="222" controls="controls">';					   
				$output.= '		<source src="upload/'. $nom_fichier_video. '" type="video/mp4" />';
				$output.= '</video></td></tr>';
			}
			$output.= '</table>';
			echo $output;			
		}
		else
		{
			echo "database not found";
			exit;
		}
		if($error!="")
			echo "<div style='margin: 15px; background-color:brown; color:white; border-radius: 10px;' align='center'>".$error."</div>";
		mysqli_close($db_handle);      		
	?>
	<br>
	<div style='margin: 15px; border-radius: 10px;' align='center'>
		<input type='button' onclick="window.open('accueil.php','_self');" value='Retour au menu'>
	</div>
</body>
<?php include 'footer.html'; ?>
</html>