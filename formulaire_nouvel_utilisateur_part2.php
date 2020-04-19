<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
  <title>Création d'un compte Utilisateur</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="style.css">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="check.js"></script>
  <script type="text/javascript">
    function verification_password()
    {
       if(document.getElementById('motdepasse').value!=document.getElementById('motdepasse_verif').value)
       {
        alert("Les mots de passe ne sont pas identique !!")
        $('#motdepasse_verif').css('background-color','#FFC0C0');
        $('#motdepasse').css('background-color','#FFC0C0');
        $('#Ajout').prop('disabled',true);
       }
       else
       {
        $('#motdepasse_verif').css('background-color','white');
        $('#motdepasse').css('background-color','white');
        $('#Ajout').prop('disabled',false);
       }
    }
    function verification_type_utilisateur()
    {
      $('.acheteur').prop('display','none');
      if(document.getElementById('utilisateur').value=="vendeur")
      {
          $('.acheteur_form').css('display','none');
          $('.acheteur_input').prop('disabled',true);
          $('.vendeur_form').css('display','');
          $('.vendeur_input').prop('disabled',false);
      }
      else
      {
          $('.acheteur_form').css('display','');
          $('.acheteur_input').prop('disabled',false);
          $('.vendeur_form').css('display','none');
          $('.vendeur_input').prop('disabled',true);
      }
    }
  </script>
</head>
<body>
  
<?php include 'navbar.html'; ?>
<tr>
    <td>Type d'utilisateur :</td>
    <td>
      <select id="utilisateur" name="utilisateur" onchange="verification_type_utilisateur()" required>
        <option> acheteur </option>
        <option> vendeur </option>
      </select>
    </td>
  </tr>
  <tr class="acheteur_form">
    <td>Adresse ligne1 :</td>
    <td><input type="text" class="form-control acheteur_input" name="adresse1" required></td>
  </tr>

  <tr class="acheteur_form">
    <td>Adresse ligne2 :</td>
    <td><input type="text" class="form-control acheteur_input" name="adresse2"></td>
  </tr>

  <tr class="acheteur_form">
    <td>Ville :</td>
    <td>
      <input type="text" class="form-control acheteur_input" name="ville" required>
    </td>
  </tr>

  <tr class="acheteur_form">
    <td>Code postal :</td>
    <td>
      <input type="text" class="form-control acheteur_input" name="codepostal" required>
    </td>
  </tr>

  <tr class="acheteur_form">
    <td>Pays :</td>
    <td>
      <input type="text" class="form-control acheteur_input" name="pays" required>
    </td>
  </tr>

  <tr class="acheteur_form">
    <td>Numéro de téléphone :</td>
    <td>
      <input type="text" class="form-control acheteur_input" name="no_tel" required>
    </td>
  </tr>

  <tr class="acheteur_form">
    <td>Type de carte :</td>
    <td>
      <select name="type_carte" class="form-control acheteur_input"required>
        <option> Visa </option>
        <option> MasterCard </option>
        <option> American Express </option>
        <option> PayPal </option>
      </select>
    </td>
  </tr>

  <tr class="acheteur_form">
    <td>Nom du propriétaire de la carte :</td>
    <td>
      <input type="text" class="form-control acheteur_input" name="proprietaire_carte" required>
    </td>
  </tr>

  <tr class="acheteur_form">
    <td>Date d'expiration :</td>
    <td>
      <input type="month" class="form-control acheteur_input" name="date_expiration" required>
    </td>
  </tr>

  <tr class="acheteur_form">
    <td>Code de carte :</td>
    <td>
      <input type="number" class="form-control acheteur_input" name="code_carte" maxlength="16" required>
    </td>
  </tr>

  <tr class="acheteur_form">
    <td>Cryptogramme de sécurité de carte :</td>
    <td>
      <input type="password" class="form-control acheteur_input" name="code_secu_carte" maxlength="4" required>
    </td>
  </tr>

  <tr class="vendeur_form" style="display: none;">
    <td>Photo de profil :</td>
    <td>
      <input type="file" class="vendeur_input" name="photo_de_profil">
    </td>
  </tr>

  <tr class="vendeur_form" style="display: none;">
    <td>Photo de fond :</td>
    <td>
      <input type="file" class="vendeur_input" name="photo_de_fond">
    </td>
  </tr>

  <tr>
    <td>Mot de passe :</td>
    <td><input type="password" id="motdepasse" class="form-control" name="motdepasse" required></td>
  </tr>

  <tr>
    <td>Vérification mot de passe :</td>
    <td><input type="password" id="motdepasse_verif" class="form-control" name="motdepasse_verif" required onblur="verification_password()"></td>
  </tr>

  <tr class="acheteur_form">
    <td colspan="2" align="">
      <input type="checkbox" class="acheteur_input" name="condition_d'utilisation" required><strong>  Conditions d'utilisation: </strong>Vous acceptez la clause disant que si vous faites une offre sur un article, vous êtes sous contrat legal de l'achetez si le vendeur accepte l'offre.
    </td>
  </tr>
  <tr>
   <td colspan="2" align="center">
    <input type="submit" class="btn btn-primary" name="Ajout" id="Ajout" value="Créer">
  </td>
 </tr>
