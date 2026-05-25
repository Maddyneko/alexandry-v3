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

	public function getPersonneAffichage($idPersonne)
	{
		$bdd = new SPDO();
		$personneRepository = new PersonneRepository($bdd);
		$datasPersonne = $personneRepository->getPersonneParId($idPersonne);
		$personneInterface = new personneInterface();
		$personne = $personneInterface->fromSqlToObject($datasPersonne[0]);

		return $personne;
	}

    public function modifierPersonne($idPersonne, $datasPersonne, $datasImage)
    {
        $bdd = new SPDO();

        $personneExistant = $this->getPersonneAffichage($idPersonne);
        $personneNouveau = new Personne();
        $personneNouveau->setId($idPersonne);

        if ($personneExistant->getNomPersonne() != $datasPersonne['nomPersonne']) {
            $personneNouveau->setNomPersonne($datasPersonne['nomPersonne']);
        }

        $slug = $this->calculerModificationSlug($personneExistant, $personneNouveau);
        if ($personneExistant->getSlug() != $slug) {
            $personneNouveau->setSlug($slug);
        }

        $personneRepository = new PersonneRepository($bdd);
        $personneRepository->updatePersonne($personneNouveau);

        $this->mettreAJourImage('personne', $personneExistant->getSlug(), $slug, $datasImage['imagePersonne']['name'], $datasImage['imagePersonne']['tmp_name']);
    }

        public function calculerModificationSlug($ancienPersonne, $nouveauPersonne)
    {
        $personneSlug = new Personne();
        $nomPersonne = $nouveauPersonne->getNomPersonne() != null ? $nouveauPersonne->getNomPersonne() : $ancienPersonne->getNomPersonne();
        $personneSlug->setNomPersonne($nomPersonne);
        $slug = $personneSlug->makeSlug();

        return $slug;
    }
}