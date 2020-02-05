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
$niperien=verifstring($_POST["tarteau"]);
$fun=verifstring($_POST["citron"]);


$sql="SELECT mail,mdp,statut_id FROM utilisateur WHERE mail=:wazaa ";

$req=$db->prepare($sql);
$req->bindParam(":wazaa",$niperien);
$req->execute();



$data = $req->fetchObject();

var_dump($data);
if($data!=FALSE){
	echo '$data != false';

	if(password_verify($fun,$data->mdp)){
		echo "pw ok";
		$_SESSION["stat"] = $data->statut_id;
	}
}

	function verifstring($mot){
		if (isset($mot)) {
			if(!empty($mot)){
				if(!is_int($mot)){
					//return intval((htmlspecialchars(trim(($mot)))));
					return htmlspecialchars(stripslashes(trim($mot)));
				}
			}
		}
	};



header('location:connect.php');

?>