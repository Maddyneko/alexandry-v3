<?php
require_once CHEMIN_DOSSIER . '/app/handler/filmHandler.php';
require_once CHEMIN_DOSSIER . '/app/interfaces/filmInterface.php';
require_once CHEMIN_DOSSIER . '/app/modele/film.class.php';
require_once CHEMIN_DOSSIER . '/app/repository/filmRepository.php';
require_once CHEMIN_DOSSIER . '/app/repository/paysRepository.php';
require_once CHEMIN_DOSSIER . '/app/repository/personneRepository.php';

$bdd = new SPDO();
$filmHandler = new FilmHandler();
$films = $filmHandler->getFilmsAffichage($bdd);
?>

<?php
foreach ($films as $film) {?>
	<div class="liste_element liste_element_long">
		<div class="liste_element_panel liste_element_panel_long">
			<div class="liste_element_image" style="background-image: url('public/images/film/<?php echo $film['id'] ?>.png');"></div>
			<a href="<?php echo NOM_DOMAINE; ?>/?type=film&vue=element&id=<?php echo $film['id'];?>"><?php echo $film['titreFilm'];?></a>
		</div>
	</div>
<?php } ?>

