<?php
require_once '../config/config.php';
require_once CHEMIN_DOSSIER . '/app/tools/utils.php';
require_once CHEMIN_DOSSIER . '/app/tools/fichiers.php';

require_once CHEMIN_DOSSIER . '/app/tools/validation.php';
require_once CHEMIN_DOSSIER . '/app/handler/paysHandler.php';
require_once CHEMIN_DOSSIER . '/app/interfaces/paysInterface.php';

require_once CHEMIN_DOSSIER . '/app/modele/pays.class.php';
require_once CHEMIN_DOSSIER . '/app/repository/paysRepository.php';


if (empty($_GET['type']) || !estValideType($_GET['type'])) {
	header('Location: ' . NOM_DOMAINE . "/");
} else {
	$type = $_GET['type'];
	 if (empty($_GET['id'])) {
		header('Location: ' . NOM_DOMAINE . "/?type=" . $type);
	} else {
		 $id = $_GET['id'];
		switch ($type) {
			case 'pays':
				$paysHandler = new PaysHandler();
				$paysHandler->modifierPays($id, $_POST, $_FILES);
				header('Location: ' . NOM_DOMAINE . "/?type=" . $type . "&vue=element&id=" . $id);

				break;
		}
	 }
}