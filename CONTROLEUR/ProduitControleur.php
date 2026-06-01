<?php
namespace Axiom\Controleur;

use Axiom\Modele\ProduitModel;

// Contrôleur de la page détail produit.
// Gère deux cas selon la méthode HTTP :
//   GET  → affiche la fiche produit identifiée par ?id=
//   POST → traite "Ajouter au panier", puis redirige vers /panier
class ProduitControleur extends Controleur {
    private ProduitModel $model;

    public function __construct(\PDO $pdo) {
        $this->model = new ProduitModel($pdo);
    }

    public function index(): void {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Lecture de l'identifiant produit depuis la query string (?id=X).
        // FILTER_VALIDATE_INT retourne false si la valeur n'est pas un entier valide.
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        // Bloc POST : le formulaire "Ajouter au panier" soumet product_id.
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $postedId = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
            if ($postedId) {
                // Initialisation du panier en session si inexistant.
                if (!isset($_SESSION['panier']) || !is_array($_SESSION['panier'])) {
                    $_SESSION['panier'] = [];
                }
                // Initialisation du compteur pour ce produit s'il n'est pas encore dans le panier.
                if (!isset($_SESSION['panier'][$postedId])) {
                    $_SESSION['panier'][$postedId] = 0;
                }
                // Incrémentation de la quantité et redirection immédiate.
                $_SESSION['panier'][$postedId] += 1;
                header('Location: ' . BASE_URL . 'panier');
                exit;
            }
        }

        // Bloc GET : chargement du produit depuis la BDD.
        $produit = $id ? $this->model->findById($id) : null;

        // Produit introuvable : on retourne un 404 mais on affiche quand même la vue
        // avec des valeurs par défaut (pas de page d'erreur séparée).
        if (!$produit) {
            http_response_code(404);
        }

        $nom         = $produit['nom'] ?? "Produit introuvable";
        $description = $produit['description'] ?? "Ce produit n'existe pas.";
        $prix        = $produit['prix'] ?? null;
        $imageUrl    = $produit['image_url'] ?? null;
        // Fallback sur le logo si aucune image n'est définie pour le produit.
        $imageFile   = $imageUrl ?: "logo_axiom.png";
        $imageSrc    = BASE_URL . "public/" . htmlspecialchars($imageFile);
        $title       = $nom ?: "Produit";

        $this->render('produit', [
            'produit'     => $produit,
            'nom'         => $nom,
            'description' => $description,
            'prix'        => $prix,
            'imageUrl'    => $imageUrl,
            'imageSrc'    => $imageSrc,
            'title'       => $title,
        ]);
    }
}
