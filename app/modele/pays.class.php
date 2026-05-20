<?php
require_once CHEMIN_DOSSIER . '/app/modele/element.class.php';

class Pays extends Element
{
	private $id;
    private $nomPays;
    private $initialePays;
	private $films;

	public function __construct()
	{
		$this->films = array();
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

	public function getFilms()
	{
		return $this->films;
	}

	public function setFilms($films): void
	{
		$this->films = $films;
	}

	public function makeSlug()
	{
		$slug = null;
		if ($this->nomPays != null) {
			$slug = slugify($this->nomPays);
		}

		return $slug;
	}
}