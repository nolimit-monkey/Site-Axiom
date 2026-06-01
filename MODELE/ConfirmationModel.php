<?php
namespace Axiom\Modele;

// Modèle de la page de confirmation.
// Reprend la logique de PaiementModel et y ajoute le moyen de paiement
// ainsi que la génération d'une référence de commande unique.
class ConfirmationModel {
    private \PDO $pdo;

    // Libellés affichés pour chaque mode de livraison.
    private array $deliveryLabels = [
        'standard' => 'Standard (3 a 5 jours)',
        'express'  => 'Express (24h a 48h)',
        'pickup'   => 'Retrait en magasin',
    ];

    // Frais de port associés à chaque mode de livraison (en euros).
    private array $deliveryPrices = [
        'standard' => 7.90,
        'express'  => 14.90,
        'pickup'   => 0.00,
    ];

    // Libellés affichés pour chaque moyen de paiement.
    private array $paymentLabels = [
        'card'   => 'Carte bancaire',
        'paypal' => 'PayPal',
        'wallet' => 'Apple Pay / Google Pay',
    ];

    public function __construct(\PDO $pdo) {
        $this->pdo = $pdo;
    }

    // Construit toutes les données de la page de confirmation.
    // Identique à PaiementModel::getOrderSummary mais ajoute paymentLabel et reference.
    public function getConfirmationData(array $cartSession, ?string $deliveryMode, ?string $paymentMethod): array {
        $deliveryLabel  = $this->deliveryLabels[$deliveryMode] ?? 'Non selectionne';
        $shippingAmount = $this->deliveryPrices[$deliveryMode] ?? 0.00;
        $paymentLabel   = $this->paymentLabels[$paymentMethod] ?? 'Non selectionne';

        // Assainissement du panier (même logique que PanierModel et PaiementModel).
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

        // Génération d'une référence unique de commande : préfixe + date + 6 caractères aléatoires.
        // Ex : AXM-20260601-A3F9C2
        $reference = 'AXM-' . date('Ymd') . '-' . strtoupper(substr(md5((string) microtime(true)), 0, 6));

        return [
            'deliveryLabel'  => $deliveryLabel,
            'shippingAmount' => $shippingAmount,
            'paymentLabel'   => $paymentLabel,
            'cartItems'      => $cartItems,
            'subtotal'       => $subtotal,
            'grandTotal'     => $subtotal + $shippingAmount,
            'reference'      => $reference,
        ];
    }
}
