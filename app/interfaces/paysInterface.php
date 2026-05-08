<?php

class PaysInterface
{
    public function fromSqlToObject($datasPays)
    {
        $pays = new Pays();
        $pays->setId($datasPays['id']);
        $pays->setNompPays($datasPays['nomPays']);
        $pays->setDateAjout($datasPays['dateAjout']);
        $pays->setDateModification($datasPays['dateModification']);
        $pays->setInitialePays($datasPays['initialePays']);

        return $pays;
    }

	public function fromObjectToView($pays)
	{
		$paysView = [];
		$paysView['id'] = $pays->getId();
		$paysView['nomPays'] = $pays->getNomPays();

		return $paysView;
	}
}