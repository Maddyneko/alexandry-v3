<?php

class PaysHandler {
    public function creerPaysBase($bdd, $nomPays) {
        $idPays = null;
        if ($nomPays !== null) {
            $pays = new Pays();
            $pays->setNompPays($nomPays);
            $paysRepository = new PaysRepository($bdd);
            $idPays = $paysRepository->insertPays($pays);
        }

        return $idPays;
    }
}