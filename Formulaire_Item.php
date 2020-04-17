<?php session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Ajout Item</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="style.css">
 	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="check.js"></script>
  <style type="text/css">
  
  </style>

</head>
<body>
	
<?php include 'navbar.html'; ?>

  <p style="font-size: 40px" align="center">Mise en vente d'un objet</p>

  <form form action="Formulaire_Item.php" method="post" id="formulaire_item">
   <table style="padding: 60px;" align="center" >


    <tr>
     <td>Nom de l'objet :</td>
     <td><input type="text" class="form-control" id="nom" name="nom"></td>
   </tr>

   <tr>
    <td>Description (qualités/défauts) :</td>
    <td><textarea class="form-control" id="description" name="description"></textarea></td>
  </tr>

  <tr>
    <td>Une ou plusieurs photos de l'objet :</td>
    <td><input type="file"  id="photo" name="photo"></td>
  </tr>

  <tr>
    <td>Vidéo :</td>
    <td><input type="file" id="video" name="video"></td>
  </tr>

  <tr>
    <td>Catégorie :</td>
    <td><!--<input type="radio" name="categorie" value="Ferraille ou Tresor">  Ferraille ou Trésor<br>
      <input type="radio"  name="categorie" value="Bon pour le Musee">  Bon pour le Musée<br>
      <input type="radio"  name="categorie" value="Accessoire VIP">  Accessoire VIP-->
      <?php
      $database="ebayece";
      $db_handle = mysqli_connect('localhost','root','');
      $db_found = mysqli_select_db($db_handle,$database);
      $increment=0;
      if($db_found)
      { 
        $sql = "SELECT * from categorie";
        $result = mysqli_query($db_handle, $sql);
        while($data = mysqli_fetch_assoc($result))//==> nul s'il n'y a plus de ligne dans le tableau
        {
          
          echo "<input type='radio' name='categorie' value='".$data['ID']."' id='categorie_".$increment++."'>  ".utf8_encode($data['nom'])."<br>";
        }
        $sql = "SELECT COUNT(*) from categorie";
        $result = mysqli_query($db_handle, $sql);
        $row = $result->fetch_row();
        echo"<script>set_num_categorie_max(".$row[0].")</script>";

      }
      else
      {
        echo "database not found";
      }
      mysqli_close($db_handle);
      ?>
    </td>
  </tr>

  <tr>
    <td>Prix :</td>
    <td><input type="number" id="prix" class="form-control" name="prix" placeholder="€"></td>
  </tr>
  <tr>
    <td>Type de vente :</td>
    <td>
      <input id="enchere" type="checkbox" name="enchere" onclick="verification_type_vente(this)">  Enchères<br>
      <input id="meilleure_offre" type="checkbox" name="meilleure_offre" onclick="verification_type_vente(this)">  Meilleure offre<br>
      <input id="achat_immediat" type="checkbox" name="achat_immediat">  Achat immédiat<br>
    </td>
  </tr>

  <tr id="date_fin" style="display: none;">
    <td>Date de fin de l'enchère :</td>
    <td>
      <input type="date" name="type_vente" class="form-control">
    </td>
  </tr>

  <tr>
   <td colspan="2" align="center"><input type="button" class="btn btn-primary" name="submit" value="Mettre en Vente" onclick="verification_formulaire()"></td>
 </tr>

</table>
</form>
</center>
</body>
</html>