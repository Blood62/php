<?php

function verif($mot){
	if (isset($mot)) {
		if(!empty($mot)){
			if(!is_int($mot)){
				return intval((htmlspecialchars(trim(($mot)))));
				//return htmlspecialchars(trim($mot));
			}
		}
	}
};


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

	<div class="mt-2 text-center"><u><h1>Ajouter un nouveau produit</h1></u></div>
	<form method="post" action="">

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
				<option value="1">Fashion</option>
				<option value="2">Electronics</option>
				<option value="3">Motors</option>

			</select>
		</div>
		<div class="form-group">
			<p>image: (chemin)</p>
			<input type="text" class="form-control" name="image" >
		</div>
		<div><button type="submit" class="btn btn-primary btn-lg btn-block">Ajouter</button>
			<a href="connect.php"><button type="button" class="btn btn-danger btn-lg btn-block mt-1">Annuler</button></a></div>
	</form>
</div>
</body>
</html>



