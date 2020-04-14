<!DOCTYPE html>
<html>
<head>
	<title>Ajout Item</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="style.css">
 	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="check.js"></script>
  <style type="text/css">
  td
    {
      padding: 5px;
    }
  </style>
   <script type="text/javascript">
    var num_categorie_max=0;
      function verification_type_vente(object)
      {
          if(document.getElementById("enchere").checked && document.getElementById("meilleure_offre").checked)
          {
            if(object.id=="enchere")
            {
                document.getElementById("meilleure_offre").checked=false;
            }
            if(object.id=="meilleure_offre")
            {
                document.getElementById("enchere").checked=false;
            }
            alert("Votre objet ne peut être à la fois mis en vente par enchère et par meilleure offre !!!");
          }
          if(!document.getElementById("enchere").checked)
          {
            $('#date_fin').css('display', 'none');
          }
          else
          {
            $('#date_fin').css('display', '');
          }
      }

      /*******************************************************************/
      function verification_formulaire()
      {
        nom=document.getElementById("nom").value;
        description=document.getElementById("description").value;
        prix=document.getElementById("prix").value;
        enchere=document.getElementById("enchere").checked;
        meilleure_offre=document.getElementById("meilleure_offre").checked;
        achat_immediat=document.getElementById("achat_immediat").checked;
        var erreur="";
        var categorie="";
        for(var i=0;i<num_categorie_max;i++)
        {
          if(document.getElementById('categorie_'+i).checked)
          {
            categorie=document.getElementById('categorie_'+i).value;
          }
        }
        if(nom=="")
        {
          erreur+="Merci de remplir le champ nom.\n";
        }
        if(description=="")
        {
          erreur+="Merci de remplir la description de l'objet.\n";
        }
        if(prix=="")
        {
          erreur+="Merci de remplir la description de l'objet.\n";
        }
        if(categorie=="")
        {
          erreur+="Merci de mettre une catégorie pour votre objet.\n";
        }
        if(!meilleure_offre && !achat_immediat && !enchere)
        {
          erreur+="Merci de mettre un/des types d'achats pour votre objet.\n";
        }
        if(erreur=="")
        {   alert(categorie);
            window.open("Sauvegarde_objet.php?nom="+nom+"&description="+description+"&prix="+prix+"&categorie="+categorie+"&meilleure_offre="+meilleure_offre+"&achat_immediat="+achat_immediat+"&enchere="+enchere,"_self");
        }
        else
        {
          alert(erreur);
        }
      }
      function set_num_categorie_max(max)
      {
          num_categorie_max=max;
      }
  </script>
</head>
<body>
	
<?php include 'navbar.html'; ?>

  <p style="font-size: 40px" align="center">Mise en vente d'un objet</p>

  <form form action="Formulaire_Item.php" method="post" id="formulaire_item">
   <table style="padding: 60px;" align="center" >


    <tr>
     <td>Nom de l'objet :</td>
     <td><input type="text" class="form-control" id="nom" name="nom"></td>
   </tr>

   <tr>
    <td>Description (qualités/défauts) :</td>
    <td><textarea class="form-control" id="description" name="description"></textarea></td>
  </tr>

  <tr>
    <td>Une ou plusieurs photos de l'objet :</td>
    <td><input type="file"  id="photo" name="photo"></td>
  </tr>

  <tr>
    <td>Vidéo :</td>
    <td><input type="file" id="video" name="video"></td>
  </tr>

  <tr>
    <td>Catégorie :</td>
    <td><!--<input type="radio" name="categorie" value="Ferraille ou Tresor">  Ferraille ou Trésor<br>
      <input type="radio"  name="categorie" value="Bon pour le Musee">  Bon pour le Musée<br>
      <input type="radio"  name="categorie" value="Accessoire VIP">  Accessoire VIP-->
      <?php
      $database="ebay_ece";
      $db_handle = mysqli_connect('localhost','root','');
      $db_found = mysqli_select_db($db_handle,$database);
      $increment=0;
      if($db_found)
      { 
        $sql = "SELECT * from categorie";
        $result = mysqli_query($db_handle, $sql);
        while($data = mysqli_fetch_assoc($result))//==> nul s'il n'y a plus de ligne dans le tableau
        {
          
          echo "<input type='radio' name='categorie' value='".$data['ID']."' id='categorie_".$increment++."'>  ".utf8_encode($data['nom'])."<br>";
        }
        $sql = "SELECT COUNT(*) from categorie";
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
    </td>
  </tr>

  <tr>
    <td>Prix :</td>
    <td><input type="number" id="prix" class="form-control" name="prix" placeholder="€"></td>
  </tr>
  <tr>
    <td>Type de vente :</td>
    <td>
      <input id="enchere" type="checkbox" name="enchere" onclick="verification_type_vente(this)">  Enchères<br>
      <input id="meilleure_offre" type="checkbox" name="meilleure_offre" onclick="verification_type_vente(this)">  Meilleure offre<br>
      <input id="achat_immediat" type="checkbox" name="achat_immediat">  Achat immédiat<br>
    </td>
  </tr>

  <tr id="date_fin" style="display: none;">
    <td>Date de fin de l'enchère :</td>
    <td>
      <input type="date" name="type_vente" class="form-control">
    </td>
  </tr>

  <tr>
   <td colspan="2" align="center"><input type="button" class="btn btn-primary" name="submit" value="Mettre en Vente" onclick="verification_formulaire()"></td>
 </tr>

</table>
</form>
</center>
</body>
</html>