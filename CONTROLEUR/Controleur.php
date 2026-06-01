<?php
namespace Axiom\Controleur;

abstract class Controleur {
    protected function render(string $vue, array $donnees = []): void {
        extract($donnees);
        require __DIR__ . '/../VUE/' . $vue . '.php';
    }
}
