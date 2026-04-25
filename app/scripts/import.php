<?php
require_once '../config/config.php';
require_once CHEMIN_DOSSIER . '/app/modele/film.class.php';
$fichierImport = CHEMIN_DOSSIER . "/app/datas/films.csv";
$datas = file_get_contents($fichierImport);
$listeFilms = explode("\n", $datas);
array_shift($listeFilms);
$bdd = new SPDO();
foreach ($listeFilms as $film) {
    $datasFilms = explode(",", $film);
    debug(cleanDonnee($datasFilms[0]));

    $pays = new Pays();
    $pays->setNompPays($datasFilms[4]);

    $paysRepository = new PaysRepository($bdd);
    $datasPays = $paysRepository->getPaysParNom($datasFilms[1]);
    if ($datasPays['id'] == null) {
        // insert
    } else {
        $paysInterface = new PaysInterface();
        $pays = $paysInterface->fromSqlToObject($datasPays);
    }

    $personne = new Personne();
    $personne->setNomPersonne(cleanDonnee($datasFilms[2]));

    $film = new Film();
    $film->setTitreFilm(cleanDonnee($datasFilms[0]));
    $film->setTitreFilmVO(cleanDonnee($datasFilms[1]));
    $film->setDateFilm(date('Y-m-d', strtotime($datasFilms[3]));
    debug($film);
}

function cleanDonnee($valeur)
{
    return trim($valeur);
}