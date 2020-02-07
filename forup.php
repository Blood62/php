
<?php
if (isset($_POST['submit'])) {
	//var_dump($_FILES);

	$dest = ('libs/img/' . $_FILES['userfile']['name']);
	$fichierupType = ($_FILES['userfile']['type']);
	$fichierup = ($_FILES['userfile']['tmp_name']);
//var_dump($_FILES);
	if ($fichierupType == preg_match('@image/@', verifstring($fichierup))) {
		//var_dump(mime_content_type($fichierup));
		//var_dump($fichierupType);echo "/////";var_dump(mime_content_type($_FILES['userfile']['tmp_name']));
		if ($fichierupType == mime_content_type($fichierup)) {
			var_dump($_FILES['userfile']['tmp_name']);
			var_dump($dest);
			$test = move_uploaded_file($_FILES['userfile']['tmp_name'], $dest);

			//var_dump($test);
		}

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
};
?>



<!-- Le type d'encodage des données, enctype, DOIT être spécifié comme ce qui suit -->
<form enctype="multipart/form-data" action="forup.php" method="post">
	<!-- MAX_FILE_SIZE doit précéder le champ input de type file -->
	<input type="hidden" name="MAX_FILE_SIZE" value="30000000" />
	<!-- Le nom de l'élément input détermine le nom dans le tableau $_FILES -->
	Envoyez ce fichier : <input name="userfile" type="file" />
	<input type="submit" name="submit" value="Envoyer le fichier" />
</form>