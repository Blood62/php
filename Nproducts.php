<?php
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

$sql="SELECT * FROM categories;";

$req=$db->prepare($sql);
$req->execute();

?>


<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>

<html>
<body>
<div class="container bg-light">

	<div class="mt-2 text-center"><u><h1>Ajout d'un produit</h1></u></div>
	<form method="post" action="taffNprod.php">
		<div class="form-group">
			<p>Nom du produit:</p>
			<input type="text" class="form-control" name="nom" >
		</div>
		<div class="form-group">
			<p>Description:</p>
			<textarea type="text" class="form-control" name="desc" ></textarea>
		</div>
		<div class="form-group">
			<p>Prix du produit:</p>
			<input type="text" class="form-control" name="Prix" >
		</div>
		<div class="form-group">
			<p>Categorie</p>
			<select class="form-control" name="cat">
				<?php
				while($datacat = $req->fetchObject()){
					?>
                    <option value="<?=$datacat->id?>"><?=$datacat->name?></option>

					<?php
				}
				?>

			</select>
		</div>
		<div class="form-group">
			<p>image:</p>
			<input type="text" class="form-control" name="image" >
		</div>
		<div><button type="submit" class="btn btn-primary btn-lg btn-block">Ajouter</button>
			<a href="connect.php"><button type="button" class="btn btn-danger btn-lg btn-block mt-1">Annuler</button></a></div>
	</form>
</div>
</body>
</html>



