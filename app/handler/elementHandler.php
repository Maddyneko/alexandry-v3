<?php

class ElementHandler {
    public function mettreAJourImage($type, $ancienSlug, $nouveauSlug, $tmpName, $datas)
    {
        if (!empty($tmpName)) {
            if (existeImage($type, $ancienSlug)) {
                supprimerImage($type, $ancienSlug);
            }
            uploadImage($type, $nouveauSlug, $datas);
        } else {
            if ($ancienSlug != $nouveauSlug && existeImage($type, $ancienSlug)) {
                modifierNomImage($type, $ancienSlug, $nouveauSlug);
            }
        }
    }
}