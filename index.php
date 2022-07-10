<?php  

require_once('functions/function.php');

if (isset($_POST['action'])) {
	$recherche = true;
}else{
	$recherche = false;
}

if (isset($_POST['recherche'])) {
	$mot = $_POST['recherche'];
}else{
	$mot="";
}

try{
	
	$dbh = connect();

	$min=0;
	$max=count(selectAll($dbh));

	$maxPage = ceil(count(selectAll($dbh))/10);

	if (isset($_GET['page'])) {
		$page = $_GET['page'];
	}else{
		$page=1;
	}

	if ($page == 0) {
		$page = 1;
	}
	if ($page > $maxPage) {
		$page = $maxPage;
	}

	$max = $page*10;
	$min = $max-10;

	if (!$recherche) {
		$dbh = select($dbh,$min,$max);
	}else{
		$dbh = recherche($dbh,$mot);
		$cpt = count($dbh);
	}
	// toutes les interactions avec la DB doivent se faire dans le try

}catch (Exception $ex) {
	die("ERREUR FATALE : ". $ex->getMessage().'<form><input type="button" value="Retour" onclick="history.go(-1)"></form>');
}


require_once('templates/template.php');

?>