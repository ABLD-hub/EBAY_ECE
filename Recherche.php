<?php
$database="test2";
$db_handle = mysqli_connect('localhost','root','');
$db_found = mysqli_select_db($db_handle,$database);
echo "test";
if($db_found)
{
	$sql ="";
	if(isset($_POST["Ferraille_ou_Tresor"]))
	{}
	$sql = "SELECT * from item where Categorie ='FERRAILLE_OU_TRESOR';";
	$result = mysqli_query($db_handle, $sql);
	while($data = mysqli_fetch_assoc($result))//==> nul s'il n'y a plus de ligne dans le tableau
	{
		echo "Nom: " .$data['Nom']. "<br>";
		echo "<br>";
	}
}
else
{
	echo "database not found";
}
mysqli_close($db_handle);
?>