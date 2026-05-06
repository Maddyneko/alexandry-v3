<?php

class filmRepository extends elementrepository
{

    public function __construct($bdd)
    {
        parent::__construct($bdd, 'film_t');
    }

    public function selectFilms()
    {
        return parent::selectElements();
    }

	public function insertFilm($film)
	{
		$idFilm = null;
		if ($film->getTitreFilm() != null) {
			$requete = "INSERT INTO " . $this->getNomTable() . " ("
				. "titreFilm "
				. ", idPays "
				. ", idRealisateur "
				. ($film->getTitreFilmVo() != null ? ", titreFilmVo " : "")
				. ($film->getDateFilm() != null ? ", dateFilm " : "")
				. ") VALUES ("
				. $this->bdd->quote($film->getTitreFilm()) . " "
				. ", " . (int) $film->getIdPays()
				. ", " . (int) $film->getIdRealisateur()
				. ($film->getTitreFilmVo() != null ? "," . $this->bdd->quote($film->getTitreFilm()) . " " : "")
				. ($film->getDateFilm() != null ? "," .  $this->bdd->quote(date('Y-m-d', strtotime($film->getDateFilm()))) . " " : "")
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
}