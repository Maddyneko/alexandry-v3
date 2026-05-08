<?php
    require_once('app/config/config.php');
    require_once('app/tools/utils.php');
    require_once('app/tools/validation.php');

    $type = $_GET['type'] ?? 'films';
    $vue = $_GET['vue'] ?? 'all';
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
    	<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="<?php echo NOM_DOMAINE; ?>/public/css/reset.css">
        <link rel="stylesheet" href="<?php echo NOM_DOMAINE; ?>/public/css/style.css">
        <link rel="stylesheet" href="<?php echo NOM_DOMAINE; ?>/public/css/font-awesome.css">
    </head>
    <body>
        <nav id="menu">
            <div>
                <ul>
                    <li class="logo onglet">Alexandrie</li>
                    <li class="onglet"><a href=<?php echo NOM_DOMAINE; ?>/?type=pays><i class="fas fa-tag"></i> Global</a></li>
                    <li class="onglet"><a><i class="fas fa-user"></i> Personnes</a></li>
                    <li class="onglet"><a><i class="fas fa-film"></i> Films</a></li>
                    <li class="onglet"><a><i class="fas fa-book"></i> Livres</a></li>
                    <li class="onglet"><a><i class="fas fa-book-open"></i> Bds</a></li>
                </ul>
                <ul>
                    <li class="onglet_admin"><a><i class="fa-solid fa-gears"></i></a></li>
                </ul>
            </div>
        </nav>
    	
        <div id="contenu">
           <?php require_once('app/views/' . $type . '/'  . $vue . '.php'); ?>
        </div>
    </body>
</html>