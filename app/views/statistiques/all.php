<?php
require_once CHEMIN_DOSSIER . '/app/handler/filmHandler.php';
require_once CHEMIN_DOSSIER . '/app/interfaces/filmInterface.php';
require_once CHEMIN_DOSSIER . '/app/modele/film.class.php';
require_once CHEMIN_DOSSIER . '/app/repository/filmRepository.php';

$filmHandler = new FilmHandler();
$payss = $filmHandler->getNbFilmsParPays();
$i = 0;
$couleurs = ['4e79a7', 'f28e2c', 'e15759', '76b7b2', '59a14f', 'edc949', '4e79a7', 'f28e2c', 'e15759', '76b7b2', '59a14f', 'edc949', '4e79a7', 'f28e2c', 'e15759', '76b7b2', '59a14f', 'edc949'];
?>
<figure class="pie-chart">
	<h2>Films par pays</h2>
	<figcaption>
		<?php foreach ($payss as $pays) { 
			if ($pays['pourcentageFilms'] > 0) {
		?>
			<?php echo $pays['nomPays']; ?><span style="color:#<?php echo $couleurs[$i]; ?>"></span><br>
			<?php $i++; ?>
		<?php }
			}
		?>
	</figcaption>
	<cite>International Energy Agency</cite>
</figure>

<style>
	.pie-chart {
		background:
			radial-gradient(
				circle closest-side,
				transparent 66%,
				white 0
			),
			conic-gradient(
				<?php $i = 0;
                    $listeValeurDiagramme = null;
                ?>
				<?php foreach ($payss as $pays) {
					if ($pays['pourcentageFilms'] > 0) {
	                    $listeValeurDiagramme .= $listeValeurDiagramme == null ? '': ', ';
	                    $listeValeurDiagramme .= "#" . $couleurs[$i] . " 0, #" . $couleurs[$i] . " " . $pays['pourcentageCumuleFilms'] . "%";
	                    $i++;
	                }
                    }
                    echo $listeValeurDiagramme;
                ?>
		);
		position: relative;
		width: 500px;
		min-height: 350px;
		margin: 0;
		outline: 1px solid #ccc;
	}
	.pie-chart h2 {
		position: absolute;
		margin: 1rem;
	}
	.pie-chart cite {
		position: absolute;
		bottom: 0;
		font-size: 80%;
		padding: 1rem;
		color: gray;
	}
	.pie-chart figcaption {
		position: absolute;
		bottom: 1em;
		right: 1em;
		font-size: smaller;
		text-align: right;
	}
	.pie-chart span:after {
		display: inline-block;
		content: "";
		width: 0.8em;
		height: 0.8em;
		margin-left: 0.4em;
		height: 0.8em;
		border-radius: 0.2em;
		background: currentColor;
	}
</style>
