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
  function lancement_page(categorie,type_achat,ID)
  {
    window.open("page_objet.php?categorie="+categorie+"&type_achat="+type_achat+"&id="+ID,"_self");
  } 
  </script>
 
</head>
<body>
  <?php include 'navbar.html';?>
  <div class="container-fluid">
  <?php
    $categorie=null;
    $type_achat=null;
    $nom_recherche=null;
    $categorie=$_GET['categorie'];
    $type_achat=$_GET['type_achat'];
    $nom_recherche=$_GET['recherche'];
    $database="ebay_ece";
    $db_handle = mysqli_connect('localhost','root','');
    $db_found = mysqli_select_db($db_handle,$database);

    if($db_found)
    {   echo"<div class='col-sm-12 titre_recherche'>";
        if($categorie!='null')
        {
            $sql = "SELECT * from categorie where id_categorie='".$categorie."';";
            $result = mysqli_query($db_handle, $sql);
            while($data = mysqli_fetch_assoc($result))//==> nul s'il n'y a plus de ligne dans le tableau
            {   echo utf8_encode($data['nom']); }
        } 
        else if($type_achat!='null')
        {
          if($type_achat=="vente_par_enchere")
            echo "Vente par enchère";
          if($type_achat=="vente_immediat")
            echo "Vente immédiate";
          if($type_achat=="vente_par_meilleure_offre")
            echo "Vente par meilleure offre!!";
        }
        if($nom_recherche!='null')
        {
          if($nom_recherche=="")
          {
              $nom_recherche="%";
              echo "Resultat de la recherche : Tout";
          }
          else
          {
            echo "Resultat de la recherche : ".$nom_recherche;
          }
        }
        echo"</div>";
        $sql="";
        if($type_achat!="null" || $categorie!="null")
          $sql = "SELECT * from objet where (id_categorie='".$categorie."' OR ".$type_achat."='1') AND statut_vente='en_vente';";
        else
          $sql = "SELECT * from objet where nom_objet like '%$nom_recherche%' AND statut_vente='en_vente';";
        $result = mysqli_query($db_handle, $sql);
        if(mysqli_num_rows($result)==0)
        {
          echo "<center><div class='col-sm-6'id='aucun_resultat'>Désolé , Il n'y a aucun résultat.</div><center>";
        }
        while($data = mysqli_fetch_assoc($result))//==> nul s'il n'y a plus de ligne dans le tableau
        {
          echo "<div class='row' onclick=lancement_page('".$data['id_objet']."')>";
          echo "<div class='col-sm-6 item'>";
          echo "<p><strong>Nom: </strong>" .utf8_encode($data['nom_objet']). "<br>";
          echo "<strong>Prix: </strong>" .$data['prix_initial_objet']. " euros<br>";
          echo "<strong>Description: </strong><br>" .utf8_encode($data['description_objet']). "</p><br>";
          echo "</div>";
          echo "<div class='col-sm-6 item_image'>";
          $id_objet=$data['id_objet'];
          $sql_image = "SELECT * FROM objet WHERE id_objet='$id_objet';";
          $result_image = mysqli_query($db_handle, $sql_image);
          while($data_image = mysqli_fetch_assoc($result_image))
          {
           echo "<img class='img'src='upload/".$data_image['photo_1']."' height='100%'>";break;
          }
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
 <?php include 'footer.html'; ?>
 </html>

<!--onclick=lancement_page('".$categorie."','".$type_achat."','".$data['ID']."')-->
