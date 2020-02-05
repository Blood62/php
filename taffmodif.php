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
$descri=verifstring($_POST["desc"]);
$name=verifstring($_POST["nom"]);
$prix=verifint($_POST["Prix"]);
$idprod=verifint($_POST["id"]);
$img=verifstring($_POST["image"]);
$cate=verifint($_POST["cat"]);

$sql="UPDATE products as popo SET popo.name=:nom,popo.description=:descri,popo.price=:prix,popo.category_id=:cat,popo.image=:img WHERE popo.id=:idprod;";

$req=$db->prepare($sql);
$req->bindParam(":idprod",$idprod);
$req->bindParam(":descri",$descri);
$req->bindParam(":prix",$prix);
$req->bindParam(":cat",$cate);
$req->bindParam(":img",$img);
$req->bindParam(":nom",$name);
$req->execute();




function verifstring($mot){
	if (isset($mot)) {
		if(!empty($mot)){
			if(!is_int($mot)){
				//return intval((htmlspecialchars(trim(($mot)))));
				return htmlspecialchars(trim($mot));
			}
		}
	}
};


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




header('location:detail.php?id='.$idprod);

?>



