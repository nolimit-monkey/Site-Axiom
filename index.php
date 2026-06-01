<?php
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/config/autoload.php';

use Axiom\Controleur\AccueilControleur;
use Axiom\Controleur\ProduitControleur;
use Axiom\Controleur\PanierControleur;
use Axiom\Controleur\InscriptionControleur;
use Axiom\Controleur\FacturationControleur;
use Axiom\Controleur\PaiementControleur;
use Axiom\Controleur\ConfirmationControleur;

$uri      = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$basePath = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
$path     = '/' . ltrim(substr($uri, strlen($basePath)), '/');

switch (rtrim($path, '/') ?: '/') {
    case '/':
        (new AccueilControleur($pdo))->index();
        break;
    case '/produit':
        (new ProduitControleur($pdo))->index();
        break;
    case '/panier':
        (new PanierControleur($pdo))->index();
        break;
    case '/inscription':
        (new InscriptionControleur())->index();
        break;
    case '/facturation':
        (new FacturationControleur())->index();
        break;
    case '/paiement':
        (new PaiementControleur($pdo))->index();
        break;
    case '/confirmation':
        (new ConfirmationControleur($pdo))->index();
        break;
    default:
        http_response_code(404);
        require __DIR__ . '/VUE/404.php';
}
