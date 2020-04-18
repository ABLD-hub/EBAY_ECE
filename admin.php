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
 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script type="text/javascript" src="check.js">
</script>

</head>
<body>
<?php include 'navbar.html';?>
<div class="container-fluid" id="utilisateur">
	  <div class="row">
		  <div id="categories" class="col-sm-12 area" >
				<h1 align="center">Utilisateur</h1>
				<div class="row">
				<?php
			      $database="ebay_ece";
			      $db_handle = mysqli_connect('localhost','root','');
			      $db_found = mysqli_select_db($db_handle,$database);
			      $increment=0;
			      if($db_found)
			      { 
			        $sql = "SELECT * from utilisateur";
			        $result = mysqli_query($db_handle, $sql);
			        while($data = mysqli_fetch_assoc($result))//==> nul s'il n'y a plus de ligne dans le tableau
			        {
			          
			          echo "<input class='button col-sm-4' id='".$data['type_utilisateur']."' type='submit' name='".$data['type_utilisateur']."' value='".utf8_encode($data['nom_utilisateur'])."' onclick=RechercheUtilisateur('".$data['type_utilisateur']."')>";
			        }
			        $sql = "SELECT COUNT(*) from utilisateur";
			        $result = mysqli_query($db_handle, $sql);
			        $row = $result->fetch_row();
			        echo"<script>set_num_categorie_max(".$row[0].")</script>";

			      }
			      else
			      {
			        echo "database not found";
			      }
			      mysqli_close($db_handle);
      			?>	
			</div>
		  </div>
		  <div class="container-fluid" id="item">
	  <div class="row">
		  <div id="categories" class="col-sm-12 area" >
				<h1 align="center">Objets en Vente</h1>
				<div class="row">
				<?php
			      $database="ebay_ece";
			      $db_handle = mysqli_connect('localhost','root','');
			      $db_found = mysqli_select_db($db_handle,$database);
			      $increment=0;
			      if($db_found)
			      { 
			        $sql = "SELECT * from item";
			        $result = mysqli_query($db_handle, $sql);
			        while($data = mysqli_fetch_assoc($result))//==> nul s'il n'y a plus de ligne dans le tableau
			        {
			          
			          echo "<input class='button col-sm-4' id='".$data['id_objet']."' type='submit' name='".$data['id_objet']."' value='".utf8_encode($data['nom_objet'])."' onclick=Recherche('".$data['id_objet']."',null)>";
			        }
			        $sql = "SELECT COUNT(*) from item";
			        $result = mysqli_query($db_handle, $sql);
			        $row = $result->fetch_row();
			        echo"<script>set_num_categorie_max(".$row[0].")</script>";

			      }
			      else
			      {
			        echo "database not found";
			      }
			      mysqli_close($db_handle);
      			?>	
			</div>
		  </div>
</body>
<footer>
	<?php include 'footer.html'; ?>
</footer>