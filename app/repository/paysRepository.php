<?php

class paysRepository extends elementrepository
{
    public function __construct($bdd)
    {
        parent::__construct($bdd);
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
}