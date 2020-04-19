<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
	<title>Catégories</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="style.css">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>  
</head>
<body>

<?php include 'navbar.html';?>
<?php
$id=$_GET['id'];
$database="ebay_ece";
$db_handle = mysqli_connect('localhost','root','');
$db_found = mysqli_select_db($db_handle,$database);
if($db_found)
{ 
  echo "<div class='container-fluid' style='padding:10px;'>";
    $sql = "SELECT * from utilisateur where (id_utilisateur='".$id."')";
  $result = mysqli_query($db_handle, $sql);
  while($data = mysqli_fetch_assoc($result))//==> nul s'il n'y a plus de ligne dans le tableau
  {
              $_SESSION['id_utilisateur']=$data['id_utilisateur'];
              $nom_utilisateur=$data['nom_utilisateur'];
              $prenom_utilisateur=$data['prenom_utilisateur'];
              $pseudo=$data['pseudo'];
              $email=$data['email'];
              $mot_de_passe=$data['mot_de_passe'];
              $type_utilisateur=$data['type_utilisateur'];
              $lien_photo_utilisateur=$data['lien_photo_utilisateur'];
              $lien_photo_fond=$data['lien_photo_fond'];
              $adresse_ligne_1=$data['adresse_ligne_1'];
              $adresse_ligne_2=$data['adresse_ligne_2'];
              $adresse_ville=$data['adresse_ville'];
              $adresse_code_postal=$data['adresse_code_postal'];
              $adresse_pays=$data['adresse_pays'];
              $no_telephone=$data['no_telephone'];
              $carte_type=$data['carte_type'];
              $carte_numero=$data['carte_numero'];
              $carte_nom=$data['carte_nom'];
              $carte_date_expiration=$data['carte_date_expiration'];
              $carte_code=$data['carte_code'];
}
}
?>
<form class="form-group" action="update.php" method="post">
  <div>
    <label>ID</label>
    <input type="id_utilisateur" name="id_utilisateur"class="form-control" id="ZoneID" placeholder="<?php echo $id;?>" readonly>
  </div>
  <div>
    <label>Adresse Email</label>
    <input type="email" name="email"class="form-control" id="ZoneMail" placeholder="<?php echo $email;?>">
  </div>
  <div class="form-group">
    <label>Nom</label>
    <input type="nom" name="nom" class="form-control" id="ZoneNom" placeholder="<?php echo $nom_utilisateur;?>">
  </div>
  <div class="form-group">
    <label>Prénom</label>
    <input type="prenom" name="prenom"class="form-control" id="ZonePrenom" placeholder="<?php echo $prenom_utilisateur;?>">
  </div>
  <div class="form-group">
    <label>Pseudo</label>
    <input type="pseudo" name="pseudo"class="form-control" id="ZonePseudo" placeholder="<?php echo $pseudo;?>">
  </div>
  <div class="form-group">
    <label>Password</label>
    <input type="password" name="password" class="form-control" id="ZonePassword" placeholder="<?php echo $mot_de_passe;?>">
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
  <input class="form-check-input" type="radio" name="statut" id="admin" value="admin">
  <label class="form-check-label">
    Admin
  </label>
</div>
  <div class="form-group">
    <label>Adresse 1</label>
    <input type="adresse_ligne_1" name="adresse_ligne_1"class="form-control" id="ZoneAdresse" placeholder="<?php echo $adresse_ligne_1;?>">
  </div>
  <div class="form-group">
    <label>Adresse 2</label>
    <input type="adresse_ligne_2" name="adresse_ligne_2"class="form-control" id="ZoneAdresse2" placeholder="<?php echo $adresse_ligne_2;?>">
  </div>
  <div class="form-group">
    <label>Ville</label>
    <input type="adresse_ville" name="adresse_ville"class="form-control" id="ZoneVille" placeholder="<?php echo $adresse_ville;?>">
  </div>
  <div class="form-group">
    <label>Code Postal</label>
    <input type="adresse_code_postal" name="adresse_code_postal"class="form-control" id="ZonePostal" placeholder="<?php echo $adresse_code_postal;?>">
  </div>
  <div class="form-group">
    <label>Pays</label>
    <input type="adresse_pays" name="adresse_pays"class="form-control" id="ZonePays" placeholder="<?php echo $adresse_pays;?>">
  </div>
  <div class="form-group">
    <label>Téléphone</label>
    <input type="no_telephone" name="no_telephone"class="form-control" id="ZoneTel" placeholder="<?php echo $no_telephone;?>">
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
    <input type="carte_nom" name="carte_nom"class="form-control" id="ZoneCarteNom" placeholder="<?php echo $carte_nom;?>">
  </div>
  <div class="form-group">
    <label>Date Expiration</label>
    <input type="carte_date_expiration" name="carte_date_expiration"class="form-control" id="ZoneExpiration" placeholder="<?php echo $carte_date_expiration;?>">
  </div>
   <div class="form-group">
    <label>Code</label>
    <input type="carte_code" name="carte_code"class="form-control" id="ZoneCode" placeholder="<?php echo $carte_code;?>">
  </div>
   <input type="submit" class="btn btn-primary" name="submit" value="Modifier">
   <input type="submit" class="btn btn-danger" name="effacer" value="Supprimer">
</form>
 </body>
 </html>