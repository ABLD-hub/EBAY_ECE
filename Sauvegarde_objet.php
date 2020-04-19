<?php session_start();?>
<!DOCTYPE html>
<html>
  <head>
    <title>Ajout Item</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  </head>
  <body>
    <?php include 'navbar.html';?>
    <?php
      /********************************************Récupération des données******************************************************/
      ///On récupère les données du formulaire 
      $nom=isset($_POST["nom"])? $_POST["nom"]:"";
      $description=utf8_decode(isset($_POST["description"])? $_POST["description"]:"");
      $prix=isset($_POST["prix"])? $_POST["prix"]:"";
      $categorie=isset($_POST["categorie"])? $_POST["categorie"]:"";
      $enchere=isset($_POST["enchere"])? $_POST["enchere"]:0;
      $achat_immediat=isset($_POST["achat_immediat"])? $_POST["achat_immediat"]:0;
      $meilleure_offre=isset($_POST["meilleure_offre"])? $_POST["meilleure_offre"]:0;
      $id_vendeur=$_SESSION['id_utilisateur'];
      ///la check box envoie une donnée 'on' ou rien, on transforme donc cela en booléen
      if($enchere)
          $enchere=1;
      if($achat_immediat)
          $achat_immediat=1;
      if($meilleure_offre)
          $meilleure_offre=1;
    
      $output="";
      $error="";
      $data_requete_item="";
      $already_exist=0;
      /************************************************Ouverture BDD***********************************************************/
      $database="ebay_ece";
      $db_handle = mysqli_connect('localhost','root','');
      $db_found = mysqli_select_db($db_handle,$database);

      if($db_found)
      { 
        /*********************************vérification pre-existance dans la BDD***********************************************/

        $sql = "SELECT DISTINCT * FROM item WHERE nom_objet LIKE '$nom' AND id_categorie LIKE '$categorie' AND description_objet LIKE '$description' AND prix_initial_objet LIKE '$prix';";
        $result = mysqli_query($db_handle, $sql);
        if(mysqli_num_rows($result)!=0)
        {
          $error.= "Erreur: l'objet existe déjà !!<br>Aucune données n'a été mis à jour!!<br>";
          $already_exist=1;
        }
        else
        {
          /******************************Envoie de la requete de création de l'objet dans la bdd*************************/
          ///envoie de la requête de sql
          $sql = "INSERT INTO item(id_objet,id_utilisateur,nom_objet,id_categorie,description_objet,lien_video,prix_initial_objet,prix_propose,vente_par_enchere,date_fin_enchere,vente_immediat,vente_par_meilleure_offre,statut_vente) VALUES (NULL,'$id_vendeur','$nom','$categorie','$description',NULL,'$prix',NULL,$enchere,NULL,$achat_immediat,$meilleure_offre,'en_vente');";
          ///récupere le resultat de la requête
          $result = mysqli_query($db_handle, $sql);
        }
        ///on affiche le resultat de la requete
        $output.= "<center><h1>Mise en vente de l'objet</h1></center>";
        $output.=  "<div class='col-sm-6 area'>";
        $output.=  "Nom: " .$nom. "<br>";
        $output.=  "Description: " .utf8_encode($description). "<br>";
        $output.=  "Prix: " .$prix. "euros<br>";
        $output.=  "Catégorie: " .$categorie. "<br>";
        $output.=  "Type de vente:<ul>";

        if($achat_immediat==1)
        {
          $output.="<li> Achat immédiat. </li>";
        }
        if($enchere==1)
        {
          $output.="<li> Enchère. </li>";
        }
        if($meilleure_offre==1)
        {
          $output.="<li> Meilleure offre. </li>"; 
        }
        $output.= "</ul><br>"; 
        $output.=  "</div>";
        echo $output;

        /******************************recupération de l'id de l'objet via une requete de recherche de l'objet dans la bdd*************************/
        $sql = "SELECT DISTINCT * FROM item WHERE nom_objet LIKE '$nom' AND id_categorie LIKE '$categorie' AND description_objet LIKE '$description' AND prix_initial_objet LIKE '$prix';";
            $result = mysqli_query($db_handle, $sql);
            $data_requete_item = mysqli_fetch_assoc($result);
      /*******************************Boucle for de recupération de 3 images max*********************************/
      for ($i=1; $i < 4; $i++) 
      {  
          // On verifie les erreurs 
        //echo isset($_FILES["photo_".$i]["error"] );
        if(isset($_FILES["photo_".$i]) && $_FILES["photo_".$i]["error"] == 0)
        {
          //$allowedExts = array("jpg", "jpeg", "gif", "png", "mp3", "mp4", "wma");
          $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
          $filename = $_FILES["photo_".$i]["name"];
          $filetype = $_FILES["photo_".$i]["type"];
          $filesize = $_FILES["photo_".$i]["size"];

            // on verifie si l'extension du fichier est bien celle d'une image
          $ext = pathinfo($filename, PATHINFO_EXTENSION);
          if(!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");

            //on verifie la taille du fichier (<5M)
          $maxsize = 5 * 1024 * 1024;
          if($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");
          if($already_exist==0)
          {
            // Verify MYME type of the file
            if(in_array($filetype, $allowed))
            {
                  ///on recupere le future id de fichier afin de l'utiliser pour nommer l'objet
              $sql = "SELECT MAX(id_photo) FROM photo_objet;";
              $result = mysqli_query($db_handle, $sql);
              $row = $result->fetch_row();
              //echo "<br>".$row[0]."<br>";
              $filename=($row[0]+1).".jpg";
                  ///on transfert le fichier dans notre dossier upload
              move_uploaded_file($_FILES["photo_".$i]["tmp_name"], "upload/" . $filename);
              //echo "Your file was uploaded successfully.";
                  ///on ajoute l'image à la bdd
              $sql = "INSERT INTO photo_objet(id_photo,id_objet) VALUES (NULL,'".$data_requete_item['id_objet']."');";
              $result = mysqli_query($db_handle, $sql);   
            } 
            else
            {
              $error.= "Erreur: il y a eu une erreur dans le téléchargement du fichier<br>"; 
            }
          }    
        } 
        else
        {
          $error.= "Erreur: ".$_FILES["photo_".$i]["error"]."<br>";
        }
      }
        echo "<div class='image_list row'>";
        $sql = "SELECT * from photo_objet where id_objet='".$data_requete_item['id_objet']."';";
        $result = mysqli_query($db_handle, $sql);
        while($data = mysqli_fetch_assoc($result))//==> nul s'il n'y a plus de ligne dans le tableau
        {
          echo "<img class='col-sm-4' src='upload/".$data['id_photo'].".jpg'>";
        }
        echo "</div>";

      }
      else
      {
        echo "database not found";
      }
      if($error!="")
        echo "<div style='margin: 15px; background-color:brown; color:white; border-radius: 10px;' align='center'>".$error."</div>";
      mysqli_close($db_handle);      
    
    ?>
    <input type='button' onclick="window.open('accueil.php','_self');" value='Retour au menu'>
  </body>
  <?php include 'footer.html'; ?>
</html>