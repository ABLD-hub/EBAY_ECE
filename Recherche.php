<!DOCTYPE html>
<html>
<head>
	<title>Catégories</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="styles.css">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>  
  <style type="text/css">
  	.item:hover
  	{
  		opacity: 0.8;
  	}
  </style>  
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
 </body>
 </html>


<?php
$categorie=null;
$type_achat=null;
$categorie=$_GET['categorie'];
$type_achat=$_GET['type_achat'];
$database="test2";
$db_handle = mysqli_connect('localhost','root','');
$db_found = mysqli_select_db($db_handle,$database);
if($db_found)
{	
  echo "<div class='container-fluid' style='padding:10px;'>";
	  $sql = "SELECT * from item where Categorie='".$categorie."' OR ".$type_achat."='1';";
	$result = mysqli_query($db_handle, $sql);
	while($data = mysqli_fetch_assoc($result))//==> nul s'il n'y a plus de ligne dans le tableau
	{
		echo "<div class='row' style='padding:2px;'><div class='col-sm-6 item' style='border:solid 1px black; border-radius:20px; height:150px; background-color:pink;'>";
		echo "Nom: " .$data['Nom']. "<br>";
		echo "Prix: " .$data['Prix']. "euros<br>";
		echo "Description: " .utf8_encode($data['Description']). "euros<br>";
		echo "</div></div>";
	}
	echo "</div>";
}
else
{
	echo "database not found";
}
mysqli_close($db_handle);
?>