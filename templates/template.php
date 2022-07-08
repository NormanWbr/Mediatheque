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
		<div class='films'>
		<img class='affiche' src='images/{$affiche}''>
		<h2>{$titre}</h2>
		<p>{$annee}</p>
		<p>{$genres}</p>
		<p>Réalisateur : {$real}</p>
		<p>Acteurs : {$acteurs}</p>
		<p>Durée : {$heures}h{$minutes}</p>
		<p>{$resume}</p>
		</div>
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
			<a href="index.php?min=<?php echo ($min-10);?>&max=<?php echo ($max-10);?>">Précédent</a>
			Page <?php echo ($min/10) ?> sur 7
			<a href="index.php?min=<?php echo ($min+10);?>&max=<?php echo ($max+10);?>">Suivant</a>

		</p>
</div>
		<?php afficher($dbh,$min,$max); ?>
</body>
</html>