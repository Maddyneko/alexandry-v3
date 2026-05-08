<?php

class elementrepository
{
    protected $bdd;
    protected $nomTable;
    protected $filtres;

    public function __construct($bdd, $nomTable)
    {
        $this->bdd = $bdd;
        $this->nomTable = $nomTable;
    }

    public function getbdd()
    {
        return $this->bdd;
    }

    public function setbdd($bdd)
    {
        $this->bdd = $bdd;
    }

    public function getNomTable()
    {
        return $this->nomTable;
    }

    public function setNomTable($nomTable)
    {
        $this->nomTable = $nomTable;
    }

    public function getFiltres()
    {
        return $this->filtres;
    }

    public function setFiltres($filtres)
    {
        $this->filtres = $filtres;
    }


    public function selectElement()
    {
        $requete = "SELECT * "
                . "FROM " . $this->getNomTable() . " "
                . "WHERE 1 = 1 "
                . $this->filtres
                . "LIMIT 0, 1 "
        ;

        return $this->bdd->qfetch($requete);
    }

	public function selectElements()
	{
		$requete = "SELECT * "
			. "FROM " . $this->getNomTable() . " "
			. "WHERE 1 = 1 "
			. $this->filtres
		;

		return $this->bdd->qfetch($requete);
	}
}