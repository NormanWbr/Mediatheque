<?php 

function connect(){
	$dbh = new PDO(
		"mysql:dbname=mediatheque;host=localhost;port=3308",
		"root",
		"",
		array(
			PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'',
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
		)
	);

	return $dbh;
}

function selectAll($dbh){

	$sql = "
	SELECT films_id,films_affiche,films_titre,
	group_concat(distinct genres_nom) AS genres,real_nom,
	group_concat(distinct acteurs_nom) AS acteurs ,films_duree,films_resume,films_annee 
	FROM realisateurs
	JOIN films ON real_id=films_real_id      
	LEFT OUTER JOIN films_genres ON films_id=fg_films_id      
	LEFT OUTER JOIN genres ON genres_id=fg_genres_id     
	JOIN films_acteurs ON fa_films_id=films_id     
	JOIN acteurs ON acteurs_id=fa_acteurs_id 
	GROUP BY films_titre
	ORDER BY films_id;
	";
	$stmt = $dbh -> prepare($sql);
        //faire binParam() ou bindValue() si paramètres
        //3. Exécution de la requête
	$stmt->execute(); 
        $stmt->setFetchMode(PDO::FETCH_ASSOC); //donc le tableau associatif résultant prendra comme clef les noms des colonnes
        $dbh=$stmt->fetchAll(); //pour remplir le tableau du set résultat

        return $dbh;
    }

function select($dbh,$min,$max){

	$sql = "
	SELECT films_id,films_affiche,films_titre,
	group_concat(distinct genres_nom) AS genres,real_nom,
	group_concat(distinct acteurs_nom) AS acteurs ,films_duree,films_resume,films_annee 
	FROM realisateurs
	JOIN films ON real_id=films_real_id      
	LEFT OUTER JOIN films_genres ON films_id=fg_films_id      
	LEFT OUTER JOIN genres ON genres_id=fg_genres_id     
	JOIN films_acteurs ON fa_films_id=films_id     
	JOIN acteurs ON acteurs_id=fa_acteurs_id 
	GROUP BY films_titre
	ORDER BY films_id limit $min,$max;
	";
	$stmt = $dbh -> prepare($sql);
        //faire binParam() ou bindValue() si paramètres
        //3. Exécution de la requête
	$stmt->execute(); 
        $stmt->setFetchMode(PDO::FETCH_ASSOC); //donc le tableau associatif résultant prendra comme clef les noms des colonnes
        $dbh=$stmt->fetchAll(); //pour remplir le tableau du set résultat

        return $dbh;
    }

function recherche($dbh,$mot){

	$mot=$mot;

	$sql = "
	SELECT films_id,films_affiche,films_titre,
	group_concat(distinct genres_nom) AS genres,real_nom,
	group_concat(distinct acteurs_nom) AS acteurs ,films_duree,films_resume,films_annee 
	FROM realisateurs
	JOIN films ON real_id=films_real_id      
	LEFT OUTER JOIN films_genres ON films_id=fg_films_id      
	LEFT OUTER JOIN genres ON genres_id=fg_genres_id     
	JOIN films_acteurs ON fa_films_id=films_id     
	JOIN acteurs ON acteurs_id=fa_acteurs_id 
    WHERE films_titre LIKE '%$mot%'
    OR films_annee LIKE '%$mot'
    OR genres_nom LIKE '%$mot%'
    OR real_nom LIKE '%$mot%'
    OR acteurs_nom LIKE '%$mot%'
    OR films_resume LIKE '%$mot%'
    OR films_affiche LIKE '%$mot%'

	GROUP BY films_titre
	ORDER BY films_id";
	$stmt = $dbh -> prepare($sql);
        //faire binParam() ou bindValue() si paramètres
        //3. Exécution de la requête
	$stmt->execute(); 
        $stmt->setFetchMode(PDO::FETCH_ASSOC); //donc le tableau associatif résultant prendra comme clef les noms des colonnes
        $dbh=$stmt->fetchAll(); //pour remplir le tableau du set résultat

        return $dbh;
    }

?>