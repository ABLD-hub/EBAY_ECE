<!DOCTYPE html>
<html>
<head>
	<title>Ajout Item</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="styles.css">
 	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <style type="text/css">
  td
    {
      padding: 5px;
    }
  </style>
  <script type="text/javascript">
      function verification(object)
      {
          if(document.getElementById("enchere").checked && document.getElementById("meilleure_offre").checked)
          {
            if(object.id=="enchere")
            {
                document.getElementById("meilleure_offre").checked=false;
            }
            if(object.id=="meilleure_offre")
            {
                document.getElementById("enchere").checked=false;
            }
            alert("Votre objet ne peut être à la fois mis en vente par enchère et par meilleure offre !!!");
          }
          if(!document.getElementById("enchere").checked)
          {
            $('#date_fin').css('display', 'none');
          }
          else
          {
            $('#date_fin').css('display', '');
          }
      }
  </script>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="accueil.html">ECE Ebay</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Mettre en vente<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Bon Plan</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Mon Panier</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Connexion</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Mon Compte
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">Mon Compte</a>
            <a class="dropdown-item" href="#">Récemment regardé</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Mes Commandes</a>
          </div>
        </li>

      </ul>
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>
  </nav>
  <p style="font-size: 40px" align="center">Mise en vente d'un objet</p>
  <form>
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
    <td><input type="radio" name="categorie" value="Ferraille ou Tresor">  Ferraille ou Trésor<br>
      <input type="radio" name="categorie" value="Bon pour le Musee">  Bon pour le Musée<br>
      <input type="radio" name="categorie" value="Accessoire VIP">  Accessoire VIP
    </td>
  </tr>
  <tr>
    <td>Prix :</td>
    <td><input type="number" class="form-control" name="prix" placeholder="€"></td>
  </tr>
  <tr>
    <td>Type de vente :</td>
    <td>
      <input id="enchere" type="checkbox" name="enchere" onclick="verification(this)">  Enchères<br>
      <input id="meilleure_offre" type="checkbox" name="meilleure_offre" onclick="verification(this)">  Meilleure offre<br>
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
   <td colspan="2" align="center"><input type="button" class="btn btn-primary" name="submit" value="Mettre en Vente"></td>
 </tr>
</table>
</form>
</center>
<?php
  $nom = isset($_POST["nom"])? $_POST["nom"]:"";
  $description = isset($_POST["description"])? $_POST["description"]:"";
  $categorie = isset($_POST["categorie"])? $_POST["categorie"]:"";
  $enchere = isset($_POST["enchere"])? $_POST["enchere"]:"";
  $meilleure_offre = isset($_POST["meilleure_offre"])? $_POST["meilleure_offre"]:"";
  $achat_immediat = isset($_POST["achat_immediat"])? $_POST["achat_immediat"]:"";
  echo $enchere;
  $erreur="";

  /*if($nom=="")
  {
    $erreur.="Vous devez donnez le nom de votre objet à vendre.<br>";
  }
  if($description=="")
  {
    $erreur.="vous devez donnez une description à votre objet.<br>";
  }
  if($categorie=="")
  {
    $erreur.="vous devez donnez une catégorie à votre objet.<br>";
  }
  if($enchere)
  {
    $erreur.="vous devez donnez une description à votre objet.<br>";
  }*/


?>
</body>
</html>