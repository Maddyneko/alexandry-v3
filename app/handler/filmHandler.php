<?php

class filmHandler {
    public function creerFilmbase($bdd, $titreFilm, $titreFilmVo, $dateFilm, $idPays, $idRealisateur) {
        $idFilm = null;

        if ($titreFilm !== null) {
            $film = new Film();
			$film->setTitreFilm($titreFilm);
			$film->setTitreFilmVO($titreFilmVo);
			$film->setDateFilm($dateFilm);

			$film->setIdPays($idPays);
			$film->setIdRealisateur($idRealisateur);

			$filmRepository = new FilmRepository($bdd);
			$idFilm = $filmRepository->insertFilm($film);
        }

        return $idFilm;
    }

	public function nettoyerBaseFilm($bdd)
	{
		$filmRepository = new FilmRepository($bdd);
		$filmRepository->cleanDateFilms();
	}

	public function getFilmsPays($bdd, $idPays)
	{
		$filmRepository = new FilmRepository($bdd);
		$datasFilms = $filmRepository->getFilmsParIdPays($idPays);

		return $this->miseEnFormeFilmAffichage($datasFilms);

	}

	public function miseEnFormeFilmAffichage($datasFilms)
	{
		$filmInterface = new FilmInterface();
		$films = [];
		foreach ($datasFilms as $datasFilm) {
			$filmObj = $filmInterface->fromSqlToObject($datasFilm);
			$films[] = $filmInterface->fromObjectToView($filmObj);
		}
		return $films;
	}

	public function getFilmsAffichage($bdd)
	{
		$filmRepository = new FilmRepository($bdd);
		$datasFilms = $filmRepository->selectFilmsDetail();
		$films = $this->miseEnFormeFilmAffichage($datasFilms);

		return $films;
	}
}