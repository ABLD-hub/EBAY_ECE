<?php session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Création d'un compte Utilisateur</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="style.css">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="check.js"></script>
  <script type="text/javascript">
  </script>
  </head>

<body id="fond_ajout_utilisateur">
<?php if(isset($_SESSION['email'])) {
    echo "la session vaut : ".$_SESSION['email'];
    echo "l'utilisateur vaut : ".$_SESSION['type_utilisateur'];
  }else
{
echo 'pas de variable de session';
} ?>
<?php include 'navbar.html'; ?>

<div align="center">
  <div id="fond_formulaire" class="col-sm-4" align="center">
  <p style="font-size: 40px" align="center">Demande de statut Vendeur</p>

  <form action="update.php" method="post" id="Formulaire_Demande">
   <table style="padding: 60px;" align="center" >
   <tr>
     <td> Mail :</td>
     <td><input type="text" class="form-control" name="email" required></td>
   </tr>

  <tr>
    <td>Pseudo :</td>
    <td><input type="text" class="form-control" name="pseudo" ></td>
  </tr>

  <tr>
      <div class="form-check">
    <input class="form-check-input" type="radio" name="statut" id="ACHETEUR" value="Acheteur">
    <label class="form-check-label">
      ACHETEUR
    </label>
  </div>
  <div class="form-check">
    <input class="form-check-input" type="radio" name="statut" id="VENDEUR" value="Vendeur">
    <label class="form-check-label">
      Vendeur
    </label>  
  </div>
  </tr>
  <tr>
   <td colspan="2" align="center">
    <input type="submit" class="btn btn-primary" name="submit" value="Demander">
  </td>
 </tr>
<p>
</table>
</form>
