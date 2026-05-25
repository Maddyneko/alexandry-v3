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
        <?php
        $adresseFichier = "public/images/pays/" . $pays->getSlug() . ".png";
        if (file_exists($adresseFichier)) { ?>
            <div class="element_image">
                <img src = "<?php echo $adresseFichier; ?>" width="200" />
            </div>
        <?php } ?>
	<div class="element_titre">
		<h1><?php echo $pays->getNomPays();?></h1>
	</div>
    <div class="sous_liste_elements">
        <p>Films <span class="badge"><?php echo count($pays->getFilms()); ?></span></p>
        <?php foreach($pays->getFilms() as $film) { ?>
                <div class="liste_element">
                    <div class="liste_element_panel">
                        <div class="liste_element_image" style="background-image: url('public/images/film/<?php echo $film->getSlug(); ?>.png');"></div>
                        <a href="<?php echo getUrlFilm($film->getId());?>"><?php echo $film->getTitreFilm();?></a>
                    </div>
                </div>
        <?php } ?>
    </div>
</div>

<div class="action_element">
	<div class="bouton_action">
		<a href="<?php echo NOM_DOMAINE; ?>/?type=pays&vue=edit&id=<?php echo $pays->getId();?>">
			<i class="fas fa-pencil"></i>
		</a>

	</div>
</div>