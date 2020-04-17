<?php
session_start();
if($_POST["utilisateur"])
{
	$bdd= isset($_POST["utilisateur"])? $_POST["utilisateur"] : "";
}
else if($_POST["item"])
{
	$bdd= isset($_POST["item"])? $_POST["item"] : "";
}
$database="ebayece";
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
			while($data = mysqli_fetch_assoc($result))
			{
				echo $data['pseudo'];
			}
		}
}
?>