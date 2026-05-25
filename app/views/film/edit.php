<?php
require_once CHEMIN_DOSSIER . '/app/handler/filmHandler.php';
require_once CHEMIN_DOSSIER . '/app/handler/paysHandler.php';
require_once CHEMIN_DOSSIER . '/app/handler/personneHandler.php';

require_once CHEMIN_DOSSIER . '/app/interfaces/filmInterface.php';
require_once CHEMIN_DOSSIER . '/app/interfaces/paysInterface.php';
require_once CHEMIN_DOSSIER . '/app/interfaces/personneInterface.php';

require_once CHEMIN_DOSSIER . '/app/modele/film.class.php';
require_once CHEMIN_DOSSIER . '/app/modele/pays.class.php';
require_once CHEMIN_DOSSIER . '/app/modele/personne.class.php';

require_once CHEMIN_DOSSIER . '/app/repository/filmRepository.php';
require_once CHEMIN_DOSSIER . '/app/repository/paysRepository.php';
require_once CHEMIN_DOSSIER . '/app/repository/personneRepository.php';

	if (empty($_GET['id'])) {
		header('Location: ' . NOM_DOMAINE . "/?type=film");
	} else {
		$bdd = new SPDO();

		$idFilm = $_GET['id'];
		$filmHandler = new FilmHandler();
		$film = $filmHandler->getFilmAffichage($bdd, $idFilm);

        $paysHandler = new PaysHandler();
        $payss = $paysHandler->getPayssAffichage();

  		$personneHandler = new PersonneHandler();
        $realisateurs = $personneHandler->getPersonnesAffichage();
	}
?>
<div class="contenu_element">
	<h1>Modifier <?php echo $film->getTitreFilm();?></h1>
	<div class="contenu_form">
		<form action="<?php echo NOM_DOMAINE; ?>/app/scripts/save.php?type=film&id=<?php echo $film->getId();?>" method="post" enctype="multipart/form-data">
			<div class="form_element">
				<label for="titreFilm">Titre film</label>
				<input id="titreFilm" type="text" name="titreFilm" value="<?php echo $film->getTitreFilm();?>" />
			</div>
            <div class="form_element">
                <label for="titreFilmVo">Titre film Vo</label>
                <input id="titreFilmVo" type="text" name="titreFilmVo" value="<?php echo $film->getTitreFilmVo();?>" />
            </div>
            <div class="form_element">
                <label for="dateFilm">Date de sortie</label>
                <input id="dateFilm" type="date" name="dateFilm" value="<?php echo formatDate($film->getDateFilm(), 'Y-m-d');?>" />
            </div>
            <div class="form_element">
                <label for="paysFilm">Pays</label>
                <input id="paysFilm" name="paysFilm" list="payss" value="<?php echo $film->getPays()->getNomPays();?>" />
                <datalist id="payss">
                    <?php foreach ($payss as $pays) { ?>
                        <option><?php echo $pays->getNomPays(); ?></option>
                    <?php } ?>
                </datalist>
            </div>
			<div class="form_element">
                <label for="realisateurFilm">Réalisateur.ice</label>
                <input id="realisateurFilm" name="realisateurFilm" list="realisateurs" value="<?php echo $film->getRealisateur()->getNomPersonne();?>" />
                <datalist id="realisateurs">
                    <?php foreach ($realisateurs as $realisateur) { ?>
                        <option><?php echo $realisateur->getNomPersonne(); ?></option>
                    <?php } ?>
                </datalist>
            </div>
			<div class="form_element">
                <label for="imageFilm">Affiche du film</label>
                <input id="imageFilm" type="file" name="imageFilm" accept="image/png, image/jpeg" />
			</div>
			<input class="button" type="submit" value="Enregistrer" />
		</form>
	</div>
	<div class="contenu_apercu">
        <a href="<?php echo getUrlFilm($film->getId());?>">
            <div class="contenu_apercu_elements">
                <div class="element_titre">
                    <h1><?php echo $film->getTitreFilm();?></h1>
                </div>
                <div class="element_titre">
                    <h3><?php echo $film->getTitreFilmVO();?></h3>
                </div>
                <div class="element_titre">
                    <p><?php echo $film->getDateFilm() != null ? formatDate($film->getDateFilm()) : null;?></p>
                </div>
                 <div class="element_titre">
                    <p><?php echo $film->getRealisateur() != null ? $film->getRealisateur()->getNomPersonne() : null;?></p>
                </div>
                <?php
                $adresseFichier = getAdresseImageAffichage('film', $film->getSlug());
                if (file_exists($adresseFichier)) { ?>
                    <img src = <?php echo $adresseFichier; ?> width="100" />
                <?php } ?>
            </div>
        </a>
	</div>
</div>
