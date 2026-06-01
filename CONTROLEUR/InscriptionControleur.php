<?php
namespace Axiom\Controleur;

class InscriptionControleur extends Controleur {
    public function index(): void {
        $this->render('inscription');
    }
}
