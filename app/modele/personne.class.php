<?php
require_once CHEMIN_DOSSIER . '/app/modele/element.class.php';

class Personne extends Element
{
 	private $id;
	 private $idPays;
	private $nomPersonne;
	private $pays;
	private $films;


	public function getId()
	{
		return $this->id;
	}

	public function setId($id): void
	{
		$this->id = $id;
	}

	public function getIdPays()
	{
		return $this->idPays;
	}

	public function setIdPays($idPays): void
	{
		$this->idPays = $idPays;
	}

	public function getNomPersonne()
	{
		return $this->nomPersonne;
	}

	public function setNomPersonne($nomPersonne): void
	{
		$this->nomPersonne = $nomPersonne;
	}

	public function getPays()
	{
		return $this->pays;
	}

	public function setPays($pays): void
	{
		$this->pays = $pays;
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
		if ($this->nomPersonne != null) {
			$slug = slugify($this->nomPersonne);
		}

		return $slug;
	}
}