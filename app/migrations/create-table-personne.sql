DROP TABLE IF EXISTS personne_t;
CREATE TABLE personne_t (
	id int NOT NULL AUTO_INCREMENT,
    dateAjout timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    dateModification timestamp NULL DEFAULT NULL,
    nomPersonne varchar(255) NOT NULL,
    slug varchar(255),
	PRIMARY KEY (id)
);