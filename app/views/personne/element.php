<?php
require_once CHEMIN_DOSSIER . '/app/handler/personneHandler.php';

if (empty($_GET['id'])) {
	header('Location: ' . NOM_DOMAINE . "/?type=personne");
} else {
	$bdd = new SPDO();

	$idPersonne = $_GET['id'];
	$personneHandler = new PersonneHandler();
	$pays = $personneHandler->getPersonneAffichage($bdd, $idPersonne);
}
