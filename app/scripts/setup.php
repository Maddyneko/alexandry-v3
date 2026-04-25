<?php
require_once CHEMIN_DOSSIER.'/app/classes/spdo.class.php';
require_once CHEMIN_DOSSIER.'/app/constantes/erreurspdo_constantes.php';

checkBdd();

function checkBdd()
{
	$bdd = new SPDO();
	if ($bdd->getCodeErreur() == ERREURSPDO_BASE_INCONNUE) {
		$bddTech = new PDO("mysql:host=" . DB_HOST . ";charset=utf8", DB_USER, DB_PWD);
		$requete = 'CREATE DATABASE IF NOT EXISTS ' . DB_NOMBASE;
		$bddTech->query($requete);
		$bdd = new SPDO();
	}

	if ($bdd->getErreur() != null) {
		debug($bdd->getErreur());
		die();
	}

	// Check existence tables
	$requeteTables = "SHOW TABLES FROM " . DB_NOMBASE;
	$datas = $bdd->qfetch($requeteTables);

	if (!in_array('film_t', $datas[0])) {
		initialiserBddFilm();
	}
	if (!in_array('pays_t', $datas[0])) {
		initialiserBddPays();
	}
	if (!in_array('personne_t', $datas[0])) {
		initialiserBddPersonne();
	}

}

function debug($datas)
{
	echo '<pre>';
	print_r($datas);
	echo '</pre>';
}

function initialiserBddFilm()
{
	initialiserBdd(file_get_contents(CHEMIN_DOSSIER.'/app/migrations/create-table-film.sql'));
}

function initialiserBddPays()
{
	initialiserBdd(file_get_contents(CHEMIN_DOSSIER.'/app/migrations/create-table-pays.sql'));
}

function initialiserBddPersonne()
{
	initialiserBdd(file_get_contents(CHEMIN_DOSSIER.'/app/migrations/create-table-personne.sql'));
}

function initialiserBdd($requete)
{
	$requetes = explode(';', $requete);
	$bdd = new SPDO();
	foreach ($requetes as $sql) {
		if (trim($sql) != '') {
			$bdd->query($sql);
			if ($bdd->getErreur() != null) {
				debug($bdd->getErreur());
			}
		}
	}
}