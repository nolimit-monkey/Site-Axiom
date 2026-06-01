<?php
namespace Axiom\Controleur;

// Classe de base dont héritent tous les contrôleurs.
// Elle centralise l'unique mécanisme commun : le rendu d'une vue.
abstract class Controleur {
    // Charge un fichier de vue en lui injectant les données sous forme de variables locales.
    // extract() transforme chaque clé du tableau $donnees en variable PHP du même nom,
    // disponible directement dans le fichier de vue inclus.
    // Ex : render('produit', ['prix' => 49.9]) → $prix est accessible dans produit.php.
    protected function render(string $vue, array $donnees = []): void {
        extract($donnees);
        require __DIR__ . '/../VUE/' . $vue . '.php';
    }
}
