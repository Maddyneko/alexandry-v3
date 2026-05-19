<?php
require_once CHEMIN_DOSSIER . '/app/handler/paysHandler.php';
require_once CHEMIN_DOSSIER . '/app/handler/filmHandler.php';

require_once CHEMIN_DOSSIER . '/app/interfaces/paysInterface.php';
require_once CHEMIN_DOSSIER . '/app/interfaces/filmInterface.php';
require_once CHEMIN_DOSSIER . '/app/modele/pays.class.php';
require_once CHEMIN_DOSSIER . '/app/modele/film.class.php';
require_once CHEMIN_DOSSIER . '/app/repository/paysRepository.php';
require_once CHEMIN_DOSSIER . '/app/repository/filmRepository.php';

	if (empty($_GET['id'])) {
		header('Location: ' . NOM_DOMAINE . "/?type=pays");
	} else {
		$bdd = new SPDO();

		$idPays = $_GET['id'];
		$paysHandler = new PaysHandler();
		$pays = $paysHandler->getPaysAffichage($bdd, $idPays);
	}
?>
<div class="contenu_element">

	<h1>Modifier <?php echo $pays->getNomPays();?></h1>
	<div class="contenu_form">
		<form action="<?php echo NOM_DOMAINE; ?>/app/scripts/save.php?type=pays&id=<?php echo $pays->getId();?>" method="post" enctype="multipart/form-data">
			<div class="form_element">
				<label for="nomPays">Nom</label>
				<input id="nomPays" type="text" name="nomPays" value="<?php echo $pays->getNomPays();?>" />
			</div>
            <div class="form_element">
                <input id="imagePays" type="file" name="imagePays" accept="image/png, image/jpeg" />
            </div>
            <input class="button" type="submit" value="Enregistrer" />
		</form>
	</div>
	<div class="contenu_apercu">
		<div class="contenu_apercu_elements">
			<div class="element_titre">
				<h1><?php echo $pays->getNomPays();?></h1>
			</div>
            <?php
            $adresseFichier = "public/images/pays/" . $pays->getSlug() . ".png";
            if (file_exists($adresseFichier)) { ?>
                <img src = <?php echo $adresseFichier; ?> width="100" />
            <?php } ?>
		</div>
	</div>
</div>
