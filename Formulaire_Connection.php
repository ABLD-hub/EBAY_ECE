<?php 
session_start(); 
?>

<!DOCTYPE html>
<html>
<head>
	<title>Connection ...</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
 	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="check.js"></script>
</head>
<body>

<p style="font-size: 30px" align="center">Formulaire de Connection</p>
<form action="Utilisateur.php" method="post">
	<table align="center">

		<tr>
			<td>Email ou Pseudo:</td>
			<td><input type="pseudo" class="form-control" id="pseudo" name="pseudo"></td>
		</tr>
		<tr>
			<td>Mot de passe :</td>
			<td><input type="password" class="form-control" id="password" name="password"></td>
		</tr>
		<tr>
			<td colspan="2" align="center"><input type="submit" class="btn btn-primary" name="submit" value="Connection"></td>
		</tr>
	</table>
</center>
</body>
</html>