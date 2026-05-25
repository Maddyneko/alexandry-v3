<?php
require_once CHEMIN_DOSSIER . '/app/handler/personneHandler.php';
require_once CHEMIN_DOSSIER . '/app/interfaces/personneInterface.php';
require_once CHEMIN_DOSSIER . '/app/modele/personne.class.php';
require_once CHEMIN_DOSSIER . '/app/repository/personneRepository.php';

if (empty($_GET['id'])) {
	header('Location: ' . NOM_DOMAINE . "/?type=personne");
} else {
	$idPersonne = $_GET['id'];
	$personneHandler = new PersonneHandler();
	$personne = $personneHandler->getPersonneAffichage($idPersonne);
}


?>

<div class="contenu_element">
	<h1>Modifier <?php echo $personne->getNomPersonne();?></h1>
	<div class="contenu_form">
		<form action="<?php echo NOM_DOMAINE; ?>/app/scripts/save.php?type=personne&id=<?php echo $personne->getId();?>" method="post" enctype="multipart/form-data">
			<div class="form_element">
				<label for="nomPersonne">Nom</label>
				<input id="nomPersonne" type="text" name="nomPersonne" value="<?php echo $personne->getNomPersonne();?>" />
			</div>
            <div class="form_element">
                <input id="imagePersonne" type="file" name="imagePersonne" accept="image/png, image/jpeg" />
            </div>
            <input class="button" type="submit" value="Enregistrer" />
		</form>
	</div>

	<div class="contenu_apercu">
		<a href="<?php echo NOM_DOMAINE; ?>/?type=personne&vue=element&id=<?php echo $personne->getId();?>">
			<div class="contenu_apercu_elements">
				<div class="element_titre">
					<h1><?php echo $personne->getNomPersonne();?></h1>
				</div>
	            <?php
	            $adresseFichier = getAdresseImageAffichage('personne', $personne->	());
	            if (file_exists($adresseFichier)) { ?>
	                <img src = <?php echo $adresseFichier; ?> width="100" />
	            <?php } ?>
			</div>
		</a>
	</div>
</div>