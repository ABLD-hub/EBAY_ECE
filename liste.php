
<?php

//On veut sortir tous les objets de l'utilisateur
//La table panier est composé d'un id de l'objet et d'un id_utilisateur égal à $_SESSION['id_utilisateur']
//Si un utilisateur est connecté
if(isset($_SESSION['id_utilisateur']))
{
	$id_utilisateur=$_SESSION['id_utilisateur'];	
}
//Dans le cas contraire, on lui demande de se connecter
else 
{
	header('Location: Formulaire_Connection.php');
	exit();
}
//On initialise la base de donnée
$database="ebay_ece";
//On veut tous les objets 
$table1="item";
//du panier
$table2="panier";
//associé à un utilisateur $id_utilisateur
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);
//Si la base de donnée est trouvée
if ($db_found) 
{
	//On selectionne tous les objets de panier où l'utilisateur apparait
	//On selectionne tous les objets de panier que l'utilisateur a ajouté.
	//$sql = "SELECT id_objet, id_utilisateur, nom_objet, id_categorie, description_objet, lien_video, prix_initial_objet, prix_proposé, vente_par_enchere, date_fin_enchere, vente_immediat, vente_par_meilleure_offre, statut_vente FROM $table1 INNER JOIN $table2 ON $table1.id_objet = $table2.id_item WHERE $table2.id_acheteur = $id_utilisateur";
	$sql= "SELECT * FROM $table1 INNER JOIN $table2 ON $table1.id_objet = $table2.id_item WHERE $table2.id_acheteur = $id_utilisateur";
		//echo $sql; //le sql fonctionne
		$result =mysqli_query($db_handle, $sql);
	if (!mysqli_num_rows($result))
	{
		echo "votre panier est vide";
	}
	else 
	{
		 while($data = mysqli_fetch_assoc($result))//==> nul s'il n'y a plus de ligne dans le tableau
 		 {
    		echo "<form action='delete_item.php' method='post' style='display: inline;'>
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
        if($_SESSION['type_utilisateur']=="admin")
        {

          echo "<div id='admin'>
          <input type='id_objet' name='id_objet' class='form-control' value='".$data['id_objet']."'  style='display:none;' readonly>
          <input type='submit' class='btn btn-danger' name='effacer' value='Supprimer'></div>";
        }
        echo "</div></form>";

 	    }
	}
	

}
else
{
  echo "database not found";
  mysqli_close($db_handle);
}
?>