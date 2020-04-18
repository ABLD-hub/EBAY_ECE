<?php
function check()
{
	echo $_SESSION['email'];
}


function check_vendeur()
{
	///Si il y a un utilisateur
	if(isset($_SESSION['type_utilisateur']))
	{
		if($_SESSION['type_utilisateur']=="vendeur" OR $_SESSION['type_utilisateur']=="admin")
		{
			echo 'Formulaire_Item.php';
		}
		else
		{
			echo "Formulaire_Demande.php";
		}
	}
	else
	{
		echo "Formulaire_Connection.php";
	}
}

function recup_number()
{	
	echo "***********".substr($_SESSION['carte_numero'],-5);
}


?>