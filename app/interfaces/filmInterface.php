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
		$film->setSlug($datasFilm['slug']);

		return $film;
    }
}