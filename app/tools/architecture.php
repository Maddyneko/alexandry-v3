<?php 

function getUrlElement($type, $id)
{
	return NOM_DOMAINE . '?type=' . $type . '&vue=element&id='.  $id;
}

function getUrlFilm($id)
{
	return getUrlElement('film', $id);
}

function getUrlPersonne($id)
{
	return getUrlElement('personne', $id);
}

function getUrlPays($id)
{
	return getUrlElement('pays', $id);
}