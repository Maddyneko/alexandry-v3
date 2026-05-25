<?php
require_once CHEMIN_DOSSIER . '/app/handler/personneHandler.php';
require_once CHEMIN_DOSSIER . '/app/interfaces/personneInterface.php';
require_once CHEMIN_DOSSIER . '/app/modele/personne.class.php';
require_once CHEMIN_DOSSIER . '/app/repository/personneRepository.php';

$personneHandler = new PersonneHandler();
$personnes = $personneHandler->getPersonnesAffichage();
?>
<?php
foreach ($personnes as $personne) {?>
	<div class="liste_element liste_element_long">
		<div class="liste_element_panel liste_element_panel_long">
			<div class="liste_element_image" style="background-image: url('public/images/personne/<?php echo $personne->getSlug() ?>.png');"></div>
			<a href="<?php echo NOM_DOMAINE; ?>/?type=personne&vue=element&id=<?php echo $personne->getId();?>"><?php echo $personne->getNomPersonne();?></a>
		</div>
	</div>
<?php } ?>
