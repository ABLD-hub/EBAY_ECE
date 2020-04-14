<html>
<head>
<title>Ebay ECE </title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet"
 href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script type="text/javascript" src="check.js">
</script>
<style type="text/css">
  .div_button
    {
      height: 110px;
      border: thick double green;
      background-color: white;
    }
    .div_button:hover
    {
      opacity: 0.5;
    }

    .area
    {
      opacity: 0.8;
      margin-top: 100px;
      margin-bottom: 100px;
      box-shadow:  0px 5px 5px grey;
      background-color: beige; 
      border-radius: 35px; 
      border:green solid 1px;
      padding:30px;
    }
    #Ferraille_ou_Tresor
    {
        color: white;
        background-color: gold;
    }
    #Bon_pour_le_musee
    {
        color: white;
        background-color: brown;        
    }
    #Accessoire_vip
    {
        color: white;
        background-color:grey; 

    }
    #main
    {
      background-image: url(https://cdn.futura-sciences.com/buildsv6/images/wide1920/3/7/c/37c286b435_115315_arbre-plus-grand-sequoia.jpg);
      background-size:100%;
    }
</style>
</head>
<body>
  <<?php include 'navbar.html'; ?>
  <div class="container-fluid" id="main">
  <form action="Recherche.php" method="post">
  <div class="row">
  <div id="categories" class="col-sm-6 area" >
        <h1 align="center">Catégories</h1>
        <div class="div_button" id="Ferraille_ou_Tresor" name="Ferraille_ou_Tresor" align="center" onclick="Recherche.php"><h1>Ferraille ou Trésor</h1></div>
        <div class="div_button" id="Bon_pour_le_musee"  align="center" onclick="alert('lien');"><h1>Bon pour le musée</h1></div>
        <div class="div_button" id="Accessoire_vip"align="center" onclick="alert('lien');"><h1>Accessoire VIP</h1></div>
</div>
  <div id="achats" class="col-sm-6 area">
        <h1 align="center">Achats</h1>
        <div class="div_button" id="Ferraille_ou_Tresor" align="center" onclick="alert('lien');"><h1>Enchères</h1></div>
        <div class="div_button" id="Bon_pour_le_musee"  align="center" onclick="alert('lien');"><h1>Achetez le maintenant !! </h1></div>
        <div class="div_button" id="Accessoire_vip"align="center" onclick="alert('lien');"><h1>Meilleure Offre</h1></div>
  </div>
</div>
          <div class="row">
      <div id="vendre" class="col-sm-12 div_button" style="background-color: beige;  border: black; border-radius: 35px; border:green solid 1px; height: 100px;margin:10px;" align="center"><h1>Vendre un Item</h1></div>
</div>
</form>
</div>

</body>
<footer style="background-color: grey; both:clear; height: 100px;">
  
</footer>