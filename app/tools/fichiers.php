<?php

function getAdresseImage($type, $slug)
{
    return CHEMIN_DOSSIER . "/public/images/" . $type . "/" . $slug . ".png";
}

function existeImage($type, $slug)
{
    return file_exists(getAdresseImage($type, $slug));
}

function uploadImage($type, $slug , $tmpName)
{
    $adresseDossier = CHEMIN_DOSSIER_IMAGE . "/" . $type;
    makeDirs($adresseDossier);
    $adresseFichier = getAdresseImage($type, $slug);
    move_uploaded_file($tmpName , $adresseFichier );
}

function makeDirs($adresseDossier) {
    return is_dir($adresseDossier) || mkdir($adresseDossier, 0777, true);
}

function supprimerImage($type, $slug)
{
    unlink(getAdresseImage($type, $slug));
}

function modifierNomImage($type, $ancienNom, $nouveauNom)
{
    rename(getAdresseImage($type, $ancienNom), getAdresseImage($type, $nouveauNom));
}