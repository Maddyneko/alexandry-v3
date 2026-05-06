<?php
require_once CHEMIN_DOSSIER . '/app/repository/elementRepository.php';

class paysRepository extends elementrepository
{
    public function __construct($bdd)
    {
        parent::__construct($bdd, 'pays_t');
    }

    public function getPaysParNom($nomPays)
    {
        $this->filtres = "AND nomPays = " . $this->bdd->quote($nomPays);
        return $this->selectPays();
    }

    public function selectPays()
    {
      return parent::selectElement();
    }

	public function selectPayss()
	{
		return parent::selectElements();
	}

    public function insertPays($pays)
    {
		$idPays = null;
        if ($pays->getNomPays() != null) {
            $requete = "INSERT INTO " . $this->getNomTable() . " ("
                . "nomPays "
                . ") VALUES ("
                . $this->bdd->quote($pays->getNomPays()) . " "
                . ") "
                ;
            $this->bdd->query($requete);
			$idPays = $this->bdd->lastInsertId();
        }

		return $idPays;
    }
}