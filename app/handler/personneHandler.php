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
}