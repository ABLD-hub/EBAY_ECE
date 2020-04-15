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
		if($_SESSION['type_utilisateur']!="VENDEUR" || $_SESSION['type_utilisateur']!="Admin")
	{
		echo 'Formulaire_Item.php';
	}
	else
	{
		"Veuillez vous connecter en tant que vendeur";
	}
	}
	else
	{
		echo "Formulaire_Connection.php";
	}
}

function phpcheck()
{
	if(isset($_SESSION['type_utilisateur']))
	{
		return "True";
	}
	else
	{
		return "false";
	}
}


?>