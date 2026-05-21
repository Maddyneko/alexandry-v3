<?php
require_once CHEMIN_DOSSIER . '/app/repository/elementRepository.php';

class filmRepository extends elementrepository
{

    public function __construct($bdd)
    {
        parent::__construct($bdd, 'film_t', 'titreFilm');
    }

	public function getFilmsParIdPays($idPays)
	{
		$this->filtres = "AND idPays = " . (int) $idPays . " ";
		return $this->selectFilms();
	}

	public function getFilmParId($id)
	{
		$this->filtres = "AND id = " . (int) $id . " ";
		return $this->selectFilm();
	}

    public function selectFilms()
    {
        return parent::selectElements();
    }

	public function selectFilm()
	{
		return parent::selectElement();
	}

	public function selectFilmsDetail()
	{
		$requete = "SELECT F.* "
			."FROM " . $this->getNomTable() . " F "
			. ($this->order != null ? "ORDER BY " . $this->order : "")

		;

		return $this->bdd->qfetch($requete);
	}

	public function insertFilm($film)
	{
		$idFilm = null;
		if ($film->getTitreFilm() != null && $film->getSlug() != null) {
			$requete = "INSERT INTO " . $this->getNomTable() . " ("
				. "titreFilm "
				. ", idPays "
				. ", idRealisateur "
				. ($film->getTitreFilmVo() != null ? ", titreFilmVo " : "")
				. ($film->getDateFilm() != null ? ", dateFilm " : "")
				. ", slug "
				. ") VALUES ("
				. $this->bdd->quote($film->getTitreFilm()) . " "
				. ", " . (int) $film->getIdPays()
				. ", " . (int) $film->getIdRealisateur()
				. ($film->getTitreFilmVo() != null ? "," . $this->bdd->quote($film->getTitreFilmVO()) . " " : "")
				. ($film->getDateFilm() != null ? "," .  $this->bdd->quote(date('Y-m-d', strtotime($film->getDateFilm()))) . " " : "")
				. ", " . $this->bdd->quote($film->getSlug()) . " "
				. ") "
			;
			$this->bdd->query($requete);
			$idFilm = $this->bdd->lastInsertId();
		}

		return $idFilm;
	}

	public function cleanDateFilms()
	{
		$requete = "UPDATE " . $this->getNomTable() . " SET dateFilm = NULL "
			. "WHERE dateFilm = '1970-01-01 00:00:00'"
		;
		$this->bdd->query($requete);

	}

	public function updateFilm($film)
	{
		if ($film->getId() != null && $film->getTitreFilm() != null) {
			$requete = "UPDATE " . $this->getNomTable() . " SET "
				. "titreFilm = " . $this->bdd->quote($film->getTitreFilm()) . " "
				. ", slug = " . $this->bdd->quote($film->getSlug()) . " "
				. ", dateFilm = " . $this->bdd->quote($film->getDateFilm()) . " "
				. "WHERE id = " . (int) $film->getId()
			;

			$this->bdd->query($requete);
		}
	}
}