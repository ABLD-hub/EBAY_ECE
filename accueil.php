<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
<title>Ebay ECE </title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="style.css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script type="text/javascript" src="check.js"></script>

</head>
<body>
	<?php
	if(isset($_SESSION['email'])) {
		echo "Session : ".$_SESSION['email'];
		echo " Type : ".$_SESSION['type_utilisateur'];
	}
	else {
		echo 'pas de variable de session';
	}
	?>

	<?php include 'navbar.html';?>
	<?php include 'main.php'; ?>

</body>
	<?php include 'footer.html'; ?>
</html>