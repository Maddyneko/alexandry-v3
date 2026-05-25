<?php
require_once CHEMIN_DOSSIER . '/app/modele/element.class.php';

class Film extends Element
{
	private $id;
	private $idRealisateur;
	private $idPays;
	private $titreFilm;
	private $titreFilmVO;
	private $dateFilm;
	private $pays;
	private $realisateur;

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

	public function getIdRealisateur()
	{
		return $this->idRealisateur;
	}

	public function setIdRealisateur($idRealisateur): void
	{
		$this->idRealisateur = $idRealisateur;
	}

	public function getIdPays()
	{
		return $this->idPays;
	}

	public function setIdPays($idPays): void
	{
		$this->idPays = $idPays;
	}

	public function getTitreFilm()
	{
		return $this->titreFilm;
	}

	public function setTitreFilm($titreFilm): void
	{
		$this->titreFilm = $titreFilm;
	}

	public function getTitreFilmVO()
	{
		return $this->titreFilmVO;
	}

	public function setTitreFilmVO($titreFilmVO): void
	{
		$this->titreFilmVO = $titreFilmVO;
	}

	public function getDateFilm()
	{
		return $this->dateFilm;
	}

	public function setDateFilm($dateFilm): void
	{
		$this->dateFilm = $dateFilm;
	}

	public function getPays()
	{
		return $this->pays;
	}

	public function setPays($pays): void
	{
		$this->pays = $pays;
	}

	public function getRealisateur()
	{
		return $this->realisateur;
	}

	public function setRealisateur($realisateur): void
	{
		$this->realisateur = $realisateur;
	}

	public function makeSlug()
	{
		$slug = null;
		if ($this->getTitreFilm() != null) {
			$slug = slugify($this->getTitreFilm() . ($this->dateFilm != null ? "-" . substr($this->dateFilm, 0, 4) : null));
		}

		return $slug;
	}


}