<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
	<title><?php 
    $type_utilisateur=$_GET['type_utilisateur'];
    if($type_utilisateur!='null')
      echo $type_utilisateur;
  ?>
  </title>
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
  <?php include 'navbar.html';?>

  <div class="container-fluid">
  <?php
    $type_utilisateur=null;
    $type_utilisateur=$_GET['type_utilisateur'];
    $database="ebay_ece";
    $db_handle = mysqli_connect('localhost','root','');
    $db_found = mysqli_select_db($db_handle,$database);
    if($db_found)
    { 
        $sql = "SELECT * from utilisateur where type_utilisateur='".$type_utilisateur."';";
      $result = mysqli_query($db_handle, $sql);
      while($data = mysqli_fetch_assoc($result))//==> nul s'il n'y a plus de ligne dans le tableau
      {
        echo "<div class='row' onclick=lancement_suppr('".$data['id_utilisateur']."')>";
        echo "<div class='col-sm-6 item'>";
        echo "<p><strong>Nom: </strong>" .$data['nom_utilisateur']. "<br>";
        echo "<strong>Prenom: </strong>" .$data['prenom_utilisateur']. "<br>";
        echo "<strong>Pseudo: </strong>" .utf8_encode($data['pseudo'])."<br></p>";
        echo "</div>";
        echo "<div class='col-sm-6 item_image'>";
        echo "<img src='https://www.citationbonheur.fr/wp-content/uploads/2018/09/L_influence_du_paysage_sur_le_bonheur.jpg' height='100%'>";
        echo "</div>";
        echo "</div>";
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

