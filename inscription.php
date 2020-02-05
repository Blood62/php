<?php session_start();


require "config.php";

function connect()
{
	try {
		$db = new PDO('mysql:host=' . LOCALHOST . ';dbname=' . DATABASE . ';charset=utf8', USER, MDP);
		$db -> setAttribute ( PDO :: ATTR_ERRMODE , PDO :: ERRMODE_EXCEPTION );
		return $db;
	} catch (Exception $e) {
		die('Erreur : ' . $e->getMessage());
	}
}
$db=connect();
$name=verifstring($_POST["meringue"]);
$prenom=verifstring($_POST["chicon"]);
$mail=verifstring($_POST["citron"]);
$mdp=verifstring($_POST["gnak"]);

$mdp2=verifstring($_POST["gnak2"]);



$hash= password_hash (  $mdp,PASSWORD_BCRYPT);

$stat=($_POST["jakson"]);// valeur venant de db donc verif pas obligatoire!
$sql2="SELECT mail FROM utilisateur WHERE mail LIKE :totof";

$req2=$db->prepare($sql2);
$req2->bindParam(":totof",$mail);
$req2->execute();
$test = FALSE;
while($data=$req2->fetchObject()){
	if ($data->mail==$mail){
		$test=TRUE;
	}
}


if ($mdp==$mdp2&&$test==FALSE) {
	$sql = "INSERT INTO utilisateur (name,prenom,mail,mdp,statut_id) VALUES (:toto,:tata,:titi,:tutu,2);";

	$req = $db->prepare($sql);
	$req->bindParam(":toto", $name);
	$req->bindParam(":tata", $prenom);
	$req->bindParam(":titi", $mail);
	$req->bindParam(":tutu", $hash);
	$req->execute();
$_SESSION["success"]='youpi vous etes inscrit!';
header('location:connect.php');
}
else{
	if ($mdp!=$mdp2){
	$_SESSION["error"]='mot de passe non identique!';
	header('location:forminscription.php');
	}
	if ($test==TRUE){
		$_SESSION["error2"]='login deja existant';
		header('location:forminscription.php');
	}
}

function verifstring($mot){
	if (isset($mot)) {
		if(!empty($mot)){
			if(!is_int($mot)){
				//return intval((htmlspecialchars(trim(($mot)))));
				return htmlspecialchars(trim($mot));
			}
		}
	}
		//header('location:forminscription.php');
};


function verifint($mot)
{
	if (isset($mot)) {
		if (!empty($mot)) {
			if (is_int($mot)) {
				return intval((htmlspecialchars(trim(($mot)))));
				//return htmlspecialchars(trim($mot));
			}
		}
	}
	//header('location:forminscription.php');
};

echo 'inscription effectuer!';
//header('location:connect.php')
?>