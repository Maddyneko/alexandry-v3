<?php

class FilmInterface
{
    public function fromSqlToObject($datasFilm)
    {
        $film = new Film();

    }

    public function fromObjectToView($film)
    {
        $datas = [];
        $datas['titreFilm'] = $film->getTitreFilm();
        $datas['titreFilmVo'] = $film->getTitreFilmVo();
        $datas['dateSortie'] = $film->getDateSortie();
        $pays = new Pays();
        $datas['pays'] = [];


    }
}