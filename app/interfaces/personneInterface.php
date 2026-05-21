<?php

class PersonneInterface
{
	public function fromSqlToObject($datasPersonne)
    {
        $personne = new Personne();
        $personne->setId($datasPersonne['id']);
        $personne->setNomPersonne($datasPersonne['nomPersonne']);
		$personne->setSlug($datasPersonne['slug']);

        return $personne;
    }

}