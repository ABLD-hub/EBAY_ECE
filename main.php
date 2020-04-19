<html>
<head>
<title>Ebay ECE </title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="style.css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script type="text/javascript" src="check.js"></script>

<body>
	<?php
		if (isset($_SESSION['type_utilisateur'])=='vendeur'){
			// récupération dans la base de l'image de fond si il y en a une
			$database="ebay_ece";
			$db_handle = mysqli_connect('127.0.0.1','root','');
			$db_found = mysqli_select_db($db_handle,$database);
			if($db_found) { 
				$sql = "SELECT lien_photo_fond from utilisateur where email='" . $_SESSION['email'] . "';";
				$result = mysqli_query($db_handle, $sql);
				while($data = mysqli_fetch_assoc($result))//==> nul s'il n'y a plus de ligne dans le tableau
				{					 
					if ($data['lien_photo_fond']!=NULL){
						// modification du background avec l'image de fond du vendeur
						echo '<div style="background-image: url(upload/photobg.jpg);" class="container-fluid" id="main">';
					}
					else {
						echo '<div class="container-fluid" id="main">';
					}
				}				
			}
			else {
				echo "database not found";
			}
			mysqli_close($db_handle);
		}
		else {
			echo '<div class="container-fluid" id="main">';
		}
	?>
		<div class="row">
			<div id="categories" class="col-sm-12 area" >
				<h1 align="center">Catégories</h1>
				<div class="row">				
					<?php
						$database="ebay_ece";
						$db_handle = mysqli_connect('127.0.0.1','root','');
						$db_found = mysqli_select_db($db_handle,$database);
						$increment=0;
						if($db_found) { 
							$sql = "SELECT * from categorie";
							$result = mysqli_query($db_handle, $sql);
							while($data = mysqli_fetch_assoc($result))//==> nul s'il n'y a plus de ligne dans le tableau
							{					 
							  echo "<input class='button col-sm-4' id='".$data['id_categorie']."' type='submit' name='".$data['id_categorie']."' value='".utf8_encode($data['nom'])."' onclick=Recherche('".$data['id_categorie']."',null,null)>";
							}
						}
						else {
							echo "database not found";
						}
						mysqli_close($db_handle);
					?>	
				</div>
			</div>
			<div id="type_achat" class="col-sm-12 area">
				<h1 align="center">Type d'achats</h1>
				<input class="button" id="Encheres" type="submit" name="Encheres" value="Enchères" onclick="Recherche(null,'vente_par_enchere',null)">
				<input class="button" id="Achat_immediat"  type="submit" name="Achat_immediat" value="Achetez le maintenant !! " onclick="Recherche(null,'vente_immediat',null)">
				<input class="button" id="Meilleure_offre" type="submit" name="Meilleure_offre" value="Meilleure Offre " onclick="Recherche(null,'vente_par_meilleure_offre',null)">
			</div>
		</div>
		<div class="row">
			<div id='vendre' class='col-sm-12 div_button' style='background-color: beige;  border: black; border-radius: 35px; border:green solid 1px; height: 100px;' align='center' onclick="window.open('<?php check_vendeur();?>','_self')"><h1>Vendre un Item</h1>
			  </div>";


		</div>
	</div>
</body>