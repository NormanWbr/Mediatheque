<?php 

function afficher($dbh){

	foreach ($dbh as $row) {

		$titre = $row['films_titre'];
		$annee = $row['films_annee'];
		$genres = $row['genres'];
		$real = $row['real_nom'];
		$acteurs = $row['acteurs'];
		$duree = $row['films_duree'];
		$heures = floor($duree/60);
		$minutes = $duree % 60;
		$resume = $row['films_resume'];
		$affiche = $row['films_affiche'];

		echo "
		<img src='images/{$affiche}''>
		<h2>{$titre}</h2>
		<p>{$annee}</p>
		<p>{$genres}</p>
		<p>Réalisateur : {$real}</p>
		<p>Acteurs : {$acteurs}</p>
		<p>Durée : {$heures}h{$minutes}</p>
		<p>{$resume}</p>
		";

	}

}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Médiathèque</title>
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/styles.css">
</head>
<header>

</header>
<body>
	<div class="header">
		<form class="recherche" action="index.php" method="POST">
			<input type="text" name="recherche" placeholder="Rechercher un film...">
			<input type="submit" name="action" value="Chercher">
		</form>
	</div>

	<div class="navig">
		<p>
			<a href="prec">Précedent</a>
			Page 1 sur 7
			<a href="suiv">Suivant</a>
		</p>
	</div>
	<div>
		<?php afficher($dbh); ?>
	</div>
</body>
</html>