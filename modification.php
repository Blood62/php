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

$var=verif($_GET["id"]);

$db=connect();

$sql="SELECT * FROM categories;";

$req=$db->prepare($sql);
$req->execute();

$sql2="SELECT * FROM products WHERE id=:lol;";

$req2=$db->prepare($sql2);
$req2->bindParam(":lol",$var);
$req2->execute();

$dataprod = $req2->fetch();



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

    <div class="mt-5  text-center"><u><h1>Modification du produit N°<?=$var?></h1></u></div>
    <form method="post" action="taffmodif.php" enctype="multipart/form-data">
        <div class="form-group">
            <input type="text" class="form-control" value="<?=$var?>" name="id" hidden>
        </div>


        <div class="form-group">
            <p>Nom du produit:</p>
            <input type="text" class="form-control" name="nom" value="<?=$dataprod["name"]?>" >
        </div>

        <div class="form-group">
            <p>Description:</p>
            <textarea type="text" class="form-control" name="desc"  ><?=$dataprod["description"]?></textarea>
        </div>
        <div class="form-group">
            <p>Prix du produit:</p>
            <input type="text" class="form-control" name="Prix" value="<?=$dataprod["price"]?>" >
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
            <!-- MAX_FILE_SIZE doit précéder le champ input de type file -->
            <input type="hidden" name="MAX_FILE_SIZE" value="30000000" />
            <!-- Le nom de l'élément input détermine le nom dans le tableau $_FILES -->
            Envoyez ce fichier : <input name="userfile" type="file"  />
        </div>
        <div><button type="submit" name="submit" class="btn btn-primary btn-lg btn-block">Modifier</button>
            <a href="connect.php"><button type="button" class="btn btn-danger btn-lg btn-block mt-1">Annuler</button></a></div>
    </form>
</div>
</body>
</html>



