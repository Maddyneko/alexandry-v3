<?php

function estValideType($type) {
	$estValideType = false;
	if (in_array($type, ['pays', 'film', 'personne'])) {
		$estValideType = true;
	}
	return $estValideType;
}