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
		$pays = $paysHandler->getPaysParId($bdd, $film->getIdPays());
		$film->setPays($pays);

		return $film;
	}

	public function modifierFilm($idFilm, $datasFilm, $datasImage)
	{
		$bdd = new SPDO();
		$filmExistant = $this->getFilmAffichage($bdd, $idFilm);
		$datasFilm['idPays'] = null;
		if ($datasFilm['paysFilm'] != null) {
			$paysHandler = new PaysHandler($bdd);
			$pays = new Pays();
			$pays->setNompPays($datasFilm['paysFilm']);
			$nouveauPays = $paysHandler->getPaysParSlug($pays->makeSlug());
			if ($nouveauPays->getId() == null) {
				$datasFilm['idPays'] = $paysHandler->creerPaysBase($bdd, $datasFilm['paysFilm']);
			} else {
				$datasFilm['idPays'] = $nouveauPays->getId();
			}
		}
		$nouveauFilm = new Film();
		$nouveauFilm->setId($idFilm);

		if ($filmExistant->getTitreFilm() != $datasFilm['titreFilm']) {
			$nouveauFilm->setTitreFilm($datasFilm['titreFilm']);
		}
		if ($filmExistant->getTitreFilmVO() != $datasFilm['titreFilmVo']) {
			$nouveauFilm->setTitreFilmVO($datasFilm['titreFilmVo']);
		}
		if ($filmExistant->getDateFilm() != $datasFilm['dateFilm']) {
			$nouveauFilm->setDateFilm($datasFilm['dateFilm']);
		}
		if ($filmExistant->getIdPays() != $datasFilm['idPays']) {
			$nouveauFilm->setIdPays($datasFilm['idPays']);
		}
		$slug = $this->calculerModificationSlug($filmExistant, $nouveauFilm);
		if ($filmExistant->getSlug() != $slug) {
			$nouveauFilm->setSlug($slug);
		}
		$filmRepository = new FilmRepository($bdd);
		$filmRepository->updateFilm($nouveauFilm);
		
		$this->mettreAJourImage('film', $filmExistant->getSlug(), $slug, $datasImage['imageFilm']['name'], $datasImage['imageFilm']['tmp_name']);
	}

	public function calculerModificationSlug($ancienFilm, $nouveauFilm)
	{
		$filmSlug = new Film();
		$titreFilm = $nouveauFilm->getTitreFilm() != null ? $nouveauFilm->getTitreFilm() : $ancienFilm->getTitreFilm();
		$filmSlug->setTitreFilm($titreFilm);
		$dateFilm = $nouveauFilm->getDateFilm() != null ? $nouveauFilm->getDateFilm() : $ancienFilm->getDateFilm();
		if ($dateFilm != null) {
			$filmSlug->setDateFilm($dateFilm);
		}
		$slug = $filmSlug->makeSlug();


		return $slug;
	}
}