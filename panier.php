<?php session_start();
?>
<!DOCTYPE html>
<html>
<head>
<head>
<title>
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

<div class="container-fluid" id="Panier">
  <?php include 'navbar.html';?>  
  </div>
 <div class="container-fluid" id="VraiPanier">
 	 	<form class="form-group" action="liste.php" method="post">
	 	 	<label for="Trier par">Trier par</label>
		    <select class="form-control" id="Choice">
		      <option>Tous les objets</option>
		      <option>Bon pour le Musée</option>
		      <option>Ferrailles ou Trésor</option>
		      <option>Accessoire VIP</option>	
		    </select>
		 </form>

</div>
</body>