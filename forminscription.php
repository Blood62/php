<?php session_start();
require "config.php";

function connect()
{
	try {
		$db = new PDO('mysql:host=' . LOCALHOST . ';dbname=' . DATABASE . ';charset=utf8', USER, MDP);
		return $db;
	} catch (Exception $e) {
		die('Erreur : ' . $e->getMessage());
	}
}


$db=connect();

$sql="SELECT * FROM statut ";

$req=$db->prepare($sql);
$req->execute();








?>


<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="libs/css/inscriform.css">
</head>
<body>
<div class="container bg-light border border-dark mt-5">
	<div class="mt-5  text-center"><u><h1>Inscription</h1></u></div>
    <span class="mt-2" id="skin"><?php if (isset($_SESSION["error2"])){
			if(!empty($_SESSION["error2"])){
				echo 	$_SESSION["error2"];
				$_SESSION["error2"]='';
			}}; ?></span>
<form method="post"  action="inscription.php">

	<div class="form-group">
		<label class="under" for="Nom">Nom:</label>
		<input type="text" class="form-control" name="meringue" id="Nom">
	</div>
	<div class="form-group">
		<label class="under" for="Prenom">Prénom:</label>
		<input type="text" class="form-control" name="chicon" id="Prenom">
	</div>
	<div class="form-group">
		<label class="under" for="Email1">Mail:</label>
		<input type="email" name="citron" class="form-control" id="Email1" aria-describedby="emailHelp">
		<small id="emailHelp" class="form-text text-muted">Nous ne partagerons jamais votre e-mail avec quelqu'un d'autre.</small>
	</div>
	<div class="form-group mt-2">
		<label class="under" for="Password1">Mot de passe:</label>
		<input type="password" name="gnak" class="form-control" id="Password1">
	</div>
	<div class="form-group">
		<label class="under" for="Password2">Confirmation du mot de passe:</label>
		<input type="password" class="form-control" name="gnak2" id="Password2">
		<span id="alert"><?php if (isset($_SESSION["error"])){
		if(!empty($_SESSION["error"])){
		echo 	$_SESSION["error"];
		$_SESSION["error"]='';
		}}; ?></span>
	</div>


	<button type="submit" class="btn btn-primary btn-lg btn-block mt-2 mb-1">Valider</button>
    <a href="connect.php"><button type="button" class="btn btn-danger btn-lg btn-block mt-1 mb-3">Annuler</button></a></div>
</form>
</div>

</body>
</html>