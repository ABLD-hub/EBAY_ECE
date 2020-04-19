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
 <script type="text/javascript" src="check.js"></script>
 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>


</head>
<body>
<?php include 'navbar.html';?>
<div class="container-fluid" id="utilisateur">
		  <div id="type_achat" class="col-sm-12 area">
				<h1 align="center">Type Utilisateur</h1>
				<input class="button" id="vendeur"  type="submit" name="vendeur" value="vendeur " onclick="RechercheUtilisateur('vendeur')">
				<input class="button" id="acheteur" type="submit" name="acheteur" value="acheteur" onclick="RechercheUtilisateur('acheteur')">
		  </div>
		  <div class="container-fluid" id="item">
	  <div class="row">
		  <div id="categories" class="col-sm-12 area" >
		  <h1 align="center">Actions sur Objet</h1>
				<div class="row">
				<input class="button" id="FinEnchère"  type="submit" name="FinEnchère" value="Mettre Fin aux enchère " onclick="RechercheEnchere(1,'termine');">
				<input class="button" id="acheteur" type="submit" name="acheteur" value="acheteur" onclick="RechercheUtilisateur('acheteur')">
			</div>
		  </div>
</body>
<footer>
	<?php include 'footer.html'; ?>
</footer>