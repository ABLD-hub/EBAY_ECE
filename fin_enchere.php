<?php
$database = "ebay_ece";
$id = isset($_POST["id_objet"])? $_POST["id_objet"] : "";
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);

if ($db_found)
{
if($_POST["vendu"])
		{
			$sql= "UPDATE item SET statut_vente='vendu' WHERE id_objet=$id;";
			echo $sql;
			$result = mysqli_query($db_handle, $sql);
			session_write_close();
			header('Location: admin.php');
			exit();
		}
}
?>