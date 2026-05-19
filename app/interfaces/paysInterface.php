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
		$pays->setSlug($datasPays['slug']);

        return $pays;
    }

	public function fromObjectToView($pays)
	{
		$paysView = [];
		$paysView['id'] = $pays->getId();
		$paysView['nomPays'] = $pays->getNomPays();
		$paysView['slug'] = $pays->getSlug();

		return $paysView;
	}

	public function addFilmsToView($paysView, $films)
	{
		$paysView['films'] = $films;
		return $paysView;
	}
}