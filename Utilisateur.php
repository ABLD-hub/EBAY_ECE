<?php session_start();?>


<?php

$mail = isset($_POST["email"])? $_POST["email"] : "";
$mdp = isset($_POST["password"])? $_POST["password"] : "";

$database = "ebayece";


$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);
if ($_POST["submit"])
{
	if ($db_found) {
		$sql = "SELECT type_utilisateur FROM utilisateur WHERE email LIKE '$mail' AND mot_de_passe LIKE '$mdp'";
			$result = mysqli_query($db_handle, $sql);
			if (mysqli_num_rows($result) == 0) {
				echo 'mot de passe ou utilisateur incorrect';
					exit();
			}

				else {
						$_SESSION['email']=$mail;
						while($data = mysqli_fetch_assoc($result))
						{
							$_SESSION['type_utilisateur']=$data['type_utilisateur'];
						}
						echo $_SESSION['email'];
						echo $_SESSION['type_utilisateur'];
						session_write_close();
						header('Location: accueil.php');
						exit();
					 } 
	}
	else {  echo "Database not found";}
}

		?>