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

function formatDate($dateSql)
{
	return date('d/m/Y', strtotime($dateSql));
}