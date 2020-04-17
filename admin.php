<?php 
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>Ebay ECE </title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet"
 href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
 <link rel="stylesheet" type="text/css" href="style.css">
 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script type="text/javascript" src="check.js">
</script>

</head>
<body>
<?php include 'navbar.html';?>
<form class="form-group" action="liste.php" method="post">
	<input type="submit" class="btn btn-primary" name="utilisateur" value="utilisateur">
	<input type="submit" class="btn btn-primary" name="item" value="item">
</body>