<?php
namespace Axiom\Controleur;

use Axiom\Modele\ProduitModel;

class ProduitControleur extends Controleur {
    private ProduitModel $model;

    public function __construct(\PDO $pdo) {
        $this->model = new ProduitModel($pdo);
    }

    public function index(): void {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $postedId = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
            if ($postedId) {
                if (!isset($_SESSION['panier']) || !is_array($_SESSION['panier'])) {
                    $_SESSION['panier'] = [];
                }
                if (!isset($_SESSION['panier'][$postedId])) {
                    $_SESSION['panier'][$postedId] = 0;
                }
                $_SESSION['panier'][$postedId] += 1;
                header('Location: ' . BASE_URL . 'panier');
                exit;
            }
        }

        $produit = $id ? $this->model->findById($id) : null;

        if (!$produit) {
            http_response_code(404);
        }

        $nom         = $produit['nom'] ?? "Produit introuvable";
        $description = $produit['description'] ?? "Ce produit n'existe pas.";
        $prix        = $produit['prix'] ?? null;
        $imageUrl    = $produit['image_url'] ?? null;
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
