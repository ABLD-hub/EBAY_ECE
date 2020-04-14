

<?php
// On démarre la session AVANT toute chose
function check()
{
	echo $_SESSION['email'];
}




function href($href="Formulaire_Connection.php")
{
	
	if(check()=="")
	{
		$href="Formulaire_Connection.php";
		return $href;
	}
	else
	{
		return $href;
	}
}


?>