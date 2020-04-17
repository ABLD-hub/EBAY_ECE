<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
	<title>Catégories</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="styles.css">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>  
</head>
<body>

<?php include 'navbar.html';?>
<?php
$categorie=$_GET['categorie'];
$type_achat=$_GET['type_achat'];
$id=$_GET['id'];

$database="ebay_ece";
$db_handle = mysqli_connect('localhost','root','');
$db_found = mysqli_select_db($db_handle,$database);
if($db_found)
{ 
  echo "<div class='container-fluid' style='padding:10px;'>";
    $sql = "SELECT * from item where (id_categorie='".$categorie."' OR ".$type_achat."='1') AND id_objet='".$id."';";
  $result = mysqli_query($db_handle, $sql);
  while($data = mysqli_fetch_assoc($result))//==> nul s'il n'y a plus de ligne dans le tableau
  {
    echo "<form style='display: inline;'>
            <div class='container-fluid'>
              <div class='row'>
                <div class='col-sm-6'>
                  <p style='font-size: 30px;'>
                    <center><h1 style='border:1px grey double; border-radius:10px; '>" .$data['nom_objet']. "</h1></center><br>
                    <strong>Description:</strong><br> " .utf8_encode($data['description_objet']). "</p><br>
                    <h2>Prix: " .$data['prix_initial_objet']. " euros</h2><br>";
     if($data['vente_par_enchere']=='1')
    {
            echo "  <div class='col-sm-4'>
                      <input class='form-control' type='number' id='enchere'value='".$data['prix_initial_objet']."'>
                      <input class='btn btn-primary' style='font-size: 25px' type='button' value='Encherir' onclick=verification_encherir(0)>
                    </div>";
    }
    if($data['vente_immediat']=='1')
    {
              echo "<div class='col-sm-4'>
                        <input class='btn btn-primary' style='font-size: 25px' type='button' value='Achat immédiat'>
                    </div>";
    }
    if($data['vente_par_meilleure_offre']=='1')
    {
            echo "<div class='col-sm-4'>
                    <input class='btn btn-primary' style='font-size: 25px' type='button' value='Achat par meilleure offre'>
                    <input class='form-control' type='number' id='enchere'value='".$data['prix_initial_objet']."'>
                    <input class='btn btn-primary' style='font-size: 25px' type='button' value='Négocier' onclick=verification_encherir(0)>
                  </div>";
    }
        echo "</div>
              <div class='col-sm-6'>
               <img style='width:100%;' src='upload/test.jpg'>";
               echo "<div class='embed-responsive embed-responsive-4by3 video'>
                    <iframe class='embed-responsive-item'src='https://www.youtube.com/embed/C0DPdy98e4c'></iframe>";
             echo" </div>
           </div>
          </div>
          </div>
        </div>";

  }
echo "</div></form>";
}
else
{
  echo "database not found";
}
mysqli_close($db_handle);
?>
 </body>
 </html>
