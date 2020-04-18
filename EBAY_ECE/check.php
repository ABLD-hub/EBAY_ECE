<?php

function check()
{
	$AdresseMail= isset($_POST["AdresseMail"])? $_POST["AdresseMail"] : "";
$ID = isset($_POST["ID"])? $_POST["ID"] : "";
$database = "EbayECE";
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);   
if($db_found)
{
	return $AdresseMail;
}
mysqli_close($db_handle);
}

?>