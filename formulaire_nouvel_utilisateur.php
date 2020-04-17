<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
	<title>Création d'un compte Utilisateur</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="style.css">
 	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="check.js"></script>
  <script type="text/javascript">
    function verification_password()
    {
       if(document.getElementById('motdepasse').value!=document.getElementById('motdepasse_verif').value)
       {
        alert("Les mots de passe ne sont pas identique !!")
        $('#motdepasse_verif').css('background-color','#FFC0C0');
        $('#motdepasse').css('background-color','#FFC0C0');
       }
       else
       {
        $('#motdepasse_verif').css('background-color','white');
        $('#motdepasse').css('background-color','white');
       }
    }
  </script>
</head>
<body id="fond_ajout_utilisateur">
	
<?php include 'navbar.html'; ?>
<div  align="center">
  <div id="fond_formulaire" class="col-sm-4" align="center">
  <p style="font-size: 40px" align="center">Créer votre compte Ebay ECE</p>

  <form action="formulaire_nouvel_utilisateur.php" method="post" id="formulaire_nouvel_utilisateur">
   <table style="padding: 60px;" align="center" >
   <tr>
     <td>Nom :</td>
     <td><input type="text" class="form-control" name="nom" required></td>
   </tr>

   <tr>
    <td>Prenom :</td>
    <td><input type="text" class="form-control" name="prenom" required></textarea></td>
  </tr>

  <tr>
    <td>Pseudo :</td>
    <td><input type="text" class="form-control" name="pseudo" ></td>
  </tr>

  <tr>
    <td>Email :</td>
    <td><input type="email" class="form-control" name="email" required></td>
  </tr>

  <tr>
    <td>Type d'utilisateur :</td>
    <td>
      <select id="utilisateur" name="utilisateur" required>
        <option> Acheteur </option>
        <option> Vendeur </option>
      </select>
    </td>
  </tr>
  <tr>
    <td>Mot de passe :</td>
    <td><input type="password" id="motdepasse" class="form-control" name="motdepasse" required></td>
  </tr>
  <tr>
    <td>Vérification mot de passe :</td>
    <td><input type="password" id="motdepasse_verif" class="form-control" name="motdepasse_verif" required onblur="verification_password()"></td>
  </tr>

  <tr>
   <td colspan="2" align="center">
    <input type="submit" class="btn btn-primary" name="Ajout" value="Créer">
  </td>
 </tr>
<p>
</table>
</form>
<?php
  $nom = isset($_POST["nom"])? $_POST["nom"]:"";
  $prenom = isset($_POST["prenom"])? $_POST["prenom"]:"";
  $pseudo = isset($_POST["pseudo"])? $_POST["pseudo"]:"";
  $email = isset($_POST["email"])? $_POST["email"]:"";
  $utilisateur = isset($_POST["utilisateur"])? $_POST["utilisateur"]:"";
  $motdepasse = isset($_POST["motdepasse"])? $_POST["motdepasse"]:"";

  $database="ebayece";
  $db_handle = mysqli_connect('localhost','root','');
  $db_found = mysqli_select_db($db_handle,$database);
  if($db_found)
  {

  if(isset($_POST["Ajout"]))
    {
      $erreur="";
      echo "<script>$('form').css('display','none');</script>";
      $sql = "SELECT DISTINCT * FROM utilisateur WHERE email LIKE '$email';";
      $result = mysqli_query($db_handle, $sql);
      if(mysqli_num_rows($result)!=0)
      {
        $erreur.="<div style='margin: 15px; background-color:brown; color:white; border-radius: 10px;'>Erreur: Un utilisateur avec la même adresse email est déjà existant!!<br></div>";
      }
      if($erreur=="")
      {
        $sql = "INSERT INTO utilisateur(email,nom,prenom,pseudo,mot_de_passe,type_utilisateur,numero_carte,type_carte,date_expiration) VALUES ('$email','$nom','$prenom','$pseudo','$motdepasse','$utilisateur',NULL,NULL,NULL);";
        $result=mysqli_query($db_handle, $sql);
        echo "<div style='margin: 15px; background-color:green; color:white; border-radius: 10px;'>Votre Compte à bien été créé.</div>";
      }
      else
      {
        echo $erreur;
      }
      echo "<form action='Accueil.php'><input type=submit class='btn btn-primary' value='Accueil'></form>";
      $_SESSION['email']=$email;
      $sql = "SELECT DISTINCT * FROM utilisateur WHERE email LIKE '$email';";
      $result = mysqli_query($db_handle, $sql);
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
      session_write_close();
      exit();
    }
}
else
{
  echo "BDD introuvable";
}
mysqli_close($db_handle);
?>
</div></div>
</body>
</html>