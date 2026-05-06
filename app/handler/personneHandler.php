<?php

class PersonneHandler {
    public function creerPersonneBase($bdd, $nomPersonne) {
        $idPays = null;
        if ($nomPersonne !== null) {
            $personne = new Personne();
			$personne->setNomPersonne($nomPersonne);
            $personneRepository = new PersonneRepository($bdd);
            $idPersonne = $personneRepository->insertPersonne($personne);
        }

        return $idPersonne;
    }
}