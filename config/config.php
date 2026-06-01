<?php
// Garde pour éviter une double inclusion accidentelle du fichier.
if (!defined('APP_STARTED')) {
    define('APP_STARTED', true);
}

// BASE_URL est calculée dynamiquement d'après l'URL du script en cours.
// Cela permet d'héberger le projet dans n'importe quel sous-dossier
// (ex. localhost/axiom/ → BASE_URL = "/axiom/").
$baseUrl = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/') . '/';
define('BASE_URL', $baseUrl);
