<?php
require_once CHEMIN_DOSSIER . '/app/handler/paysHandler.php';
require_once CHEMIN_DOSSIER . '/app/interfaces/paysInterface.php';
require_once CHEMIN_DOSSIER . '/app/modele/pays.class.php';
require_once CHEMIN_DOSSIER . '/app/repository/paysRepository.php';

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
        <?php
        $adresseFichier = "public/images/pays/" . $pays['id'] . ".png";
        if (file_exists($adresseFichier)) { ?>
            <div class="element_image");">
                <img src = <?php echo $adresseFichier; ?> width="200" />
            </div>
        <?php } ?>
	<div class="element_titre">
		<h1><?php echo $pays['nomPays'];?></h1>
	</div>

</div>
<div class="action_element">
	<div class="bouton_action">
		<a href="<?php echo NOM_DOMAINE; ?>/?type=pays&vue=edit&id=<?php echo $pays['id'];?>">
			<i class="fas fa-pencil"></i>
		</a>

	</div>
</div>