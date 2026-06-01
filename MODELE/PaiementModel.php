<?php
namespace Axiom\Modele;

// Modèle de la page paiement.
// Calcule le récapitulatif de commande : articles, frais de livraison et total.
class PaiementModel {
    private \PDO $pdo;

    // Table de correspondance mode de livraison → libellé affiché.
    private array $deliveryLabels = [
        'standard' => 'Standard (3 a 5 jours)',
        'express'  => 'Express (24h a 48h)',
        'pickup'   => 'Retrait en magasin',
    ];

    // Table de correspondance mode de livraison → montant des frais (en euros).
    private array $deliveryPrices = [
        'standard' => 7.90,
        'express'  => 14.90,
        'pickup'   => 0.00,
    ];

    public function __construct(\PDO $pdo) {
        $this->pdo = $pdo;
    }

    // Construit le récapitulatif complet à partir du panier en session et du mode de livraison.
    // Retourne un tableau avec libellés, frais, articles enrichis depuis la BDD et totaux.
    public function getOrderSummary(array $cartSession, ?string $deliveryMode): array {
        // Résolution du libellé et du montant depuis les tables ci-dessus.
        // Si le mode est inconnu (null ou valeur inattendue), on utilise des valeurs par défaut.
        $deliveryLabel  = $this->deliveryLabels[$deliveryMode] ?? 'Non selectionne';
        $shippingAmount = $this->deliveryPrices[$deliveryMode] ?? 0.00;

        // Assainissement du panier (même logique que PanierModel).
        $cart = [];
        foreach ($cartSession as $productId => $quantity) {
            $cleanProductId = filter_var($productId, FILTER_VALIDATE_INT);
            $cleanQuantity  = filter_var($quantity, FILTER_VALIDATE_INT);
            if ($cleanProductId && $cleanQuantity && $cleanQuantity > 0) {
                $cart[$cleanProductId] = $cleanQuantity;
            }
        }

        $cartItems = [];
        $subtotal  = 0.0;

        if ($cart !== []) {
            $ids          = array_keys($cart);
            $placeholders = implode(',', array_fill(0, count($ids), '?'));

            $stmt = $this->pdo->prepare("
                SELECT id, nom, prix
                FROM produits
                WHERE id IN ($placeholders)
            ");
            $stmt->execute($ids);
            $produits = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            foreach ($produits as $produit) {
                $productId = (int) $produit['id'];
                $quantity  = $cart[$productId] ?? 0;
                if ($quantity < 1) continue;

                $unitPrice = (float) $produit['prix'];
                $lineTotal = $unitPrice * $quantity;
                $subtotal += $lineTotal;

                $cartItems[] = [
                    'nom'        => $produit['nom'],
                    'quantity'   => $quantity,
                    'line_total' => $lineTotal,
                ];
            }
        }

        return [
            'deliveryMode'   => $deliveryMode,
            'deliveryLabel'  => $deliveryLabel,
            'shippingAmount' => $shippingAmount,
            'cartItems'      => $cartItems,
            'subtotal'       => $subtotal,
            // grandTotal = sous-total articles + frais de livraison
            'grandTotal'     => $subtotal + $shippingAmount,
        ];
    }
}
