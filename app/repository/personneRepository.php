<?php

class personneRepository extends elementrepository
{
    public function __construct($bdd)
    {
        parent::__construct($bdd, 'personne_t');
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
				. ") VALUES ("
				. $this->bdd->quote($personne->getNomPersonne()) . " "
				. ") "
			;
			$this->bdd->query($requete);
			$idPersonne = $this->bdd->lastInsertId();
		}

		return $idPersonne;
	}
}