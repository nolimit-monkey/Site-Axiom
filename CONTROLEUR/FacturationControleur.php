<?php
namespace Axiom\Controleur;

class FacturationControleur extends Controleur {
    public function index(): void {
        $this->render('facturation');
    }
}
