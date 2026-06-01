<?php
spl_autoload_register(function (string $class): void {
    $prefixes = [
        'Axiom\\Controleur\\' => __DIR__ . '/../CONTROLEUR/',
        'Axiom\\Modele\\'     => __DIR__ . '/../MODELE/',
    ];

    foreach ($prefixes as $prefix => $dir) {
        if (str_starts_with($class, $prefix)) {
            $file = $dir . substr($class, strlen($prefix)) . '.php';
            if (file_exists($file)) {
                require $file;
            }
            return;
        }
    }
});
