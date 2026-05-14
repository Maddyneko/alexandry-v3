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
		<h1><?php echo $film['titreFilm'];?></h1>
	</div>
	<div class="element_details">
        <div class="element_detail_left">
            <?php echo ($film['dateFilm'] != null ? formatDate($film['dateFilm']) : ""); ?>
        </div>
        <div class="element_detail_right element_image">
            <?php
                $adresseFichier = "public/images/pays/" . $film['pays']['id'] . ".png";
                if (file_exists($adresseFichier)) {
            ?>
            <img src = "<?php echo $adresseFichier; ?>" width="40" />

            <?php } else {
                echo ($film['pays']['nomPays'] != null ? $film['pays']['nomPays'] : "");
                }
            ?>
        </div>
        <div class="element_detail_left ligne_2" style="width: 100%">

        <p>Dan Trachtenberg</p>
        </div>
	    </div>
	<?php if ($film['titreFilmVO'] != null) { ?>
	<div class="element_sous_titre">
		<h3><?php echo $film['titreFilmVO'];?></h3>
	</div>
	<?php }?>
</div>
