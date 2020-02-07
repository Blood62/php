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

$sql="SELECT p.id,p.name,p.description,p.price,p.image,c.name as nomcat FROM products as p,categories as c WHERE p.category_id=c.id;";

$req=$db->prepare($sql);
$req->execute();
?>

<!DOCTYPE html>
<html lang="fr" xmlns="http://www.w3.org/1999/html">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="libs/css/modal.css">
</head>
<body>

<span id="good-job"><?php if (isset($_SESSION["success"])){
		if(!empty($_SESSION["success"])){
			echo 	$_SESSION["success"];
			$_SESSION["success"]='';
		}}; ?></span>
<div class="row w">

	<?php if(isset($_SESSION["stat"])&&$_SESSION["stat"]!=FALSE){
	?><a href="deco.php"><button type="button" class="mt-5 btn btn-outline-danger  ml-3 mb-3">Deconnexion</button></a><?php } ?>


    <a href="forminscription.php"><button type="button" class="mt-5 btn btn-outline-primary  ml-3 mb-3">Inscription</button></a>

	<?php if ($_SESSION==NULL)
	{?><a href="formconnect.php"><button type="button" class="mt-5 btn btn-outline-success  ml-3 mb-3">Connexion</button></a><?php } ?>


	<h1 class="text-center mt-5 mb-3 col-5 -col-sm-5"><u>Gestion des Produits</u></h1>
    <?php if(isset($_SESSION["stat"]) && $_SESSION["stat"] == "1"){
    	?>
	<a href="Nproducts.php"><button type="button" class="mt-5 lol btn btn-outline-warning  mr-3 mb-3">Ajouter un nouveau produit</button></a><?php } ?>
</div>

<table class="table table-dark">
	<thead>
	<tr>
		<th scope="col">Nom produits</th>
		<th scope="col">Descriptions</th>
		<th scope="col">Prix</th>
		<th scope="col" class="text-center">images</th>
		<th scope="col">categories</th>

	</tr>
	</thead>
	<tbody>


<?php
while($data = $req->fetchObject()){
	?>
    <tr>
        <td> <?=$data->name ?> </td>
        <td> <?= $data->description ?> </td>
        <td> <?= $data->price ?> </td>
        <td><img class="short" src="libs/img/<?=$data->image?>" alt="image"></td>
        <td> <?= $data->nomcat ?></td>
        <td>
            <a href="detail.php?id=<?=$data->id?>"><button type="button" class="btn btn-info mr-1 mb-2">Details</button></a>
			<?php if(isset($_SESSION["stat"]) && $_SESSION["stat"] == "1"){
				?><a href="modification.php?id=<?=$data->id?>"><button type="button" class="btn btn-primary mr-1 mb-2">Modifier</button></a><?php }?>
			<!--Modal+btn-->
			<!-- Button trigger modal -->
			<?php if(isset($_SESSION["stat"]) && $_SESSION["stat"] == "1"){
				?><button type="button" class="btn btn-danger mb-2" data-toggle="modal" data-target="#staticBackdrop<?=$data->id?>">
				Supprimer
			</button><?php }?>

			<!-- Modal -->
			<div class="modal fade" id="staticBackdrop<?=$data->id?>" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h2 class="modal-title color" id="staticBackdropLabel<?=$data->id?>">Confirmation de suppression d'article</h2>
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body color">
							<p>Souhaitez-vous réellement supprimer <u><?=$data->name?></u>?</p>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
							<a href="suppression.php?id=<?=$data->id?>"><button type="button" class="btn btn-primary">Confirmer</button></a>
						</div>
					</div>
				</div>
			</div>
    </tr>
	<?php
}
?>

	</tbody>
</table>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>






