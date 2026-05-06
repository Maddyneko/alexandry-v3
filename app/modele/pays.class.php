<?php
require_once CHEMIN_DOSSIER . '/app/modele/element.class.php';

class Pays extends Element
{
	private $id;
    private $nomPays;
    private $initialePays;

	public function __construct()
	{

	}

	public function getId()
	{
		return $this->id;
	}

	public function setId($id): void
	{
		$this->id = $id;
	}

	public function getNomPays()
	{
		return $this->nomPays;
	}

	public function setNompPays($nomPays): void
	{
		$this->nomPays = $nomPays;
	}

	public function getInitialePays()
	{
		return $this->initialePays;
	}

	public function setInitialePays($initialePays): void
	{
		$this->initialePays = $initialePays;
	}
}