<?php
namespace Axiom\Controleur;

// Contrôleur de la page de facturation (étape 2 du tunnel de commande).
// Aucune interaction avec la BDD : la page affiche le choix du mode de livraison.
// Le delivery_mode sélectionné est transmis en POST vers /paiement.
class FacturationControleur extends Controleur {
    public function index(): void {
        $this->render('facturation');
    }
}
