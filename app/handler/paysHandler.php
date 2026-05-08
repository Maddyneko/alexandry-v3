<?php

class PaysHandler {
    public function creerPaysBase($bdd, $nomPays) {
        $idPays = null;
        if ($nomPays !== null) {
            $pays = new Pays();
            $pays->setNompPays($nomPays);
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
			$paysObj = $paysInterface->fromSqlToObject($datasPays);
			$payss[] = $paysInterface->fromObjectToView($paysObj);
		}

		return $payss;
	}

	public function getPaysAffichage($bdd, $idPays)
	{
		$paysRepository = new PaysRepository($bdd);
		$datasPays = $paysRepository->getPaysParId($idPays);
		$paysInterface = new PaysInterface();
		$paysObj = $paysInterface->fromSqlToObject($datasPays[0]);
		$pays = $paysInterface->fromObjectToView($paysObj);

		return $pays;
	}

	public function modifierPays($idPays, $datasPays)
	{
		$bdd = new SPDO();
		$pays = new Pays();
		$pays->setId($idPays);
		$paysRepository = new PaysRepository($bdd);
		$paysRepository->getPaysParId($idPays);
		if ($pays->getNomPays() != $datasPays['nomPays']) {
			$nouveauPays = new Pays();
			$nouveauPays->setId($idPays);
			$nouveauPays->setNompPays(cleanDonnee($datasPays['nomPays']));
			$paysRepository->updatePays($pays);
		}
	}
}