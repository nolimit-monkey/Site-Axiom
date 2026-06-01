<?php
// Point d'entrée unique de l'application.
// Toutes les requêtes HTTP sont redirigées ici par le .htaccess (mod_rewrite).
require_once __DIR__ . '/config/config.php';   // Constantes globales (BASE_URL)
require_once __DIR__ . '/config/database.php'; // Connexion PDO ($pdo)
require_once __DIR__ . '/config/autoload.php'; // Chargement automatique des classes

use Axiom\Controleur\AccueilControleur;
use Axiom\Controleur\ProduitControleur;
use Axiom\Controleur\PanierControleur;
use Axiom\Controleur\InscriptionControleur;
use Axiom\Controleur\FacturationControleur;
use Axiom\Controleur\PaiementControleur;
use Axiom\Controleur\ConfirmationControleur;

// Extraction du chemin relatif depuis l'URL complète.
// substr() retire le préfixe du sous-dossier (ex. /axiom) pour ne garder
// que la partie significative (ex. /produit, /panier...).
$uri      = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$basePath = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
$path     = '/' . ltrim(substr($uri, strlen($basePath)), '/');

// Routeur : instancie le contrôleur correspondant au chemin demandé.
// rtrim supprime un éventuel slash final (/panier/ → /panier).
// Le fallback ?: '/' gère la racine quand le chemin est vide.
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
        // Pas de PDO : ce contrôleur ne fait qu'afficher un formulaire statique.
        (new InscriptionControleur())->index();
        break;
    case '/facturation':
        // Idem : page de formulaire, pas d'accès BDD.
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
