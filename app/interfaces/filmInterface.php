<?php

class FilmInterface
{
    public function fromSqlToObject($datasFilm)
    {
        $film = new Film();
		$film->setId($datasFilm['id']);
		$film->setTitreFilm($datasFilm['titreFilm']);
		$film->setDateFilm($datasFilm['dateFilm']);
		$film->setTitreFilmVO($datasFilm['titreFilmVO']);
		$film->setIdPays($datasFilm['idPays']);

		return $film;

    }

    public function fromObjectToView($film)
    {
        $filmView = [];
		$filmView['id'] = $film->getId();
		$filmView['titreFilm'] = $film->getTitreFilm();
		$filmView['dateFilm'] = $film->getDateFilm();
		$filmView['titreFilmVO'] = $film->getTitreFilmVO();

		return $filmView;
    }

	public function addPaysToView($filmView, $pays)
	{
		$filmView['pays'] = $pays;

		return $filmView;
	}
}