<?php session_start();?>
<!DOCTYPE html>
<html>
  <head>
    <title>Catégories</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>  
  </head>
  <body>
    <?php include 'navbar.html';?>

    <?php
      $id_objet=$_GET['id_objet'];
      $prix=0;
      $proposition_achat=0;
      $ancienne_proposition_achat=0;

      $output="";
      $output_media="";
      $output_information="";

      $database="ebay_ece";
      $db_handle = mysqli_connect('localhost','root','');
      $db_found = mysqli_select_db($db_handle,$database);
      if($db_found)
      { 
        echo "<div class='container-fluid' style='padding:10px;'>";
        $sql = "SELECT * from objet where id_objet='".$id_objet."';";
        $result = mysqli_query($db_handle, $sql);
        while($data = mysqli_fetch_assoc($result))//==> nul s'il n'y a plus de ligne dans le tableau
        {
          $output.= "<form style='display: inline;' action='page_objet.php?id_objet=".$id_objet."' method='post'>
          <div class='container-fluid'>
          <div class='row'>
          <div class='col-sm-6'>
          <p style='font-size: 30px;'>
          <center><h1 style='border:1px grey double; border-radius:10px; '>" .utf8_encode($data['nom_objet']). "</h1></center><br>
          <strong><h2>Description:</h2></strong><br> " .utf8_encode($data['description_objet']). "</p><br>
          <h2>Prix: " .$data['prix_initial_objet']. " euros</h2><br>
          <table>";

          if(isset($_SESSION['id_utilisateur'])!=NULL)
          {
            if($data['vente_par_enchere']=='1')
            {
             
              $sql = "SELECT * from panier where id_objet='".$id_objet."' AND id_acheteur='".isset($_SESSION['id_utilisateur'])."';";
              $result = mysqli_query($db_handle, $sql);
              if(mysqli_num_rows($result)!=0)
              { 
                while($requete_enchere = mysqli_fetch_assoc($result))//==> nul s'il n'y a plus de ligne dans le tableau
                {
                  $output.= "  
                      <tr>
                        <td><input class='form-control' type='number' name='enchere_value_max' value='".$requete_enchere['proposition_montant_achat']."'></td>
                        <td><input class='btn btn-primary' style='font-size: 25px' type='submit' Name='Encherir' value='Encherir'></td>
                      </tr>";
                
                  $output.= "<tr><td colspan='2' align='center'>vous avez déjà encheri sur cet objet<br>";
                  $ancienne_proposition_achat=$requete_enchere['proposition_montant_achat'];
                }
              }
            }
            if($data['vente_immediat']=='1')
            {
              $output.= "<tr>
                              <td colspan='2' align='center'><input class='btn btn-primary' style='font-size: 25px' type='submit' Name='Achat_immediat' value='Achat immédiat'></td>
                        </tr>";
              $prix=$data['prix_initial_objet'];
            }
           if($data['vente_par_meilleure_offre']=='1')
            {
              $output.= "<tr>
                          <td><input class='form-control' type='number' name='negociation' value='".$data['prix_initial_objet']."'></td>
                          <td><input class='btn btn-primary' style='font-size: 25px' type='button' Name='Negocier' value='Négocier'><td>
                        </tr>";
              $sql = "SELECT * from panier where id_objet='".$id_objet."' AND id_acheteur='".$_SESSION['id_utilisateur']."';";
              $result = mysqli_query($db_handle, $sql);
              if(mysqli_num_rows($result)!=0)
              {
                $output.= "<tr><td colspan='2' align='center'>vous avez déjà négocié sur cet objet<br>";
                while($requete_enchere = mysqli_fetch_assoc($result))//==> nul s'il n'y a plus de ligne dans le tableau
                {
                  $output.= "votre enchère était de :".$requete_enchere['proposition_montant_achat']." euro</td></tr>";
                  $ancienne_proposition_achat=$requete_enchere['proposition_montant_achat'];
                }
              }
            }
          }

          $output_media.="<div class='col-sm-6'>";
          $sql = "SELECT * FROM objet WHERE id_objet='$id_objet';";
          $result = mysqli_query($db_handle, $sql);
          while($data = mysqli_fetch_assoc($result))
          {
           $output_media.= "<img style='width:100%;' src='upload/".$data['photo_1']."'>";
           if($data['photo_2']!=null)
            $output_media.= "<img style='width:100%;' src='upload/".$data['photo_2']."'>";
           if($data['photo_3']!=null)
            $output_media.= "<img style='width:100%;' src='upload/".$data['photo_3']."'>";
          }
          $output_media.= "<div class='embed-responsive embed-responsive-4by3 video'>
          <video class='embed-responsive-item'src='".$data['lien_video']."'></iframe>";
          $output_media.=" </div>
          </div>
          </div>
          </div>
          </div>";
        }
        if(isset($_SESSION['id_utilisateur'])!=NULL)
        {
          $id_utilisateur = $_SESSION['id_utilisateur'];


          if(isset($_POST["Achat_immediat"]))
          {
            $sql = "SELECT * FROM panier WHERE id_acheteur=$id_utilisateur AND id_objet=$id_objet";
            $result = mysqli_query($db_handle, $sql);
            echo $sql;
            if(mysqli_num_rows($result)==0)
            {
              $sql = "INSERT INTO panier(id_panier,id_acheteur,id_objet,proposition_montant_achat,prix_vente) VALUES (NULL,$id_utilisateur,$id_objet,NULL,$prix);";
              ///récupere le resultat de la requête
              $result = mysqli_query($db_handle, $sql);
              header('Location: panier.php');
                exit();
            }
            else
            $output_information.= "Cet objet est déjà présent dans votre panier";
          }
          if(isset($_POST["Encherir"]))
          {
            $mon_enchere_max=isset($_POST["enchere_value_max"])? $_POST["enchere_value_max"]:"";
            $sql = "SELECT * FROM panier WHERE id_acheteur=$id_utilisateur AND id_objet=$id_objet";
            $result = mysqli_query($db_handle, $sql);
            if(mysqli_num_rows($result)==0)
            {
              $sql = "INSERT INTO panier(id_panier,id_acheteur,id_objet,proposition_montant_achat,prix_vente) VALUES (NULL,$id_utilisateur,$id_objet,$mon_enchere_max,NULL);";
              ///récupere le resultat de la requête
              $result = mysqli_query($db_handle, $sql);
            }
            else
            {
              if($ancienne_proposition_achat>$mon_enchere_max)
              {
                $output_information.="Vous ne pouvez pas diminiuer votre enchère initiale !!<br>";
              }
              else
              {
                $sql_update_enchere="UPDATE panier SET proposition_montant_achat='$mon_enchere_max' WHERE id_acheteur='$id_utilisateur' AND id_objet='$id_objet';";
                $result = mysqli_query($db_handle, $sql_update_enchere);
                $output_information.="Votre Enchère a été mis à jour !!<br>";
              }

            }
          }
          if(isset($_POST["Encherir"]))
          {
            $mon_enchere_max=isset($_POST["enchere_value_max"])? $_POST["enchere_value_max"]:"";
            $sql = "SELECT * FROM panier WHERE id_acheteur=$id_utilisateur AND id_objet=$id_objet AND prix_vente=$prix;";
            $result = mysqli_query($db_handle, $sql);
            if(mysqli_num_rows($result)==0)
            {
              $sql = "INSERT INTO panier(id_acheteur,id_objet,proposition_montant_achat,prix_vente) VALUES ($id_utilisateur,$id_objet,NULL,$prix);";
              ///récupere le resultat de la requête
              $result = mysqli_query($db_handle, $sql);
            }
            else
              echo "Cet objet est déjà présent dans votre panier";
          }
        }
      }
      else
      {
        echo "database not found";
      }
      /************************************affichage des données**************************/
        echo $output;
        echo "<tr><td colspan='2'>".$output_information."</td></tr>";
        echo "</table></div>";  
        echo $output_media;
        echo "</div></form>";
        if($_SESSION['type_utilisateur']=="admin")
        {

          echo "<div id='admin'>
          <input type='id_objet' name='id_objet' class='form-control' value='".$data['id_objet']."'  style='display:none;' readonly>
          <input type='submit' class='btn btn-danger' name='effacer' value='Supprimer'></div>";
        }

      mysqli_close($db_handle);
    ?>
  </body>
  <?php include 'footer.html';?>
</html>
