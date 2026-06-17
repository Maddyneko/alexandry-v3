<?php
require_once CHEMIN_DOSSIER . '/app/handler/filmHandler.php';
require_once CHEMIN_DOSSIER . '/app/handler/personneHandler.php';
require_once CHEMIN_DOSSIER . '/app/interfaces/filmInterface.php';
require_once CHEMIN_DOSSIER . '/app/interfaces/personneInterface.php';
require_once CHEMIN_DOSSIER . '/app/modele/film.class.php';
require_once CHEMIN_DOSSIER . '/app/modele/personne.class.php';
require_once CHEMIN_DOSSIER . '/app/repository/filmRepository.php';
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
        <div class="sous_liste_elements">
        <p>Films <span class="badge"><?php echo count($personne->getFilms()); ?></span></p>
        <?php foreach($personne->getFilms() as $film) { ?>
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
        <a href="<?php echo getUrlEdit('personne', $personne->getId());?>">
            <i class="fas fa-pencil"></i>
        </a>
    </div>
</div>