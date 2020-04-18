<?php
session_start();
?>

<?php

if($_POST["utilisateur"])
{
	$bdd= isset($_POST["utilisateur"])? $_POST["utilisateur"] : "";
	$option=2;
}
else if($_POST["item"])
{
	$bdd= isset($_POST["item"])? $_POST["item"] : "";
	$option="1";
}
$database="ebay_ece";
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);
if ($db_found) 
{
		echo $bdd;
		$sql = "SELECT * FROM $bdd";
		echo $sql;
		$result = mysqli_query($db_handle, $sql);
		if (mysqli_num_rows($result) == 0) {
				echo 'naze';
				exit();
			}

		else {
			if($option=="1")
			{
				<form class="form-group" action="Recherche.php" method="post">
				<input type="submit" class="btn btn-primary" name="utilisateur" value="utilisateur">
				<input type="submit" class="btn btn-primary" name="item" value="item">
			}
			else
			{
				while($data = mysqli_fetch_assoc($result))
			{
				echo $data['pseudo'];
			}	
			}
			
		}
}
?>