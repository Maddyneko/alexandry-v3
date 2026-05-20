<?php
require_once CHEMIN_DOSSIER . '/app/handler/elementHandler.php';

class PaysHandler extends ElementHandler {
    public function creerPaysBase($bdd, $nomPays) {
        $idPays = null;
        if ($nomPays !== null) {
            $pays = new Pays();
            $pays->setNompPays($nomPays);
            $slug = $pays->makeSlug();
            $pays->setSlug($slug);
            $paysRepository = new PaysRepository($bdd);
            $idPays = $paysRepository->insertPays($pays);
        }

        return $idPays;
    }

	public function getPayssAffichage($bdd)
	{
		$paysRepository = new PaysRepository($bdd);
		$datasPayss = $paysRepository->selectPayss();
		$paysInterface = new PaysInterface();
		$payss = [];
		foreach ($datasPayss as $datasPays) {
			$payss[] = $paysInterface->fromSqlToObject($datasPays);
		}

		return $payss;
	}

	public function getPaysAffichage($bdd, $idPays)
	{
		$pays = $this->getPaysParId($bdd, $idPays);

		$filmHandler = new FilmHandler();
		$films = $filmHandler->getFilmsPays($bdd, $idPays);
		$pays->setFilms($films);

		return $pays;
	}

	public function getPaysParId($bdd, $idPays)
	{
		$paysRepository = new PaysRepository($bdd);
		$datasPays = $paysRepository->getPaysParId($idPays);
		$paysInterface = new PaysInterface();
		$pays = $paysInterface->fromSqlToObject($datasPays[0]);

		return $pays;
	}

	public function modifierPays( $idPays, $datasPays, $datasImage)
	{
		$bdd = new SPDO();

		$paysExistant = $this->getPaysParId($bdd, $idPays);

		if ($paysExistant->getNomPays() != $datasPays['nomPays']) {
			$nouveauPays = new Pays();
			$nouveauPays->setId($idPays);
			$nouveauPays->setNompPays(cleanDonnee($datasPays['nomPays']));
			$nouveauPays->setSlug($nouveauPays->makeSlug());
			$paysRepository = new PaysRepository($bdd);
			$paysRepository->updatePays($nouveauPays);
		} else {
			$nouveauPays = $paysExistant;
		}
		// Gestion image
		$this->mettreAJourImage('pays', $paysExistant->getSlug(), $nouveauPays->getSlug(), $datasImage['imagePays']['name'], $datasImage['imagePays']['tmp_name']);
	}
}