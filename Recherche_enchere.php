<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
  <title><?php 
    $categorie=$_GET['categorie'];
    $type_achat=$_GET['type_achat'];
    if($categorie!='null')
      echo $categorie;
    if($type_achat!='null')
      echo $type_achat;
  ?>
  </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="style.css">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> 
  <script type="text/javascript" src="check.js">
  </script>
 
</head>
<body>
  <?php include 'navbar.html';?>
  <div class="container-fluid">
  <?php
    $vente_par_enchere=null;
    $statut_vente=null;
    $vente_par_enchere=$_GET['vente_par_enchere'];
    $statut_vente=$_GET['statut_vente'];
    $database="ebay_ece";
    $db_handle = mysqli_connect('localhost','root','');
    $db_found = mysqli_select_db($db_handle,$database);
    if($db_found)
    { 
        $sql = "SELECT * FROM item WHERE vente_par_enchere='".$vente_par_enchere."' AND statut_vente='".$statut_vente."';";
      $result = mysqli_query($db_handle, $sql);
      while($data = mysqli_fetch_assoc($result))//==> nul s'il n'y a plus de ligne dans le tableau
      {
        echo "<form action='fin_enchere.php' method='post' style='display: inline;'>";
        echo"<div class='row'>";
        echo "<div class='col-sm-6 item'>";
        echo "<p><strong>Nom: </strong>" .$data['nom_objet']. "<br>";
        echo "<strong>Prix: </strong>" .$data['prix_initial_objet']. " euros<br>";
        echo "<div id='admin'>
          <input type='id_objet' name='id_objet' class='form-control' value='".$data['id_objet']."'  style='display:none;' readonly>
          <input type='submit' class='btn btn-danger' name='vendu' value='vendu'></div>";
        echo "</div>";
        echo "<div class='col-sm-6 item_image'>";
        echo "<img src='https://www.citationbonheur.fr/wp-content/uploads/2018/09/L_influence_du_paysage_sur_le_bonheur.jpg' height='100%'>";
        echo "</div>";
        echo "</div>";
        echo "</form>";
      }
    }
    else
    {
      echo "database not found";
    }
    mysqli_close($db_handle);
?>
 </div>
 </body>
 </html>

<!--onclick=lancement_page('".$categorie."','".$type_achat."','".$data['ID']."')-->
