<?php
// Autoloader maison — aucune dépendance Composer n'est nécessaire.
// Il mappe les namespaces PHP sur les dossiers physiques du projet :
//   Axiom\Controleur\ProduitControleur  →  CONTROLEUR/ProduitControleur.php
//   Axiom\Modele\ProduitModel           →  MODELE/ProduitModel.php
spl_autoload_register(function (string $class): void {
    $prefixes = [
        'Axiom\\Controleur\\' => __DIR__ . '/../CONTROLEUR/',
        'Axiom\\Modele\\'     => __DIR__ . '/../MODELE/',
    ];

    foreach ($prefixes as $prefix => $dir) {
        if (str_starts_with($class, $prefix)) {
            // Retire le préfixe du namespace pour obtenir le nom de fichier.
            $file = $dir . substr($class, strlen($prefix)) . '.php';
            if (file_exists($file)) {
                require $file;
            }
            return;
        }
    }
});
