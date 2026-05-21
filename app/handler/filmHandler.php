<?php
require_once CHEMIN_DOSSIER . '/app/handler/elementHandler.php';

class filmHandler extends ElementHandler {
    public function creerFilmbase($bdd, $titreFilm, $titreFilmVo, $dateFilm, $idPays, $idRealisateur) {
        $idFilm = null;

        if ($titreFilm !== null) {
            $film = new Film();
			$film->setTitreFilm($titreFilm);
			$film->setTitreFilmVO($titreFilmVo);
			if ($dateFilm != null) {
				$jour = substr($dateFilm, 0, 2);
				$mois = substr($dateFilm, 3, 2);
				$annee = substr($dateFilm, 6);

				$dateFilm = $annee . "-" . $mois . "-" . $jour;
			}
			$film->setDateFilm($dateFilm);
			$slug = $film->makeSlug();
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

	public function modifierFilm($idFilm, $datasFilm, $datasImage)
	{
		$bdd = new SPDO();
		$filmExistant = $this->getFilmAffichage($bdd, $idFilm);
		if ($filmExistant->getTitreFilm() != $datasFilm['titreFilm']) {
			$nouveauFilm = new Film();
			$nouveauFilm->setId($idFilm);
			$nouveauFilm->setTitreFilm($datasFilm['titreFilm']);
			$nouveauFilm->setTitreFilmVO($datasFilm['titreFilmVo']);
			$nouveauFilm->setDateFilm($filmExistant->getDateFilm());
			$nouveauFilm->setSlug($nouveauFilm->makeSlug());
			$filmRepository = new FilmRepository($bdd);
			$filmRepository->updateFilm($nouveauFilm);
		} else {
			$nouveauFilm = $filmExistant;
		}
		$this->mettreAJourImage('film', $filmExistant->getSlug(), $nouveauFilm->getSlug(), $datasImage['imageFilm']['name'], $datasImage['imageFilm']['tmp_name']);
	}

}