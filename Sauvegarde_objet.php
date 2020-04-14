<!DOCTYPE html>
<html>
<head>
  <title>Ajout Item</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
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
<?php
  $nom=$_GET['nom'];
  $description=utf8_decode($_GET['description']);
  $prix=$_GET['prix'];
  $categorie=$_GET['categorie'];
  $enchere=$_GET['enchere'];
  $achat_immediat=$_GET['achat_immediat'];
  $meilleure_offre=$_GET['meilleure_offre'];
  $output="";

  $database="ebay_ece";
  $db_handle = mysqli_connect('localhost','root','');
  $db_found = mysqli_select_db($db_handle,$database);
  if($db_found)
  { 
    $sql = "INSERT INTO item(Nom,Categorie,Description,Prix,vente_par_enchere,vente_immediat,vente_par_meilleure_offre) VALUES ('$nom','$categorie','$description','$prix',$enchere,$achat_immediat,$meilleure_offre);";
     $result = mysqli_query($db_handle, $sql);
     $output.= "<h1>Mise en vente de l'objet réussi</h1>";
     $output.=  "<div class='col-sm-6 item' style='border:solid 1px black; border-radius:20px; height:150px; background-color:pink;'>";
     $output.=  "Nom: " .$nom. "<br>";
     $output.=  "Description: " .utf8_encode($description). "<br>";
     $output.=  "Prix: " .$prix. "euros<br>";
     $output.=  "Catégorie: " .$categorie. "<br>";
     $output.=  "Type de vente:<ul>";
     if($achat_immediat=='true')
     {
        $output.="<li> Achat immédiat. </li>";
     }
     if($enchere=='true')
     {
        $output.="<li> Enchère. </li>";
     }
     if($meilleure_offre=='true')
     {
        $output.="<li> Meilleure offre. </li>"; 
     }
     $output.= "</ul><br>"; 
     $output.=  "</div>";
     echo $output;
  }
  else
  {
    echo "database not found";
  }
mysqli_close($db_handle);
?>
<input type='button' onclick="window.open('accueil.html','_self');" value='Retour au menu'>
</body>
</html>