<p>
</table>
</form>
<?php
  $nom = isset($_POST["nom"])? $_POST["nom"]:"";
  $prenom = isset($_POST["prenom"])? $_POST["prenom"]:"";
  $pseudo = isset($_POST["pseudo"])? $_POST["pseudo"]:"";
  $email = isset($_POST["email"])? $_POST["email"]:"";
  $utilisateur = isset($_POST["utilisateur"])? $_POST["utilisateur"]:"";
  $motdepasse = isset($_POST["motdepasse"])? $_POST["motdepasse"]:"";

  $adresse1 = isset($_POST["adresse1"])? $_POST["adresse1"]:"";
  $adresse2 = isset($_POST["adresse2"])? $_POST["adresse2"]:"";
  $ville = isset($_POST["ville"])? $_POST["ville"]:"";
  $codepostal = isset($_POST["codepostal"])? $_POST["codepostal"]:"";
  $pays = isset($_POST["pays"])? $_POST["pays"]:"";

  $no_telephone = isset($_POST["no_tel"])? $_POST["no_tel"]:"";

  $type_carte = isset($_POST["type_carte"])? $_POST["type_carte"]:"";
  $propio_carte = isset($_POST["proprietaire_carte"])? $_POST["proprietaire_carte"]:"";
  $date_expiration = isset($_POST["date_expiration"])? $_POST["date_expiration"]:"";
  $code_carte = isset($_POST["code_carte"])? $_POST["code_carte"]:"";
  $cryptogramme = isset($_POST["code_secu_carte"])? $_POST["code_secu_carte"]:"";

  $database="ebay_ece";
  $db_handle = mysqli_connect('localhost','root','');
  $db_found = mysqli_select_db($db_handle,$database);
  if($db_found)
  {
    if(isset($_POST["Ajout"]))
      {
        $erreur="";
        echo "<script>$('form').css('display','none');</script>";
        $sql = "SELECT DISTINCT * FROM utilisateur WHERE email LIKE '$email';";
        $result = mysqli_query($db_handle, $sql);
        if(mysqli_num_rows($result)!=0)
        {
          $erreur.="<div style='margin: 15px; background-color:brown; color:white; border-radius: 10px;'>Erreur: Un utilisateur avec la même adresse email est déjà existant!!<br></div>";
        }
        if($erreur=="")
        {
          if($utilisateur=="acheteur")
          {
          $sql = "INSERT INTO utilisateur(id_utilisateur,nom_utilisateur,prenom_utilisateur,pseudo,email,mot_de_passe,type_utilisateur,lien_photo_utilisateur,lien_photo_fond,adresse_ligne_1,adresse_ligne_2,adresse_ville,adresse_code_postal,adresse_pays,no_telephone,carte_type,carte_numero,carte_nom,carte_date_expiration,carte_code) VALUES (NULL,'$nom','$prenom','$pseudo','$email','$motdepasse','$utilisateur',NULL,NULL,'$adresse1','$adresse2','$ville','codepostal','$pays','$no_telephone','$type_carte','$code_carte','$propio_carte','$date_expiration','$cryptogramme');";
          }
          else
          {
            $photo_de_profil="";
            $photo_de_fond="";
            $nom_image = array(0 => "photo_de_profil",1 => "photo_de_fond");
            $file_image = array(0 => "" , 1=> "");

            for ($i=0; $i <2  ; $i++) 
            { 
            if(isset($_FILES[$nom_image[$i]]) && $_FILES[$nom_image[$i]]["error"] == 0){
                $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
                $filename = $_FILES[$nom_image[$i]]["name"];
                $filetype = $_FILES[$nom_image[$i]]["type"];
                $filesize = $_FILES[$nom_image[$i]]["size"];
                    // Verify file extension
                    $ext = pathinfo($filename, PATHINFO_EXTENSION);
                    if(!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");
                    // Verify file size - 5MB maximum
                    $maxsize = 5 * 1024 * 1024;
                    if($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");
                    // Verify MYME type of the file
                    if(in_array($filetype, $allowed)){
                        // Check whether file exists before uploading it
                            $file_image[$i]=$nom."_".$prenom."_".$pseudo."_".$i."_".rand(0,40).".jpg";
                            move_uploaded_file($_FILES[$nom_image[$i]]["tmp_name"], "upload_profil/" . $file_image[$i]);
                            echo "Your file was uploaded successfully.";
                    }else{echo "Error: There was a problem uploading your file. Please try again."; }
                }else{echo "Error: " . $_FILES[$nom_image[$i]]["error"];}
             echo "<br><img src='upload_profil/".$_FILES[$nom_image[$i]]['name']."'>";
            }
            echo $_FILES['photo_de_profil']['name'];
            $sql = "INSERT INTO utilisateur(id_utilisateur,nom_utilisateur,prenom_utilisateur,pseudo,email,mot_de_passe,type_utilisateur,lien_photo_utilisateur,lien_photo_fond) VALUES (NULL,'$nom','$prenom','$pseudo','$email','$motdepasse','$utilisateur','$file_image[0]','$file_image[1]');";
          echo $sql;
          $result=mysqli_query($db_handle, $sql);
        }
          echo "<div style='margin: 15px; background-color:green; color:white; border-radius: 10px;'>Votre Compte à bien été créé.</div>";
        }
        else
        {
          echo $erreur;
        }
        echo "<form action='Accueil.php'><input type=submit class='btn btn-primary' value='Accueil'></form>";
        $_SESSION['email']=$email;
        $sql = "SELECT DISTINCT * FROM utilisateur WHERE email LIKE '$email';";
        $result = mysqli_query($db_handle, $sql);
        while($data = mysqli_fetch_assoc($result))
        {
          $_SESSION['id_utilisateur']=$data['id_utilisateur'];
          $_SESSION['nom_utilisateur']=$data['nom_utilisateur'];
          $_SESSION['prenom_utilisateur']=$data['prenom_utilisateur'];
          $_SESSION['pseudo']=$data['pseudo'];
          $_SESSION['email']=$data['email'];
          $_SESSION['mot_de_passe']=$data['mot_de_passe'];
          $_SESSION['type_utilisateur']=$data['type_utilisateur'];
          $_SESSION['lien_photo_utilisateur']=$data['lien_photo_utilisateur'];
          $_SESSION['lien_photo_fond']=$data['lien_photo_fond'];
          $_SESSION['adresse_ligne_1']=$data['adresse_ligne_1'];
          $_SESSION['adresse_ligne_2']=$data['adresse_ligne_2'];
          $_SESSION['adresse_ville']=$data['adresse_ville'];
          $_SESSION['adresse_code_postal']=$data['adresse_code_postal'];
          $_SESSION['adresse_pays']=$data['adresse_pays'];
          $_SESSION['no_telephone']=$data['no_telephone'];
          $_SESSION['carte_type']=$data['carte_type'];
          $_SESSION['carte_numero']=$data['carte_numero'];
          $_SESSION['carte_nom']=$data['carte_nom'];
          $_SESSION['carte_date_expiration']=$data['carte_date_expiration'];
          $_SESSION['carte_code']=$data['carte_code'];
        }
        session_write_close();
        exit();
    }
  if(isset($_POST["Ajout"]))
  {

  }
}
else
{
  echo "BDD introuvable";
}
mysqli_close($db_handle);
?>
</div></div>
</body>
<?php include 'footer.html'; ?>
</html>