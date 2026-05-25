<?php

function cleanDonnee($valeur)
{
    return trim($valeur);
}

function debug($datas)
{
	echo '<pre>';
	print_r($datas);
	echo '</pre>';
}

function formatDate($dateSql, $format = "d/m/Y")
{
	return date($format, strtotime($dateSql));
}

function slugify($valeurASlugifier)
{
	$slug = trim(strtolower($valeurASlugifier));
	$slug = str_replace(['\'', '"'], "", $slug);
	$slug = str_replace([' ', '_', '.'], "-", $slug);
    $slug = str_replace('&', 'et', $slug);
	$slug = str_replace(['à'], "a", $slug);
	$slug = str_replace(['é', 'è', 'ê'], "e", $slug);
	$slug = str_replace(['ù'], "u", $slug);
	$slug = str_replace(['ô'], "o", $slug);

	$slug = preg_replace("#[^A-Z0-9\'\ ]#i", "-", $slug);
	while (substr_count($slug, "--") >= 1) {
		$slug = str_replace('--', "-", $slug);
	}

	return $slug;
}