DROP TABLE IF EXISTS film_t;
CREATE TABLE film_t (
	id int NOT NULL AUTO_INCREMENT,
    dateAjout timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    dateModification timestamp NULL DEFAULT NULL,
    idRealisateur int DEFAULT NULL,
    idPays int DEFAULT NULL,
    titreFilm varchar(255) NOT NULL,
    titreFilmVO varchar(255) DEFAULT NULL,
    dateFilm datetime DEFAULT NULL,
    slug varchar(255),
	PRIMARY KEY (id)
);