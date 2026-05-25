<?php
require_once CHEMIN_DOSSIER . '/app/repository/elementRepository.php';

class personneRepository extends elementrepository
{
    public function __construct($bdd)
    {
        parent::__construct($bdd, 'personne_t', 'nomPersonne');
    }

	public function getPersonneParId($id)
	{
		$this->filtres = "AND id = " . (int) $id . " ";
		
		return $this->selectPersonne();
	}

		public function getPaysParSlug($slug)
	{
		$this->filtres = "AND slug = " . $this->bdd->quote($slug) . " ";
		
		return $this->selectPersonne();
	}

	public function selectPersonne()
	{
		return parent::selectElement();
	}

    public function selectPersonnes()
    {
        return parent::selectElements();
    }

	public function insertPersonne($personne)
	{
		$idPersonne = null;
		if ($personne->getNomPersonne() != null) {
			$requete = "INSERT INTO " . $this->getNomTable() . " ("
				. "nomPersonne "
				. ", slug "
				. ") VALUES ("
				. $this->bdd->quote($personne->getNomPersonne()) . " "
				. ", " . $this->bdd->quote($personne->getSlug()) . " "
				. ") "
			;
			$this->bdd->query($requete);
			$idPersonne = $this->bdd->lastInsertId();
		}

		return $idPersonne;
	}

	public function updatePersonne($personne)
	{
		if ($personne->getId() != null) {
			$requete = "UPDATE " . $this->getNomTable() . " SET ";
			$elementsAModifier = null;
			if ($personne->getNomPersonne() != null) {
				$elementsAModifier .= ($elementsAModifier == null ? "" : ", ") . "nomPersonne = " . $this->bdd->quote($personne->getNomPersonne()) . " ";
			}
			if ($personne->getSlug() != null) {
				$elementsAModifier .= ($elementsAModifier == null ? "" : ", ") . "slug = " . $this->bdd->quote($personne->getSlug()) . " ";
			}
			if ($elementsAModifier != null) {
				$requete .= $elementsAModifier . "WHERE id = " . (int) $personne->getId();
				$this->bdd->query($requete);
			}
		}
	}
}