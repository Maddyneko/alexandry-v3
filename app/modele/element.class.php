<?php

class Element
{
    private $dateAjout;
    private $dateModification;

	public function __construct()
	{

	}

	public function getDateAjout()
	{
		return $this->dateAjout;
	}

	public function setDateAjout($dateAjout): void
	{
		$this->dateAjout = $dateAjout;
	}

	public function getDateModification()
	{
		return $this->dateModification;
	}

	public function setDateModification($dateModification): void
	{
		$this->dateModification = $dateModification;
	}
}