<?php
namespace Axiom\Controleur;

// Contrôleur de la page d'inscription (étape 1 du tunnel de commande).
// Aucune interaction avec la BDD : la page affiche uniquement un formulaire statique
// dont l'action pointe vers /facturation.
class InscriptionControleur extends Controleur {
    public function index(): void {
        $this->render('inscription');
    }
}
