<?php
	session_start();
	unset($_SESSION);
	session_destroy();
	$_SESSION = array();
	header('Location: accueil.php');
	exit();
?>