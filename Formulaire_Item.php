<!DOCTYPE html>
<html>
<head>
	<title>Ajout Item</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="styles.css">
 	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="check.js"></script>
  <style type="text/css">
  td
    {
      padding: 5px;
    }
  </style>
</head>
<body>
	
<?php include 'navbar.html'; ?>
<div id=Formulaire>

<p style="font-size: 40px" align="center">Mise en vente d'un Item</p>
	<table style="padding: 60px;" align="center" >

		<tr>
			<td>Nom de l'Item :</td>
			<td><input type="text" class="form-control" id="nom" name="nom"></td>
		</tr>
    <tr>
      <td>Description (qualités/défauts) :</td>
      <td><textarea class="form-control" id="description" name="description"></textarea></td>
    </tr>
    <tr>
      <td>Une ou plusieures photos de l'Item :</td>
      <td><input type="file"  id="photo" name="photo"></td>
    </tr>
    <tr>
      <td>Vidéo :</td>
      <td><input type="file" id="video" name="video"></td>
    </tr>
    <tr>
      <td>Catégorie :</td>
      <td><input type="radio"  id="prix" name="categorie" value="Ferraille ou Tresor">  Feraille ou Trésor<br>
          <input type="radio"  id="prix" name="categorie" value="Bon pour le Musee">  Bon pour le Musée<br>
          <input type="radio"  id="prix" name="categorie" value="Accessoire VIP">  Accessoire VIP
          </td>
    </tr>
     <tr>
      <td>Prix :</td>
      <td><input type="number" class="form-control" id="prix" name="prix" placeholder="€"></td>
    </tr>
		<tr>
			<td colspan="2" align="center"><input type="button" class="btn btn-primary" name="submit" value="Mettre en Vente"></td>
		</tr>
	</table>
</div>
</center>

<script type="text/javascript">
    cacher("Formulaire",'<?php check(); ?>');
</script>

</body>
</html>