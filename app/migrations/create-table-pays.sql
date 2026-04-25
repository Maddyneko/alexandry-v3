DROP TABLE IF EXISTS pays_t;
CREATE TABLE pays_t (
	id int NOT NULL AUTO_INCREMENT,
    dateAjout timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    dateModification timestamp NULL DEFAULT NULL,
    nomPays varchar(255) NOT NULL,
    initialePays varchar(255) DEFAULT NULL,
	PRIMARY KEY (id)
);