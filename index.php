<?php  

require_once('functions/function.php');

try{

	$dbh = connect();
	$dbh = select($dbh);
	// toutes les interactions avec la DB doivent se faire dans le try

}catch (Exception $ex) {
	die("ERREUR FATALE : ". $ex->getMessage().'<form><input type="button" value="Retour" onclick="history.go(-1)"></form>');
}


require_once('templates/template.php');

?>