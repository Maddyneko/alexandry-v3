<?php
require_once CHEMIN_DOSSIER . '/app/handler/elementHandler.php';

class PersonneHandler extends ElementHandler {
    public function creerPersonneBase($bdd, $nomPersonne) {
        $idPays = null;
        if ($nomPersonne !== null) {
            $personne = new Personne();
			$personne->setNomPersonne($nomPersonne);
            $slug = slugify($nomPersonne);
            $personne->setSlug($slug);
            $personneRepository = new PersonneRepository($bdd);
            $idPersonne = $personneRepository->insertPersonne($personne);
        }

        return $idPersonne;
    }

    public function getPersonnesAffichage()
    {
		$bdd = new SPDO();
        $personneRepository = new PersonneRepository($bdd);
        $datasPersonnes = $personneRepository->selectPersonnes();
        $personneInterface = new personneInterface();
        $personnes = [];
        foreach ($datasPersonnes as $datasPersonne) {
            $personnes[] = $personneInterface->fromSqlToObject($datasPersonne);
        }

        return $personnes;
    }

	public function getPersonneAffichage()
	{
		$bdd = new SPDO();
		$personneRepository = new PersonneRepository($bdd);
		$datasPersonne = $personneRepository->getPersonneParId($bdd);
		$personneInterface = new personneInterface();
		$personne = $personneInterface->fromSqlToObject($datasPersonne);

		return $personne;
	}
}