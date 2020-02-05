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

$sql="SELECT p.id,p.name,p.description,p.price,p.image,c.name as nomcat FROM products as p,categories as c WHERE p.category_id=c.id AND p.id=:prod;";

$idprod=verifint($_GET["id"]);

$req=$db->prepare($sql);
$req->bindParam(":prod",$idprod);
$req->execute();

function verifint($mot)
{
	if (isset($mot)) {
		if (!empty($mot)) {
			if (!is_int($mot)) {
				return intval((htmlspecialchars(trim(($mot)))));
				//return htmlspecialchars(trim($mot));
			} else {
				return htmlspecialchars(trim($mot));
			}
		}
	}
};


?>
<?php
while($detail = $req->fetchObject()){
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
<div class="container border border-dark bg-light mt-5">
	<div class="border border-dark  text-center mt-3">
		<u><h1>Détails sur <?=$detail->name ?></h1></u>
	</div>
	<div class="mt-1 text-center">
		<h3>appartenant à la catégorie:<?=$detail->nomcat?></h3>
	</div>
	<div class="text-center mt-2">
		<h2>Au prix de: <?=$detail->price?>€</h2>
	</div>
	<div class="mt-2 text-center">
		<img  src="libs/img/<?=$detail->image?>" alt="image">
	</div>
	<div class=" mt-5 border border-dark mb-2">
		<p class="ml-3"><?=$detail->description?></p>
	</div>
	<div>
		<?php if(isset($_SESSION["stat"]) && $_SESSION["stat"] == "1"){
			?><a href="modification.php?id=<?=$detail->id?>"><button type="button" class="btn btn-primary btn-lg btn-block  ">Modifier</button></a><?php } ?>
		<a href="connect.php"><button type="button" class="btn btn-danger btn-lg btn-block mt-1 mb-3">Annuler</button></a></div>
	</div>

</div>
</body>
</html>
	<?php
}
?>