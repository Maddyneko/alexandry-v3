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

    public function getPersonnesAffichage($bdd)
    {
        $personneRepository = new PersonneRepository($bdd);
        $datasPersonnes = $personneRepository->selectPersonnes();
        $personneInterface = new personneInterface();
        $personnes = [];
        foreach ($datasPersonnes as $datasPersonne) {
            $personnes[] = $personneInterface->fromSqlToObject($datasPersonne);
        }

        return $personnes;
    }
}