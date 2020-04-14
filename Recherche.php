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
    $categorie=$_GET['categorie'];
    $type_achat=$_GET['type_achat'];
    $database="ebay_ece";
    $db_handle = mysqli_connect('localhost','root','');
    $db_found = mysqli_select_db($db_handle,$database);
    if($db_found)
    { 
        $sql = "SELECT * from item where Categorie='".$categorie."' OR ".$type_achat."='1';";
      $result = mysqli_query($db_handle, $sql);
      while($data = mysqli_fetch_assoc($result))//==> nul s'il n'y a plus de ligne dans le tableau
      {
        echo "<div class='row' onclick=lancement_page('".$categorie."','".$type_achat."','".$data['ID']."')>";
        echo "<div class='col-sm-6 item'>";
        echo "<p><strong>Nom: </strong>" .$data['Nom']. "<br>";
        echo "<strong>Prix: </strong>" .$data['Prix']. " euros<br>";
        echo "<strong>Description: </strong><br>" .utf8_encode($data['Description']). "</p><br>";
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

<!--onclick=lancement_page('".$categorie."','".$type_achat."','".$data['ID']."')-->
