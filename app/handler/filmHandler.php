<?php
require_once CHEMIN_DOSSIER . '/app/handler/elementHandler.php';

class filmHandler extends ElementHandler {
    public function creerFilmbase($bdd, $titreFilm, $titreFilmVo, $dateFilm, $idPays, $idRealisateur) {
        $idFilm = null;

        if ($titreFilm !== null) {
            $film = new Film();
			$film->setTitreFilm($titreFilm);
			$film->setTitreFilmVO($titreFilmVo);
			$film->setDateFilm($dateFilm);
			$slug = slugify($titreFilm . ($dateFilm != null ? "-" . substr($dateFilm, 6) : null));
			$film->setSlug($slug);
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
			$films[] = $filmInterface->fromSqlToObject($datasFilm);
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

	public function getFilmAffichage($bdd, $idFilm)
	{
		$filmRepository = new FilmRepository($bdd);
		$datasFilm = $filmRepository->getFilmParId($idFilm);
		$filmInterface = new FilmInterface();
		$film = $filmInterface->fromSqlToObject($datasFilm[0]);

		$paysHandler = new PaysHandler();
		$pays = $paysHandler->getPaysAffichage($bdd, $film->getIdPays());
		$film->setPays($pays);

		return $film;
	}
}