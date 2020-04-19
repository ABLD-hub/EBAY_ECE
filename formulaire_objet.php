<?php 
session_start(); 
?>
<!DOCTYPE html>

<html>
  <head>
      <title>Mise en vente d'un objet</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="style.css">
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
      <script type="text/javascript" src="formulaire_objet.js"></script>
  </head>
  <body onload="param_input_date__enchere();">
      <?php include 'navbar.html'; ?>
      <div align="center">
        <div id="fond_formulaire" class="col-sm-6" align="center">
          <!-----Titre Formulaire---->
          <p style="font-size: 40px" align="center">Mise en vente d'un objet</p>

          <!-----Création du formulaire avec un appel d'un fichier .php---->
          <form action="stockage_objet.php" method="post" id="formulaire_objet" enctype="multipart/form-data" align="center">

            <!-----Création d'un tableau contenant les différents champs du formulaire---->
            <table style="padding: 60px;" align="center" id="formulaire_nouvel_utilisateur">

              <!-----Ligne du tableau contenant le champ pour obtenir le nom de l'objet---->  
              <tr>
                <td align="left">Nom de l'objet :</td>
                <td><input type="text" class="form-control" name="nom" required></td>
              </tr>

              <!------Ligne du tableau contenant le champ description---->
              <tr>
                <td align="left" valign="top">Description (qualités/défauts):</td>
                <td><textarea class="form-control" name="description" required></textarea></td>
              </tr>

              <!------Ligne du tableau contenant le champ pour selectionner les photos---->
              <tr>
                <td align="left" valign="top">Photos de l'objet :</td>
                <td align="left">
					<input type="button" value="+" onclick="ajout_input_image()">
					<input type="button" value="-" onclick="suppression_input_image()"><br>
					<input type="file" name="photo_1" id="photo_1" accept="image/*" ><br>
					<input type="file" name="photo_2" id="photo_2" accept="image/*" style="display: none;"><br id="a_la_ligne" style="display: none;">
					<input type="file" name="photo_3" id="photo_3" accept="image/*" style="display: none;">
				<p><strong>Note :</strong> Ne sont autorisés que les formats .jpg, .jpeg, .gif et .png avec une taille maximale de 5 Mo.</p>
				</td>
              </tr>

              <!------Ligne du tableau contenant le champ pour selectionner la vidéo---->
              <tr>
                <td align="left" valign="top">Vidéo :</td>
                <td align="left">
                  <input type="radio" name="choix_video" id="upload" onclick="type_video()" checked> Upload vidéo<br>
                  <input type="file" name="video_upload" id="video_upload" accept="video/mp4">
				  <p><strong>Note :</strong> Ne sont autorisés que le format .mp4 avec une taille maximale de 50 Mo.</p>
                </td>
              </tr>

              <!------Ligne du tableau contenant le champ pour selectionner la catégorie---->
              <tr>
                <td align="left" valign="top">Catégorie :</td>
                <td align="left">
				
                <!------Appel du php pour envoyer une requete pour récupérer les differentes catégorie contenues dans la base de données---->
                <?php
                $database="ebay_ece";
                $db_handle = mysqli_connect('localhost','root','');
                $db_found = mysqli_select_db($db_handle,$database);
                $increment=0;
                if($db_found)
                { 
                  $sql = "SELECT * from categorie";
                  $result = mysqli_query($db_handle, $sql);
                  while($data = mysqli_fetch_assoc($result))//==> nul s'il n'y a plus de ligne dans le tableau
                  { 
                    echo "<input type='radio' name='categorie' value='".$data['id_categorie']."' required>  ".utf8_encode($data['nom'])."<br>";
					echo "<input type='hidden' name='nom_categorie' value='".utf8_encode($data['nom'])."'>";
                  }
                }
                else
                {
                    echo "database not found";
                }
                mysqli_close($db_handle);
                ?>
                </td>
              </tr>

              <!------Ligne du tableau contenant le champ pour selectionner le prix---->
              <tr>
                <td align="left">Prix :</td>
                <td><input type="number" class="form-control" name="prix_initial" placeholder="€" required></td>
				<td>Euros</td>
              </tr>

              <!------Ligne du tableau contenant le champ pour selectionner le type de vente---->
              <tr>
                <td align="left" valign="top">Type de vente :</td>
                <td align="left">
                  <input id="enchere"         type="checkbox" name="enchere"         onclick="verification_type_vente(this)">  Enchère<br>
                  <input id="meilleure_offre" type="checkbox" name="meilleure_offre" onclick="verification_type_vente(this)">  Meilleure offre<br>
                  <input id="achat_immediat"  type="checkbox" name="achat_immediat"                                         >  Achat immédiat<br>
                </td>
              </tr>

              <!------Ligne du tableau qui n'apparait que quand la checkbox enchere est selectionné ci dessus afin de selectionner la date de fin de l'enchère---->
              <tr id="date_fin" style="display: none;">
                <td>Date de fin de l'enchère :</td>
                <td>
                  <input id="date_fin_enchere" type="date" name="date_fin_enchere" class="form-control">
                </td>
              </tr>
              <!------Ligne du tableau contenant le bouton de submit------>
              <tr>
                <td colspan="2" align="center"><input type="submit" class="btn btn-primary" name="submit" value="Mettre en Vente" onmouseover="verification_formulaire()"></td>
              </tr>
            </table>
          </form>
        </div>
      </div>
  </body>
  <?php include 'footer.html'; ?>
</html>