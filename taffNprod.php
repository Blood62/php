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
$img=$_FILES['userfile'];
$cate=verifint($_POST["cat"]);


$dest = ('libs/img/' . $_FILES['userfile']['name']);
$fichierupType = ($_FILES['userfile']['type']);
$fichierup = ($_FILES['userfile']['tmp_name']);
//var_dump($_FILES);
if ($fichierupType == preg_match('@image/@', verifstring($fichierup))) {
	//var_dump(mime_content_type($fichierup));
	//var_dump($fichierupType);echo "/////";var_dump(mime_content_type($_FILES['userfile']['tmp_name']));
	if ($fichierupType == mime_content_type($fichierup)) {
		//var_dump($_FILES['userfile']['tmp_name']);
		//var_dump($dest);
		$test = move_uploaded_file($_FILES['userfile']['tmp_name'], $dest);

		//var_dump($test);
	}

}


$sql="INSERT INTO products (name,description,price,category_id,image) VALUES (:nom,:descri,:prix,:cat,:img);";

$req=$db->prepare($sql);
$req->bindParam(":descri",$descri);
$req->bindParam(":prix",$prix);
$req->bindParam(":cat",$cate);
$req->bindParam(":img",$img['name']);
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
			if (is_int($mot)) {
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