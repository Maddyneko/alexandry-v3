<?php

class FilmInterface
{
    public function fromSqlToObject($datasFilm)
    {
        $film = new Film();
		$film->setId($datasFilm['id']);
		$film->setTitreFilm($datasFilm['titreFilm']);

		return $film;

    }

    public function fromObjectToView($film)
    {
        $filmView = [];
		$filmView['id'] = $film->getId();
		$filmView['titreFilm'] = $film->getTitreFilm();

		return $filmView;


    }
}