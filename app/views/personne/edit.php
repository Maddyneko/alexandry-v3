<?php
require_once CHEMIN_DOSSIER . '/app/handler/personneHandler.php';
require_once CHEMIN_DOSSIER . '/app/interfaces/personneInterface.php';
require_once CHEMIN_DOSSIER . '/app/modele/personne.class.php';
require_once CHEMIN_DOSSIER . '/app/repository/personneRepository.php';

require_once CHEMIN_DOSSIER . '/app/handler/filmHandler.php';
require_once CHEMIN_DOSSIER . '/app/interfaces/filmInterface.php';
require_once CHEMIN_DOSSIER . '/app/modele/film.class.php';
require_once CHEMIN_DOSSIER . '/app/repository/filmRepository.php';

require_once CHEMIN_DOSSIER . '/app/handler/paysHandler.php';
require_once CHEMIN_DOSSIER . '/app/interfaces/paysInterface.php';
require_once CHEMIN_DOSSIER . '/app/modele/pays.class.php';
require_once CHEMIN_DOSSIER . '/app/repository/paysRepository.php';


if (empty($_GET['id'])) {
	header('Location: ' . NOM_DOMAINE . "/?type=personne");
} else {
	$idPersonne = $_GET['id'];
	$personneHandler = new PersonneHandler();
	$personne = $personneHandler->getPersonneAffichage($idPersonne);

    $paysHandler = new PaysHandler();
    $payss = $paysHandler->getPayssAffichage();
}


?>

<div class="contenu_element">
	<h1>Modifier <?php echo $personne->getNomPersonne();?></h1>
	<div class="contenu_form">
		<form action="<?php echo NOM_DOMAINE; ?>/app/scripts/save.php?type=personne&id=<?php echo $personne->getId();?>" method="post" enctype="multipart/form-data">
			<div class="form_element">
				<label for="nomPersonne">Nom</label>
				<input id="nomPersonne" type="text" name="nomPersonne" value="<?php echo $personne->getNomPersonne();?>" />
			</div>
            <div class="form_element">
                <label for="paysFilm">Pays</label>
                <?php
                    $nomPays = null;
                    if ($personne->getIdPays() != null) {
                        $nomPays = $personne->getPays()->getNomPays();
                    }
                ?>
                <input id="paysFilm" name="paysFilm" list="payss" value="<?php echo $nomPays;?>" />
                <datalist id="payss">
                    <?php foreach ($payss as $pays) { ?>
                        <option><?php echo $pays->getNomPays(); ?></option>
                    <?php } ?>
                </datalist>
            </div>
            <div class="form_element">
                <input id="imagePersonne" type="file" name="imagePersonne" accept="image/png, image/jpeg" />
            </div>
            <input class="button" type="submit" value="Enregistrer" />
		</form>
	</div>

	<div class="contenu_apercu">
		<a href="<?php echo getUrlPersonne($personne->getId());?>">
			<div class="contenu_apercu_elements">
				<div class="element_titre">
					<h1><?php echo $personne->getNomPersonne();?></h1>
				</div>
	            <?php
	            $adresseFichier = getAdresseImageAffichage('personne', $personne->getSlug());
	            if (file_exists($adresseFichier)) { ?>
	                <img src = <?php echo $adresseFichier; ?> width="100" />
	            <?php } ?>
			</div>
		</a>
	</div>
</div>