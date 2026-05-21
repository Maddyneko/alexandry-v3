<?php
require_once CHEMIN_DOSSIER . '/app/handler/filmHandler.php';
require_once CHEMIN_DOSSIER . '/app/handler/paysHandler.php';
require_once CHEMIN_DOSSIER . '/app/interfaces/filmInterface.php';
require_once CHEMIN_DOSSIER . '/app/interfaces/paysInterface.php';
require_once CHEMIN_DOSSIER . '/app/modele/film.class.php';
require_once CHEMIN_DOSSIER . '/app/modele/pays.class.php';
require_once CHEMIN_DOSSIER . '/app/repository/filmRepository.php';
require_once CHEMIN_DOSSIER . '/app/repository/paysRepository.php';

if (empty($_GET['id'])) {
    header('Location: ' . NOM_DOMAINE . "/?type=film");
} else {
    $bdd = new SPDO();

    $idFilm = $_GET['id'];
    $filmHandler = new FilmHandler();
    $film = $filmHandler->getFilmAffichage($bdd, $idFilm);
}
?>
<div class="contenu_element film">
	<div class="element_titre">
		<h1><?php echo $film->getTitreFilm();?></h1>
	</div>
	<div class="element_details">
        <div class="element_detail_left">
            <?php echo ($film->getDateFilm() != null ? formatDate($film->getDateFilm()) : ''); ?>
        </div>
        <div class="element_detail_right element_image">
            <?php
                $adresseFichier = "public/images/pays/" . $film->getPays()->getSlug() . ".png";
                if (file_exists($adresseFichier)) {
            ?>
            <img src = "<?php echo $adresseFichier; ?>" width="40" />

            <?php } else {
                echo ($film->getPays()->getNomPays() != null ? $film->getPays()->getNomPays() : "");
                }
            ?>
        </div>
        <div class="element_detail_left ligne_2" style="width: 100%">

        <p>Nom du réalisateur</p>
        </div>
    </div>
	<?php if ($film->getTitreFilmVo() != null) { ?>
	<div class="element_sous_titre">
        <?php if ($film->getTitreFilm() != $film->getTitreFilmVo() ) { ?>
		<h3><?php echo $film->getTitreFilmVo();?></h3>
        <?php } ?>
	</div>
	<?php }?>
    <div class="element_sous_rubrique">
        
        <?php if (file_exists(getAdresseImageAffichage('film', $film->getSlug()))) { ?>
        <div class="element_image">
            <img src = "<?php echo getAdresseImageAffichage('film', $film->getSlug()); ?>" width="200" />
        </div>
        <?php } ?>
    </div>
</div>

<div class="action_element">
    <div class="bouton_action">
        <a href="<?php echo NOM_DOMAINE; ?>/?type=film&vue=edit&id=<?php echo $film->getId();?>">
            <i class="fas fa-pencil"></i>
        </a>

    </div>
</div>