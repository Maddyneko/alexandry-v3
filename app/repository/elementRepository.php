<?php

class elementrepository
{
    protected $bdd;
    protected $nomTable;
    protected $filtres;
	protected $order;

    public function __construct($bdd, $nomTable, $order)
    {
        $this->bdd = $bdd;
        $this->nomTable = $nomTable;
		$this->order = $order;
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
			. ($this->order != null ? "ORDER BY " . $this->order : "")
		;

		return $this->bdd->qfetch($requete);
	}
}