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
$idprod=verifint($_GET["id"]);
$sql="DELETE FROM products WHERE id=:idprod;";

$req=$db->prepare($sql);
$req->bindParam(":idprod",$idprod);
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

header('location:connect.php');
?>