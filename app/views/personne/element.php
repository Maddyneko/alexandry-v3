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

<div class="contenu_element personne">
	<div class="element_titre">
		<h1><?php echo $personne->getNomPersonne();?></h1>
	</div>
	<div class="element_details">
 
    </div>

    <div class="element_sous_rubrique">
        <?php if (file_exists(getAdresseImageAffichage('personne', $personne->getSlug()))) { ?>
        <div class="element_image">
            <img src = "<?php echo getAdresseImageAffichage('personne', $personne->getSlug()); ?>" width="200" />
        </div>
        <?php } ?>
    </div>
</div>
	

<div class="action_element">
    <div class="bouton_action">
        <a href="<?php echo NOM_DOMAINE; ?>/?type=personne&vue=edit&id=<?php echo $personne->getId();?>">
            <i class="fas fa-pencil"></i>
        </a>
    </div>
</div>