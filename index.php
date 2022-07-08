<?php  

require_once('functions/function.php');

if (isset($_GET['min'])) {
	if ($_GET['min']<>-10) {
		$min = $_GET['min'];
	}
}else{
	$min=0;
}

if (isset($_GET['max'])) {
	if ($_GET['max']<>0) {
		$max = $_GET['max'];
	}
}else{
	$max=10;
}

try{

	$dbh = connect();
	$dbh = select($dbh,$min,$max);
	// toutes les interactions avec la DB doivent se faire dans le try

}catch (Exception $ex) {
	die("ERREUR FATALE : ". $ex->getMessage().'<form><input type="button" value="Retour" onclick="history.go(-1)"></form>');
}


require_once('templates/template.php');

?>