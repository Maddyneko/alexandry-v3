<?php
require_once CHEMIN_DOSSIER . '/app/repository/elementRepository.php';

class paysRepository extends elementrepository
{
    public function __construct($bdd)
    {
        parent::__construct($bdd, 'pays_t', 'nomPays');
    }

    public function getPaysParNom($nomPays)
    {
        $this->filtres = "AND nomPays = " . $this->bdd->quote($nomPays);
        return $this->selectPays();
    }

	public function getPaysParId($id)
	{
		$this->filtres = "AND id = " . (int) $id . " ";
		return $this->selectPays();
	}

	public function getPaysParSlug($slug)
	{
		$this->filtres = "AND slug = " . $this->bdd->quote($slug) . " ";
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
        if ($pays->getNomPays() != null && $pays->getSlug() != null) {
            $requete = "INSERT INTO " . $this->getNomTable() . " ("
                . "nomPays "
                . ", slug"
                . ") VALUES ("
                . $this->bdd->quote($pays->getNomPays()) . " "
				. ", " . $this->bdd->quote($pays->getSlug()) . " "
                . ") "
                ;
            $this->bdd->query($requete);
			$idPays = $this->bdd->lastInsertId();
        }

		return $idPays;
    }

	public function updatePays($pays)
	{
		if ($pays->getId() != null && $pays->getNomPays() != null) {
			$requete = "UPDATE " . $this->getNomTable() . " SET "
				. "nomPays = " . $this->bdd->quote($pays->getNomPays()) . " "
				. ", slug = " . $this->bdd->quote($pays->getSlug()) . " "
				. "WHERE id = " . (int) $pays->getId()
				;
			$this->bdd->query($requete);
		}
	}
}