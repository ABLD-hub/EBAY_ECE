<?php session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>
		</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="style.css">
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> 
		<script type="text/javascript" src="check.js">
		</script>  
	</head>
	<body>
		<?php include 'navbar.html';?>  
		<div class="page">
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
			$table1="objet";
			//du panier
			$table2="panier";
			//associé à un utilisateur $id_utilisateur
			$prix_total = 0;

			$db_handle = mysqli_connect('localhost', 'root', '');
			$db_found = mysqli_select_db($db_handle, $database);
			//Si la base de donnée est trouvée
			if ($db_found) 
			{
				//On selectionne tous les objets de panier où l'utilisateur apparait
				//On selectionne tous les objets de panier que l'utilisateur a ajouté
				echo "<div id='panier'>
						<div id='titre_panier'>
							<h1>Mon panier</h1>
						</div>
						<div class='type_vente'>
							<u><center><h2>Vente immediat</h2></center></u>";
				$sql= "SELECT * FROM $table1 INNER JOIN $table2 ON $table1.id_objet = $table2.id_objet WHERE $table2.id_acheteur = $id_utilisateur AND $table1.vente_immediat=1 ";
				$result =mysqli_query($db_handle, $sql);
				if (mysqli_num_rows($result)==0)
				{
					echo "<div class='panier_info'><center>Votre panier d'achat immédiat est vide<center></div>";
				}
				else 
				{
					 while($data = mysqli_fetch_assoc($result))//==> nul s'il n'y a plus de ligne dans le tableau
			 		 {	
			               echo "<div class='container-fluid'>
				               		<div class='row objet_panier' onclick='lancement_page(".$data['id_objet'].")'>
					               		<div class=' col-sm-4'>
					               			<p><strong>" .$data['nom_objet']. "</strong></p>
					                    	<p><strong>Description:</strong><br> " .utf8_encode($data['description_objet']). "</p>
					                    </div>
					              		<div class='col-sm-4'>
					               			<img style='height:200px;' src='upload/test.jpg'>
							            </div>
							           <div class='col-sm-3'>
							           	<table>
											<tr>
												<td style='text-align:center;'></td>
												<td><h2 align='center'>Prix: " .$data['prix_initial_objet']. " euros</h2></td>
											<tr>
										</table>           
									   </div>
							           <div class='col-sm-1' align='right'>
							           <form action='panier.php' method='post'>
							           		<input type='hidden' name='id' value=".$data['id_panier'].">  
					               			<input type='submit' name='suppression' value='X' class='suppresion_objet btn' style='height:200px;'>
					               	   </form>
							           </div>
						           </div>
						        </div>";
						        $prix_total += $data['prix_initial_objet'];
			 	    }
				}
				echo "<div id='paiement_total'>
						<form action='panier.php' method='post'>
						<center><h2>Prix total = ". $prix_total." euro</h2><br>";
						if($prix_total>0)
						{
							echo	"<input type='submit' name='paiement' value='Tout payer' class='btn btn-primary'></center>";
						}
				echo "</form>
					</div>
				  </div>
				<div class='type_vente'>
							<u><center><h2>Vente par enchere</h2></center></u>";

				$sql= "SELECT * FROM $table1 INNER JOIN $table2 ON $table1.id_objet = $table2.id_objet WHERE $table2.id_acheteur = $id_utilisateur AND $table1.vente_par_enchere=1 AND proposition_montant_achat != null";
				$result =mysqli_query($db_handle, $sql);
				if (mysqli_num_rows($result)==0)
				{
					echo "<div class='panier_info'><center>Votre panier d'enchère est vide<center></div>";
				}
				else 
				{
					 while($data = mysqli_fetch_assoc($result))//==> nul s'il n'y a plus de ligne dans le tableau
			 		 {	
			               echo "<div class='container-fluid'>
				               		<div class='row objet_panier' onclick='lancement_page(".$data['id_objet'].")'>
					               		<div class=' col-sm-4'>
					               			<p><strong>" .$data['nom_objet']. "</strong></p>
					                    	<p><strong>Description:</strong><br> " .utf8_encode($data['description_objet']). "</p>
					                    </div>
					              		<div class='col-sm-4'>
					               			<img style='height:200px;' src='upload/test.jpg'>
							           </div>
							           <div class='col-sm-3'>
							           	<table>
											<tr>
												<td style='text-align:center;'></td>
												<td><h2 align='center'>Prix de départ: " .$data['prix_initial_objet']. " euros</h2></td>
											<tr>
											<tr>
												<td style='text-align:center;'></td>
												<td><h2 align='center'>Votre enchère: " .$data['proposition_montant_achat']. " euros</h2></td>
											<tr>
										</table>           
									   </div>
						           </div>
						        </div>";
						        $prix_total += $data['prix_initial_objet'];
			 	    }
				}
				echo "<br><center><strong>les enchères sont automatiquement débités sur votre compte afin de simplifier la démarche.<br>Pour augmenter votre enchère max, il suffit de cliquer sur l'onglet de l'objet ci-dessus.<br>Une fois que vous avez encheri sur un objet il est impossible de l'annuler.</strong><center>
						</div>
					</div>";
				if(isset($_POST["suppression"]))
			      {
			      	$id_panier=$mon_enchere_max=isset($_POST["id"])? $_POST["id"]:"";
			      	$sql= "DELETE FROM panier WHERE id_panier = '$id_panier';";
					$result =mysqli_query($db_handle, $sql);
			      }
			    if(isset($_POST["paiement"]))
			      {
			      	$date_maintenant = date("Y-m-d");
			      	$date_facture = date("Y-m-d");
			      	$date_livraison =date('Y-m-d', strtotime($date_maintenant. ' + 5 days'));
			      	$sql_creation_facture = "INSERT INTO facture(id_facture,id_acheteur,validation_transaction,date_facture,date_livraison) VALUES (NULL,$id_utilisateur,true,'$date_facture','$date_livraison');";
	              	$result_creation_facture = mysqli_query($db_handle, $sql_creation_facture);
					$sql_id_facture = "SELECT id_facture FROM facture WHERE id_utilisateur='$id_utilisateur' AND date_facture='NULL' AND date_livraison = NULL;";
	              	$sql_id_facture = mysqli_query($db_handle, $sql_id_facture);
	              	
					/*while($data_recuperation_objet = mysqli_fetch_assoc($result_recuperation_objet))//==> nul s'il n'y a plus de ligne dans le tableau
			 		{	
			 			$id_acheteur=$data_recuperation_objet['id_acheteur'];
			 			$proposition_montant_achat=$data_recuperation_objet['proposition_montant_achat'];
			 			if($proposition_montant_achat=="") $proposition_montant_achat='NULL';
			 			$prix_vente=$data_recuperation_objet['prix_vente'];
			 			if($prix_vente=="") $prix_vente='NULL';
				      	$sql = "INSERT INTO facture(id_facture,id_acheteur,proposition_montant_achat,prix_vente) VALUES (NULL,$id_acheteur,$proposition_montant_achat,$prix_vente);";
				      	echo $sql;
	              		///récupere le resultat de la requête
	              		$result = mysqli_query($db_handle, $sql);
				      	$id_panier=$mon_enchere_max=isset($_POST["id"])? $_POST["id"]:"";
				      	$sql= "DELETE FROM panier WHERE id_panier = '$id_panier';";
						$result =mysqli_query($db_handle, $sql);
					}*/
			      }
			}
			else
			{
			  echo "database not found";
			  mysqli_close($db_handle);
			}
			?>
			</div>
		</div>
	</body>
	<?php include 'footer.html';?>  
</html>