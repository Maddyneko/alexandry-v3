<?php
require_once '../config/config.php';
require_once CHEMIN_DOSSIER . '/app/modele/film.class.php';
require_once CHEMIN_DOSSIER . '/app/modele/pays.class.php';
require_once CHEMIN_DOSSIER . '/app/modele/personne.class.php';

require_once CHEMIN_DOSSIER . '/app/handler/paysHandler.php';
require_once CHEMIN_DOSSIER . '/app/handler/personneHandler.php';
require_once CHEMIN_DOSSIER . '/app/handler/filmHandler.php';

require_once CHEMIN_DOSSIER . '/app/repository/paysRepository.php';
require_once CHEMIN_DOSSIER . '/app/repository/personneRepository.php';
require_once CHEMIN_DOSSIER . '/app/repository/filmRepository.php';

$fichierImport = CHEMIN_DOSSIER . "/app/datas/films.csv";
$datas = file_get_contents($fichierImport);
$listeFilms = explode("\n", $datas);
array_shift($listeFilms);
$bdd = new SPDO();

$listePays = importPays($bdd, $listeFilms);
$listePersonnes = importPersonnes($bdd, $listeFilms);
importFilms($bdd, $listePersonnes, $listePays, $listeFilms);
$filmHandler = new FilmHandler();
$filmHandler->nettoyerBaseFilm($bdd);

function cleanDonnee($valeur)
{
    return trim($valeur);
}

function importPays($bdd, $listeFilms)
{
	$listePaysSimplifiee = [];
	$paysRepository = new PaysRepository($bdd);
	$listePays = $paysRepository->selectPayss();

	foreach($listePays as $dataPays) {
		$listePaysSimplifiee[$dataPays['id']] = $dataPays['nomPays'];
	}
	foreach ($listeFilms as $film) {
		$datasFilm = explode(";", $film);
		$nomPays = cleanDonnee($datasFilm[4]);
		if (!in_array($nomPays, $listePaysSimplifiee)) {
			$paysHandler = new PaysHandler();
			$idPays = $paysHandler->creerPaysBase($bdd, $nomPays);
			$listePaysSimplifiee[$idPays] = $nomPays;
		}
	}

	return $listePaysSimplifiee;
}

function importPersonnes($bdd, $listeFilms)
{
	$listePersonnesSimplifiee = [];
	$personneRepository = new PersonneRepository($bdd);
	$listePersonnes = $personneRepository->selectPersonnes();
	foreach($listePersonnes as $dataPersonne) {
		$listePersonnesSimplifiee[$dataPersonne['id']] = $dataPersonne['nomPersonne'];
	}
	foreach ($listeFilms as $film) {
		$datasFilm = explode(";", $film);
		$nomPersonne = cleanDonnee($datasFilm[2]);
		if (!in_array($nomPersonne, $listePersonnesSimplifiee)) {
			$personneHandler = new PersonneHandler();
			$idPersonne = $personneHandler->creerPersonneBase($bdd, $nomPersonne);
			$listePersonnesSimplifiee[$idPersonne] = $nomPersonne;
		}
	}

	return $listePersonnesSimplifiee;

}

function importFilms($bdd, $personnes, $pays, $listeFilms)
{
	$listeFilmsSimplifiee = [];
	$filmRepository = new FilmRepository($bdd);
	$listeFilmsBase = $filmRepository->selectFilms();
	foreach($listeFilmsBase as $dataFilm) {
		$listeFilmsSimplifiee[$dataFilm['id']] = getSlugFilm($dataFilm['idPays'], $dataFilm['idRealisateur'], $dataFilm['titreFilm']);
	}
	foreach ($listeFilms as $film) {
		$datasFilm = explode(";", $film);
		$titreFilm = cleanDonnee($datasFilm[0]);
		$titreFilmVo = cleanDonnee($datasFilm[1]);
		$dateFilm = cleanDonnee($datasFilm[3]);

		$nomRealisateur = cleanDonnee($datasFilm[2]);
		$nomPays = cleanDonnee($datasFilm[4]);
		$idPays = array_search($nomPays, $pays);
		$idRealisateur = array_search($nomRealisateur, $personnes);

		$identifiantFilm = getSlugFilm($idPays, $idRealisateur, $titreFilm);
		if (!in_array($identifiantFilm, $listeFilmsSimplifiee)) {
			$filmHandler = new FilmHandler();
			$idFilm = $filmHandler->creerFilmBase($bdd, $titreFilm, $titreFilmVo, $dateFilm, $idPays, $idRealisateur);
			$listeFilmsSimplifiee[$idFilm] = $identifiantFilm;
		}
	}
}

function getSlugFilm($idPays, $idrealisateur, $titreFilm)
{
	return $idPays . "-" . $idrealisateur . "-" . $titreFilm;
}