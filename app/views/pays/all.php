<?php
require_once CHEMIN_DOSSIER . '/app/handler/paysHandler.php';
require_once CHEMIN_DOSSIER . '/app/interfaces/paysInterface.php';
require_once CHEMIN_DOSSIER . '/app/modele/pays.class.php';
require_once CHEMIN_DOSSIER . '/app/repository/paysRepository.php';

$paysHandler = new PaysHandler();
$payss = $paysHandler->getPayssAffichage();

?>

<?php
foreach ($payss as $pays) {?>
	<div class="liste_element">
		<div class="liste_element_panel">
			<div class="liste_element_image" style="background-image: url('public/images/pays/<?php echo $pays->getSlug(); ?>.png');"></div>
			<a href="<?php echo getUrlPays($pays->getId());?>"><?php echo $pays->getNomPays();?></a>
		</div>
	</div>
<?php } ?>
