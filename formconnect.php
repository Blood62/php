<?php session_start();

?>


<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="libs/css/connectform.css">
</head>
<body>
<div class="container bg-light border border-dark mt-5">
	<div class="mt-5  text-center"><u><h1>Connexion</h1></u></div>
<form class="mt-3" method="post" action="taffconnexion.php">
	<div class="form-group">
		<label class="label" for="Takoyaki">Mail:</label>
		<input type="email" name="tarteau" class="form-control" id="Takoyaki">Nous ne partagerons jamais votre e-mail avec quelqu'un d'autre.</small>
	</div>
	<div class="form-group">
		<label class="label" for="Nem">Mot de passe:</label>
		<input type="password" name="citron" class="form-control" id="Nem">
	</div>

	<button type="submit" class="btn btn-primary btn-lg btn-block">Se connecter</button>
	<a href="connect.php"><button type="button" class="btn btn-danger btn-lg btn-block mt-2 mb-3">Annuler</button></a></div>
</form>
</div>
</body>
</html>
