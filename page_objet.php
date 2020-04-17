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
$categorie=$_GET['categorie'];
$type_achat=$_GET['type_achat'];
$id=$_GET['id'];

$database="ebayece";
$db_handle = mysqli_connect('localhost','root','');
$db_found = mysqli_select_db($db_handle,$database);
if($db_found)
{ 
  echo "<div class='container-fluid' style='padding:10px;'>";
    $sql = "SELECT * from item where (Categorie='".$categorie."' OR ".$type_achat."='1') AND ID='".$id."';";
  $result = mysqli_query($db_handle, $sql);
  while($data = mysqli_fetch_assoc($result))//==> nul s'il n'y a plus de ligne dans le tableau
  {
    echo "<center><h1 style='border:1px grey double; border-radius:10px; '>" .$data['Nom']. "</h1></center><br>";
    echo "<div class='container-fluid'><div class='row'><div class='col-sm-6'>";
    echo "<p style='font-size: 30px;'><strong>Description:</strong><br> " .utf8_encode($data['Description']). "</p><br>";
    echo "<h2>Prix: " .$data['Prix']. " euros</h2><br>";
     if($data['vente_par_enchere']=='1')
    {
      echo "<div class='col-sm-4'><input class='form-control' type='number' value='".$data['Prix']."'>Euros<br><input class='btn btn-primary' style='font-size: 25px' type='button' value='Encherir'></div>";
    }
    if($data['vente_immediat']=='1')
    {
      echo "<div class='col-sm-4'><input class='btn btn-primary' style='font-size: 25px' type='button' value='Achat immédiat'></div>";
    }
    if($data['vente_par_meilleure_offre']=='1')
    {
      echo "<div class='col-sm-4'><input class='btn btn-primary' style='font-size: 25px' type='button' value='Achat par meilleure offre'></div>";
    }
    echo "</div>";
    echo "<div class='col-sm-6'>";
    echo "<img src='https://www.orseu-concours.com/181-318-thickbox/test-epso-de-raisonnement-numerique-3-fr.jpg'>";
    echo "</div></div><div class='row'>";
    echo "</div></div></div>";
  }
  echo "</div>";
}
else
{
  echo "database not found";
}
mysqli_close($db_handle);
?>
 </body>
 </html>