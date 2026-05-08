<?php
require_once CHEMIN_DOSSIER . '/app/handler/paysHandler.php';
require_once CHEMIN_DOSSIER . '/app/interfaces/paysInterface.php';
require_once CHEMIN_DOSSIER . '/app/modele/pays.class.php';
require_once CHEMIN_DOSSIER . '/app/repository/paysRepository.php';

$bdd = new SPDO();
$paysHandler = new PaysHandler();
$payss = $paysHandler->getPayssAffichage($bdd);

?>

<?php
foreach ($payss as $pays) {?>
	<div class="liste_element">
		<div class="liste_element_panel">
			<div class="liste_element_image" style="background-image: url('public/images/pays/<?php echo $pays['id'] ?>.png');"></div>
			<a href="<?php echo NOM_DOMAINE; ?>/?type=pays&vue=element&id=<?php echo $pays['id'];?>"><?php echo $pays['nomPays'];?></a>
		</div>
	</div>
<?php } ?>
