<?php 
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>Ebay ECE </title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet"
 href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
 <link rel="stylesheet" type="text/css" href="style.css">
 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script type="text/javascript" src="check.js">
</script>

</head>
<body>
   <?php if(isset($_SESSION['email'])) {
    echo "la session vaut : ".$_SESSION['email'];
    echo "l'utilisateur vaut : ".$_SESSION['type_utilisateur'];
  }else
{
echo 'pas de variable de session';
} ?>
  
  <?php include 'navbar.html';?>

  <form class="form-group" action="update.php" method="post">
  <div>
    <label>Adresse Email</label>
    <input type="email" name="email"class="form-control" id="ZoneMail" placeholder="<?php echo $_SESSION['email'];?>">
  </div>
  <div class="form-group">
    <label>Nom</label>
    <input type="nom" name="nom" class="form-control" id="ZoneNom" placeholder="<?php echo $_SESSION['nom_utilisateur'];?>">
  </div>
  <div class="form-group">
    <label>Prénom</label>
    <input type="prenom" name="prenom"class="form-control" id="ZonePrenom" placeholder="<?php echo $_SESSION['prenom_utilisateur'];?>">
  </div>
  <div class="form-group">
    <label>Pseudo</label>
    <input type="pseudo" name="pseudo"class="form-control" id="ZonePseudo" placeholder="<?php echo $_SESSION['pseudo'];?>">
  </div>
  <div class="form-group">
    <label>Password</label>
    <input type="password" name="password" class="form-control" id="ZonePassword" placeholder="mot de passe">
  </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="statut" id="ACHETEUR" value="acheteur">
  <label class="form-check-label">
    Acheteur
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="statut" id="VENDEUR" value="vendeur">
  <label class="form-check-label">
    Vendeur
  </label>  
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="statut" id="admin" value="admin" disabled>
  <label class="form-check-label">
    Admin
  </label>
</div>
  
  <div class="form-group">
    <label>Adresse 1</label>
    <input type="adresse_ligne_1" name="adresse_ligne_1"class="form-control" id="ZoneAdresse" placeholder="<?php echo $_SESSION['adresse_ligne_1'];?>">
  </div>
  <div class="form-group">
    <label>Adresse 2</label>
    <input type="adresse_ligne_2" name="adresse_ligne_2"class="form-control" id="ZoneAdresse2" placeholder="<?php echo $_SESSION['adresse_ligne_2'];?>">
  </div>
  <div class="form-group">
    <label>Ville</label>
    <input type="adresse_ville" name="adresse_ville"class="form-control" id="ZoneVille" placeholder="<?php echo $_SESSION['adresse_ville'];?>">
  </div>
  <div class="form-group">
    <label>Code Postal</label>
    <input type="adresse_code_postal" name="adresse_code_postal"class="form-control" id="ZonePostal" placeholder="<?php echo $_SESSION['adresse_code_postal'];?>">
  </div>
  <div class="form-group">
    <label>Pays</label>
    <input type="adresse_pays" name="adresse_pays"class="form-control" id="ZonePays" placeholder="<?php echo $_SESSION['adresse_pays'];?>">
  </div>
  <div class="form-group">
    <label>Téléphone</label>
    <input type="no_telephone" name="no_telephone"class="form-control" id="ZoneTel" placeholder="<?php echo $_SESSION['no_telephone'];?>">
  </div>
  <div class="form-group">
    <label>Type de Carte</label>
    <select class="form-control" id="Choice">
          <option name='Choice'>Visa</option>
          <option name ='Choice'>MasterCard</option>
        </select>
  </div>
  <div class="form-group">
    <label>Num Carte</label>
    <input type="numero_carte" name="numero_carte" readonly class="form-control" id="ZoneNumCard" placeholder="<?php recup_number();?>">
  </div>
 
  <div class="form-group">
    <label>Nom du détenteur</label>
    <input type="carte_nom" name="carte_nom"class="form-control" id="ZoneCarteNom" placeholder="<?php echo $_SESSION['carte_nom'];?>">
  </div>
  <div class="form-group">
    <label>Date Expiration</label>
    <input type="carte_date_expiration" name="carte_date_expiration"class="form-control" id="ZoneExpiration" placeholder="<?php echo $_SESSION['carte_date_expiration'];?>">
  </div>
   <div class="form-group">
    <label>Code</label>
    <input type="carte_code" name="carte_code"class="form-control" id="ZoneCode" placeholder="<?php echo $_SESSION['carte_code'];?>">
  </div>
   <input type="submit" class="btn btn-primary" name="submit" value="Modifier">
</form>
<script type="text/javascript">
  if("<?php echo $_SESSION['type_utilisateur']?>"=="vendeur")
  {
    document.getElementById("VENDEUR").checked= true;
    document.getElementById("ACHETEUR").disabled= true;
  }
  else if("<?php echo $_SESSION['type_utilisateur']?>"=='acheteur')
  {
    document.getElementById("ACHETEUR").checked=true;
    document.getElementById("VENDEUR").disabled=true;
  }
  else if("<?php echo $_SESSION['type_utilisateur']?>"=='admin')
  {
    document.getElementById("ACHETEUR").disabled=true;
    document.getElementById("VENDEUR").disabled=true;
    document.getElementById("Admin").checked=true;
  }
</script>
</body>
<footer> 
  <?php include 'footer.html'; ?>
</footer>