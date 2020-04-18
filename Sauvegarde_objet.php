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
      $video =isset($_FILES["video"]);
      echo $video;
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
      /************************************************Ouverture BDD***********************************************************/
      $database="ebay_ece";
      $db_handle = mysqli_connect('localhost','root','');
      $db_found = mysqli_select_db($db_handle,$database);

      if($db_found)
      { 
        /************************************************vérification pre-existance dans la BDD***********************************************************/

        $sql = "SELECT DISTINCT * FROM item WHERE nom_objet LIKE '$nom' AND id_categorie LIKE '$categorie' AND description_objet LIKE '$description' AND prix_initial_objet LIKE '$prix';";
        $result = mysqli_query($db_handle, $sql);
        if(mysqli_num_rows($result)!=0)
        {
          $error.= "<div style='margin: 15px; background-color:brown; color:white; border-radius: 10px;' align='center'>Erreur: l'objet existe déjà !!<br></div>";
        }

        else
        {
          ///envoie de la requête de sql
          $sql = "INSERT INTO item(id_objet,id_utilisateur,nom_objet,id_categorie,description_objet,lien_video,prix_initial_objet,prix_propose,vente_par_enchere,date_fin_enchere,vente_immediat,vente_par_meilleure_offre,statut_vente) VALUES (NULL,NULL,'$nom','$categorie','$description',NULL,'$prix',NULL,$enchere,NULL,$achat_immediat,$meilleure_offre,'en_vente');";
          ///récupere le resultat de la requête
          $result = mysqli_query($db_handle, $sql);
        }
        ///on affiche le resultat de la requete
        $output.= "<center><h1>Mise en vente de l'objet réussi</h1></center>";
        $output.=  "<div class='col-sm-6'>";
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
        $sql = "SELECT DISTINCT * FROM item WHERE nom_objet LIKE '$nom' AND id_categorie LIKE '$categorie' AND description_objet LIKE '$description' AND prix_initial_objet LIKE '$prix';";
            $result = mysqli_query($db_handle, $sql);
            $data_requete_item = mysqli_fetch_assoc($result);
      
      for ($i=1; $i < 4; $i++) 
      {  
          // Check if file was uploaded without errors
          echo isset($_FILES["photo_".$i]["error"] );
          if(isset($_FILES["photo_".$i]) && $_FILES["photo_".$i]["error"] == 0)
          {
            $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
            $filename = $_FILES["photo_".$i]["name"];
            $filetype = $_FILES["photo_".$i]["type"];
            $filesize = $_FILES["photo_".$i]["size"];

            // Verify file extension
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            if(!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");

            // Verify file size - 5MB maximum
            $maxsize = 5 * 1024 * 1024;
            if($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");

            // Verify MYME type of the file
            if(in_array($filetype, $allowed))
            {
    
              if(file_exists("upload/" . $filename))
              {
                  echo $filename . " is already exists.";
                  echo "<img style='width:400px;float:right;'src='upload/".$filename."''>";
              } 
              else
              {
                  move_uploaded_file($_FILES["photo_".$i]["tmp_name"], "upload/" . $filename);
                  echo "Your file was uploaded successfully.";
                  echo "<img style='width:400px;float:right;'src='upload/".$filename."''>";
                  $sql = "INSERT INTO photo_objet(id_photo,id_objet,nom_photo) VALUES (NULL,'".$data_requete_item['id_objet']."','$filename');";
                  $result = mysqli_query($db_handle, $sql);
              } 
            } 
            else
            {
              echo "Error: There was a problem uploading your file. Please try again."; 
            }
          } 
          else
          {
            echo "Error: " . $_FILES["photo_".$i]["error"]."<br>";
          }
      }
    }
      else
      {
        echo "database not found";
      }
      mysqli_close($db_handle);      
    
    ?>
    <input type='button' onclick="window.open('accueil.php','_self');" value='Retour au menu'>
  </body>
  <?php include 'footer.html'; ?>
</html>